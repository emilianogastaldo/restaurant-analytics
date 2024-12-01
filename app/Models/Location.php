<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'latitude', 'longitude'];

    // Funzione per relazionare la location con i dati meteo
    public function WeatherRecords(){
        return $this->hasMany(WeatherRecord::class);
    }

}
