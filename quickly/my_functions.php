<?php
function db_connect() {
  $db_host = 'localhost';
  $db_user = 'user';
  $db_pass = 'P@ssw0rd';
  $db_name = 'quickly';

  $link = mysql_connect($db_host, $db_user, $db_pass);
  if (!$link) {
      die('Ошибка соединения с БД: ' . mysql_error());
  } else {
    mysql_select_db($db_name, $link);
	mysql_query("SET character_set_results = 'utf8'");
	mysql_query("SET NAMES 'UTF-8'");
	mysql_set_charset('utf8',$link);
  }
  return $link;
}

function db_disconnect($link) {
  mysql_close($link);
}
?>
