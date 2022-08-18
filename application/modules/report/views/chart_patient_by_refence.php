<div class="container-fluid">
   <div class="row">
      <div class="col-lg-12">
         <div class="card card-outline-info">
            <div class="card-header">
               <h4 class="m-b-0 text-white">Reference Wise Patient Report</h4>
               
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
        text: 'Patient By Reference'
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
       

	 Highcharts.chart('advt_provider_summary', {
    chart: {
        type: 'column'
    },
    title: {
        text: ''
    },
   
    xAxis: {
        categories: [<?php echo $monthsFinal; ?> ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Advt Count'
        }
    },
    exporting: { enabled: false },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y}</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
     credits: {
		  enabled: false
	  },
    series: []
    
});
});

</script>



<script>
	$(document).ready(function(){		
	$('#chart_val_c').on('change',function(){
	var chart_val = $(this).val();
	
		var options = {
			chart: {
			renderTo: 'advt_provider_summary',
            type: 'column',
            height: '200'
        },
        title: {
            text: ''
        },
		exporting: { enabled: false },
		credits: {
		  enabled: false
		},
        xAxis: {
            categories: []
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Count'
            }
        },
         tooltip: {
                    formatter: function() {
                            return '<b>'+ this.series.name +'</b><br/>'+
                            this.x +': '+ this.y;
                    }
                },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: []
        
        }
           
        $.ajax({
   		type: 'POST',
   		dataType:'json',
   		data: {filter:chart_val},
   		url: '<?php echo base_url(); ?>index.php/dashboard/getAdvtChartdata',
   		success: function(json) {	
                options.xAxis.categories = json['label']['data'];
                $(json['chart_data']).each(function(key,value){
					options.series[key] = value;
				});
                chart = new Highcharts.Chart(options);
            }
        });
		
	});
	
	
});
</script>
