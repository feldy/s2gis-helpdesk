<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IssueController extends Controller
{
    public static function showForm() {
        $view = view('pages.user.main_issue');
        return $view;
    }

    public static function showCreateIssues() {
        $view = view('pages.user.create_issue');
        return $view;
    }

    public static function showViewIssues() {
        $view = view('pages.user.view_issue');
        return $view;
    }
}
