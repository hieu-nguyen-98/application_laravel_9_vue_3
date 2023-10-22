<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TablePriceController extends Controller
{
    public function index(){
        return view('user.table-price.index');
    }
}
