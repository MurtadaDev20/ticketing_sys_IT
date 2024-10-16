<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Support extends Authenticatable
{
    use HasFactory;
   /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'support';
    protected $guarded = [];

   /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
   protected $hidden = [
       'password',
       'remember_token',
   ];

   /**
    * Get the attributes that should be cast.
    *
    * @return array<string, string>
    */
   protected function casts(): array
   {
       return [
           'email_verified_at' => 'datetime',
           'password' => 'hashed',
       ];
   }
}
