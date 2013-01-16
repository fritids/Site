<?php
include 'core/init.php';

# Assign local variables
$data   =   @$_GET['data'];        // The value of the textbox.

if ($data)
{
    $query  = "SELECT `city_`.`id`, `city_`.`city_name_ru`, `region_`.`region_name_ru`, `country_`.`country_name_ru`
              FROM `city_`, `region_`, `country_`
              WHERE `region_`.`id` = `city_`.`id_region` AND `country_`.`id` = `city_`.`id_country` AND `city_`.`city_name_ru` LIKE '$data%'
              LIMIT 5";

    $result = mysql_query($query);

    $dataList = array();

    while ($row = mysql_fetch_array($result))
    {
        $dataList[] = $row;
        //$toReturn   = htmlentities($row['city_name_ru'], ENT_COMPAT, 'UTF-8') . ",<br>&nbsp" . htmlentities($row['region_name_ru'], ENT_COMPAT, 'UTF-8');
        //$dataList[] = '<li id="' .$row['id'] . '"><a href="#">' . $toReturn . '</a></li>';
    }

    if (count($dataList)>=1)
    {
        $datas = array("city" => $dataList);
        //$dataOutput = join("\r\n", $dataList);
        //echo $dataOutput;
        echo json_encode($datas);
    }
    else
    {
        $datas = array("city" => array("city_name_ru" => "No Result"));
        //$dataOutput = join("\r\n", $dataList);
        //echo $dataOutput;
        echo json_encode($datas);
    }
}
else
{
    $datas = array("city" => array("city_name_ru" => "ERROR!"));
        //$dataOutput = join("\r\n", $dataList);
        //echo $dataOutput;
        echo json_encode($datas);
}
?>
