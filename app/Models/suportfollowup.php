<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suportfollowup extends Model
{
    protected $fillable = ['ticket_id', 'user_id', 'description', 'created_at', 'updated_at'];
    protected $table = "suportfollowup";
    use HasFactory;
}
