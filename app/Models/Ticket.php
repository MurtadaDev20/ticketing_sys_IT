<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function support(){
        return $this->belongsTo(Support::class, 'support_id','id');
    }


    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id','id');
    }

    public function catigory(){
        return $this->belongsTo(Catigory::class, 'ticket_cat_id','id');
    }

    public function status(){
        return $this->belongsTo(Status::class, 'status_id','id');
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCatigory::class, 'sub_category_id');
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

}
