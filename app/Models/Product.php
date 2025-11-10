<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'tagline',
        'thumbnail',
        'about'

    ];

    public function product(){
        return $this->hasMany(Appointment::class);
        
    }
}
