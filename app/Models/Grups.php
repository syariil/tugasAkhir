<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grups extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'grups';

    public function standing()
    {
        return $this->hasMany(Standings::class, 'id_grup', 'id');
    }
}
