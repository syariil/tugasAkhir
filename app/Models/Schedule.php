<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    // protected guarded
    protected $guarded = [];
    protected $table = 'schedules';
    public function timA()
    {
        return $this->belongsTo(Tim::class, 'id_timA');
    }
    public function timB()
    {
        return $this->belongsTo(Tim::class, 'id_timB');
    }
}
