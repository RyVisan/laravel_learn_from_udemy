<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_name',
        'user_id',
        'created_at'
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
