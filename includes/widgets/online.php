<?php
$session=session_id();
$time=time();
$time_check=$time-600; //SET TIME 10 Minute
$tbl_name="user_online"; // Table name
$sql="SELECT * FROM $tbl_name WHERE session='$session'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
if(isset($session_user_id) === false){
    $session_user_id = 1;
}
if($count=="0"){
$sql1="INSERT INTO $tbl_name(session, time, user_id)VALUES('$session', '$time', '$session_user_id')";
$result1=mysql_query($sql1);
}
else {
$sql2="UPDATE $tbl_name SET time='$time', user_id='$session_user_id' WHERE session = '$session'";
$result2=mysql_query($sql2);
}
$sql3="SELECT * FROM $tbl_name WHERE `user_id` = 1";
$result3=mysql_query($sql3);
$count_guest_online=mysql_num_rows($result3);
$sql4="SELECT * FROM $tbl_name";
$result4=mysql_query($sql4);
$count_user_online=mysql_num_rows($result4);
?>
        <li>Пользователей: <?php echo $count_user_online - $count_guest_online; ?></li>
        <li>Гостей: <?php echo $count_guest_online; ?></li>
        <li>Всего: <?php echo $count_user_online; ?></li>
<?php
// if over 10 minute, delete session
$sql5="DELETE FROM $tbl_name WHERE time<$time_check";
$result5=mysql_query($sql5);

// Open multiple browser page for result
?>
