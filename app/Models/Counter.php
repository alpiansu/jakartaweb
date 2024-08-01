<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;
    // Nama tabel yang digunakan oleh model ini
    protected $table = 'counters';

    // Kolom-kolom yang boleh diisi
    protected $fillable = [
        'title',
        'value',
        'subtitle',
    ];
}
