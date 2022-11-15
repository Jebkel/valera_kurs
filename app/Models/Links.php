<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    use HasFactory;

    public $table = 'links';

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

    public function get_uri(): string
    {
        $args = $this->args;
        if (!is_null($args)) {
            $args = '?' . $args;
        }
        return $this->url_address . $args;
    }

}
