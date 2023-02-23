<?php
include_once "includes/db.php";
if ($_POST['action'] == 'edit' && $_POST['id']) {	
	$updateField='';
	if(isset($_POST['first_name'])) {
		$updateField.= "first_name='".$_POST['first_name']."'";
	} else if(isset($_POST['last_name'])) {
		$updateField.= "last_name='".$_POST['last_name']."'";
	} else if(isset($_POST['display_name'])) {
		$updateField.= "display_name='".$_POST['display_name']."'";
	}
	if($updateField && $_POST['id']) {
		$sqlQuery = "UPDATE developers SET $updateField WHERE id='" . $_POST['id'] . "'";	
		mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));	
		$data = array(
			"message"	=> "Record Updated",	
			"status" => 1
		);
		echo json_encode($data);
    }
}


        if ($_POST['action'] == 'delete' && $_POST['id']) {
            $sqlQuery = "DELETE FROM member WHERE id='" . $_POST['id'] . "'";	
            mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));	
            $data = array(
                "message"	=> "Record Deleted",	
                "status" => 1
            );
            echo json_encode($data);	
        }
        ?>