<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Albisteak extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'albisteak';

    protected $fillable = ["izenburua", "laburpena" ,"xehetasunak"];

    protected $hidden = [
        "created_at",
        "updated_at",
        "deleted_at"
    ];

}
