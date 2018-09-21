<?php
include_once("functions.php");
// session_start();

$query=exec_query("select * from measurements where patient_id=".$_SESSION['patient_id']." order by date_of_meas asc");
$data_height=array();
$data_max=array();
$data_min=array();
$dates=array();
$max=160;
$min=50;

while($row=mysqli_fetch_assoc($query)){
	$dates[]="'".$row['date_of_meas']."'";
	$data_height[]=$row['head_diameter'];
	$data_max[]=$max;
	$data_min[]=$min;
	$max+=10;
	$min+=10;
	}


	
?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<style>
#container {
	height: 400px;
	margin: 0 auto;
	margin-bottom:40px;
	
}
.highcharts-credits{
	display:none;
}
</style>

<div id="container"></div>

<script>
Highcharts.chart('container', {

    title: {
        text: 'Head Diameter Chart'
    },

    subtitle: {
        text: ''
    },
	
	xAxis:{
		title:{text: 'Date of Measurements' },
		categories:[<?php echo join($dates,',');?>]
	},
	
    yAxis: {
        title: {
            text: 'Height(cm)'
        }
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
            
        }
    },

    series: [{
        name: 'Height',
        data: [<?php echo join($data_height,',');?>]
    }, {
        name: 'Maximum',
        data: [<?php echo join($data_max,',');?>]
    }, {
        name: 'Minimum',
        data: [<?php echo join($data_min,',');?>]
    },],

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