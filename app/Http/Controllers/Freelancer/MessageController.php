<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;




class MessageController extends Controller
{
    public function index($receiver_id){
        $receiver = User::findOrFail($receiver_id);

        $all_users = User::where('id', '!=', Auth::user()->id)
                            ->where(function($query){
                                $query->whereHas('sentMessages', function($subQuery){
                                    $subQuery->where('receiver_id', Auth::user()->id);
                                })->orWhereHas('receiveMessages', function($subQuery){
                                    $subQuery->where('sender_id', Auth::user()->id);
                                });
                            })->get();

        // $messages = Message::where(function($query) use ($receiver_id){
        //     $query->where('sender_id', Auth::user()->id)
        //             ->where('receiver_id', $receiver_id);
        //     })->orWhere(function($query) use ($receiver_id){
        //         $query->where('sender_id', $receiver_id)
        //             ->where('receiver_id', Auth::user()->id);
        //     })->get();
        $messages = Message::whereIn('sender_id', [Auth::user()->id, $receiver_id])
                    ->whereIn('receiver_id', [Auth::user()->id, $receiver_id])
                    ->get();

        return view('freelancers.messages.index', compact('all_users', 'messages', 'receiver'));
    }

    public function store(MessageRequest $request){
        Message::create([
            'sender_id'   => Auth::user()->id,
            'receiver_id' => $request->receiver_id,
            'content'     => $request->content
        ]);

        return redirect()->back();
    }
}
