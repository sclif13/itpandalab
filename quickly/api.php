<?php
include 'my_functions.php';

$db_link = db_connect();


if (!empty($_POST)){
	switch ($_POST['method']) {
		case 'getCousines':
			getCousines();
			break;
		case 'getRestaurantsByCousines':
			if(!empty($_POST['cousines_id'])){
				getRestaurantsByCousines($_POST['cousines_id']);
			}
			break;
		case 'getAllRestaurants':
			getAllRestaurants();
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

function getRestaurantsByCousines($cousines_id){
	$result = mysql_query("SELECT r.* FROM restaurants as r, relationship as s
							WHERE s.cousines_id = ".$cousines_id." AND r.id = s.restaurants_id" );
	$rows = array();
	while ($r = mysql_fetch_assoc($result)) {
		$rows[] = $r;
	}

	echo json_encode($rows);

}

function getAllRestaurants(){
	$result = mysql_query("SELECT * from restaurants");
	$rows = array();
	while ($r = mysql_fetch_assoc($result)) {
		$rows[] = $r;
	}

	echo json_encode($rows);

}


db_disconnect($db_link);
?>
