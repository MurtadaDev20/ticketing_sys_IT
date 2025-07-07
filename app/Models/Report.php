<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'modification',
        'folder_path',
        'name',
        'header',
        'type_date',
        'reson_request',
        'status',
        'notes',
        'date_from',
        'date_to',
        'date',
        'closed_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attaches()
    {
        return $this->hasMany(ReportAttach::class);
    }
}
