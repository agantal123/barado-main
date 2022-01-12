<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

use App\Models\BaradoSensor;
use App\Models\BaradoTraps;

use App\Charts\Reused_waterCharts;


class HomeController extends Controller
{
    public function index()
    {
        $trap_data = BaradoTraps::all();

        $sensorData = BaradoSensor::all()->sortBy('created_at');
        $trap_locations = BaradoTraps::all()->sortBy('created_at');
       
        return view('dashboard', compact('sensorData','trap_locations','trap_data'));
    }

    public function trap_store(Request $request)
    {
        $request->validate([
            'location' => 'required',
            'long' => 'required',
            'lat' => 'required'
        ]);

        BaradoTraps::create($request->all());

        return redirect()->back();
    }

    public function mayChart()
    {
        $total_loadcell_data = BaradoSensor::sum('weight');
        $latest_trash_collected = BaradoSensor::latest('created_at')->first();
        $total_sensor_deployed = BaradoTraps::count();


        $water = BaradoSensor::latest()->take(30)->get()->sortBy('id');
        $labels = $water->pluck('created_at');
        $data = $water->pluck('distance');
        $data2 = $water->pluck('weight');
        
        return response()->json(compact('labels', 'data','data2' , 'total_loadcell_data','latest_trash_collected','total_sensor_deployed'));
    }  
}
