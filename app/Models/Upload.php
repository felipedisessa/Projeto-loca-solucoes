<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'uploadable_id',
        'uploadable_type',
        'file_name',
        'file_path',
    ];

    public function uploadable(): MorphTo
    {
        return $this->morphTo();
    }
}
