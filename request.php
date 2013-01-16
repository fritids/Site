<?php
include 'core/init.php';
protect_page();
include 'includes/overall/header.php'; 
?>
<h1>Requests</h1>
<?php
if (request_count($session_user_id) < 1) {
    header('Location: index.php');
} else {
    $requests = friends_request($session_user_id);
    foreach ($requests as $friend) {
        $request_data   = user_data($friend['user_id'], 'username', 'first_name', 'last_name', 'profile');
        echo "<a href=/" . $request_data['username'] . ">" . $request_data['first_name'] . " " . $request_data['last_name'] . "</a> хочет добавить Вас в друзья. <a href=friends.php?state=accept&friend=" . $friend['user_id'] . "&user=" .$session_user_id . ">Accept</a>/<a href=friends.php?state=decline&friend=" . $friend['user_id'] . "&user=" .$session_user_id . ">Decline</a><br>";
    }
}

include 'includes/overall/footer.php'; 
?>