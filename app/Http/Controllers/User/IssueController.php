<?php

namespace App\Http\Controllers\User;

use App\Model\IssueDtlModel;
use App\Model\IssueHdrModel;
use App\Model\PICModel;
use App\Model\SCMasFormModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Ramsey\Uuid\Uuid;

class IssueController extends Controller
{
    public static function getFormName($formID) {
        return SCMasFormModel::find($formID)->name;
    }

    public static function showForm() {
        $view = view('pages.user.main_issue');
        $data = IssueHdrModel::where('user_id', Cookie::get('username_sid'))->orderBy('created_at', 'desc');

        $status = Input::get('status');
        if (!empty($status)) {
            $data->where('status', $status);
        }

        $type = Input::get('type');
        if (!empty($type)) {
            $data->where('type', $type);
        }

//        $search = Input::get('search');
//        if (!empty($type)) {
//            $data->where('type', $type);
//        }


        $data = $data->paginate(10); //pake paginate
        foreach ($data as $item) {
            $item->form_name = IssueController::getFormName($item->form_id);
        }
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
        if ($idHeader) {
            $item = IssueHdrModel::find($idHeader);
            $item->form_name = IssueController::getFormName($item->form_id);
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
        return DB::transaction(function($mysql) use ($request) {
            $obj = new IssueHdrModel();
            if ($request->id) {
                $obj = IssueHdrModel::find($request->id);
            } else {
                $obj->id = Uuid::uuid4()->toString();
            }
            $form = SCMasFormModel::find($request->form_id); //get formID
            $pic = PICModel::where('initial_name', $form->pic)->first();
            $lastNumber = DB::table('hd_issue_hdr')->increment('nomor_issue');

            $obj->subject       = $request->subject;
            $obj->user_id       = Cookie::get('username_sid');
            $obj->form_id       = $form->sid;
            $obj->pic_id        = $pic->id;
            $obj->nomor_issue   = $lastNumber+1;
            $obj->type          = 'ISSUE';
            $obj->status        = 'OPEN';

            dd($obj);
            $obj->save();

            //save Detail
            $this->saveDetail($request, $obj, $pic);

            return redirect()->route('user.main_issue')
                ->with('success','Data Berhasil di Simpan. Nomor Issue: <strong'.$obj->nomor_issue.'></strong>');
        });
    }

    private function saveDetail(Request $request, IssueHdrModel $obj, PICModel $pic) {
        $dtl = new IssueDtlModel();

        $dtl->id = Uuid::uuid4()->toString();
        $dtl->issue_id = $obj->id;
        $dtl->sender_id = $obj->user_id;
        $dtl->receiver_id = $pic->user_id;
        $dtl->keterangan = $request->keterangan;
//        dd($dtl);
        $dtl->save();
    }
}
