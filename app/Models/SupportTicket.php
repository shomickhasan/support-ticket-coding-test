<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory;
    protected $fillable = ['issue_details','current_status','created_by'];

    public function statuses(){
        return $this->hasMany(SupportTicketStatus::class, 'support_ticket_id','id');
    }

    public function replies(){
        return $this->hasMany(SupportReply::class, 'support_ticket_id','id');
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by','id');
    }
}
