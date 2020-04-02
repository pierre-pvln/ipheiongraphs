<?php 
/**
 * @package     mod_ipheiongraphs
 * @author      Pierre Veelen, www.pvln.nl
 * @copyright   Copyright (C) 2020 Pierre Veelen. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 *
 * default.php  Used to output the data to html page. Therefore a lot of html code is included.  
 *
 */

defined('_JEXEC') or die;

$document = JFactory::getDocument();
/* $document->addScript('https://code.highcharts.com/highcharts.js'); */

?>

<!-- Get the module class suffix-->
<div class="<?php echo $params->get("moduleclass_sfx");?>">

	<!-- Get the text to be displayed before the module-->
	<div> <?php echo $params->get("pretext");?> </div>

	<div id='map-graph' style='width: 100%; height: 600px;'></div>
	
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script>
	post_data = <?php echo '\'{"station_id":'.$params->get("AIS_station_ID").',"range":'.$params->get("AIS_station_range").'}\'' ?>
	
	ships_data_url = <?php echo '"'.$params->get("ships_data_url").'"' ?>

	jQuery.post(ships_data_url,post_data,
		function (data, textStatus) {
		  var tug = [];
		  var tankers = [];
		  var barges = [];
		  var cargo = [];
		  var cargo_general = [];
		  var cargo_hazard = [];
		  var special_craft = [];
		  var others = [];
		  for (x in data) {
			if(data[x].ship_type == 31){
			  tug.push([data[x].time * 1000, data[x].cnt]);
			}
			if(data[x].ship_type == 59){
			  special_craft.push([data[x].time * 1000, data[x].cnt]);
			}
			if(data[x].ship_type == 80){
			  tankers.push([data[x].time * 1000, data[x].cnt]);
			}
			if(data[x].ship_type == 90){
			  barges.push([data[x].time * 1000, data[x].cnt]);
			}
			if(data[x].ship_type == 71){
			  cargo_hazard.push([data[x].time * 1000, data[x].cnt]);
			}
			if(data[x].ship_type == 70){
			  cargo_general.push([data[x].time * 1000, data[x].cnt]);
			}
			if(data[x].ship_type == 79){
			  cargo.push([data[x].time * 1000, data[x].cnt]);
			}
			if(data[x].ship_type >= 91){
			  others.push([data[x].time * 1000, data[x].cnt]);
			}
			
		  }
		  
		  Highcharts.chart('map-graph', {
			  chart: {
				  zoomType: 'x'
			  },
			  title: {
				  text: 'Ship type analysis'
			  },
			  subtitle: {
				  text: document.ontouchstart === undefined ?
					  'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
			  },
			  xAxis: {
						  type:'datetime',
						   minorTickInterval:100,
						   minTickInterval:100,
						  title : {
							   text: null
						  }//,
						  // categories:  json.ts
			  },
			  yAxis: {
				  title: {
					  text: 'Number of ships per hour'
				  }
			  },
			  legend: {
				  align: 'left',
				  verticalAlign: 'top',
				  borderWidth: 0
			  },
			  tooltip: {
				  shared: true,
				  crosshairs: true
			  },
			  plotOptions: {
				  area: {
					  fillColor: {
						  linearGradient: {
							  x1: 0,
							  y1: 0,
							  x2: 0,
							  y2: 1
						  },
						  stops: [
							  [0, Highcharts.getOptions().colors[0]],
							  [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
						  ]
					  },
					  marker: {
						  radius: 2
					  },
					  lineWidth: 1,
					  states: {
						  hover: {
							  lineWidth: 1
						  }
					  },
					  threshold: null
				  }
			  },
			  series: [{
					  type: 'line',
					  name: 'Tug',
					  data: tug
				  },{
					  type: 'line',
					  name: 'Tankers',
					  data: tankers
				  },{
					  type: 'line',
					  name: 'Barges',
					  data: barges
				  },{
					  type: 'line',
					  name: 'Cargo Hazard',
					  data: cargo_hazard
				  },{
					  type: 'line',
					  name: 'Cargo General',
					  data: cargo_general
				  },{
					  type: 'line',
					  name: 'Cargo',
					  data: cargo
				  },{
					  type: 'line',
					  name: 'Other *',
					  data: others
				  },{
					  type: 'line',
					  name: 'Special craft',
					  data: special_craft
				  }]
			});
		}
	);
	</script>

	<!-- Get the text to be displayed after the module-->	
	<div><?php echo $params->get("posttext");?></div>

</div>
