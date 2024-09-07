<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pesan()
    {
        return $this->hasMany(Pesan::class, 'id_menu', 'id');
    }
}
