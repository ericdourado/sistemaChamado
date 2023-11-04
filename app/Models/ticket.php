<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    protected $fillable = ['user_id', 'suport_id', 'situation', 'ticket_name', 'anydesk', 'description', 'suport_started'];
    use HasFactory;
}
