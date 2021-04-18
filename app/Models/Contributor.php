<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    use HasFactory;

    protected $fillable = [
        'civility',
        'last_name',
        'first_name',
        'street',
        'zip_code',
        'city',
        'phone',
        'email',
        'company_id',
    ];
}
