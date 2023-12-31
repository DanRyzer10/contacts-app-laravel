<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    use HasFactory;
    protected $fillable = [
        'name',
        'phone_number',
        'user_id',
        'profile_picture'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
