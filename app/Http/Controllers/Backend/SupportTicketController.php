<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ReplyRequest;
use App\Http\Requests\Backend\SupportAddRequest;
use App\Mail\TicketClosedMail;
use App\Mail\TicketCreatedMail;
use App\Models\SupportReply;
use App\Models\SupportTicket;
use App\Models\SupportTicketStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SupportTicketController extends Controller
{
    public function index(Request $request){
        $user = auth()->user();
        $userType = $user->user_type ?? null;
        $tickets = SupportTicket::with('statuses','creator:id,name')->orderBy('id','desc');
        if($userType !=0){
            $tickets->where('created_by', $user->id);
        }
        $tickets = $tickets->get();
        //dd($tickets);
        return view('backend.pages.support_ticket.index',compact('tickets'));
    }

    public function add(Request $request){
        return view("backend.pages.support_ticket.add");
    }

    public function store(SupportAddRequest $request){
        try{
            DB::transaction(function () use ($request) {
                $support = SupportTicket::create([
                    'issue_details' => $request->input('issue'),
                    'current_status' => 1,
                    'created_by' => auth()->id(),
                ]);
                SupportTicketStatus::create([
                    'support_ticket_id' => $support->id,
                    'status' => 1,
                ]);
                $adminMail = User::select('email')->where('user_type',0)->first();
                Mail::to($adminMail)->send(new TicketCreatedMail($support));
            });
            return redirect()->route('ticket.index')->with('message','Support ticket created successfully!');
        }
        catch (\Exception $e){
            return redirect()->back()->with('error','!opps something wrong');
        }
    }

    public function details(Request $request, $id){
        $support = SupportTicket::with(['replies', 'creator:id,name',
            'statuses' => function ($query) {
                $query->latest('created_at');
            }
        ])->find($id);

        return view('backend.pages.support_ticket.details',compact('support'));
    }

    public function reply(ReplyRequest $request, $id){
        try{
            $reply = SupportReply::create([
                'support_ticket_id' =>  $id,
                'reply' =>  $request->input('reply'),
                'created_by' =>  auth()->user()->id,
            ]);
            if($reply){
                return redirect()->back()->with('message','Reply successfully!');
            }
            else{
                return redirect()->back()->with('error','!opps something wrong');
            }
        }
        catch (\Exception $e){
            return redirect()->back()->with('error','!opps something wrong');
        }
    }

    public function ticketClose(Request $request){
        try {
            //check user
            $userType = auth()->user()->user_type;
            if($userType !=0) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You dont have  permission to close a ticket'
                ]);
            }
            $ticket = SupportTicket::findOrFail($request->ticket_id);
            $ticket->current_status = 0;
            $ticket->save();
            SupportTicketStatus::create([
                'support_ticket_id' => $ticket->id,
                'status' => 0,
            ]);
            Mail::to($ticket->creator->email)->send(new TicketClosedMail($ticket));
            return response()->json([
                'status' => 'success',
                'message' => 'Ticket closed successfully!'
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to close ticket'
            ]);
        }
    }
}
