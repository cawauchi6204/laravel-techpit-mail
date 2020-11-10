<?php

namespace App\Http\Controllers;

use App\Http\Requests\InquiryRequest;
use App\Mail\InquiryMail;
use App\Models\Inquiry;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        
        if(is_null($sessionData)) {
            return redirect(route('index'));
        }
        $message = view('emails.inquiry',$sessionData);
        return view('confirm',['message' => $message]);
    }
    
    public function postConfirm(Request $request)
    {
        $sessionData = $request->session()->get('inquiry');
        
        if(is_null($sessionData)) {
            return redirect(route('index'));
        }
        
        $request->session()->forget('inquiry');
        
        Inquiry::create($sessionData);
        
        Mail::to($sessionData['email'])
        ->send(new InquiryMail($sessionData));
        return redirect(route('sent'))->with('sent_inquiry',true);
        // メール送信後の処理で、次の1回のみ有効なセッションデータ
        // (フラッシュデータとも言います)を渡すことのできるwithメソッド
    }
    
    public function showSentMessage(Request $request)
    {
        $request->session()->keep('sent_inquiry');
        $sessionData = $request->session()->get('sent_inquiry');
        if(is_null($sessionData)) {
            return redirect(route('index'));
        }
        return view('sent');
    }
}
