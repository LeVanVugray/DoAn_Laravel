<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExeController extends Controller
{
    //
    public function indexexe(){
        return view('EXE1.index');
    }
    public function loginexe(){
        return view('EXE1.login');
    }
    public function listexe(){
        return view('EXE1.list');
    }
    public function registerexe(){
        return view('EXE1.register');
    }
    public function updateexe(){
        return view('EXE1.update');
    }
    public function viewexe(){
        return view('EXE1.view');
    }
}
