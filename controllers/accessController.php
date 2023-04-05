<?php
session_start(); 
include "dbConnect.php";

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


   

    if(isset($_POST['getAccess'])){
        $sql = "SELECT id, accessName FROM tblAccess";
		$result = mysqli_query($conn, $sql);
    	if (mysqli_num_rows($result) >= 1) {
            $value = array();
            $int = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $value[$int] =  array("id" => $row['id'],"name" => $row['accessName'] );
                $int = $int + 1;
            }           
            echo json_encode($value);
          
		}
    }

    if(isset($_POST['getMenu'])){
        $sql = "SELECT id, menuName FROM tblMenu";
		$result = mysqli_query($conn, $sql);
    	if (mysqli_num_rows($result) >= 1) {
            $value = array();
            $int = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $value[$int] =  array("id" => $row['id'],"name" => $row['menuName'] );
                $int = $int + 1;
            }           
            echo json_encode($value);
          
		}
    }

    if(isset($_POST['getAccessMenu'])){

        $id = validate($_POST['id']);

        $sql = "SELECT a.id, b.menuName 
                FROM tblAccessMenu a
                LEFT JOIN tblMenu b on a.menuId = b.id
                WHERE accessId = $id;";
		$result = mysqli_query($conn, $sql);
    	if (mysqli_num_rows($result) >= 1) {
            $value = array();
            $int = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $value[$int] =  array("id" => $row['id'],"name" => $row['menuName'] );
                $int = $int + 1;
            }           
            echo json_encode($value);
          
		}
        

    }

    if(isset($_POST['updateAccess'])){
        $menuId = validate($_POST['menuId']);
        $AccessId = validate($_POST['AccessId']);

        $sql = "INSERT INTO tblAccessMenu ( menuId, accessId) VALUES ($menuId,$AccessId);";
        if(mysqli_query($conn, $sql)) {
            $message = "You Successfully Created a new User";

            echo json_encode($message);

        }
    }

    if(isset($_POST['checkAccess'])){
        $menuId = validate($_POST['menuId']);
        $AccessId = validate($_POST['AccessId']);

        $sql = "SELECT * FROM tblAccessMenu WHERE accessId = $AccessId and menuId = $menuId;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) >= 1) {    
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }

    }

    if(isset($_POST['deleteAccess'])){
        $AccessId = validate($_POST['AccessId']);

        $sql = "DELETE FROM tblAccessMenu WHERE id = $AccessId;";
        if(mysqli_query($conn, $sql)) {
            $message = "You Successfully Created a new User";

            echo json_encode($message);

        }
    }
    
    if(isset($_POST['newAccess'])){
        $name = validate($_POST['name']);

        $sql = "INSERT INTO tblAccess( accessName) VALUES ('$name');";
        if(mysqli_query($conn, $sql)) {
            $message = "You Successfully Created a new Access";
            echo json_encode($message);

        }
    }

    if(isset($_POST['deleteAccessName'])){
        $AccessId = validate($_POST['AccessId']);

        $sql = "DELETE FROM tblAccess WHERE id = $AccessId;";
        if(mysqli_query($conn, $sql)) {
            $message = "You Successfully Created a new Access Level";

            echo json_encode($message);

        }
    }
  

  

?>