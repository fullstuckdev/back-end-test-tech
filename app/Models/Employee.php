<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
     'fullname',
     'company_fk',
     'department',
     'email',
     'phone'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
