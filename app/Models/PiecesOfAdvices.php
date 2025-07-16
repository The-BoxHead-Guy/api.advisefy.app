<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PiecesOfAdvices extends Model
{
    protected $table = 'pieces_of_advices';

    protected $primaryKey = 'id';

    protected $fillable = [
        'author',
        'text',
    ];

    protected $perPage = 20;

    // Optionally, you can add casts for clarity
    protected $casts = [
        'id' => 'integer',
    ];
}
