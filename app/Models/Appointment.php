<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'phone_number',
        'password',
        'email',
        'budget',
        'brief',
        'product_id',

    ];

    protected $casts = [
        'meeting_at' => 'date',

    ];

    public function product(){
        return $this->belongTo(Product::class, 'product_id');
        
    }

}
