<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable =['label','color'];

    public function projects(){
        return $this->HasMany(Project::class);
    }

    public function getBadgeHTML(){
        return '<span class="badge " style="background-color:' . $this->color . '">' . $this->label . '</span>';
    }
}