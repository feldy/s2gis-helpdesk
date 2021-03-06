<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Util\SSGUtil;
use App\Model\IssueDtlModel;
use App\Model\IssueHdrModel;
use App\Model\PICModel;
use App\Model\SCMasFormModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use phpDocumentor\Reflection\Types\Integer;
use Ramsey\Uuid\Uuid;

class IssueController extends Controller
{
    public static function showMainForm() {
        $view = view('pages.main_menu');
        if(!SSGUtil::info('is_employee')) {
            $view->with('count_issue', DB::table('hd_issue_hdr')->where('pic_id', SSGUtil::info('pic_id'))->count());
            $view->with('count_resolved', DB::table('hd_issue_hdr')->where('pic_id', SSGUtil::info('pic_id'))->where('status', 'RESOLVED')->groupBy('status')->count());
            $view->with('count_puas', DB::table('hd_issue_hdr')->where('pic_id', SSGUtil::info('pic_id'))->where('ratting', 1)->groupBy('ratting')->count());
            $view->with('count_tidak_puas', DB::table('hd_issue_hdr')->where('pic_id', SSGUtil::info('pic_id'))->where('ratting', -1)->groupBy('ratting')->count());
        }

        return $view;
    }

    public static function getFormName($formID) {
        return SCMasFormModel::find($formID)->name;
    }

    public static function showForm() {
        $view = view('pages.user.main_issue');
        $data = IssueHdrModel::orderBy('created_at', 'desc');

        $util = SSGUtil::info();
        if ($util->is_employee) {
            $data->where('user_id', Cookie::get('username_sid'));
        } else {
            $data->where('pic_id', $util->pic_id);
        }

        $status = Input::get('status');
        if (!empty($status)) {$data->where('status', $status);}

        $type = Input::get('type');
        if (!empty($type)) {$data->where('type', $type);}

        $search = Input::get('search');
        if (!empty($search)) {
            $data->where(function ($query) {
                $search  = Input::get('search');
                $query->where('nomor_issue',"like", "%". $search ."%")
                    ->orWhere('subject',"like", "%". $search ."%")
                    ->orWhere('form_name',"like", "%". $search ."%");
            });
        }


        $data = $data->paginate(10); //pake pagging
//        foreach ($data as $item) { //sudah ditaro di table
//            $item->form_name = IssueController::getFormName($item->form_id);
//        }
        $view->with('items', $data);
        return $view;
    }

    public static function showCreateIssues() {
        $view = view('pages.user.create_issue');
        return $view;
    }

    public static function showViewIssues() {
        $view = view('pages.user.view_issue');
        $item = new \stdClass();
        $idHeader= Input::get('idHeader');
        $item = IssueHdrModel::find($idHeader);
        if (empty($idHeader) || empty($item)) {
            return redirect('/issues');
        }

        $item->form_name = IssueController::getFormName($item->form_id);
        $item->details = $item->details()->orderBy('created_at')->get();
        foreach ($item->details as $dtl) {
            //proses update
            if (SSGUtil::info('username_id') != $dtl->sender_id) {
                $dtl->is_read = true;
                $dtl->save();
            }

            //get informasi file upload kalau ada
            $dtl->images = glob('storage/uploads/'.$dtl->id.'_*');
        }

        $view->with('item', $item);


        return $view;

    }

    public function formAPI() {
        $label = Input::get('value');
        $data = DB::connection('db-sales')
            ->table('sc_mas_form as form')
            ->select(
                DB::raw('form.sid as form_id'),
                DB::raw('form.name as form_name'),
                DB::raw('form.pic as form_pic')
            )
            ->where('form.name', 'like', '%'.$label.'%')
            ->orderBy('form.name')
            ->limit(10)
            ->get()
        ;

        return json_encode($data);
    }

    public function save(Request $request) {

        $this->validate($request, [
            'form_id' => 'required'
        ]);
//        dd(glob(storage_path('app/uploads/*')));
//        dd($request);

        return DB::transaction(function($mysql) use ($request) {
            $obj = new IssueHdrModel();
            if ($request->id) {
                $obj = IssueHdrModel::find($request->id);
            } else {
                $obj->id = Uuid::uuid4()->toString();
            }
            $form = SCMasFormModel::find($request->form_id); //get formID
            $pic = PICModel::where('initial_name', $form->pic)->first();
            $dataLastNumber = DB::table('hd_issue_hdr')->orderByRaw('CONVERT(nomor_issue, UNSIGNED) desc')->take(1)->first();
//            dd($dataLastNumber);
            if (empty($dataLastNumber)) {
                $lastNumber = 1;
            } else {
                $lastNumber = ((int) $dataLastNumber->nomor_issue) + 1;
            }

            $obj->subject       = $request->subject;
            $obj->user_id       = Cookie::get('username_sid');
            $obj->form_id       = $form->sid;
            $obj->form_name     = $form->name;
            $obj->pic_id        = $pic->id;
            $obj->nomor_issue   = $lastNumber;
            $obj->type          = 'ISSUE';
            $obj->status        = 'OPEN';
            //cek apakah ada uploadan atau tidak
            if (!empty($request->file('attachment'))) {
                $obj->is_uploaded = true;
            }

//            dd($obj);
            $obj->save();

            //save Detail
            $this->saveDetail($request, $obj, $obj->user_id);

            return redirect()->route('user.main_issue')
                ->with('success','Data Berhasil di Simpan. Nomor Issue: '.$obj->nomor_issue);
        });
    }

    private function saveDetail(Request $request, IssueHdrModel $obj, $senderID) {
        $dtl = new IssueDtlModel();

        $dtl->id = Uuid::uuid4()->toString();
        $dtl->issue_id = $obj->id;
        $dtl->sender_id = $senderID;
        $dtl->sender_name = SSGUtil::info('username');
//        $dtl->receiver_id = $receiverID;
        $dtl->keterangan = $request->keterangan;
//        dd($dtl);

        //upload doc
        SSGUtil::prosesUploadDokumen($request, $dtl->id, 'attachment', '/public/uploads/', true);
        $dtl->save();
    }

    public function updateIssue(Request $request) {
        return DB::transaction(function($mysql) use ($request) {
            if (!empty($request->id_hdr)) {
                $obj = IssueHdrModel::find($request->id_hdr);
                switch ($request->btnsubmit) {
                    case 'save':
                        $this->saveDetail($request, $obj, SSGUtil::info('username_id'));
                        return redirect('/view-issue?idHeader='.$obj->id);
                        break;
                    case 'resolved':
                        $request->keterangan = 'Issue Telah di Resolved !';
                        $this->saveDetail($request, $obj, SSGUtil::info('username_id'));
                        $obj->status = 'RESOLVED';
                        $obj->save();

                        return redirect()->route('user.main_issue')->with('success','Data Berhasil di Update');
                        break;
                    case 'ratting':
                        if ($obj->status == 'CLOSED') {
                            return redirect()->route('user.main_issue')->with('error','Maaf ! Data tidak bisa diproses karna sudah terjadi perubahan status.');
                        }

                        if ($request->rdRatting < 0) { //TIDAK PUAS
                            $request->keterangan = 'Issue Telah di Closed, mendapatkan Ratting: <strong>TIDAK PUAS</strong>. <br />Keterangan: '.$request->keterangan;
                        } else if ($request->rdRatting > 0) { //PUAS
                            $request->keterangan = 'Issue Telah di Closed, mendapatkan Ratting: <strong>PUAS</strong>.';
                        } else { //CUKUP
                            $request->keterangan = 'Issue Telah di Closed, mendapatkan Ratting: <strong>CUKUP</strong>.';
                        }

                        $this->saveDetail($request, $obj, SSGUtil::info('username_id'));
                        $obj->status = 'CLOSED';
                        $obj->ratting = $request->rdRatting;
                        $obj->save();

                        return redirect()->route('user.main_issue')->with('success','Terima Kasih Telah Memberikan Ratting.');
                        break;
                }
            }
        });
    }
}
