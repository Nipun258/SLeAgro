@extends('admin.admin_master')
@section('admin')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<style type="text/css">
  .highcharts-figure,
.highcharts-data-table table {
  min-width: 360px;
  max-width: 800px;
  margin: 1em auto;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #ebebeb;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}

.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}

.highcharts-data-table th {
  font-weight: 600;
  padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
  padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}

.highcharts-data-table tr:hover {
  background: #f1f7ff;
}
</style>
  <div class="content-wrapper">
    <div class="container-full">

    <!-- Main content -->
    <section class="content">
      <div class="row">
        
             <div class="box box-widget widget-user">
         @foreach(json_decode($vegitables_summary) as $vegitable)
          <div class="widget-user-header bg-black text-center" >
            <h3 class="widget-user-username text-success">Wholesale Price of {{ $vegitable->name}}</h3>
            <a href="{{ url()->previous() }}" style="float: right;" class="btn btn-success mb-4">Dashboard</a>
            @if($vegitable->catagory == 'A')
            <h6 class="widget-user-desc text-danger">‎‎&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Up Country Vegetable</h6>
            @elseif($vegitable->catagory == 'B')
            <h6 class="widget-user-desc">  Down Country Vegetable</h6>
            @else
             <h6 class="widget-user-desc">  All Island Vegetable</h6>
            @endif  
          </div>
          <div class="widget-user-image">
            <img class="rounded-circle bg-img h-120 w-120" src="{{ (!empty($vegitable->image))? url($vegitable->image):url('upload/images.png')}}" alt="User Avatar" >
          </div>
          <br><br>
          <div class="box-footer">
            <div class="row">
            <div class="col-sm-4">
              <div class="description-block">
              <h3 class="description-header">Today Price</h3>
              <h2 class="description-text text-warning">
                          @if($vegitable->todayPrice == 'No Data')
                          Not Update
                          @else
                          Rs. {{ number_format($vegitable->todayPrice , 2) }}
                          @endif</h2>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4 br-1 bl-1">
              <div class="description-block">
              <h3 class="description-header">Yeasterday Price</h3>
              <h2 class="description-text text-warning">@if($vegitable->yesterdayPrice == 'No Data')
                          Not Update
                          @else
                          Rs. {{ number_format($vegitable->yesterdayPrice , 2) }}
                          @endif</h2>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
              <div class="description-block">
              <h3 class="description-header">Average Price</h3>
              <h2 class="description-text text-warning">Rs. {{ number_format($vegitable->avg , 2) }}</h2>
              </div>
              <!-- /.description-block -->
            </div>
            <!-- /.col -->
            </div>
          </div>
          </div>
      @endforeach
        <div class="col-xl-12 col-12">
          <div class="box">
            <div class="box-body">
              <div>
                <div id="container" ></div>
              </div>
            </div>
          </div>
        </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    
    </div>
  </div>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

  var userData = <?php echo json_encode($simple_array)?>;

  var userData2 = <?php echo json_encode($simple_array2)?>;

  var userData3 = <?php echo json_encode($VegPriceAverage)?>; 

     Highcharts.chart('container', {

  title: {
    text: 'Vegetable WholeSale Weekly Price change, 2021'
  },

  subtitle: {
    text: 'Sri Lanka Agriculture Department'
  },

  yAxis: {
    title: {
      text: 'WholeSale Price(Rs)'
    }
  },

    xAxis: {
      title: {
      text: 'Price Date'
    },
      categories: userData,
    },

  legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
  },

  plotOptions: {
    series: {
      label: {
        connectorAllowed: false
      },
      //pointStart: 2021-12-01
    }
  },
  exporting: {
    buttons: {
        contextButton: {
            enabled: false
        }
    }
},

  series: [{
    name: 'Daily Price',
    data: userData2
  }, {
    name: 'weekly Average Price',
    data: [userData3 , userData3 ,userData3,userData3,userData3,userData3,userData3,userData3,userData3]
  }],

  responsive: {
    rules: [{
      condition: {
        maxWidth: 500
      },
      chartOptions: {
        legend: {
          layout: 'horizontal',
          align: 'center',
          verticalAlign: 'bottom'
        }
      }
    }]
  }

});
    </script>
@endsection
