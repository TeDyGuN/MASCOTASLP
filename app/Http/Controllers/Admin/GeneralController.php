<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GeneralController extends Controller{
    public function index()
    {
        return view('Admin/index');
    }
}