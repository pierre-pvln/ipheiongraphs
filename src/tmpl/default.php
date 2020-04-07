<?php 
/**
 * @package     mod_ipheiongraphs
 * @author      Pierre Veelen, www.pvln.nl
 * @copyright   Copyright (C) 2020 Pierre Veelen. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 *
 * default.php  Used to output the data to html page.
 *
 */

defined('_JEXEC') or die;

/* $document = JFactory::getDocument(); */
/* $document->addScript('https://code.highcharts.com/highcharts.js'); */

?>

<!-- Get the module class suffix-->
<div class="<?php echo $params->get("moduleclass_sfx");?>">

	<!-- Get the text to be displayed before the graph-->
	<div> <?php echo $params->get("pretext");?> </div>

	<div id='map-graph' style='width: 100%; height: 600px;'></div>
	
    <!-- Load highcharts graphs library -->
	<script src="https://code.highcharts.com/highcharts.js"></script>
	
	<!-- Set required parameters -->
	<script>
	post_data = <?php echo '\'{"station_id":'.$params->get("AIS_station_ID").',"range":'.$params->get("AIS_station_range").'}\'' ?>;
	ships_data_url = <?php echo '"'.$params->get("ships_data_url").'"' ?>;
    </script>
	
	<!-- load graph -->
	<script src="./media/mod_ipheiongraphs/js/graphs.js"></script>

	<!-- Get the text to be displayed after the graph-->	
	<div><?php echo $params->get("posttext");?></div>

</div>
