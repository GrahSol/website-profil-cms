<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class CompanyStatistic extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        
        'name',
        'goal',
        'icon',

    ];
}
