<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;

    public function projects(){
        return $this->belongsToMany(Project::class);
    }
    // public function getTechBadgeHTML(){
    //     return '<span class="bedge" style="background-color:' . $this->color . '">' . $this->label . '</span';
    // }
}