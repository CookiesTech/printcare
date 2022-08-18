<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-outline-info">
            <div class="card-header">
               <h4 class="m-b-0 text-white">New / Old - Patient Report</h4>
               
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
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Patient Total New / Old'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}% <br>Total : {point.y}</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Percentage',
        colorByPoint: true,
        data: [{
            name: 'New Patient',
            y: <?= $new_patient_count?>,
            sliced: true,
            selected: true
        }, {
            name: 'Old Patient',
            y: <?= $old_patient_count?>
        }]
    }]
});
           
       

	
});

</script>



