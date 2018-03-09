<?php

namespace App\Http\Controllers\Util;

use App\Model\PICModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

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
}
