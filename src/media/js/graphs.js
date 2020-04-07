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
