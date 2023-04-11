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
  <button class="btn btn-warning" id="cmd" onClick="hideText()">DOWNLOAD</button>

  <div id="content" class="container mx-auto"> 
    <div class="row">
              <div class="col">
                  <p>RTU-FA-MIC-F-004 RIZAL TECHNOLOGICAL UNIVERSITY</p>
              </div>
              <div class="col text-right">
                  <p>Control No.: <?php echo $id; ?> <!--Ticket Number--><p>
              </div>
             
    </div>
    <div class="text-center" class="row">  <strong><h5>Technical Service Report</h5><strong> </div>
    <div class="row" style="margin-left: 1%; margin-right: 1%;"> 
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

    <table class="col d-flex justify-content-center align-items-center"><tr><?php echo $incident; ?></tr></table>
    <div class="row" style="margin-left: 1%; margin-right: 1%;"> 
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td style="width: 8.50cm">Reported Problem:</td>
                        <td style="width: 8.50cm">Time:<!--insert time ticket was created--></td>
                        <td tyle="width: 7.50cm">Date:<!--insert date ticket was created--></td>
                      </tr>
                      <tr>
                        <td style="height: 2.90cm"><p> <?php echo $title; ?>  </p> <p> <?php echo $description; ?>  </p> </td>
                        <td style="height: 2.90cm"><p> <?php echo $tCreate; ?>  </p> </td>
                        <td style="height: 2.90cm"><p> <?php echo $dCreate; ?>  </p> </td>
                      </tr>
                    </tbody>
                  </table>
    </div>
    <div class="row" style="margin-left: 1%; margin-right: 1%;"> 
                    <table class="table table-bordered">
                      <tbody>
                        <tr>
                          <td style="width: 8.50cm">Action Taken:</td>
                          <td style="width: 8.50cm">Time:<!--insert timestamp --></td>
                          <td tyle="width: 7.50cm">Date: <!--insert datestamp --></td>
                        </tr>
                        <tr> 
                          <td style="height: 1.90cm"><p> <?php echo $message; ?>  </p></td>
                          <td style="height: 1.90cm"><p> <?php echo $tStatus; ?>  </p> </td>
                          <td style="height: 1.90cm"><p> <?php echo $dStatus; ?>  </p> </td> </tr>
                        </tr>
                      </tbody>
                    </table>
    </div>

    <div class="row" style="margin-left: 1%; margin-right: 1%;"> 
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td style="width: 8.50cm">Recommendation:</td>
                        <td style="width: 8.50cm">Time:<!--insert data--></td>
                        <td tyle="width: 7.50cm">Date: <!--insert data--></td>
                      </tr>
                      <tr>
                        <td colspan="3" style="padding: 10px; height: 1.90cm;"> <?php echo $recommend; ?>
                          </td>
                      </tr>
                    </tbody>
                  </table>   
    </div>
    <div class="row" style="margin-left: 1%; margin-right: 1%;"> 
                  <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td style="width: 8.50cm">Status:</td>
                        <td style="width: 8.50cm">Time:<!--insert timestamp where the ticket was resolved--></td>
                        <td tyle="width: 7.50cm">Date: <!--insert datestamp--></td>
                      </tr>
                      <tr>
                        <td style="height: 1.90cm"><p> <?php echo $status; ?>  </p></td>
                        <td style="height: 1.90cm"><p> <?php echo $tStatus; ?>  </p> </td>
                        <td style="height: 1.90cm"><p> <?php echo $dStatus; ?>  </p> </td>
                      </tr>
                    </tbody>
                  </table>
    
    </div>
   

    <div class="row" style="margin-left: 10%; margin-right: 10%;"> 
                        <table class="table border-0">
                              <tr>
                                  <td style="width: 5cm">Client: 
                                  <td style="border-bottom: 0.9px solid black;" class="text-center"><?php echo $rname; ?></td>
                                  <td style="border-bottom: 0.9px solid black;"><!----></td>  
                              </tr>
                              <tr>
                                  <td></td>
                                  <td style="text-align: center;">Name</td>
                                  <td style="text-align: center;">Signature</td>
                              </tr>
                                                                  
                              <tr>
                                  <td style="width: 5cm">  Technician/Trainee: 
                                  <td style="border-bottom: 0.9px solid black;" class="text-center"><?php echo $techni; ?></td>
                                  <td style="border-bottom: 0.9px solid black;"></td>  
                              </tr>
                              <tr>
                                  <td></td>
                                  <td style="text-align: center;">Name</td>
                                  <td style="text-align: center;">Signature</td>
                              </tr>

                              <tr>
                                  <td style="width: 5cm">  Immediate Head 
                                  <td style="border-bottom: 0.9px solid black;"><!--insert Admin name--></td>
                                  <td style="border-bottom: 0.9px solid black;"><!--insert data--></td>  
                              </tr>
                              <tr>
                                  <td></td>
                                  <td style="text-align: center;">Name</td>
                                  <td style="text-align: center;">Signature</td>
                              </tr>
                      </table>

    </div> 

    <div class="row">
                  <div class="col">
                     <br>
                      <strong>RIZAL TECHNOLOGICAL UNIVERSITY<span style="margin-left: 200px;">Rev.1<span style="margin-left: 300px;">Oct 1, 2019</span></strong>
                  </div>
                </div>
            </div>


  </div>
  
  

    <script> 

      function hideText() {
        var element = document.getElementById('content'); 
        var opt = 
        {
          margin:       0,
          filename:     'pageContent_tech'+'.pdf',
          image:        { type: 'jpeg', quality: 0.98 },
          html2canvas:  { scale: 2 },
          jsPDF:        { unit: 'in', orientation: 'portrait' }
        };

			  html2pdf().set(opt).from(element).save();

      }
  
    

  </script>
  </body>
 
</html>
