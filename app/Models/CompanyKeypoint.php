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
        'name',
        'achievement',
        'thumbnail', 
        'type'
    ];

    // Tambah properti untuk default values
    protected $attributes = [
        'achievement' => '',
        'thumbnail' => '',
        'type' => ''
    ];

    public function companyAbout()
    {
        return $this->belongsTo(CompanyAbout::class);
    }
}