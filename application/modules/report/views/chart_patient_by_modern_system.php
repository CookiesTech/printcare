<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-outline-info">
            <div class="card-header">
               <h4 class="m-b-0 text-white">Modern System Wise Patient Report</h4>
               
            </div>
            <div class="card-body">
                <div class="card">
                        <div class="body">
                            <div id="container" style="height: 400px;"></div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<script type="text/javascript">
var chart;
$(function () {

    Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Patient By Modern System'
    },
    xAxis: {
            categories: <?= $x_val_data ?>
        },   
    yAxis: {
        min: 0,
        title: {
            text: 'Total'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Total Patient: <b>{point.y:.1f}</b>'
    },
    series: [{
        name: 'Patient Total',
        data: <?= $y_val_data ?>        
    }]
});
       

	
});

</script>



