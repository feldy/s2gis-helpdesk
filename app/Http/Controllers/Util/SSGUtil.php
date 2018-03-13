<?php

namespace App\Http\Controllers\Util;

use App\Model\IssueDtlModel;
use App\Model\PICModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class SSGUtil extends Controller
{
    public static function info($param = null) {
        $item = new \stdClass();
        $item->is_employee = true;
        $item->username_id = Cookie::get('username_sid');
        $item->username = Cookie::get('user_real_name');
        $item->bu_display = 'BU: '.Cookie::get('bu_display');

        $username_sid = Cookie::get('username_sid');
        $data = PICModel::where('user_id', $username_sid)->first();
        if (!empty($data)) {
            $item->is_employee = false;
            $item->pic_id = $data->id;
            $item->username = $data->name;
            $item->bu_display = $data->type;
        }

        if (empty($param)) {
            return $item;
        } else {
            return $item->$param;
        }
    }

    public static function prosesUploadDokumen(Request $request, $id, $name, $path, $isMultiple = false) {
        $file = $request->file($name);
        if ($file) {
//            dd($file);
            if ($isMultiple) {
                $idx = 1;
                foreach ($file as $item) {
                    $ext = '.'.$item->extension();

                    //delete dahulu file sebelumnya
//                    UtilController::prosesDeletePreviousFile($path."/".$id."_".$idx);

                    $upload_path = $item->storeAs($path, $id."_".$idx.$ext);
                    $idx++;
                }
            } else {
                //generate extension
                $ext = '.'.$file->extension();

                //delete dahulu file sebelumnya
//                UtilController::prosesDeletePreviousFile($path."/".$id);

                //upload file
                $upload_path = $file->storeAs($path, $id.$ext);
            }

        }
    }

    public static function getNotification() {
        $info = SSGUtil::info();

        $data = DB::table('hd_issue_dtl')
            ->join('hd_issue_hdr', 'hd_issue_hdr.id', '=', 'hd_issue_dtl.issue_id')
            ->select(
                DB::raw('count(hd_issue_dtl.id) as jumlah_notif'),
                'hd_issue_dtl.sender_name',
                'hd_issue_dtl.created_at',
                'hd_issue_hdr.form_name',
                'hd_issue_dtl.keterangan',
                DB::raw('hd_issue_hdr.status as status_issue'),
                DB::raw('hd_issue_hdr.id as id_hdr'),
                DB::raw('(select dtl.keterangan as keterangan_final from hd_issue_dtl dtl where dtl.issue_id = hd_issue_hdr.id order by dtl.created_at desc LIMIT 1) as keterangan_final')
            )
            ->where('is_read', false)
            ->where('sender_id', '<>', $info->username_id)
            ->orderBy('hd_issue_hdr.updated_at', 'desc')
            ->groupBy('hd_issue_dtl.issue_id')
        ;

        if ($info->is_employee) {
            $data->where('hd_issue_hdr.user_id', $info->username_id);
        } else {
            $data->join('hd_pic', 'hd_pic.id', '=', 'hd_issue_hdr.pic_id');
            $data->where('hd_pic.user_id', $info->username_id);
        }
        return $data->get();
    }
}
