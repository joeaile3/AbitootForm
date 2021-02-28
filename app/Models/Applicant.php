<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Position;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Applicant extends Model
{
    use HasFactory, Notifiable;

   public function user()
   {
    return $this->belongsTo(User::class);
   }

   public function position()
   {
       return $this->belongsTo(Position::class);
   }
}
