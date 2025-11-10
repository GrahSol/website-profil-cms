<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class CompanyAbout extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'thumbnail',
        'type',

    ];

    public function keypoints(){
        return $this->hasMany(CompanyKeypoint::class);
    }
}
