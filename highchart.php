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
	$data_height[]=$row['height'];
	$data_weight[]=$row['weight'];
	$data_head[]=$row['head_diameter'];
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

<div id="container-height" class="chart"></div>
<div id="container-weight" class="chart"></div>
<div id="container-head" class="chart"></div>
<script>
Highcharts.chart('container-height', {

    title: {
        text: 'Height Chart'
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
//Weight
Highcharts.chart('container-weight', {

    title: {
        text: 'Weight Chart'
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
            text: 'Weight(kg)'
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
        name: 'Weight',
        data: [<?php echo join($data_weight,',');?>]
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
//Head
Highcharts.chart('container-head', {

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
            text: 'Head(cm)'
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
        name: 'Head Diameter',
        data: [<?php echo join($data_head,',');?>]
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