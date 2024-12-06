<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherRecord extends Model
{
    use HasFactory;

    // Funzione per relazionare i dati meteo alla location
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
