<?php

namespace App\Http\Controllers\User;

use App\Model\IssueHdrModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class IssueController extends Controller
{
    public static function showForm() {
        $view = view('pages.user.main_issue');
        $data = IssueHdrModel::all();
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
        }
        $view->with('item', $item);
        return $view;
    }
}
