<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\WeatherRecord;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $locations = Location::all();
        return view('index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Recupero i dati della location
        $data = $request->all();

        // Creo la nuova location
        $new_location = new Location();
        // Inserisco i dati raccolti
        $new_location->fill($data);
        // Salvo i dati
        $new_location->save();

        $coordinates = $new_location->latitude.','.$new_location->longitude;
        // Faccio la chiamata API per raccogliere le informazioni sul meteo della location creata
        $res_weather = Http::withoutVerifying()->get('http://api.weatherapi.com/v1/forecast.json',
            [
                'key' => env('WEATHER_API_KEY'),
                'q' => $coordinates,
                'days' => 3
            ]
        );
        $res_json = $res_weather->json();

        // Destrutturo la risposta
        ["forecast" => $forecast] = $res_json;

        // Creo il raccoglitore per i dati del meteo
        $data_to_save = [];

        // Registro i dati 
        // Entro nell'array associativo forecastday
        foreach($forecast["forecastday"] as $day){
            // Entro nell'array associativo hour
            foreach($day["hour"] as $hour){
                // Salvo i dati nel raccoglitore
                $data_to_save[] = $hour;
            }
        }

        // Salvo i dati nel database
        foreach($data_to_save as $day){
            $new_record = new WeatherRecord();
            
            $new_record->temperature = $day["temp_c"];
            $new_record->timestamp = $day["time"];
            $new_record->humidity = $day["humidity"];
            $new_record->precipitation = $day["precip_mm"];
            $new_record->wind_speed = $day["wind_kph"];
            $new_record->condition = $day["condition"]["text"];
            $new_record->location_id = $new_location->id;

            $new_record->save();
        }

        
        // Rindirizzo alla pagina della location creata
        return to_route('locations.show', $new_location->id);
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $location = Location::find($id);
        
        // Recupero l'ora per recuperare il meteo
        $date = new DateTime("now", new DateTimeZone("Europe/Rome"));
        $data_ora = $date->format("Y-m-d H:i:s");
        $current_weather = WeatherRecord::whereTimestamp($date->format("Y-m-d H:0:0"))->whereLocationId($location->id)->first();
        
        // Preparo i dati per il grafico
        $hours = [];
        $temperatures = [];
        foreach($location->weatherRecords as $day){
            $hours[] = date('d-m-Y H:i', strtotime($day["timestamp"]));
            $temperatures[] = $day["temperature"];
        }
        return view('show', compact('location', 'data_ora', 'current_weather', 'hours', 'temperatures'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
