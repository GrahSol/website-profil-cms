<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class ProjectClient extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'occupation',
        'name',
        'avatar',
        'logo'
    ];
}
