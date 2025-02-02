<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catigory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function approvers()
    {
        return $this->hasMany(Approval::class);
    }
}
