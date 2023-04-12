<?php
include "./controllers/dbConnect.php";
if(isset($_FILES["file"]["name"])){

    $filename = $_POST['filename'];

    $target_directory = "uploads/";
    $target_file = $target_directory.basename($_FILES["file"]["name"]);   //name is to get the file name of uploaded file
    $filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $newfilename = $target_directory.$filename.".".$filetype;
    $docu = $filename.".".$filetype;
    
    //move_uploaded_file($_FILES["file"]["tmp_name"],$newfilename);   // tmp_name is the file temprory stored in the server
    //Now to check if uploaded or not
    if(move_uploaded_file($_FILES["file"]["tmp_name"],$newfilename)) {
        $sql = "UPDATE tblTicket 
        SET fileAttach='$docu'  
        WHERE id = $filename;";
            if(mysqli_query($conn, $sql)) {
                echo json_encode('1');
            } else {
                $message = "Something went wrong.";
                echo json_encode($message);
            }
    } else {

        echo json_encode(0);
    }


   
   



}


?>