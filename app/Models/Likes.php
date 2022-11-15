<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Likes extends Pivot
{
    use HasFactory;

    public $table = 'likes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'url_address',
        'description',
        'name',
        'args'
    ];


}
