<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/header.php'; 
?>
<link rel="stylesheet" href="css/complete.css" type="text/css" media="screen" charset="utf-8" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.ausu-autosuggest.min.js"></script>
<script>
$(document).ready(function() {
    $.fn.autosugguest({  
           className: 'ausu-suggest',
          methodType: 'POST',
            minChars: 2,
              rtnIDs: true,
            dataFile: 'data.php'
    });
});
</script>
<?php
if (isset($_POST['cityID']) === true && empty($_POST['cityID']) === false) {
    $cityID = $_POST['cityID'];
} else {
    $cityID = $user_data['city_id'];
}
?>
<form action="" method="post" class="form-wrapper">
    <ul>
        <li> 
            <h1>Search city</h1><br>
            <div class="ausu-suggest">
                <input type="text" size="25" value="<?php //echo city_from_city_id($cityID, 'true'); ?>" id="scity" autocomplete="off" placeholder="<?php echo city_from_city_id($cityID); ?>" required/>
                <input type="hidden" size="6" value="<?php echo $cityID; ?>" name="cityID" id="cityid" autocomplete="off" />
                <input type="submit" value="Search" id="submit"></div>
        </li>
    </ul>
</form>
<?php
if (isset($_POST['cityID']) === true && empty($_POST['cityID']) === false) {
    if (city_info($_POST['cityID']) === false){
        echo "Add info";
    } else {
        echo city_info($_POST['cityID']);
    }
}
include 'includes/overall/footer.php'; 
?>