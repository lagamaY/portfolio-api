<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'logo', 'lien', 'description', 'images'];

    public function technologies()
    {
        return $this->belongsToMany(Technologie::class, 'projet_technologie');
    }
}
