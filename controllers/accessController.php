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

        $sql = "SELECT a.id, b.menuName, c.isActive
                FROM tblAccessMenu a
                LEFT JOIN tblMenu b on a.menuId = b.id
                LEFT JOIN tblAccess c on c.id = a.accessId
                WHERE accessId = $id and isnull(b.id) = false;";
		$result = mysqli_query($conn, $sql);
    	if (mysqli_num_rows($result) >= 1) {
            $value = array();
            $int = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $value[$int] =  array("id" => $row['id'],"name" => $row['menuName'], "isActive" => $row['isActive']  );
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
        $isActive = validate($_POST['isActive']);
        $sql = "UPDATE tblAccess SET isActive=$isActive  WHERE id = $AccessId;";
        if(mysqli_query($conn, $sql)) {
            $message = "You Successfully Deactivate Access Level";

            echo json_encode($message);

        }
    }

    if(isset($_POST['getMainMenu'])){
        $sql = "SELECT DISTINCT Child FROM tblMenu;";
		$result = mysqli_query($conn, $sql);
    	if (mysqli_num_rows($result) >= 1) {
            $value = array();
            $int = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $value[$int] =  array("id" => $row['Child'],"name" => $row['Child'] );
                $int = $int + 1;
            }           
            echo json_encode($value);
          
		}
    }

    if(isset($_POST['newMenu'])){
        $name = validate($_POST['name']);
        $url = validate($_POST['url']);
        $icon = $_POST['icon'];
        $mainMenu = validate($_POST['mainMenu']);

        $sql = "INSERT INTO tblMenu ( menuName, Child, URL, icon) VALUES ('$name','$mainMenu','$url','$icon');";
        if(mysqli_query($conn, $sql)) {
            $message = "You successfully created menu";

            echo json_encode($message);

        }
    }

    if(isset($_POST['deleteMenu'])){
        $MenuId = validate($_POST['MenuId']);

        $sql = "DELETE FROM tblMenu WHERE id = $MenuId;";
        if(mysqli_query($conn, $sql)) {
            $message = "You Successfully Created a new Access Level";

            echo json_encode($message);

        }
    }

    if(isset($_POST['getMenuDetails'])){
        $menuId = validate($_POST['menuId']);

        $sql = "SELECT * FROM tblMenu WHERE id = $menuId;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) >= 1) {
            $value = array();
            $int = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $value[$int] =  array(  "menuName" => $row['menuName'],
                                        "Child" => $row['Child'],
                                        "URL" => $row['URL'],
                                        "icon" => $row['icon']);
                $int = $int + 1;
            }           
            echo json_encode($value);
          
        }
    }

    if(isset($_POST['updateMenu'])){
        $name = validate($_POST['name']);
        $url = validate($_POST['url']);
        $icon = $_POST['icon'];
        $mainMenu = validate($_POST['mainMenu']);
        $id = validate($_POST['id']);

        $sql = "UPDATE tblMenu SET menuName='$name',Child='$mainMenu',URL='$url',icon='$icon' WHERE id= $id";
        if(mysqli_query($conn, $sql)) {
            $message = "You successfully updated menu";
            echo json_encode($message);

        }
    }


  

  

?>