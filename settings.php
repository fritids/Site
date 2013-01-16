<?php 
include 'core/init.php';
protect_page();
include 'includes/overall/header.php'; 

if (empty($_POST) === false) {
    $required_fields = array('first_name', 'email', 'city');
    foreach($_POST as $key=>$value) {
        if (empty($value) && in_array($key, $required_fields) === true) {
            $errors[] = 'Fields marked with an asterisk are required';
            break 1;
        }
    }
    
    if (empty($errors) === true) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
            $errors[] = 'A valid email adress is required';
        } else if (email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']) {
            $errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use.';
        }
    }
}

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
<h1>Settings</h1>

<?php
if (isset($_GET['success']) && empty($_GET['success'])) {
    echo 'Your details have been updated!';
} else {
    if (empty($_POST) === false && empty($errors) === true) {
        
        $update_data = array(
            'first_name'     => $_POST['first_name'],
            'last_name'      => $_POST['last_name'],
            'email'          => $_POST['email'],
			'city_id'		 => $_POST['cityID'],
            'allow_email'    => ($_POST['allow_email'] == 'on') ? 1 : 0
        );
        
        update_user($session_user_id, $update_data);
        header('Location: settings.php?success');
        exit();

    } else if (empty($errors) === false) {
        echo output_errors($errors);
    }
?>

<form action="" method="post">
    <ul>
        <li>
            First name*:<br>
            <input type="text" name="first_name" value="<?php echo $user_data['first_name']; ?>">
        </li>
        <li>
            Last name:<br>
            <input type="text" name="last_name" value="<?php echo $user_data['last_name']; ?>">
        </li>
		<li> 
			City*:<br>
			<div class="ausu-suggest">
				<input type="text" size="25" value="<?php echo city_from_city_id($user_data['city_id']); ?>" name="city" id="city" autocomplete="off" />
				<input type="hidden" size="6" value="<?php echo $user_data['city_id']; ?>" name="cityID" id="cityid" autocomplete="off" />
			</div>
        </li>
        <li>
            Email*:<br>
            <input type="text" name="email" value="<?php echo $user_data['email']; ?>">
        </li>
        <li>
            <input type="checkbox" name="allow_email"<?php if ($user_data['allow_email'] == 1) { echo 'checked="checked"'; } ?>> Would you like to recieve email from us?
        </li>
        <li>
            <input type="submit" value="Update">
        </li>
    </ul>
</form>

<?php
}
include 'includes/overall/footer.php'; 
?>
