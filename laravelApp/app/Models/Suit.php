<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suit extends Model
{
    use HasFactory;
    protected $table = 'CIM_SUITS';
    protected $fillable = ['*'];
    public $timestamps = false;
    public $incrementing = false;

}
