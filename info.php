<?php
include 'core/init.php';

$data   =   $_GET['data']; 
$query  = "SELECT `city_`.`id`, `city_`.`city_name_ru`, `region_`.`region_name_ru`, `country_`.`country_name_ru` 
			  FROM `city_`, `region_`, `country_` 
			  WHERE `region_`.`id` = `city_`.`id_region` AND `country_`.`id` = `city_`.`id_country` AND `city_`.`city_name_ru` LIKE '%$data%'
			  LIMIT 5";

	$result = mysql_query($query);
	$dataList = array();
	while ($row = mysql_fetch_array($result))
	{
		$toReturn   = htmlentities($row['city_name_ru']) . "<br>&nbsp" . htmlentities($row['region_name_ru']);
		$dataList[] = '<li id="' .$row['id'] . '"><a href="#">' . $toReturn . '</a></li>';
	}
	print_r ($dataList);
	phpinfo();
?>