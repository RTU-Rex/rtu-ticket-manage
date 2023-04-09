<?php
session_start(); 
include "./controllers/dbConnect.php";


if(isset($_POST['Print'])){ 
  $id = $_POST['Print'];
  $rname = "";
  $office = "";
  $incident = "";
  $title = "";
  $description = "";
  $dCreate = "";
  $message = "";
  $status = "";
  $dStatus = "";
  $techni = "";


  $sql = "SELECT a.id, a.name, g.Office, e.IncidentName, a.title, a.description, 
          DATE(a.DateCreated) as DateCreated, TIME(a.DateCreated) as TimeCreated, 
          b.ticketMessage, b.dateModified, 
          DATE(b.dateModified) as dateModified, TIME(b.dateModified) as timeModified, 
          c.statusName, concat( d.firstName,' ', d.lastName ) Technician
  FROM tblTicket a 
  LEFT JOIN  (SELECT *, ROW_NUMBER() OVER(PARTITION BY ticketId ORDER by dateModified DESC) AS row_num 
              FROM `tblTicketHistory`) b on a.Id = b.ticketId and row_num = 1
  LEFT JOIN tblStatus c on c.id = b.ticketStatus
  LEFT JOIN tblUser d on d.id = b.technicianId
  LEFT JOIN tblIncident e on e.id = a.incident
  LEFT JOIN tblPriority f on f.id = a.priority
  LEFT JOIN tblDepartment g on g.id = a.department
  WHERE a.id = $id;";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) >= 1) {
   
      while ($row = mysqli_fetch_assoc($result)) {
      
      $rname = $row['name'] ;
      $office = $row['Office']; 
      
      if ($row['IncidentName'] == "Hardware") {
        $incident = "<td style='padding: 5px;'><input type='checkbox' checked> EDP </td><td style='padding: 5px;'><input type='checkbox' > Network Division </td><td style='padding: 5px;'><input type='checkbox' > Technical Division </td>";
      } else if( $row['IncidentName'] == "Software") {
        $incident = "<td style='padding: 5px;'><input type='checkbox'> EDP </td><td style='padding: 5px;'><input type='checkbox' checked> Network Division </td><td style='padding: 5px;'><input type='checkbox' > Technical Division </td>";
      } else {
        $incident = "<td style='padding: 5px;'><input type='checkbox'> EDP </td><td style='padding: 5px;'><input type='checkbox'> Network Division </td><td style='padding: 5px;'><input type='checkbox' checked> Technical Division </td>";
      }
      $title = $row['title']; 
      $description = $row['description']; 
      $dCreate = $row['DateCreated']; 
      $tCreate = $row['TimeCreated']; 
      $message = $row['ticketMessage']; 
      $status = $row['statusName']; 
      $dStatus = $row['dateModified']; 
      $tStatus = $row['timeModified']; 
      $techni =  $row['Technician']; 

      }           

  }

}


?>


<!DOCTYPE html>
<html>
  <head>
    <title>Technical Service Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <style>
        body {
          font-family: Arial, sans-serif;
          font-size: 14.3333px;
        }      
  
      @page {
        size: A4;
      }

     
      .container {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
      }

     @media print {
    table.table-bordered {
    border-color: black !important;
    }
    }

    table.table-bordered{
    border:1px solid black;
    }
    table.table-bordered > tbody > tr > td{
    border:1px solid black;
    }
 
      </style>
  </head>



  <body>
    <div class="container mx-auto">
        <div class="row">
            <div class="col h6">
                <strong><p>RTU-FA-MIC-F-004 RIZAL <br> TECHNOLOGICAL UNIVERSITY</p></strong>
            </div>
            <div class="col text-right h5">
                 <strong><p>Control No.: <?php echo $id; ?> <!--Ticket Number--><p></strong>
            </div>
          </div>
          
          <strong><h1 class="text-center">Technical Service Report</h1><strong>
      <div class="row">

        <div class="col-md-11">
          <table class="table table-bordered">
            <tbody>
                <colgroup>
                    <col style="width: 5.39cm">
                    <col style="width: 11.48cm">
                  </colgroup>
              <tr>
                <td>Contact Person:</td>
                <td><?php echo $rname; ?> </td>
              </tr>
              <tr>
                <td>Department:</td>
                <td><?php echo $office; ?> </td>
              </tr>
              <tr>
                <td>Serial Number:</td>
                <td><!--None--></td>
              </tr>
              <tr>
                <td>Property Number:</td>
                <td><!--None--></td>
              </tr>
            </tbody>

            <table class="col d-flex justify-content-center align-items-center">
                <tr>
                <?php echo $incident; ?>
                </tr>

            <table class="table table-bordered">
            <tbody>
            <tr>
            <td style="width: 8.50cm">Reported Problem:</td>
            <td style="width: 8.50cm">Time:<!--insert time ticket was created--></td>
            <td tyle="width: 7.50cm">Date:<!--insert date ticket was created--></td>
            <tr><td style="height: 3.90cm"><p> <?php echo $title; ?>  </p> <p> <?php echo $description; ?>  </p> </td>
            <td style="height: 3.90cm"><p> <?php echo $tCreate; ?>  </p> </td>
            <td style="height: 3.90cm"><p> <?php echo $dCreate; ?>  </p> </td>
          </tr>
            </tr>
            </tbody>


            <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td style="width: 8.50cm">Action Taken:</td>
                    <td style="width: 8.50cm">Time:<!--insert timestamp --></td>
                    <td tyle="width: 7.50cm">Date: <!--insert datestamp --></td>
                    <tr> <td style="height: 3.90cm"><p> <?php echo $message; ?>  </p></td>
            <td style="height: 3.90cm"><p> <?php echo $tStatus; ?>  </p> </td>
            <td style="height: 3.90cm"><p> <?php echo $dStatus; ?>  </p> </td> </tr>
                  </tr>
                </tbody>
            

            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td style="width: 8.50cm">Recommendation:</td>
                  <td style="width: 8.50cm">Time:<!--insert data--></td>
                  <td tyle="width: 7.50cm">Date: <!--insert data--></td>
                </tr>
                   <td colspan="3" style="padding: 10px;"><input type="checkbox" name="partreplacement" value="1"> Parts Replacement (Specify):  <!--OPTIONAL:insert 'partreplacement' textfield-->
                    <br> <input type="checkbox" name="unservicable" value="2"> Unserviceable / To Be Surrendered
                    <br> <input type="checkbox" name="others" value="3"> Others (Specify) : <!--OPTIONAL:insert 'others' textfield--> </td>
              </tbody>   
              

            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td style="width: 8.50cm">Status:</td>
                  <td style="width: 8.50cm">Time:<!--insert timestamp where the ticket was resolved--></td>
                  <td tyle="width: 7.50cm">Date: <!--insert datestamp--></td>
                  <tr><td style="height: 3.90cm"><p> <?php echo $status; ?>  </p></td>
            <td style="height: 3.90cm"><p> <?php echo $tStatus; ?>  </p> </td>
            <td style="height: 3.90cm"><p> <?php echo $dStatus; ?>  </p> </td></tr>
              </tbody>

              
            <table class="table border-0">
                        <tr>
                            <td style="width: 10cm">Client: 
                            <td style="border-bottom: 0.9px solid black;"><?php echo $rname; ?></td>
                            <td style="border-bottom: 0.9px solid black;"><!----></td>  
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align: center;">Name</td>
                            <td style="text-align: center;">Signature</td>
                        </tr>
                                                            
                        <tr>
                            <td style="width: 10cm">  Technician/Trainee: 
                            <td style="border-bottom: 0.9px solid black;"><?php echo $techni; ?></td>
                            <td style="border-bottom: 0.9px solid black;"></td>  
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align: center;">Name</td>
                            <td style="text-align: center;">Signature</td>
                        </tr>

                        <tr>
                            <td style="width: 10cm">  Immediate Head 
                            <td style="border-bottom: 0.9px solid black;"><!--insert Admin name--></td>
                            <td style="border-bottom: 0.9px solid black;"><!--insert data--></td>  
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align: center;">Name</td>
                            <td style="text-align: center;">Signature</td>
                        </tr>
                </table>
        </table>
    
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col h6">
                    <br><br><br><br>
                    <tr><strong>RIZAL TECHNOLOGICAL UNIVERSITY<span style="margin-left: 200px;">Rev.1<span style="margin-left: 300px;">Oct 1, 2019</span></strong></tr>
                </div>
              </div>
      </footer>
  </body>
</html>
