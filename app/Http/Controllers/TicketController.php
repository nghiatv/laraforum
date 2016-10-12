<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Http\Requests;
use App\Http\Requests\TicketRequest;
class TicketController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'create']);

    }
    public function create(TicketRequest $request){


        $ticket = new Ticket();


        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->content = $request->input('content');

        $ticket->save();
        alert()->success('Success!', 'Gửi phản hồi thành công nhé!!');
        return redirect('/');



    }
}
