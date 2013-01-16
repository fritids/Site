<?php
function city_users($city_id, $num_result)  {
    $city_id = sanitize($city_id);
    $query = "SELECT `username`, `first_name`, `last_name`, `profile` FROM `users` WHERE `city_id` = '$city_id' ORDER BY RAND() LIMIT $num_result";
    $result = mysql_query($query);
    $return = "";
    global $base_url;
    if (mysql_num_rows($result) != 0) {
        while ($row = mysql_fetch_array($result)) {
            $return .= "<div style='text-align: center' class='span2'><a href=" . $base_url . "profile/" . $row["username"] . " ><img class='img-polaroid' style='max-width:100%;' src=" . $base_url . $row['profile'] . " /><h5>" . $row['first_name'] . " " . $row['last_name'] . "</h5></a></div>";
        }
        return $return;
    } else {
        return "No result!";
    }
}

function city_sights($city_id, $num_result)  {
    $city_id = sanitize($city_id);
    $query = "SELECT `id`, `main_img`, `title` FROM `sights` WHERE `city_id` = '$city_id' ORDER BY RAND() LIMIT $num_result";
    $result = mysql_query($query);
    $return = "";
    global $base_url;
    if (mysql_num_rows($result) != 0) {
        while ($row = mysql_fetch_array($result)) {
            $return .= "<div style='text-align: center' class='span2'><a href=" . $base_url . "sight/" . $row["id"] . " ><img class='img-polaroid' style='max-width:100%;' src=" . $base_url . $row['main_img'] . " /><h5>" . $row['title'] . "</h5></a></div>";
            //$return .= "<li class='inline'><a class='ava' href='" . $base_url . $row['id'] . "'><img width='50' height='50' src='" . $base_url . $row['main_img'] . "'></a><div class='name_field'><a href='" . $base_url . $row['id'] . "'><small>" . $row['title'] . "</small></a></div></li>";
        }
        return $return;
    } else {
        return "No result!";
    }
}

function city_info($city_id) {
    $city_id = sanitize($city_id);
    if (mysql_num_rows(mysql_query("SELECT `desc` FROM `city_info` WHERE `city_id` = '$city_id'")) == 1) {
        return mysql_result(mysql_query("SELECT `desc` FROM `city_info` WHERE `city_id` = '$city_id'"), 0, 'desc');
    } else {
        return false;
    }
}

function city_for_map($city_id) {
    $city_id = sanitize($city_id);
    if (empty($city_id) === false) {
        $query = mysql_query("SELECT `city_`.`city_name_ru`, `region_`.`region_name_ru` FROM `city_`, `region_` WHERE `region_`.`id` = `city_`.`id_region` AND `city_`.`id` = '$city_id'");
        while ($row = mysql_fetch_assoc($query)) {
        $city = $row['city_name_ru'] . '_' . $row['region_name_ru'];
        }
        return str_replace(' ', '_', $city);
    } else {
        return "";
    }
}

function city_from_city_id($city_id, $region = 'false') {
    $city_id = sanitize($city_id);
    $region = sanitize($region);
    if (empty($city_id) === false) {
        if (mysql_num_rows(mysql_query("SELECT `city_name_ru`, `region_name_ru` FROM `city_`, `region_` WHERE `region_`.`id` = `city_`.`id_region` AND `city_`.`id` = '$city_id'")) < 1 ) {
            return "City not found!";
        } else {
            if ($region === 'true') {
                $query = mysql_query("SELECT `city_name_ru`, `region_name_ru` FROM `city_`, `region_` WHERE `region_`.`id` = `city_`.`id_region` AND `city_`.`id` = '$city_id'");
                while (($row = mysql_fetch_assoc($query)) !== false) {
                    $city = $row['city_name_ru'] . ", " . $row['region_name_ru'];
                }
                return $city;
            } else {
                return mysql_result(mysql_query("SELECT `city_name_ru` FROM `city_` WHERE `id` = '$city_id'"), 0, 'city_name_ru');
            }
            }
    } else {
        return "";
    }
}
?>
