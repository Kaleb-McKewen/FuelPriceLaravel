<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fuelprice extends Model
{
    protected $connection = "sqlitefuel";

    protected $table = "fuelprice";

    protected $fillable = [
        "id", "time", "average", "lowest"
    ];
    protected $primaryKey = "id";

    public $timestamps = false;
    
}
