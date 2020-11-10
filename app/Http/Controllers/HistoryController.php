<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function show() 
    {
        $inquiries = Inquiry::orderBy('id','desc')->paginate(10);
        return view('history',['inquiries' => $inquiries]);
    }
}
