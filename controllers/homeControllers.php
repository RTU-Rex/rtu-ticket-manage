<?php
session_start(); 
include "dbConnect.php";

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }


    if(isset($_POST['gettickets'])){
        $accessid = $_SESSION['accessId'];
        $user = "1";
        if ($accessid == 2) {
            $user = $_SESSION['email'];
        }
        $prio = $_POST['priority'];

        $sql = "SELECT CASE WHEN Isnull(c.statusName) then 'Open' ELSE c.statusName END Stas,
        a.title, a.description, a.name, IFNULL(e.IncidentName, 'Not Assigned') AS IncidentName, a.Id, IFNULL(f.priorityName, '---') as priorityName, IFNULL(a.priority, 0) as prioId, g.Office,
        d.firstName, d.lastName,
        CASE 
                    WHEN a.dateModified IS NULL THEN a.DateCreated 
                    ELSE a.dateModified 
                END AS dateModified
        FROM tblTicket a 
        LEFT JOIN  (SELECT *, ROW_NUMBER() OVER(PARTITION BY ticketId ORDER by dateModified DESC) AS row_num 
                    FROM `tblTicketHistory`) b on a.Id = b.ticketId and row_num = 1
        LEFT JOIN tblStatus c on c.id = b.ticketStatus
        LEFT JOIN tblUser d on d.id = b.technicianId
        LEFT JOIN tblIncident e on e.id = a.incident
        LEFT JOIN tblPriority f on f.id = a.priority
        LEFT JOIN tblDepartment g on g.id = a.department
        WHERE NOT(CASE WHEN ISNULL(c.id) THEN 5 ELSE c.id END = 4) AND (CASE WHEN c.id = 1 THEN d.email ELSE 1 END) = '$user' AND  (CASE WHEN $prio = -1 THEN -1 ELSE IFNULL(a.priority,0) END ) = $prio;";


        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) >= 1) {
        $value = array();
        $int = 0;
        $priority_tooltip = array(
            'Critical' => 'Response Time: 1 hour or less&#10;Resolution Time: Within 24 hours',
            'High' => 'Response Time: 4-8 hours&#10;Resolution Time: Within 3 business days',
            'Moderate' => 'Response Time: 24-48 hours&#10;Resolution Time: Within 5 business days',
            'Low' => 'Response Time: 3-5 business days&#10;Resolution Time: Within 6-7 business days'
        );
        
        
    
        $badge_class = array('badge badge-danger', 'badge badge-warning', 'badge badge-info', 'badge badge-success' );

        while ($row = mysqli_fetch_assoc($result)) {
        $prioId = $row['prioId'];
        $priorityName = $row['priorityName'];
        if ($priorityName === '---') {
            $priorityNameWithBadge = '<span>' . $priorityName . '</span>';
        } else {
            $badge_class_index = $prioId > 0 ? $prioId - 1 : 0;
            $priorityNameWithBadge = '<span class="badge ' . $badge_class[$badge_class_index] . '" data-toggle="tooltip" data-placement="top" title="' . $priority_tooltip[$priorityName] . '">' . $priorityName . '</span>';
        }
        $technicianName = $row['firstName'] . ' ' . $row['lastName'];
        $technicianName = empty($row['firstName']) && empty($row['lastName']) ? 'Not assigned' : $row['firstName'] . ' ' . $row['lastName'];

        
        $value[$int] =  array(
            "Id" => $row['Id'],
            "Stas" => $row['Stas'],
            "title" => $row['title'],
            "description" => $row['description'],
            "IncidentName" => $row['IncidentName'],
            "name" => $row['name'],
            "Office" => $row['Office'],
            "priorityName" => $priorityNameWithBadge,
            "prioId" => $row['prioId'],
            "lastUpdate" => $row['dateModified'],
            "technicianName" => $technicianName
        );
        $int = $int + 1;
        }

        echo json_encode($value);
        } else {

            echo json_encode(0);

        }

    }


    if(isset($_POST['getPrio'])){
        $sql = "SELECT * FROM tblPriority";
		$result = mysqli_query($conn, $sql);
    	if (mysqli_num_rows($result) >= 1) {
            $value = array();
            $int = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $value[$int] =  array("id" => $row['id'],"name" => $row['priorityName'] );
                $int = $int + 1;
            }           
            echo json_encode($value);
          
		}
    }

    if(isset($_POST['getTech'])){
        $accessid = $_SESSION['id'];
        $sql = "SELECT id, CONCAT(lastName,', ',firstName) as name FROM tblUser WHERE not(accessId = 1);";
		$result = mysqli_query($conn, $sql);
    	if (mysqli_num_rows($result) >= 1) {
            $value = array();
            $int = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $value[$int] =  array("id" => $row['id'],"name" => $row['name'], "accessid" => $accessid );
                $int = $int + 1;
            }           
            echo json_encode($value);
          
		}
    }

    if(isset($_POST['getRecomend'])){
        $sql = "SELECT id, name FROM tblRecomend;";
		$result = mysqli_query($conn, $sql);
    	if (mysqli_num_rows($result) >= 1) {
            $value = array();
            $int = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $value[$int] =  array("id" => $row['id'],"name" => $row['name'] );
                $int = $int + 1;
            }           
            echo json_encode($value);
          
		}
    }

    if(isset($_POST['getTicketDetails'])){
        $ticketId = validate($_POST['ticketId']);
 
        $sql = "SELECT 	email,
                        empId,
                        name,
                        b.Department,
                        a.department as Offices,
                        description,
                        incident,
                        IFNULL(priority,0) priority,
                        IFNULL(contactType,0) contactType,
                        title 
                FROM tblTicket a
                LEFT JOIN tblDepartment b 
                ON a.department = b.id
                WHERE a.id = $ticketId;";
       $result = mysqli_query($conn, $sql);
       if (mysqli_num_rows($result) >= 1) {
           $value = array();
           $int = 0;
           while ($row = mysqli_fetch_assoc($result)) {
               $value[$int] =  array(  "email" => $row['email'],
                                       "empId" => $row['empId'],
                                       "name" => $row['name'],
                                       "Department" => $row['Department'],
                                       "Offices" => $row['Offices'],
                                       "description" => $row['description'],
                                       "incident" => $row['incident'],
                                       "priority" => $row['priority'],
                                       "contactType" => $row['contactType'],
                                       "title" => $row['title']);
               $int = $int + 1;
           }           
           echo json_encode($value);
         
       } else {
        echo json_encode(0);

       }
    }

    if(isset($_POST['updateTicket'])){

        $sessionId = $_SESSION['id'];
        $id = validate($_POST['ticketId']);
        $email = validate($_POST['txtEmail']);
        $name = validate($_POST['txtEmpName']);
        $incident = validate($_POST['cmbIncident']);
        $department = validate($_POST['cmbDepartment']);
        $title = validate($_POST['txtTitle']);
        $description = validate($_POST['txtdescription']);
        $prio = validate($_POST['cmbPrio']);

    
        $sql = "UPDATE tblTicket 
                SET email='$email', name='$name', 
                    department=$department,
                    description='$description',incident=$incident,
                    modifiedBy=$sessionId,dateModified=CURRENT_TIMESTAMP(),
                    priority=$prio,
                    title='$title' 
                WHERE id=$id;";
        if(mysqli_query($conn, $sql)) {
            $message = "You successfully updated ticket. $id";
            echo json_encode($message);

        }
    }

    if(isset($_POST['createJourney'])){
        $ticketId = validate($_POST['ticketId']);
        $cmbStatus = validate($_POST['cmbStatus']);
        $txtdescription = validate($_POST['txtdescription']);
        $tech = validate($_POST['cmbTech']);
        $recommend = validate($_POST['recommend']);
        $dRecomend = validate($_POST['dRecomend']);
        $sessionId = $_SESSION['id'];
        $propertyNumber = validate($_POST['propertyNumber']);
        $serialNumber = validate($_POST['serialNumber']);
        
        if($recommend == '') {
            $recommend = 0;
        }
        
        $sql = "";
        if ($cmbStatus == 5) {
            $sql = "INSERT INTO tblTicketHistory 
                            ( ticketId, 
                              ticketStatus, 
                              ticketMessage,
                              modifiedBy,
                              fileAttach, recomend, recomendDes, property_number, serial_number) 
                VALUES ($ticketId,$cmbStatus,'$txtdescription',$sessionId,'1',$recommend, '$dRecomend', '$propertyNumber', '$serialNumber');";
        } else {
            $sql = "INSERT INTO tblTicketHistory 
                            ( ticketId, 
                              ticketStatus, 
                              ticketMessage,
                              technicianId, 
                              modifiedBy,
                              fileAttach, recomend ,recomendDes, property_number, serial_number) 
                VALUES ($ticketId,$cmbStatus,'$txtdescription',$tech,$sessionId,'1',$recommend, '$dRecomend', '$propertyNumber', '$serialNumber');";
        }
       
        if(mysqli_query($conn, $sql)) {
            $message = "You successfully updated ticket";
            echo json_encode($message);
        } else {
            $message = "Something went wrong.";
            echo json_encode($message);
        }
    }

    

    if(isset($_POST['getTicketsJourneyHistory'])){
        $ticketId = validate($_POST['ticketId']);
        $sessionId = $_SESSION['id'];

        $sql = "SELECT a.ticketMessage, IFNULL(a.ticketStatus,0) ticketStatus ,IFNULL(recomend,0) recomend, IFNULL(recomendDes, '') recomendDes,c.email, b.statusName, c.name, a.dateModified, IFNULL(a.technicianId,0) technicianId ,  IFNULL(CONCAT(f.firstName,' ',f.lastName),'') as techName , IFNULL(CONCAT(e.accessName,'(', d.firstName,' ', d.lastName, ')'), 'REQUESTOR') AS Tech , IFNULL(a.modifiedFrom, CASE WHEN a.modifiedBy = $sessionId then 'User' else 'admin' end ) modifiedFrom,
                IFNULL(serial_number, '') serial_number, IFNULL(property_number, '') property_number, c.DateCreated
                FROM tblTicketHistory a 
                LEFT JOIN tblStatus b on a.ticketStatus = b.id 
                LEFT JOIN tblTicket c on c.Id = a.ticketId 
                LEFT JOIN tblUser d on d.id = a.modifiedBy
                LEFT JOIN tblUser f on f.id = a.technicianId
                LEFT JOIN tblAccess e on e.id = d.accessId
                WHERE a.ticketId = $ticketId;";
       $result = mysqli_query($conn, $sql);
       if (mysqli_num_rows($result) >= 1) {
           $value = array();
           $int = 0;
           while ($row = mysqli_fetch_assoc($result)) {
               $value[$int] =  array(  "ticketMessage" => $row['ticketMessage'],
                                       "statusName" => $row['statusName'],
                                       "name" => $row['name'],
                                       "dateModified" => date('M d, Y h:i A', strtotime($row['dateModified'])),
                                       "modifiedFrom" => $row['modifiedFrom'],
                                       "email" => $row['email'],
                                       "technicianId" => $row['technicianId'],
                                       "recomend" => $row['recomend'],
                                       "recomendDes" => $row['recomendDes'],
                                       "ticketStatus" => $row['ticketStatus'],
                                       "techName" => $row['techName'],
                                       "Tech" => $row['Tech'],
                                       "serial_number" => $row['serial_number'],
                                       "property_number" => $row['property_number'],
                                       "dateCreated" => date('M d, Y h:i A', strtotime($row['DateCreated'])),
                                    );
               $int = $int + 1;
           }           
           echo json_encode($value);
        } else {
            echo json_encode("0");
    
       }
    }

    if(isset($_POST['getTicketsJourney'])){
        $ticketId = validate($_POST['ticketId']);
        $accessId = $_SESSION['accessId']; 

        $sql = "SELECT a.Id, email, name, title, description, IFNULL(b.IncidentName, 'Unassigned') AS IncidentName, c.Office, a.DateCreated, 
                CASE 
                    WHEN a.dateModified IS NULL THEN a.DateCreated 
                    ELSE a.dateModified 
                END AS dateModified, IFNULL(fileAttach,'0') fileAttach
        FROM tblTicket a 
        LEFT JOIN tblIncident b ON a.incident = b.id 
        LEFT JOIN tblDepartment c ON a.department = c.id  
        WHERE a.Id = $ticketId";

		$result = mysqli_query($conn, $sql);
    	if (mysqli_num_rows($result) >= 1) {
            $value = array();
            $int = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $link = $row['fileAttach'];
                $file = "";
                if ( !($link == '0'))   {
                    $file = "<br>File : <a target='_blank' href='./uploads/$link'>View Attached</a>";
                }
                $value[$int] =  array(  "id" => $row['Id'],
                                        "email" => $row['email'],
                                        "name" => $row['name'],
                                        "title" => $row['title'],
                                        "description" => $row['description'],
                                        "IncidentName" => $row['IncidentName'],
                                        "Office" => $row['Office'],
                                        "access" => $accessId,
                                        "file" => $file,
                                        "dateModified" => date('M d, Y h:i A', strtotime($row['dateModified'])),
                                        "DateCreated" => $row['DateCreated'] );
                $int = $int + 1;
            }           
            echo json_encode($value);
          
		}
    }


    if(isset($_POST['getTechs'])){
        $ticketId = validate($_POST['ticketId']);
        $sql = "SELECT a.id, CONCAT(b.lastName,', ',b.firstName) as name 
        FROM tblTechShared a 
        LEFT JOIN tblUser b on a.userId = b.id 
        WHERE a.ticketId = $ticketId;";
		$result = mysqli_query($conn, $sql);
    	if (mysqli_num_rows($result) >= 1) {
            $value = array();
            $int = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $value[$int] =  array("id" => $row['id'],"name" => $row['name'], "accessid" => $accessid );
                $int = $int + 1;
            }           
            echo json_encode($value);
          
		} else {

            echo json_encode(0);
        }
    }

    if(isset($_POST['updateTechs'])){
        $ticketId = validate($_POST['ticketId']);
        $tech = validate($_POST['tech']);
        $sql = "INSERT INTO tblTechShared ( ticketId, userId) VALUES ($ticketId,$tech);";
        if(mysqli_query($conn, $sql)) {
            $message = "You Successfully Created a new User";

            echo json_encode($message);

        }
    }

    if(isset($_POST['DeleteTechs'])){
        $id = validate($_POST['id']);

        $sql = "DELETE FROM tblTechShared WHERE id = $id;";
        if(mysqli_query($conn, $sql)) {
            $message = "You Successfully Created a new User";

            echo json_encode($message);

        }
    }

    if(isset($_POST['checkTechExist'])){
        $ticketId = validate($_POST['id']);
        $tech = validate($_POST['tech']);

        $sql = "SELECT * FROM tblTechShared WHERE ticketId = $ticketId and userId = $tech;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) >= 1) {    
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }

    }
?>