<?php
include 'core/init.php';
protect_page();
$sql4="DELETE FROM $tbl_name WHERE time<$time_check";
$result4=mysql_query($sql4);
$session=session_id();
$time=time();
$time_check=$time-600; //SET TIME 10 Minute
$tbl_name="user_online"; // Table name
$sql="SELECT * FROM $tbl_name WHERE session='$session'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
if($count=="0"){
$sql1="INSERT INTO $tbl_name(session, time)VALUES('$session', '$time')";
$result1=mysql_query($sql1);
}
else {
$sql2="UPDATE $tbl_name SET time='$time' WHERE session = '$session'";
$result2=mysql_query($sql2);
}
$sql3="SELECT * FROM $tbl_name";
$result3=mysql_query($sql3);
$count_user_online=mysql_num_rows($result3);
?>
<div class="widget">
    <h2>Users online</h2>
    <div class="inner">
        We current have <?php echo $$count_user_online; ?> online user.
    </div>
</div>
<?php
// if over 10 minute, delete session

mysql_close();
// Open multiple browser page for result
?>
