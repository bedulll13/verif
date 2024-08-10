<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'part_id',
        'part_name',
        'file_name',
        'qty',
        'job_no',
    ];
}
