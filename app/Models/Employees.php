<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $fillable = [
        'first_nm',
        'last_nm',
        'company_id',
        'email',
        'phone',
    ];
    public $timestamps = true;
}
