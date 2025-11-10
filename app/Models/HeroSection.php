<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'achievement',
        'heading',
        'subheading',
        'path_video',
        'banner'

    ];
}
