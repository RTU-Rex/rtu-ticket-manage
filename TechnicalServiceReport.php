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
  $recommend = "";


  $sql = "SELECT a.id, a.name, g.Office, e.IncidentName, a.title, a.description, 
          DATE(a.DateCreated) as DateCreated, TIME(a.DateCreated) as TimeCreated, 
          b.ticketMessage, b.dateModified, 
          DATE(b.dateModified) as dateModified, TIME(b.dateModified) as timeModified, 
          c.statusName, concat( d.firstName,' ', d.lastName ) Technician , b.recomend, b.recomendDes
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
      if ($row['recomend'] == 1) {
        $recommend  = "<input type='checkbox' name='partreplacement' value='1' checked> Parts Replacement (Specify):  ". $row['recomendDes'] ." <br> <input type='checkbox' name='unservicable' value='2'> Unserviceable / To Be Surrendered <br> <input type='checkbox' name='others' value='3'> Others (Specify) : ";
      } else if ($row['recomend'] == 2) {

        $recommend  = "<input type='checkbox' name='partreplacement' value='1'> Parts Replacement (Specify): <br> <input type='checkbox' name='unservicable' value='2' checked> Unserviceable / To Be Surrendered <br> <input type='checkbox' name='others' value='3'> Others (Specify) : ";
      } else {
        $recommend  = "<input type='checkbox' name='partreplacement' value='1' > Parts Replacement (Specify): <br> <input type='checkbox' name='unservicable' value='2'> Unserviceable / To Be Surrendered <br> <input type='checkbox' name='others' value='3' checked> Others (Specify) : ". $row['recomendDes'] ." ";

      }

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
          font-size: 10px;
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


  <script src="js/jquery-3.6.3.min.js"></script>  
  <script src="./dist/html2pdf.bundle.min.js"></script>
  <body>
  <div id="content" class="container mx-auto"> 
    <div class="row">
              <div class="col h6" style="margin-left: 2%;" >
                  <strong><p>RTU-FA-MIC-F-004 <br> RIZAL TECHNOLOGICAL UNIVERSITY</p></strong>
              </div>
              <div class="col text-right h5 " style="margin-right: 2%;">
                  <strong><p>Control No.: <?php echo $id; ?> <!--Ticket Number--><p></strong>
              </div>
             
    </div>
    <div class="text-center" class="row">  <strong><h2>TECHNICAL SERVICE REPORT</h2><strong> </div>
    <div class="row" style="margin-left: 2%; margin-right: 2%;"> 
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
                </table>
      </div>

    <div class="row" style="margin-left: 2%; margin-right: 2%;"> 
    <table class="col d-flex justify-content-center align-items-center"><tr><?php echo $incident; ?></tr></table>
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td style="width: 8.50cm">Reported Problem:</td>
                        <td style="width: 8.50cm">Time: <?php echo $tCreate; ?> </td>
                        <td tyle="width: 7.50cm">Date: <?php echo $dCreate; ?></td>
                        <tr><td colspan ="3" style="height: 3.90cm"> <h4> <?php echo $title; ?></h4> <br><h5> <?php echo $description; ?></h5></td></tr>
                      </tr>
    
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td style="width: 8.50cm">Action Taken:</td>
                          <td style="width: 8.50cm">Time: <?php echo $tStatus; ?></td>
                          <td tyle="width: 7.50cm">Date: <?php echo $dStatus; ?> </td>
                          <tr><td colspan ="3" style="height: 3.90cm"> <h4><?php echo $message; ?></h4> </td></tr>
                        </tr>
                      </tbody>
                    </table>
   
    
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td style="width: 8.50cm">Recommendation:</td>
                        <td style="width: 8.50cm">Time:<?php echo $tStatus; ?></td>
                        <td tyle="width: 7.50cm">Date: <?php echo $dStatus; ?></td>
                      </tr>
                      <tr>
                        <td colspan="3" style="padding: 10px; height: 1.90cm;"> <?php echo $recommend; ?>
                          </td>
                      </tr>
                    </tbody>
                  </table>   
   
    
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td style="width: 8.50cm">Status:</td>
                        <td style="width: 8.50cm">Time: <?php echo $tStatus; ?></td>
                        <td tyle="width: 7.50cm">Date: <?php echo $dStatus; ?></td>
                        <tr><td colspan ="3" style="height: 3.90cm"> <h4><?php echo $status; ?> </h4></td></tr>
                      </tr>
                    </tbody>
              
    
  

                        <table class="table border-0">
                              <tr>
                                  <td style="width: 10cm">Client: 
                                  <td style="border-bottom: 0.9px solid black; padding-bottom: 0; margin-bottom: 0;" class="text-center"><h7 class="text-uppercase"><?php echo $rname; ?></h7></td>
                                  <td style="border-bottom: 0.9px solid black;"><!----></td>  
                              </tr>
                              <tr>
                                  <td></td>
                                  <td style="text-align: center;">Name</td>
                                  <td style="text-align: center;">Signature</td>
                              </tr>
                                                                  
                              <tr>
                                  <td style="width: 10cm">  Technician/Trainee: 
                                  <td style="border-bottom: 0.9px solid black; padding-bottom: 0; margin-bottom: 0;" class="text-center"><h7 class="text-uppercase"><?php echo $techni; ?></h7></td>
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
  <footer>
        <div class="container">
            <div class="row">
                <div class="col h6">
                    <br><br><br><br>
                    <tr><strong>RIZAL TECHNOLOGICAL UNIVERSITY<span style="margin-left: 200px;">Rev.1<span style="margin-left: 300px;">Oct 1, 2019</span></strong></tr>
                </div>
              </div>
      </footer>
  </div> 
  </body>
 
</html>
