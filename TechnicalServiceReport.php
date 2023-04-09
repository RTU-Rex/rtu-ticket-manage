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
                 <strong><p>Control No.: ___-___-___ <!--Ticket Number--><p></strong>
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
                <td><!--Requestor Name--></td>
              </tr>
              <tr>
                <td>Department:</td>
                <td><!--Department Name--></td>
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
                <td style="padding: 5px;"><input type="checkbox"> EDP </td> 
                <td style="padding: 5px;"><input type="checkbox"> Network Division </td>
                <td style="padding: 5px;"><input type="checkbox" checked> Technical Division </td>
                </tr>

            <table class="table table-bordered">
            <tbody>
            <tr>
            <td style="width: 8.50cm">Reported Problem:</td>
            <td style="width: 8.50cm">Time:<!--insert time ticket was created--></td>
            <td tyle="width: 7.50cm">Date:<!--insert date ticket was created--></td>
            <tr><td colspan="3" style="height: 3.90cm"><!--Insert Title and Decription of the Ticket--> </td></tr>
            </tr>
            </tbody>


            <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td style="width: 8.50cm">Action Taken:</td>
                    <td style="width: 8.50cm">Time:<!--insert timestamp --></td>
                    <td tyle="width: 7.50cm">Date: <!--insert datestamp --></td>
                    <tr><td colspan="3" style="height: 3.90cm"><!--Insert Technical Action Report--> </td></tr>
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
                  <tr><td colspan="3" style="height: 1.50cm"><!--insert status of the ticket--> </td></tr>
              </tbody>

              
            <table class="table border-0">
                        <tr>
                            <td style="width: 10cm">Client: 
                            <td style="border-bottom: 0.9px solid black;"><!--insert name of the requestor--></td>
                            <td style="border-bottom: 0.9px solid black;"><!----></td>  
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align: center;">Name</td>
                            <td style="text-align: center;">Signature</td>
                        </tr>
                                                            
                        <tr>
                            <td style="width: 10cm">  Technician/Trainee: 
                            <td style="border-bottom: 0.9px solid black;"><!--insert technician name--></td>
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
