<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificat extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'organisme', 'image','date_obtention'];

    public function utilisateurs(){

        return $this->belongsTo(User::class);
    }
}
