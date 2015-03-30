<?php
include 'my_functions.php';

$db_link = db_connect();


if (!empty($_POST)){
	switch ($_POST['method']) {
		case 'getCousines':
			getCousines();
			break;
		
		default:
			break;
	}
}

function getCousines(){
	$result = mysql_query("SELECT * from cousines");
	$rows = array();
	while ($r = mysql_fetch_assoc($result)) {
		$rows[] = $r;
	}

	echo json_encode($rows);

}

db_disconnect($db_link);
?>
