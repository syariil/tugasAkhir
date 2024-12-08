<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tim extends Model
{
    use HasFactory;

    // preference table
    protected $table = 'tims';
    protected $guarded = [];

    public function  scheduleAsTimA()
    {
        return $this->hasMany(Schedule::class, 'id_timA', 'id');
    }
    public function  scheduleAsTimB()
    {
        return $this->hasMany(Schedule::class, 'id_timB', 'id');
    }

    public function standing()
    {
        return $this->hasMany(Standings::class, 'id_tim', 'id');
    }
}
