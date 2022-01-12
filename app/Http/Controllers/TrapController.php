<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Redirect;

use App\Models\BaradoSensor;
use App\Models\BaradoTraps;

use App\Charts\Reused_waterCharts;


class TrapController extends Controller
{
    public function index($id)
    {   
        $trap_data = BaradoTraps::all();
        $this_trap_data = BaradoTraps::where('id',$id)->first();

        $trap_sensorData = BaradoSensor::where('trap_id',$id)->get();
        $trap_location = BaradoTraps::where('id',$id)->first();
       
        return view('trap', compact('trap_sensorData','trap_location','trap_data','this_trap_data'));
    }

    public function delete_trap($id)
    {
        $trap = BaradoTraps::findOrFail($id);
        $trap->delete();

        return Redirect::route('home');
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
