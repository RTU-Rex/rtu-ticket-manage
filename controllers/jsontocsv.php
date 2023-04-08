<?php 
 
// Load the database configuration file 
include_once '../controllers/dbConnect.php'; 
 



        // Fetch records from database 
        $query = $conn->query("SELECT DISTINCT Department FROM tblDepartment;"); 
        
        if($query->num_rows > 0){ 
            $delimiter = ","; 
            $filename = "members-data_" . date('Y-m-d') . ".csv"; 
            
            // Create a file pointer 
            $f = fopen('php://memory', 'w'); 
            
            // Set column headers 
            $fields = array('ID'); 
            fputcsv($f, $fields, $delimiter); 
            
            // Output each row of the data, format line as csv and write to file pointer 
            while($row = $query->fetch_assoc()){ 
            
                $lineData = array($row['Department']); 
                fputcsv($f, $lineData, $delimiter); 
            } 
            
            // Move back to beginning of file 
            fseek($f, 0); 
            
            // Set headers to download file rather than displayed 
            header('Content-Type: text/csv'); 
            header('Content-Disposition: attachment; filename="' . $filename . '";'); 
            
            //output all remaining data on a file pointer 
            fpassthru($f); 
        } 
        exit; 



 
?>