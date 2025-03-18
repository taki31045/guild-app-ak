<?php

namespace App\Http\Controllers\Company\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    //adminとcontactを取るためのpageに移動するだけもの
    public function contact(){
        return view('companies.contact.to_admin');
    }

//adminへのコンタクトはgmailを使用する。そのためのfunction
    public function sendMail(ContactRequest $request){
        $email = Auth::user()->email;
        $emailContent = "
        <p>You have receive a new inquiry.</p>
        <p><strong>Name: </strong>$request->name</p>
        <p><strong>Email: </strong>" . Auth::user()->email . "</p>
        <p><strong>Title: </strong> $request->title</p>
        <p><strong>Message: </strong>" . nl2br(e($request->content)) . "</p>
        ";
        Mail::send([], [], function($message) use ($request, $emailContent,$email){
            $message->from($email, $request->name)
                    ->to('guild20250106@gmail.com')
                    ->replyTo($email, $request->name)
                    ->subject('New Inquiry: ' . $request->title)
                    ->html($emailContent);
            if($request->hasFile('attachment')){
                $file = $request->file('attachment');
                $message->attach($file->getRealPath(), [
                    'as'   => $file->getClientOriginalName(),
                    'mime' => $file->getMimeType()
                ]);
            }
        });
        return redirect()->route('company.contact.contact')->with('success', 'Your inquiry has been sent successfully.');
    }
}
