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
    // バリデーションを通過したデータを保存しています。
    {
        $validated = $request->validated();
        // フォームリクエストクラスのsessionメソッドで、セッションの読み書きをするためのオブジェクトを取得することが出来ます。
        // ここではputメソッドを使って、「inquiry」という名前でバリデーション後の入力値を保存しています。
        $request->session()->put('inquiry',$validated);
        // Laravelではフォームリクエストクラス(InquiryRequest)のvalidatedメソッドを使って
        // 配列形式でバリデーション通過後のデータを取得することが出来ます。
        return redirect(route('confirm'));
        // 続くreturnの部分ではLaravelのredirect関数を利用して、リダイレクトを行っています。
        // 引数はURLとなりますので、route関数を利用してURL生成を行っています。
    }
    
    public function showConfirm(Request $request)
    {
        // dd($request->session()->get('inquiry'));
        $sessionData = $request->session()->get('inquiry');
        $message = view('emails.inquiry',$sessionData);
        return view('confirm',['message' => $message]);
    }
    
    public function postConfirm(Request $request)
    {
        return redirect(route('sent'));
    }
    
    public function showSentMessage()
    {
        return view('sent');
    }
}
