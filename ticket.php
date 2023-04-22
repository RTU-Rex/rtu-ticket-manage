<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    include 'header.php';  
 ?>

<?php include 'message.php' ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                <div class="row">
                    <div class="col"><h1 class="h3 mb-2 text-gray-800">Ticket Management</h1> </div>
                    <div  class="col">
                    <button style="float:right; margin-right: 2%" class="btn btn-warning" data-toggle="modal" data-target="#TicketModal" onClick="ViewCreateTicket()"> Add New Ticket</button> 
                </div>
                    


                </div>
<br/>
                   

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 no-animation fade-up">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ticket List</h6>
                        </div>
                        
                        <div class="card-body">
                            <div id="divTable" class="table-responsive">
                            <button class= "btn btn-primary" onClick="exportdata()" style='float:right;'> Export Data <i class='fas fa-file-export'></i></button>
                                <table class="table table-bordered table-striped" id="dataTable1" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="sortable" >TICKET <i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                                <th class="sortable">STATUS <i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                                <th class="sortable">DESCRIPTION <i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                                <th class="sortable">PRIORITY <i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                                <th class="sortable">OFFICE/DEPARTMENT <i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                                <th class="sortable">TECHNICIAN <i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                                <th class="sortable">REQUESTOR <i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                                <th class="sortable">LAST UPDATE <i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                            </tr>
                                        </thead>

                                    <tbody>

                                    <?php   
                                     $accessid = $_SESSION['accessId'];
                                     $user = "1";
                                     if ($accessid == 2) {
                                         $user = $_SESSION['id'];
                                     }
                                    include "./controllers/dbConnect.php";   
                                     $sql = "SELECT CASE WHEN Isnull(b.technicianId) then 'Unassign' ELSE c.statusName END Stas,
                                     a.title,description, e.IncidentName, a.Id, IFNULL(f.priorityName, '---') as priorityName, g.Office,
                                     IFNULL(CONCAT(d.lastName,', ',d.firstName),'---') Assigned, 
                                     a.name,
                                     CASE WHEN ISNULL(b.datemodified) then a.DateCreated else b.datemodified end lastUpdate
                             FROM tblTicket a 
                             LEFT JOIN  (SELECT *, ROW_NUMBER() OVER(PARTITION BY ticketId ORDER by dateModified DESC) AS row_num 
                                         FROM `tblTicketHistory`) b on a.Id = b.ticketId and row_num = 1
                             LEFT JOIN tblStatus c on c.id = b.ticketStatus
                             LEFT JOIN tblUser d on d.id = b.technicianId
                             LEFT JOIN tblIncident e on e.id = a.incident
                             LEFT JOIN tblPriority f on f.id = a.priority
                             LEFT JOIN tblDepartment g on g.id = a.department
                             WHERE (CASE WHEN 2=$accessid then b.technicianId else $user end) = $user;";
                     
                         $result = mysqli_query($conn, $sql);
                        
                         if (mysqli_num_rows($result) >= 1) {
                          
                             while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr><td><b>'.$row['Id'].'</b></td>';
                                echo '<td>'.$row['Stas'].'</td>';
                                echo '<td data-toggle="modal" data-target="#TicketModal" class="text-primary text-capitalize" style="cursor: pointer" onClick="viewTicket('.$row['Id'].')"> <ins>'.$row['description'].'</ins> </td>';
                                echo '<td>';
                                if ($row['priorityName'] == '---') {
                                    echo  $row['priorityName'];
                                }else if ($row['priorityName'] == 'Critical') {
                                    echo '<span class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Response Time: 1 hour or less&#13;Resolution Time: Within 24 hours">'.$row['priorityName'].'</span>';
                                } elseif ($row['priorityName'] == 'High') {
                                    echo '<span class="badge badge-warning" data-toggle="tooltip" data-placement="top" title="Response Time: 4-8 hours&#13;Resolution Time: Within 3 business days">'.$row['priorityName'].'</span>';
                                } elseif ($row['priorityName'] == 'Moderate') {
                                    echo '<span class="badge badge-info" data-toggle="tooltip" data-placement="top" title="Response Time: 24-48 hours&#13;Resolution Time: Within 5 business days">'.$row['priorityName'].'</span>';
                                } elseif ($row['priorityName'] == 'Low') {
                                    echo '<span class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Response Time: 3-5 business days&#13;Resolution Time: Within 6-7 business days">'.$row['priorityName'].'</span>';
                                }
                                
                                echo '</td>';
                                echo '<td>'.$row['Office'].'</td>';
                                echo '<td>'.$row['Assigned'].'</td>';
                                echo '<td>'.$row['name'].'</td>';
                                echo '<td>'.date('M d, Y h:i A', strtotime($row['lastUpdate'])).'</td></tr>';                                
                             }           
                          
                         
                         }
                                    
                                    
                                    
                                    ?>
                                

                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  
                 

                </div>
                <!-- /.container-fluid -->

          

   

    <?php   include 'footer.php';      ?>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
      <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>



    <script> 
  
    $(document).ready(function() {
        $('#dataTable1').DataTable(); 
    });

    function ViewCreateTicket() {
    $('#divTitle').html("<h4 class='text-dark'><b> Ticket Form </b> </div> <br> </h4>");
    $('#divMessage').html("<p id='error'></p></p>" +
        "<div class='row'>" + "<br>" +
            "<div class='col-md-6'>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Email</label><input type='email' class='form-control' id='txtEmail' placeholder='Enter Email Address' required><small class='text-danger' id='txtEmail-error' style='display: none;'></small></div>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Employee No.</label><input type='text' class='form-control' id='txtEmp' placeholder='Enter Employee Number' required><small class='text-danger' id='txtEmp-error' style='display: none;'></small></div>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Employee Name</label><input type='text' class='form-control' id='txtEmpName' placeholder='Complete Name' required><small class='text-danger' id='txtEmpName-error' style='display: none;'></small></div>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Title</label><input type='text' class='form-control' id='txtTitle' placeholder='What is the major issue?' required><small class='text-danger' id='txtTitle-error' style='display: none;'></small></div>" +
            "</div>" +
            "<div class='col-md-6'>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Priority</label><select class='form-control' id='cmbPrio'></select></div>" +
                "<div class='form-group'><label class ='text-dark'>Category</label><select class='form-control' id='cmbIncident' required></select></div>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Office Under</label><select class='form-control ' onchange='getOffice()' id='cmbDepartment' required></select><small class='text-danger' style='display: none;'>Please select an office.</small></div>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Department</label><select class='form-control' id='cmbOffice' required></select></div>" +
            "</div>" +
            "<div class='col-md-12'>" +
            "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Description</label><textarea class='form-control' rows='5' id='txtdescription' placeholder='Provide a detailed description of the issue you are experiencing.'required></textarea><small class='text-danger' id='txtdescription-error' style='display: none;'></small></div>" +
            "</div>" +
        "</div>");
        
        $('#divButtons').html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" +
            " <button type='button' class='btn btn-warning' onclick='createTicket()' id='btnSubmit'>Submit</button>");


           //retrieved priorities
           $.ajax({
            async: false,
            type: "POST",
            url: "controllers/homeControllers.php",
            data: { getPrio: 1 },
            success: function (data) {
            data = JSON.parse(data);
            $("#cmbPrio").empty();
            var cmbInc = document.getElementById("cmbPrio");
            for (var i = 0; i < data.length; i++) {
                var option = document.createElement("option");
                option.text = data[i].name;
                option.value = data[i].id;
                cmbInc.add(option);
            }
            },
            error: function (e) {
            alert(e);
            },
        });
       //Retrived incidents
       $.ajax({
                async: false,
                type: "POST",
                url: 'controllers/indexControllers.php',
                data: {getIncident: 1},
                success: function(data) {
                    data = JSON.parse(data);
                    $("#cmbIncident").empty();
                    var cmbInc = document.getElementById("cmbIncident");
                    for (var i=0; i< data.length; i++ ) {
                        var option = document.createElement("option");
                        option.text = data[i].name;
                        option.value = data[i].id;
                        cmbInc.add(option);
                    }
                }, 
                error: function (e) {
                    alert(e);
                }
            });
          
          //Retrived Departments
          $.ajax({
                async: false,
                type: "POST",
                url: 'controllers/indexControllers.php',
                data: {getDept: 1},
                success: function(data) {
                    data = JSON.parse(data);
                    $("#cmbDepartment").empty();
                    var cmbDept = document.getElementById("cmbDepartment");
                    for (var i=0; i< data.length; i++ ) {
                        var option = document.createElement("option");
                        option.text = data[i];
                        option.value = data[i];
                        cmbDept.add(option);
                    }
                }, 
                error: function (e) {
                    alert(e);
                }
            });

            //Retrived Officess 
            $.ajax({
                async: false,
                type: "POST",
                url: 'controllers/indexControllers.php',
                data: {getOffice: 1,department: $('#cmbDepartment').val()},
                success: function(data) {
                   
                    data = JSON.parse(data);
                    $("#cmbOffice").empty();
                    var cmbOffice = document.getElementById("cmbOffice");
                    for (var i=0; i< data.length; i++ ) {
                        var option = document.createElement("option");
                        option.text = data[i].name;
                        option.value = data[i].id;
                        cmbOffice.add(option);
                    }
                  
                }, 
                error: function (e) {
                    alert(e);
                }
            });
    }

    function createTicket() {
        if (validateForm()) {
        $('#divTitle').html("Success"); 
            $.ajax({
                async: false,
                type: "POST",
                url: "controllers/indexControllers.php",
                data: {txtEmail: $('#txtEmail').val(), 
                       txtEmp: $('#txtEmp').val(),
                       txtEmpName: $('#txtEmpName').val(),
                       cmbIncident: $('#cmbIncident').val(),
                       cmbDepartment: $('#cmbOffice').val(),
                       txtTitle: $('#txtTitle').val(),
                       txtdescription: $('#txtdescription').val(),
                       cmbPrio: $('#cmbPrio').val(),
                       createTicket: 1
                    },
                    success: function(data) {
                    data = JSON.parse(data);

                    sendemail($('#txtEmail').val(),"RTU-Ticketing Management System - Ticket Number:" + data,"<html><body>Hi "+ $('#txtEmpName').val() +"<br>"+
                                                                                "<br>We are pleased to inform you that your ticket has been successfully created with the following details: <br>"+
                                                                                "<b><br>Ticket Number:</b> "+ data +"<br>"+
                                                                                "<b>Category: </b>"+ $('#cmbIncident option:selected').text() + "<br>"+
                                                                                "<b>Department: </b>"+ $('#cmbOffice option:selected').text() + "<br>"+
                                                                                "<b>Description: </b>"+ $('#txtdescription').val() + "<br>"+
                                                                                "<br>Thank you,<br><b> MIC - Boni Campus</b></body></html>");
                     
                    $('#divMessage').html("<div class='alert alert-info' role='alert'>" +
                                      "<i class='fas fa-info-circle'></i> Your ticket has been successfully submitted. A confirmation email has been sent to your email account.</div>" + 
                                      "<div><b>Ticket Number:</b> " + data + "</div>" +
                                      "<div><b>Requestor's Name:</b> " + $('#txtEmpName').val() + "</div>" +
                                      "<div><b>Office:</b> " + $('#cmbOffice option:selected').text() + "</div>" +
                                      "<div><b>Priority:</b> " + $('#cmbPrio option:selected').text() + "</div>" +
                                      "<div><b>Category:</b> " + $('#cmbIncident option:selected').text() + "</div>" +
                                      "<div><b>Date Created:</b> " + new Date().toLocaleString() + "</div>"); 
                $('#divButtons').html(" <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");

                }, 
                error: function (e) {
                    alert(e);
                }
            })  
            } else {    $('#error').html("<div class='alert alert-danger'>Please fill out all required fields marked with an asterisk (*).</div>");
                        $('#divButtons').html(" <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" +
                                            "  <button type='button' class='btn btn-warning' onclick='createTicket()' id='btnSubmit'>Submit</button>");
                    }
        }

        function validateForm() {
                let isValid = true;

            
                const emailField = document.getElementById('txtEmail');
                const email = emailField.value;
                const emailErrorMessage = "Please enter a valid Email Address";
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!email || !email.match(emailRegex)) {
                    emailField.classList.add('is-invalid');
                    document.getElementById('txtEmail-error').textContent = emailErrorMessage;
                    isValid = false;
                } else {
                    emailField.classList.remove('is-invalid');
                    document.getElementById('txtEmail-error').textContent = '';
                }

                const empField = document.getElementById('txtEmp');
                const emp = empField.value;
                const empRegex = /^[A-Za-z]-\d{2}-\d{2}-\d{3}$/; // Match a 5-digit number
                const empErrorMessage = "Please enter a valid employee number";
                if (!emp || !emp.match(empRegex)) {
                    empField.classList.add('is-invalid');
                    document.getElementById('txtEmp-error').textContent = empErrorMessage;
                    isValid = false;
                } else {
                    empField.classList.remove('is-invalid');
                    document.getElementById('txtEmp-error').textContent = '';
                }
                
                const empNameField = document.getElementById('txtEmpName');
                const empName = empNameField.value;
                const empNameErrorMessage = "Please enter your name";
                if (!empName) {
                    empNameField.classList.add('is-invalid');
                    document.getElementById('txtEmpName-error').textContent = empNameErrorMessage;
                    isValid = false;
                } else {
                    empNameField.classList.remove('is-invalid');
                    document.getElementById('txtEmpName-error').textContent = '';
                }

                const titleNameField = document.getElementById('txtTitle');
                const titleName = titleNameField.value;
                const titleErrorMessage = "Please enter the issue title";
                if (!titleName) {
                    titleNameField.classList.add('is-invalid');
                    document.getElementById('txtTitle-error').textContent = titleErrorMessage;
                    isValid = false;
                } else {
                    titleNameField.classList.remove('is-invalid');
                    document.getElementById('txtTitle-error').textContent = '';
                }

                const descField = document.getElementById('txtdescription');
                const txtdescription = descField.value;
                const descriptionErrorMessage = "Please a brief description of your issue";
                if (!txtdescription) {
                    descField.classList.add('is-invalid');
                    document.getElementById('txtdescription-error').textContent = descriptionErrorMessage;
                    isValid = false;
                } else {
                    descField.classList.remove('is-invalid');
                    document.getElementById('txtdescription-error').textContent = '';
                }

                var selectedOffice = $("#cmbOffice").val(); // get the selected office
                    if (!selectedOffice) { // if no office is selected
                        $(".text-danger").show(); // show error message
                        isValid = false;
                        event.preventDefault(); // prevent form submission
                    } else {
                        $(".text-danger").hide(); // hide error message
                    }
                    
                    return isValid;
                }

    function sendemail(recipient,subject,content) {
        $.ajax({
                async: false,
                type: "POST",
                url: 'controllers/emailController.php',
                data: { recipient: recipient, 
                        content: content,
                        subject: subject,
                        sendEmail: 1
                    },
                success: function(data) {
                    console.log(data);               
                }
            })    
    }

    function exportdata() {
        $.ajax({
                async: false,
                type: "POST",
                url: 'controllers/homeControllers.php',
               data: { priority: -1,
                       gettickets: 1},
                success: function(data) {
                    JSONToCSVConvertor(data, "Exported Data", true);           
                }
            })    
    }

    function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
                //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
                var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
                
                var CSV = '';    
                //Set Report title in first row or line
                
                CSV += ReportTitle + '\r\n\n';

                //This condition will generate the Label/Header
                if (ShowLabel) {
                    var row = "";
                    
                    //This loop will extract the label from 1st index of on array
                    for (var index in arrData[0]) {
                        
                        //Now convert each value to string and comma-seprated
                        row += index + ',';
                    }

                    row = row.slice(0, -1);
                    
                    //append Label row with line break
                    CSV += row + '\r\n';
                }
                
                //1st loop is to extract each row
                for (var i = 0; i < arrData.length; i++) {
                    var row = "";
                    
                    //2nd loop will extract each column and convert it in string comma-seprated
                    for (var index in arrData[i]) {
                        row += '"' + arrData[i][index] + '",';
                    }

                    row.slice(0, row.length - 1);
                    
                    //add a line break after each row
                    CSV += row + '\r\n';
                }

                if (CSV == '') {        
                    alert("Invalid data");
                    return;
                }   
                
                //Generate a file name
                var fileName = "";
                //this will remove the blank-spaces from the title and replace it with an underscore
                fileName += ReportTitle.replace(/ /g,"_");   
                
                //Initialize file format you want csv or xls
                var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);
                
                // Now the little tricky part.
                // you can use either>> window.open(uri);
                // but this will not work in some browsers
                // or you will not get the correct file extension    
                
                //this trick will generate a temp <a /> tag
                var link = document.createElement("a");    
                link.href = uri;
                
                //set the visibility hidden so it will not effect on your web-layout
                link.style = "visibility:hidden";
                link.download = fileName + ".csv";
                
                //this part will append the anchor tag and remove it after automatic click
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }

   

    </script>

    <script src="./js/ticketManagement.js"></script>
   

</body>
</style>
</html>

<?php 
}else{
     header("Location: login.php");
     exit();
}
 ?>