<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    // Nama tabel yang digunakan oleh model ini
    protected $table = 'services';

    // Kolom-kolom yang boleh diisi
    protected $fillable = [
        'title',
        'description',
        'icon_class',
        'id_sub_services',
    ];
}
