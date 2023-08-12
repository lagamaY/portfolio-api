<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagep extends Model
{
    use HasFactory;

    // protected $table = "imagebs";
    
    protected $fillable = ['path'];


    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }
}
