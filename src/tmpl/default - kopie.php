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
$document->addScript('https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js');
$document->addStyleSheet('https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css');
?>

<!-- Get the module class suffix-->
<div class="<?php echo $params->get("moduleclass_sfx");?>">

	<!-- Get the text to be displayed before the module-->
	<div> <?php echo $params->get("pretext");?> </div>

	<div id='map-polygon' style='width: 50%; height: 600px;'></div>

	<script>
		mapboxgl.accessToken = <?php echo '"'.$params->get("mapbox_accesstoken").'"' ?>
		polygon_data_url = <?php echo '"'.$params->get("polygon_data_url").'"' ?>
		window.latitude = <?php echo $params->get("window_latitude")?>
		window.longitude = <?php echo $params->get("window_longitude")?>
	</script> 

	<script type="text/javascript" src= <?php echo JURI::root()."modules/mod_ipheiongraphs/tmpl/js/map-polygon-container.js" ?> ></script>

<!-- List the variables from the module settings -->	
<?php
	echo "<p>Mapbox Accesstoken: ".$params->get("mapbox_accesstoken")."</p>";
	echo "<p>Polygon Data url  : ".$params->get("polygon_data_url")."</p>";
	echo "<p>Window Latitude   : ".$params->get("window_latitude")."</p>";
	echo "<p>Window Longitude  : ".$params->get("window_longitude")."</p>";
?>
	<!-- Get the text to be displayed after the module-->	
	<div><?php echo $params->get("posttext");?></div>

</div>
