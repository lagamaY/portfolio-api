<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['titre', 'contenu', 'image_accroche'];

    public function imagebs()
    {
        return $this->hasMany(ImageB::class);
    }
    
    public function auteurs(){

        return $this->belongsTo(User::class);
    }

}
