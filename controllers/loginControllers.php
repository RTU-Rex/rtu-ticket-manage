<?php
session_start(); 
include "dbConnect.php";

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    if(isset($_POST['getLoginDetails'])){
        $email = validate($_POST['txtEmail']);
        $password = validate($_POST['txtpassword']);

        $sql = "SELECT id, email, firstName, lastName, accessId, password FROM tblUser WHERE email = '$email';";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            $hashcheck = password_verify($password, $row['password']);
                if ($hashcheck) {

                    $_SESSION['id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['firstName'] = $row['firstName'];
                    $_SESSION['lastName'] = $row['lastName'];
                    $_SESSION['accessId'] = $row['accessId'];
    
                    $message = "1";
                    echo json_encode($message);

                } else {
                    $message = "Please make sure you input correct username and password.";
                    echo json_encode($message);

                }
              
		}else{
            $message = "Please make sure you input correct username and password.";
            echo json_encode($message);
		}
    }

    if(isset($_POST['isEmailValid'])){
        $email = validate($_POST['txtEmail']);

        $sql = "SELECT * FROM tblUser WHERE email = '$email';";
        $result = mysqli_query($conn, $sql);
    	if (mysqli_num_rows($result) >= 1) {
            $value = array();
            $int = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $value[$int] =  array("id" => $row['id'],"name" => $row['firstName'] );
                $int = $int + 1;
            }           
            echo json_encode($value);
          
		} else {
            $value = array();
            $value[0] =  array("id" => 0 );
        }
    }

    if(isset($_POST['GetOTP'])){
        $id = validate($_POST['id']);
        $six_digit_random_number = random_int(100000, 999999);
        $sql = "INSERT INTO tblForgetPass (OTPCode, userId) VALUES ('$six_digit_random_number',$id);";
        if(mysqli_query($conn, $sql)) {
            echo json_encode($six_digit_random_number);
        } else {
            $message = "Something went wrong.";
            echo json_encode($message);
        }
    }

    if(isset($_POST['getVerifyOTP'])){
        $id = validate($_POST['id']);
        $otpcode = validate($_POST['otpcode']);

        $sql = "SELECT userId,DATE_ADD(dateCreated, INTERVAL 1 MINUTE),Now()  
                FROM tblForgetPass 
                WHERE DATE_ADD(dateCreated, INTERVAL 15 MINUTE) > Now() and userId = $id and OTPCode = '$otpcode';";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) >= 1) {
                    $message = "1";
                    echo json_encode($message);
              
		}else{
            $message = "Please Enter Correct OTP.";
            echo json_encode($message);
		}
    }

    if(isset($_POST['updatePass'])){
        $id = validate($_POST['id']);
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
       
        $sql = "UPDATE tblUser 
                SET password='$password',modifiedBy=$id,dateModified=CURRENT_TIMESTAMP() 
                WHERE id = $id;";
        if(mysqli_query($conn, $sql)) {
            echo json_encode('1');
        } else {
            $message = "Something went wrong.";
            echo json_encode($message);
        }
    }

    if(isset($_POST['getLogout'])){
        session_start();

        session_unset();
        session_destroy();

        $message = "1";
        echo json_encode($message);
    }


    if(isset($_POST['checkPass'])){
        $password = validate($_POST['pass']);
        $sessionId = $_SESSION['id'];

        $sql = "SELECT id, email, firstName, lastName, accessId, password FROM tblUser WHERE id = $sessionId;";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            $hashcheck = password_verify($password, $row['password']);
                if ($hashcheck) {
                    $message = "1";
                    echo json_encode($message);

                } else {
                    $message = "0";
                    echo json_encode($message);

                }
              
		}else{
            $message = "0";
            echo json_encode($message);
		}
    }

    if(isset($_POST['updatePassHome'])){
        $sessionId = $_SESSION['id'];
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
       
        $sql = "UPDATE tblUser 
                SET password='$password',modifiedBy= $sessionId,dateModified=CURRENT_TIMESTAMP() 
                WHERE id =  $sessionId;";
        if(mysqli_query($conn, $sql)) {
            echo json_encode('1');
        } else {
            $message = "Something went wrong.";
            echo json_encode($message);
        }
    }

  

?>