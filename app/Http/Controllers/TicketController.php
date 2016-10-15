<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\Http\Requests;
use App\Http\Requests\TicketRequest;
use Illuminate\Support\Facades\Auth;
class TicketController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth','role:admin'], ['except' => 'store']);
//        $this->middleware('role:admin',)

    }
    public function store(TicketRequest $request){


        $ticket = new Ticket();


        $ticket->name = $request->name;
        $ticket->email = $request->email;
        $ticket->content = $request->input('content');

        $ticket->save();
        alert()->success('Success!', 'Gửi phản hồi thành công nhé!!');
        return redirect('/');



    }

    public function index(){


        $data = Ticket::all();
        return view('tickets.list',compact('data'));
    }
}
