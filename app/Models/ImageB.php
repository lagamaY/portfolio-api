<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageB extends Model
{
    use HasFactory;

    protected $table = "imagebs";
    
    protected $fillable = ['path'];


    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }


    public function utilisateurs(){

        return $this->belongsTo(User::class);
    }
}
