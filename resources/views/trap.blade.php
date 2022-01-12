@extends('layouts.app')
<style>
#date_recent_recycled
{
    font-size: 10px;
}
#content
{
    width: 90%;
    margin: auto;
}
#map 
{ 
    height: 500px;
}
#add_trap_button:hover
{
  background-color: white;
}
</style>
@section('content')
<div class="sidebar off-canvas-sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a class="simple-text logo-mini">
            <div class="logo-image-small">
               
            </div>
        </a> 
        <a class="simple-text" href="{{ url('/') }}">
        <h6 style="text-aling:center">BARADO MONITORING APP</h6>
        </a>
    </div>
    
    <div class="sidebar-wrapper">
    <ul class="nav">
            <li>
                <a href="{{ url('/') }}">
                    <i class="nc-icon nc-align-center"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
        </ul>
        <ul class="nav">
          @foreach($trap_data as $data)
            <li>
               <a href="{{ route('trap_page', $data->id) }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>TRAP {{$data->id}}</p>
                </a>
            </li>
          @endforeach
        </ul>

        <ul class="nav justify-content-end">
            <li>
              <a id="add_trap_button">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                  Add New Trap
                </button>
            </a>
            </li>
        </ul>

    </div>
</div>
<div class="content text-center">
  <h4>BARADO: MONITORING SYSTEM FOR TRAP {{ $this_trap_data->id }}</h4>
</div>

<div class="container d-flex flex-row-reverse">
    <div>
        <a href="{{ route('delete_trap', $this_trap_data->id) }}" OnClick="return confirm('Are you sure you want to remove this trap?')" class="text-right btn btn-outline-warning">
            {{csrf_field()}}
            {{ method_field('GET') }}      
            <h6>delete trap</h6>
        </a>
    </div>
</div>

    <div class="container">
        <div class="col-lg-7 col-md-1 col-sm-6" style="margin:auto">
                <div class="card card-stats">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="numbers">
                                    <p class="card-category">Status:</p>
                                <div id="status"></div>
                                
                                </div>
                            </div>
                            <div class="col-5 col-md-6">
                                <div id="msg">
                                    <p class="card-category">Note:</p>
                                </div>
                                <div id="message">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                    </div>
                </div>
            </div>
    </div>
    <div class="container">
            
    <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-chart-bar-32 text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Total Trash</p>
                                <div id="total_trash_collected"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-chart-bar-32 text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Most recent trash data</p>
                                <div id="current_trash_collected"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                    </div>
                </div>
            </div>
            

            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-chart-bar-32 text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category">Current Water Level</p>
                                <div class="d-flex flex-row-reverse" id="current_water_level"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                    </div>
                </div>
            </div>



            
        </div>
    </div>

    <div class="container">
        <div class="col-md-12">
            <div class="card card-chart">
                    <div class="card-header">
                            <h5 class="card-title">Water level statistics</h5>
                            <p class="card-category">Amount of water collected from start to present</p>
                    </div>

                    <div class="card-body">

                    <canvas id="myChart"></canvas>
                      
                       
                    </div>

                    <div class="card-footer">
                        <!-- <div class="chart-legend">
                                <i class="fa fa-circle text-info"></i> tubig init xd
                                <i class="fa fa-circle text-warning"></i> tubig bugnaw xd
                        </div> -->
                        <hr />
                            <div class="card-stats">
                                <i class="fa fa-check"></i> Information accumulated from database
                            </div>
                    </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-md-12">
            <div class="card card-chart">
                    <div class="card-header">
                            <h5 class="card-title">Load Cell statistics</h5>
                            <p class="card-category">Load Cell   from start to present</p>
                    </div>

                    <div class="card-body">

                    <canvas id="myChart2"></canvas>
                      
                       
                    </div>

                    <div class="card-footer">
                        <!-- <div class="chart-legend">
                                <i class="fa fa-circle text-info"></i> tubig init xd
                                <i class="fa fa-circle text-warning"></i> tubig bugnaw xd
                        </div> -->
                        <hr />
                            <div class="card-stats">
                                <i class="fa fa-check"></i> Information accumulated from database
                            </div>
                    </div>
            </div>
        </div>
    </div>

<div class="container">
        <div class="col-md-12">
            <div class="card card-chart">
            <div class="card-header text-info">
                <h4 class="title">List of data</h4>
                <p class="category"></p>
            </div>
            <div class="table-responsive">
                <table class="table" id="myTable">
                        <thead>
                            <tr>
                            <th scope="col">Trap ID</th>
                            <th scope="col">water level value</th>
                            <th scope="col">load cell value</th>
                            <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($trap_data as $data)
                            <tr>
                            <td scope="row">{{$data->trap_id}}</td>
                            <td scope="row">{{$data->distance}}cm</td>
                            <td scope="row">{{$data->weight}}g</td>
                            <td>{{$data->created_at->format('M j, Y - h:i:s A')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                 </table>
            </div>
            </div>
    </div>
</div>

  <div class="container text-info">
  <div class="col">
  <div class="card-header text-info">
                  <h4 class="title">Barado App Location</h4>
                  <p class="category">Accurate location of barado system</p>
              </div>
  <table class="table table-hover mt-4">
  <tbody>
    <tr>
      <th scope="row text-sm">Location:</th>
      <td class="text-primary">
      <i class="fas fa-map-marker-alt text-primary"></i>
          Matina-crossing, Carinosa Street, Davao City</td>
    </tr>
    <tr>
      <th scope="row">Status:</th>
      <td class="text-success">Active</td>
    </tr>
      <th scope="row"></th>
      <td></td>
    </tr>
  </tbody>
</table>
  </div>
</div>

<div class="container mb-5">
<div class="row">
  <div class="col">
    <div class="mw-100" id="map"></div>
  </div>
 
</div>
</div>


<!-- Modal for Add  -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add New Trap</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('trap_store') }}" method="POST">
         @csrf
            <div class="form-group">
              <label for="location">Trap Location</label>
              <input type="text" class="form-control" id="location" name="location" placeholder="Street Address, City, Province, Zip">
            </div>
            <div class="form-group">
              <label for="long">Longitude</label>
              <input type="text" class="form-control" id="long" name="long" placeholder="Ex: 125.0000000">
            </div>
            <div class="form-group">
              <label for="lat">Latitude</label>
              <input type="text" class="form-control" id="lat" name="lat" placeholder="Ex: 7.0000000">
            </div>
      </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Add Trap</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal for Add  -->

@endsection
<script src="//code.jquery.com/jquery-1.12.3.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
<script>
    
    $(document).ready(function() {
    $('#myTable').DataTable(
        {
        });
    
    } );
    </script>

<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment.min.js" type="text/javascript">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
 
 window.onload = function() {
    var mymap = L.map('map').setView([7.0517922, 125.5724544], 15);
    var marker = L.marker([7.0517922, 125.5724544]).addTo(mymap);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'sk.eyJ1IjoiYWdhbnRhbDEyMyIsImEiOiJja3ZtZDZtb3owd25iMzJrbHcyZno0ZzZkIn0.HCf1b8bEvpjFfabSqFzRnQ'
    }).addTo(mymap);
  var ctx = document.getElementById("myChart");
  var ctx2 = document.getElementById("myChart2");
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        label: 'Water Level (cm)',
        borderColor: "#68B3E8",
        backgroundColor: "#68B3E8",
        fill: false,
        pointRadius: 0,
        pointHoverRadius: 0,
        borderWidth: 3,
        data: [],
        tension: 0.1
      }]
    },
    options: {
      scales: {
        xAxes: [],
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });
  var myChart2 = new Chart(ctx2, {
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        label: 'Load Cell amount (g)',
        data: [],
        backgroundColor: "#f17e5d",
        pointRadius: 0,
        pointHoverRadius: 0,
        borderWidth: 3,
        fill: false,
        borderColor: "#f17e5d",
        tension: 0.1
      }]
    },
    options: {
      scales: {
        xAxes: [],
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });
  
var updateChart = function() {
  var total_trash_collected = "";
  var current_trash_collected = "";
  var current_water_level = "";
  var current_date_collected = "";
    $.ajax({
      url: "{{ route('api.chart') }}",
      type: 'GET',
      dataType: 'json',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(data) {
        
        myChart.data.labels = data.labels;
        myChart.data.datasets[0].data = data.data;
        myChart.update();
        myChart2.data.labels = data.labels;
        myChart2.data.datasets[0].data = data.data2;
        myChart2.update();
        
        total_trash_collected = data.total_loadcell_data;
        current_trash_collected =  data.latest_trash_collected.weight;
        current_water_level_data = data.total_sensor_deployed.distance;
        
        message = "";
        counter = 0;
        if(total_trash_collected == null)
        {
            message = "Device is Inactive";
            document.getElementById('total_trash_collected').innerHTML = '<p class="card-title">No Record</p>';
            document.getElementById('status').innerHTML = '<p class="card-title">Not found</p> ';
            document.getElementById('message').innerHTML = '<p class="card-category">'+ message +'</p> ';
        }
        else
        {
          document.getElementById('total_trash_collected').innerHTML = '<p class="card-title">' + total_trash_collected.toFixed(2) + ' g </p> ';
        }
          //current trash collected
        if(current_trash_collected == null)
        {
            message = "Device is Inactive";
            document.getElementById('current_trash_collected').innerHTML = '<p class="card-title">No Record</p>';
            document.getElementById('status').innerHTML = '<p class="card-title">Not found</p> ';
            document.getElementById('message').innerHTML = '<p class="card-category">'+ message +'</p> ';
        }
        else if(current_trash_collected <4000 ){
            message = "Device is active.";
            counter = 1;
            document.getElementById('current_trash_collected').innerHTML = '<p class="card-title text-success">' + current_trash_collected.toFixed(2) + ' g </p> ';
            document.getElementById('status').innerHTML = '<p class="card-title text-success">OK</p> ';
            document.getElementById('message').innerHTML = '<p class="card-category">'+message+'</p> ';
        }else if(current_trash_collected >= 4000   && current_trash_collected<=6999){
            message = "The canal is needed to be clean.";
            counter = 2;
            document.getElementById('current_trash_collected').innerHTML = '<p class="card-title text-warning"><i class="fas fa-exclamation-triangle text-warning pt-1 pr-1"></i>' + current_trash_collected.toFixed(2) + ' g </p> ';
            document.getElementById('status').innerHTML = '<p class="card-title text-warning"><i class="fas fa-exclamation-triangle text-warning pt-1 pr-1"></i>WARNING</p> ';
            document.getElementById('message').innerHTML = '<p class="card-category">'+message+'</p> ';
        }
        else
        {
            message = "Remove the device to avoid damaging.";
            counter = 3;
            document.getElementById('current_trash_collected').innerHTML = '<p class="card-title text-danger"><i class="fas fa-exclamation-triangle text-danger pt-1 pr-1"></i>' + current_trash_collected.toFixed(2) + ' g </p> ';
            document.getElementById('status').innerHTML = '<p class="card-title text-danger"><i class="fas fa-exclamation-triangle text-danger pt-1 pr-1"></i>DANGER</p> ';
            document.getElementById('message').innerHTML = '<p class="card-category">'+message+'</p> ';
        }
        //current water level collected
        if(current_water_level_data == null)
        {
            
            document.getElementById('current_water_level').innerHTML = '<p class="card-title">No Record</p>';
        }
        else if(current_water_level_data <5)
        {
          //green
          document.getElementById('current_water_level').innerHTML = '<p class="card-title text-success">' + current_water_level_data + ' cm </p> ';
        }
        else if(current_water_level_data >=5 && current_water_level_data <=7)
        {
          //yellow
            document.getElementById('current_water_level').innerHTML = '<p class="card-title text-warning"><i class="fas fa-exclamation-triangle text-warning pt-1 pr-1"></i>' + current_water_level_data + ' cm </p> ';
        }
        else
        {
          //red
            document.getElementById('current_water_level').innerHTML = '<p class="card-title text-danger"><i class="fas fa-exclamation-triangle text-danger pt-1 pr-1"></i>' + current_water_level_data + ' cm</p> ';
        }
       
        
       
      },
      error: function(data){
        console.log(data);
      }
    });
  }
  
    updateChart();
    setInterval(() => {
      updateChart();
    }, 1000);
}
</script>
