<?php
$connect_error = 'Sorry, we\'re experiencing connection problems.';
mysql_connect('localhost', 'root', '') or die($connect_error);
mysql_select_db('gosti') or die($connect_error);
//mysql_query('SET @@collation_connection = @@collation_database');
mysql_query("SET NAMES UTF8");
?>
