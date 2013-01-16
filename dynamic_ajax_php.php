<?php
include 'core/init.php';
if ($_GET['mode'] === 'cities') {
    // Array indexes are 0-based, jCarousel positions are 1-based.
    $first = max(0, intval($_GET['first']) - 1);
    $last  = max($first + 1, intval($_GET['last']) - 1);
    $city_id = $_GET['cityID'];
    $length = $last - $first + 1;

    $query = "SELECT `main_img`, `title` FROM `sights` WHERE `city_id` = '$city_id'";
    $total1 = mysql_num_rows(mysql_query($query));
    $images = array();
    $result = mysql_query($query);
                    while (($row = mysql_fetch_assoc($result)) !== false) {
                        $images[] = $base_url . $row['main_img'];
                    }
    $total = count($images);
    $selected = array_slice($images, $first, $length);

    // ---

    header('Content-Type: text/xml');

    echo '<data>';

    // Return total number of images so the callback
    // can set the size of the carousel.
    echo '  <total>' . $total . '</total>';

    foreach ($selected as $img) {
        echo '  <image>' . $img . '</image>';
    }

    echo '</data>';
} else if ($_GET['mode'] === 'users') {
        // Array indexes are 0-based, jCarousel positions are 1-based.
    $first = max(0, intval($_GET['first']) - 1);
    $last  = max($first + 1, intval($_GET['last']) - 1);
    $city_id = $_GET['cityID'];
    $length = $last - $first + 1;

    $query = "SELECT `first_name`, `profile` FROM `users` WHERE `city_id` = '$city_id'";
    $total1 = mysql_num_rows(mysql_query($query));
    $images = array();
    $result = mysql_query($query);
                    while (($row = mysql_fetch_assoc($result)) !== false) {
                        $images[] = $base_url . $row['profile'];
                    }
    $total = count($images);
    $selected = array_slice($images, $first, $length);

    // ---

    header('Content-Type: text/xml');

    echo '<data>';

    // Return total number of images so the callback
    // can set the size of the carousel.
    echo '  <total>' . $total . '</total>';

    foreach ($selected as $img) {
        echo '  <image>' . $img . '</image>';
    }

    echo '</data>';

}
?>