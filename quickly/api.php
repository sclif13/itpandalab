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
		case 'getCategories':
			if(!empty($_POST['restaurant_id'])){
				getCategories($_POST['restaurant_id']);
			}
			break;
		case 'getFoods':
			if(!empty($_POST['restaurant_id']) && !empty($_POST['categorie_id'])){
				getFoods($_POST['restaurant_id'],$_POST['categorie_id']);
			}
			break;
		case 'getDopFoods':
			if(!empty($_POST['restaurant_id']) && !empty($_POST['categorie_id']) && !empty($_POST['food_id'])){
				getDopFoods($_POST['restaurant_id'],$_POST['categorie_id'],$_POST['food_id']);
			}
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

function getCategories($restaurant_id){
	$result = mysql_query("SELECT * from categories WHERE restaurant_id =".$restaurant_id);
	$rows = array();
	while ($r = mysql_fetch_assoc($result)) {
		$rows[] = $r;
	}

	echo json_encode($rows);
}

function getFoods($categorie_id, $restaurant_id){
	$result = mysql_query("SELECT * from foods WHERE restaurant_id =".$restaurant_id."
							AND priority_meal = 0 AND categorie_id =".$categorie_id);
	$rows = array();
	while ($r = mysql_fetch_assoc($result)) {
		$rows[] = $r;
	}

	echo json_encode($rows);	
}		

function getDopFoods($categorie_id, $restaurant_id, $food_id){
	$result = mysql_query("SELECT * from foods WHERE restaurant_id =".$restaurant_id."
							AND priority_meal = 1 AND categorie_id =".$categorie_id."
							AND id =".$food_id);
	$rows = array();
	while ($r = mysql_fetch_assoc($result)) {
		$rows[] = $r;
	}

	echo json_encode($rows);	
}		

db_disconnect($db_link);
?>
