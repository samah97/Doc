
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="ilmu-detil.blogspot.com">
	<!-- Bagian css -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/ilmudetil.css">
	
	<script src="assets/js/jquery-1.10.1.min.js"></script>
	<script type="text/javascript">
		$(function () {
			var chart;
			$(document).ready(function() {
				$.getJSON("dataline.php", function(json) {
				
					chart = new Highcharts.Chart({
						chart: {
							renderTo: 'graph',
							type: 'line'
							
						},
						title: {
							text: 'Measurements for Patient'
							
						},
						subtitle: {
							text: ''
						},
						xAxis: {
							 categories: []
						},
						yAxis: {
							title: {
								text: 'Height (cm)'
							},
							plotLines: [{
								value: 0,
								width: 1,
								color: '#808080'
							}]
						},
						tooltip: {
							formatter: function() {
									return '<b>'+ this.series.name +'</b><br/>'+
									this.x +': '+ this.y;
							}
						},
						legend: {
							layout: 'vertical',
							align: 'right',
							verticalAlign: 'top',
							x: -10,
							y: 120,
							borderWidth: 0
						},
						series: json
					});
				});
			
			});
			
		});
		</script>
	<script src="assets/js/highcharts.js"></script>
	<script src="assets/js/exporting.js"></script>
        
</head>
<body>

<!--- Bagian Judul-->	
<div class="container" style="margin-top:20px">
	<div class="col-md-12">
		<div class="panel panel-primary">
				<div class="panel-body">
					<div id ="graph"></div>
				</div>
		</div>
	</div>
</div>
<script src="assets/js/highcharts.js"></script>
<script src="assets/js/jquery-1.10.1.min.js"></script>
<div class="navbar navbar-default navbar-fixed-bottom footer-bottom">
 
</div>
</body>
</html>
