<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    protected $view_dir = 'admins.build_admin.';

    public function index() {
        return view($this->view_dir.'dashboard.index');
    }
}
