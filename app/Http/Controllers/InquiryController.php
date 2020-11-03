<?php

namespace App\Http\Controllers;

use App\Http\Requests\InquiryRequest;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function index()
    {
        return view('index');
    }
    
    // 引数として先程作成したInquiryRequestクラスを渡していますが、このように記述することで
    // postInquiryメソッドの実行前にInquiryRequestクラスのバリデーションが実行されます。
    public function postInquiry(InquiryRequest $request)
    {
        return view('template');
    }
}
