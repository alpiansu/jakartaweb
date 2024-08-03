<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MContact extends Model
{
    use HasFactory;
    protected $table = 'm_contacts';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'subject',
        'message',
    ];
}
