<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RTU Ticketing Management System</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="x-icon" href="../rtu-ticket-manage/img/rtulogo.png">
    <style>
        
    </style>
</head>
<script src="js/jquery-3.6.3.min.js"></script>
<body>
      
    <?php include 'message.php' ?>
    <!-- Navbar -->
            <nav class="navbar navbar-expand-md navbar-light fixed-top" style="background: #265999;">
            <div class="container">
                <a class="navbar-brand text-white strong" href="index.php"><img src="../rtu-ticket-manage/img/rtulogo.png" class="img-fluid" alt="RTU Logo" style="max-width: 15%;"> Rizal Technological University</a>
                <button id="home" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"> </i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link text-white" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#faqs">FAQs</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white" href="login.php">Sign-in</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>-->
                    </ul>
                </div>
            </div>
        </nav>


    <div class="jumbotron jumbotron-fluid">
        <div class="container mt-5 fade-up">
        <div class="row">
            <div class="col-lg-8">
            <h1 class="display-4">Welcome to Rizal Technological University Ticketing Management System</h1>
            <p class="lead">Your comprehensive solution for technical service requests and issue reporting. Our cutting-edge platform empowers you to submit your concerns with ease, enabling our team to respond promptly and efficiently. Whether you require assistance or have feedback to provide, we're here to help.</p>
            <form class="user">
            <a href="login.html" id="btnNewTicket" class="btn btn-primary btn-user mb-3 text-white btn-block" data-toggle="modal" data-target="#TicketModal">Create Ticket</a>
                                        <div class="form-group">
                                            <div class="justify-content-center">
                                            <input type="text" class="form-control form-control-user mb-1 " id="txtTickNumber" placeholder="Enter Ticket Number to view ticket" required>
                                            <a href="login.html" id="btnView" data-toggle="modal" data-target="#TicketModal" class="btn btn-primary btn-user btn-block text-white">View Ticket History</a>
                                            </div>
                                            </div>
                </form>
            </div>
            <div class="col-lg-4 d-none d-lg-block">
            <div class="d-flex align-items-center justify-content-center fade-up">
                <img src="../rtu-ticket-manage/img/RTUTicketHub.png">
            </div>
            </div>
        </div>
        </div>
    </div>
    <?php include 'faqs.php' ?>

    <div class="container text-center mt-5 fade-up">
        <hr>
        <h4 class="mb-4">Help us improve our service</h4>
        <button type="button" id="btnFeedback" class="btn btn-primary" data-toggle="modal" data-target="#TicketModal">Submit Feedback</button>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script> 

    $('a[href^="#"]').on('click', function(event) {
    var target = $(this.getAttribute('href'));
    if( target.length ) {
        event.preventDefault();
        $('html, body').stop().animate({
            scrollTop: target.offset().top
        }, 1000);
    }
        });
    $(document).ready(function() {

    
    $('#btnNewTicket').click(function(e) {   

        
    $('#divTitle').html("Submit Ticket");
    $('#divMessage').html("<p class='text-justify mb-4'>Use this form to submit a ticket for any IT-related issues you're experiencing. Please fill out all required fields marked with an asterisk (*).</p>" +
        "<div class='row'>" + "<br>" +
            "<div class='col-md-6'>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Email</label><input type='email' class='form-control' id='txtEmail' placeholder='Enter Email Address' required><small class='text-danger' id='txtEmail-error' style='display: none;'></small></div>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Employee No.</label><input type='text' class='form-control' id='txtEmp' placeholder='Enter Employee Number' required><small class='text-danger' id='txtEmp-error' style='display: none;'></small></div>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Employee Name</label><input type='text' class='form-control' id='txtEmpName' placeholder='Complete Name' required><small class='text-danger' id='txtEmpName-error' style='display: none;'></small></div>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Title</label><input type='text' class='form-control' id='txtTitle' placeholder='What is the major issue?' required><small class='text-danger' id='txtTitle-error' style='display: none;'></small></div>" +
            "</div>" +
            "<div class='col-md-6'>" +
                "<div class='form-group'><label class ='text-dark'>Category</label><select class='form-control' id='cmbIncident' required></select></div>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Office Under</label><select class='form-control ' onchange='getOffice()' id='cmbDepartment' required></select><small class='text-danger' style='display: none;'>Please select an office.</small></div>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Department</label><select class='form-control' id='cmbOffice' required></select></div>" +
            "</div>" +
            "<div class='col-md-12'>" +
            "<div class='form-group'><label class ='text-dark'>Description</label><textarea class='form-control' rows='5' id='txtdescription' placeholder='Provide a detailed description of the issue you are experiencing.'></textarea></div>" +
            "<div class='alert alert-info' role='alert'>" +
            "<i class='fas fa-info-circle'></i> Once you submit a ticket, you can check its status and updates using the ticket tracking number provided in the confirmation message. Our support team will also contact you via email or phone to provide updates or request additional information as needed. Thank you for using Rizal Technological University's Ticketing System.</div>"+
            "</div>" +
        "</div>");
        
        $('#divButtons').html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" +
            " <button type='button' class='btn btn-warning' onclick='createTicket()' id='btnSubmit'>Submit</button>");

        function showModal() {
        $('#myModal').show(e);
        }

        $('#myModal').on('shown.bs.modal', function(e) {
          $('.modal-content').addClass('animated fadeIn');
                
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
                    var option = document.createElement("option");
                    option.text = "Select Category";
                    option.value = 0;
                    cmbIncident.add(option);
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
                var option = document.createElement("option");
                option.text = "Select Office you are under";
                option.value = 0;
                cmbDepartment.add(option);
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

        //Retrieved Offices 
        var cmbOffice = document.getElementById("cmbOffice"); // get the offices dropdown
        cmbOffice.disabled = true; // disable the offices dropdown initially

        $("#cmbDepartment").on("change", function() {
            var selectedDept = $(this).val(); // get the selected department
            if (selectedDept) { // if a department is selected
                if (selectedDept === "0") { // if the user selected the "Select Office you are under" option
                    $("#cmbOffice").empty(); // empty the offices dropdown
                    cmbOffice.disabled = true; // disable the offices dropdown
                } else { // if the user selected a department other than "Select Office you are under"
                    // retrieve the offices for the selected department
                    $.ajax({
                        async: false,
                        type: "POST",
                        url: 'controllers/indexControllers.php',
                        data: {getOffice: 1, department: selectedDept},
                        success: function(data) {
                            data = JSON.parse(data);
                            $("#cmbOffice").empty();
                            cmbOffice.disabled = false; // enable the offices dropdown
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
            } else { // if no department is selected
                $("#cmbOffice").empty();
                cmbOffice.disabled = true; // disable the offices dropdown
            }
        });

          

           
        })

                $('#btnFeedback').click(function(e) {             
                    $('#divTitle').html("Submit Feedback");
                    $('#divMessage').html("<p class='mb-4 text-justify'>We value your opinion and strive to improve our services based on your feedback. Please let us know how we're doing by sharing your thoughts and suggestions with us. Your feedback is anonymous and will be used to help us enhance our ticketing management system, optimize our processes, and deliver a better user experience for you and all our clients." + 
                    "<br><br>Thank you for your valuable feedback!</p>" +
                    "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Your Feedback</label><textarea class='form-control' rows='5' id='txtdescription' placeholder='Share your thoughts and suggestions' required></textarea><div class='invalid-feedback'>Please put some feedback.</div></div>");
                    $('#divButtons').html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" + 
                        "<button type='button' onclick='createFeedback()' class='btn btn-primary' id='btnSubmitFeed'>Submit</button>");
                    });

              
        $('#btnView').click(function(e) {   
            var error = true;
            $('#divTitle').html("Ticket Journey");
            $.ajax({
                async: false,
                type: "POST",
                url: 'controllers/indexControllers.php',
                data: {ticketId: $('#txtTickNumber').val(), getTicketsJourney: 1},
                success: function(data) {
                   
                    data = JSON.parse(data);
                    for (var i=0; i< data.length; i++ ) {
                        
                        $('#divMessage').html("<div class='card shadow mb-4'> "+
                                   "<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-primary'>RTU sysTicket</h6></div>" +
                                   "<div class='card-body'> Ticket Number: "+ data[i].id +" <br> Incident: "+ data[i].IncidentName +" <br> Title: "+ data[i].title +" <br> Description: "+ data[i].description +" <br> Requestor: "+ data[i].name +" ("+ data[i].email +") <br> Department: "+ data[i].Office + 
                                   "<hr> <p class='mb-1'>"+ formatDate(data[i].DateCreated) +"</p></div></div>");
                    error = false;
                    }
                 
                }
            });

            if (error) {
                $('#divMessage').html("<div class='alert alert-info' role='alert'>" +
                "<i class='fas fa-info-circle'></i> Please enter your <b>valid ticket number</b> on the text field provided to see your ticket history.</div>");
                $('#divButtons').html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");

            } else {
                let techid = 0;
                let statusId = 0;
                $.ajax({
                async: false,
                type: "POST",
                url: 'controllers/indexControllers.php',
                data: {ticketId: $('#txtTickNumber').val(), getTicketsJourneyHistory: 1},
                success: function(data) {
                   
                    data = JSON.parse(data);
                    if (data.length > 0) {
                    for (var i=0; i< data.length; i++ ) {
                        if (data[i].modifiedFrom == "requestor") {
                            document.getElementById("divMessage").innerHTML += "<div class='card shadow mb-4'> "+
                                   "<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-right text-warning'>"+ data[i].name +"</h6></div>" +
                                   "<div class='card-body'>"+ data[i].ticketMessage +
                                   "<hr> <p class='mb-1 text-right'>"+ data[i].dateModified +" - "+ data[i].statusName +"</p></div></div>";
                        } else {
                            document.getElementById("divMessage").innerHTML += "<div class='card shadow mb-4'> "+
                                   "<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-left text-primary'>"+ data[i].Tech +"</h6></div>" +
                                   "<div class='card-body'>"+ data[i].ticketMessage +
                                   "<hr> <p class='mb-1 text-left'>"+ data[i].dateModified +" - "+ data[i].statusName +"</p></div></div>";
                        }
                      techid = data[i].TechId;
                      statusId = data[i].statusId;
                    }
                    }
                }
            });
            
            $('#divButtons').html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>"+
                                  "<button type='button' class='btn btn-warning' onclick='replyTicket("+ techid +","+ statusId +")' id='btnUpdate'>Reply</button>" );

                 
            }
          
        })
        
    })
    function createTicket() {
        if (validateForm()) {
        $('#divTitle').html("RTU Ticketing Message"); 
            $.ajax({
                async: false,
                type: "POST",
                url: 'controllers/indexControllers.php',
                data: {txtEmail: $('#txtEmail').val(), 
                       txtEmp: $('#txtEmp').val(),
                       txtEmpName: $('#txtEmpName').val(),
                       cmbIncident: $('#cmbIncident').val(),
                       cmbDepartment: $('#cmbOffice').val(),
                       txtTitle: $('#txtTitle').val(),
                       txtdescription: $('#txtdescription').val(),
                       createTicket: 1
                    },
                    success: function(data) {
                    data = JSON.parse(data);
                 

                    sendemail($('#txtEmail').val(),"RTU-Ticketing Management - Ticket Number:" + data,"<html><body>Hi "+ $('#txtEmpName').val() +"<br>You successfully created a ticket.<br><h2><b>Ticket Number: "+ data +"</b></h2><div style='padding-left: 3%;'>"+
                                                                               "<table style='border: 1px solid black; width: 30%;'><tr style='vertical-align: text-top;'><td>Category</td><td>"+ $('#cmbIncident option:selected').text() +"</td></tr><tr style='vertical-align: text-top;'><td>Department</td><td>"+ $('#cmbOffice option:selected').text() +"</td></tr>" +
                                                                            "<tr style='vertical-align: text-top;'><td>Title</td><td>"+ $('#txtTitle').val() +"</td></tr><tr style='vertical-align: text-top;'><td>Description</td><td>"+ $('#txtdescription').val() +"</td></tr> </table></div>" +
                                                                               "<br>Thanks,<br><b>RTU Ticketing System</b></body></html>");

                   
                    $('#divMessage').html("<div class='alert alert-info' role='alert'>" +
                                      "<i class='fas fa-info-circle'></i> Your ticket has been successfully submitted. A confirmation email has been sent to your email account.</div>" + 
                                      "<div><b>Ticket Number:</b> " + data + "</div>" +
                                      "<div><b>Requestor's Name:</b> " + $('#txtEmpName').val() + "</div>" +
                                      "<div><b>Office:</b> " + $('#cmbOffice option:selected').text() + "</div>" +
                                      "<div><b>Category:</b> " + $('#cmbIncident option:selected').text() + "</div>" +
                                      "<div><b>Issue:</b> " + $('#txtTitle').val() + "</div>" +
                                      "<div><b>Date Created:</b> " + new Date().toLocaleString() + "</div>"); 
                $('#divButtons').html(" <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");

                }, 
                error: function (e) {
                    alert(e);
                }
                        })
                    } else { 
                        $('#error').html("Please Fill up the required fields");
                        $('#divButtons').html(" <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" +
                                            "  <button type='button' class='btn btn-warning' onclick='createTicket()' id='btnSubmit'>Submit</button>");

                    }


    }

    function createFeedback() {
        var description = $('#txtdescription').val();
                if (description.trim() === '') {
                    // show error message
                    $('#txtdescription').addClass('is-invalid');
                    return;
                } else {
                    // submit form
                    $('#divTitle').html("RTU Ticketing Message"); 
                    $.ajax({
                        async: false,
                        type: "POST",
                        url: 'controllers/indexControllers.php',
                        data: { txtdescription: $('#txtdescription').val(),
                            createFeedBack: 1
                            },
                        success: function(data) {
                            data = JSON.parse(data);
                            $('#divMessage').html(data)
                            $('#divButtons').html(" <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");
                        
                        }, 
                        error: function (e) {
                            alert(e);
                        }
                         })
                }

  
    }
   
    function getOffice() {
    //Retrieved Offices 
    var cmbOffice = document.getElementById("cmbOffice");
    var selectedDept = $("#cmbDepartment").val();
    if (selectedDept) {
        if (selectedDept === "0") {
            $("#cmbOffice").empty();
            cmbOffice.disabled = true;
        } else {
            $.ajax({
                async: false,
                type: "POST",
                url: 'controllers/indexControllers.php',
                data: {getOffice: 1, department: selectedDept},
                success: function(data) {
                    data = JSON.parse(data);
                    $("#cmbOffice").empty();
                    cmbOffice.disabled = false;
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
            } else {
                $("#cmbOffice").empty();
                cmbOffice.disabled = true;
            }
        }

    function replyTicket(tickedId,StatusId) {
        $('#divTitle').html("UPDATE TICKET");
        $('#divMessage').html("<div class='form-group'><textarea class='form-control' rows='5' id='txtdescription' placeholder='Description'></textarea></div>" );
        $('#divButtons').html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>"+
                              "<button type='button' class='btn btn-warning' onclick='updateTicket("+tickedId+","+ StatusId +")' id='btnUpdate'>Send</button>" );
    }

    function updateTicket(tickedId,StatusId) {
        $('#divTitle').html("RTU Ticketing Message"); 
            $.ajax({
                async: false,
                type: "POST",
                url: 'controllers/indexControllers.php',
                data: {ticketId: $('#txtTickNumber').val(),
                       cmbStatus: $('#cmbStatus').val(),
                       txtdescription: $('#txtdescription').val(),
                       modified: "requestor",
                       tech: tickedId,
                       status: StatusId,
                       createJourney: 1
                    },
                success: function(data) {
                    data = JSON.parse(data);
                    $('#divMessage').html(data);
                    $('#divButtons').html(" <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");
                }, 
                error: function (e) {
                    alert(e);
                }
            })
    }

                function validateForm() {
                let isValid = true;

            
                const emailField = document.getElementById('txtEmail');
                const email = emailField.value;
                const emailErrorMessage = "Please enter a valid Email Address";
                if (!email) {
                    emailField.classList.add('is-invalid');
                    document.getElementById('txtEmail-error').textContent = emailErrorMessage;
                    isValid = false;
                } else {
                    emailField.classList.remove('is-invalid');
                    document.getElementById('txtEmail-error').textContent = '';
                }

                const empField = document.getElementById('txtEmp');
                const emp = empField.value;
                const empRegex = /^\d{4}-\d{6}$/; // Match a 5-digit number
                const empErrorMessage = "Please enter a valid employee number('YYYY-NNNNNN')";
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
                if (!empName) {
                    titleNameField.classList.add('is-invalid');
                    document.getElementById('txtTitle-error').textContent = titleErrorMessage;
                    isValid = false;
                } else {
                    titleNameField.classList.remove('is-invalid');
                    document.getElementById('txtTitle-error').textContent = '';
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
            })   } 
                
            function formatDate(dateString) {
                var date = new Date(dateString);
                var options = { 
                    year: 'numeric', 
                    month: 'short', 
                    day: 'numeric', 
                    hour: 'numeric',
                    minute: 'numeric',
                    hour12: true,
                };
                return date.toLocaleString('en-US', options);
            }
    </script>
</body>
<?php   include 'footer.php'; ?>
</html>
