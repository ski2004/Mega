<?php
require_once "./db.php" ;

$action = "GET";

if(isset($_POST["ID"]))
	$action = "POST" ;

    // echo $action ;
    // print_r($_POST);
switch($action){

    case "POST":
        $db = new DB();
        $res = $db->post($_POST);
        echo $res ;
		break;
		
	case "GET":
        $db = new DB();
        $res = $db->get();
        $json = json_encode($res);     
        echo $json;
        break;

	default :
		//404 - not found;
		break;
}
?>