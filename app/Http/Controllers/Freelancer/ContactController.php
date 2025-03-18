<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;



class ContactController extends Controller
{
    public function index(){
        return view('freelancers.contact.form');
    }

    public function sendMail(ContactRequest $request){
        $emailContent = "
        <p>You have receive a new inquiry.</p>
        <p><strong>Name: </strong>$request->name</p>
        <p><strong>Email: </strong>" . Auth::user()->email . "</p>
        <p><strong>Title: </strong> $request->title</p>
        <p><strong>Message: </strong>" . nl2br(e($request->content)) . "</p>
        ";

        $email = Auth::user()->email;

        Mail::send([], [], function($message) use ($request, $emailContent, $email){
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
        return redirect()->route('freelancer.contact')->with('success', 'Your inquiry has been sent successfully.');
    }
}
