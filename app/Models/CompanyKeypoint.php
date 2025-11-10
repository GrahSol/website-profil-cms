<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class CompanyKeypoint extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_about_id',
        'keypoint'
    ];

    public function about()
    {
        return $this->belongsTo(CompanyAbout::class);
    }
}