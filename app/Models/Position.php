<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Applicant;

class Position extends Model
{
    use HasFactory;

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }
}
