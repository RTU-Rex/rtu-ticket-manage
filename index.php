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
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="x-icon" href="../rtu-ticket-manage/img/rtulogo.png">
</head>
<script src="js/jquery-3.6.3.min.js"></script>
<body>
      
    <?php include 'message.php' ?>
    <!-- Navbar -->
            <nav class="navbar navbar-expand-md navbar-light fixed-top" style="background: #265999;">
            <div class="container">
                <a class="navbar-brand text-white strong" href="index.php"><img src="../rtu-ticket-manage/img/rtulogo.png" class="img-fluid" alt="RTU Logo" style="max-width: 15%;"> Rizal Technological University</a>
                <button id="home" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
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


    <div class="jumbotron jumbotron-fluid mt-5">
        <div class="container mt-5 fade-up">
        <div class="row">
            <div class="col-lg-8">
            <h1 class="display-4">Welcome to Rizal Technological University Ticketing Management System</h1>
            <p class="lead">Your comprehensive solution for technical service requests and issue reporting. Our cutting-edge platform empowers you to submit your concerns with ease, enabling our team to respond promptly and efficiently. Whether you require assistance or have feedback to provide, we're here to help.</p>
            <form class="user">
            <a id="btnNewTicket" class="btn btn-primary btn-user mb-3 text-white btn-block" data-toggle="modal" data-target="#TicketModal">Create Ticket</a>
                                        <div class="form-group">
                                            <div class="justify-content-center">
                                            <input type="text" class="form-control form-control-user mb-1 " id="txtTickNumber" placeholder="Enter Ticket Number to view ticket" required>
                                            <a id="btnView" data-toggle="modal" data-target="#TicketModal" class="btn btn-primary btn-user btn-block text-white">View Ticket History</a>
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

        
    $('#divTitle').html("<h4 class='text-dark'><b> Ticket Form </b> </div> <br> </h4>");
    $('#divMessage').html("<h5> <b>Contact Information</b> </h5>" + 
    "<p class='text-justify mb-4'> Please fill out all required fields marked with an asterisk (*).</p>" +
        "<div class='row'>" + "<br>" + 
            "<div class='col-md-6'>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Email</label><input type='email' class='form-control' id='txtEmail' placeholder='Enter Email Address' required><small class='text-danger' id='txtEmail-error'></small></div>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Employee No. (ex. D-11-12-123)</label><input type='text' class='form-control' id='txtEmp' placeholder='Enter Employee Number' required><small class='text-danger' id='txtEmp-error'></small></div>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Employee Name</label><input type='text' class='form-control' id='txtEmpName' placeholder='Complete Name' required><small class='text-danger'></small></div>" +
            "</div>" +
            "<div class='col-md-6'>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Office Under</label><select class='form-control ' onchange='getOffice()' id='cmbDepartment' required></select><small class='office-error text-danger' style='display: none;'>Please select Office</small></div>" +
                "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Department</label><select class='form-control' id='cmbOffice' required></select></div>" +
                "<div class='form-group'><label class ='text-dark'>Title/Position</label><input type='text' class='form-control' id='txtTitle' placeholder='Position/Title'></div>" + 
            "</div>" + 
            "<div class='col-md-12'>" + "<hr><h5> <b>Ticket Information</b> </h5>" + 
            "<p class='text-justify mb-4'> Please fill out all required fields marked with an asterisk (*).</p>" + 
            "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Category of the issue</label><select class='form-control' id='cmbIncident' required></select><small class='priority-error text-danger' style='display: none;'>Please select category</small></div>" +
            "<div class='form-group'><label class ='text-dark'><span class='required-indicator'>*</span>Description of the issue</label><textarea class='form-control' rows='5' id='txtdescription' placeholder='Provide a detailed description of the issue you are experiencing.'required></textarea><small class='text-danger' id='txtdescription-error'></small></div>" +
            "<div class='form-group'><label class ='text-dark'>Attachment</label> <input type='file' class='fileToUpload form-control' ></input><br></div>" +
            "<div class='form-group'>"+
            "<div class='form-check'>"+
            "<input type='checkbox' class='form-check-input' id='chkAgree' required>"+
            "<label class='form-check-label' for='chkAgree'>I confirm that the information provided is true and correct.</label>"+
            "<div class='invalid-feedback'>You must confirm that the information provided is true and correct.</div>"+
            "</div>"+
            "</div>"+
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
                    "<div class='form-group'>Your Name<input type='text' class='form-control form-control-user' id='txtEmpName' placeholder='Optional'></div>" +
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
                        
                        $('#divMessage').html(
                            "<div class='card shadow mb-4 no-animation'>" +
                            "<div class='card-header py-3'>" +
                            " <h5 class='m-0 font-weight-bold text-dark text-capitalize hover-danger'>"  +
                            " <i class='fas fa-ticket-alt mr-2'></i>"  +
                            " Ticket # "+ data[i].id + " - " + data[i].IncidentName + 
                            " </h5>"  + "</div>" +
                            "<div class='card-body'>"+
                                "<small class='text-mute'>" +
                                " Created: " + formatDate(data[i].DateCreated) +
                                " by: " + "<b>" + data[i].name + "</b>" + " (" + data[i].email + ")" +
                                " located at: " + "<b>" + data[i].Office + "</b>" + 
                                "</small>" +  
                                "<div class='email-container mt-3'>" +
                                "<div class='text-dark'>" + data[i].description + "</div>" +
                                "</div><hr><p class='mb-0 text-right'><small> Updated at: " +
                                formatDate(data[i].dateModified) +
                                "</p></hr>" +
                            "</div>" +
                            "</div>");
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
                            document.getElementById("divMessage").innerHTML +=
                            "<div class='card shadow mb-4 no-animation'> " +
                            "<div class='border-right-warning card-header py-3'><h6 class='m-0 font-weight-bold text-right text-warning'>" +
                            data[i].name +
                            "</h6></div>" +
                            "<div class='card-body text-right text-dark'>" +
                            data[i].ticketMessage +
                            "<hr> <p class='mb-0 text-left'><small>" +
                            formatDate(data[i].dateModified) +
                            " - " + "<ins>" +
                            data[i].statusName +
                            "</p></div></div>";
                        } else {
                            document.getElementById("divMessage").innerHTML +=
                            "<div class='card shadow mb-4 no-animation conversation-card mb-3'> " +
                            "<div class='border-left-info  card-header py-3'><h6 class='m-0 font-weight-bold text-left text-info'>" +
                            data[i].Tech +
                            "</h6></div>" +
                            "<div class='card-body card-text text-left text-dark'>" +
                            data[i].ticketMessage +
                            "<hr> <p class='mb-0 text-right'><small>" +
                            formatDate(data[i].dateModified) +
                            " - " + "<ins>" +
                            data[i].statusName +
                            "</p></div></div>";
                        }
                      techid = data[i].TechId;
                      statusId = data[i].statusId;
                    }
                    }
                }
            });

            if (statusId == 4) {  
                $('#divTitle').html("RTU Ticketing Message");
                $('#divMessage').html("<div class='alert alert-info' role='alert'>" +
                "<i class='fas fa-info-circle'></i> The ticket you entered is <b>already close</b> please ask administartor to open again the ticket.</div>");
                $('#divButtons').html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");

            } else {
                $('#divButtons').html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>"+
                                  "<button type='button' class='btn btn-warning' onclick='replyTicket("+ techid +","+ statusId +")' id='btnUpdate'>Reply</button>" );

            }
            
         

                 
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
                    uploadfile(data);

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
                                      "<div><b>Category:</b> " + $('#cmbIncident option:selected').text() + "</div>" +
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

    function uploadfile(id){
        var filename = $('#filename').val();                    //To save file with this name
        var file_data = $('.fileToUpload').prop('files')[0];    //Fetch the file
        var form_data = new FormData();
        form_data.append("file",file_data);
        form_data.append("filename",id);
        //Ajax to send file to upload
        $.ajax({
            url: "upload.php",                      //Server api to receive the file
                    type: "POST",
                    dataType: 'script',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                success:function(dat2){
                  
                }
            });
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
                        data: { txtEmpName: $('#txtEmpName').val(),
                            txtdescription: $('#txtdescription').val(),
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
                    const empField = document.getElementById('txtEmp');
                    const empNameField = document.getElementById('txtEmpName');
                    const descField = document.getElementById('txtdescription');
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                    setError(emailField, !emailField.value.match(emailRegex), '', 'Please enter a valid email address');
                    setError(empField, !empField.value.match(/^[A-Za-z]-\d{2}-\d{2}-\d{3}$/), '', 'Please enter a valid employee number');
                    setError(empNameField, !empNameField.value, '', 'Please enter your name');
                    setError(descField, !descField.value, '', 'Please enter a brief description of your issue');

                    function setError(field, condition, successMessage, errorMessage) {
                        if (condition) {
                        field.classList.add('is-invalid');
                        field.classList.remove('is-valid');
                        field.nextElementSibling.textContent = errorMessage;
                        isValid = false;
                        } else {
                        field.classList.remove('is-invalid');
                        field.classList.add('is-valid');
                        field.nextElementSibling.textContent = successMessage;
                        }
                    }

                var selectedOffice = $("#cmbOffice").val(); // get the selected office
                    if (!selectedOffice) { // if no office is selected
                        $("#cmbDepartment").addClass("is-invalid");
                        $(".office-error").show(); // show error message
                        isValid = false;
                        event.preventDefault(); // prevent form submission
                    } else {
                        $("#cmbDepartment").removeClass("is-invalid").addClass('is-valid');
                        $(".office-error").hide(); // hide error message.
                    }

                 var aspriority = $("#cmbIncident").val();
                    if (aspriority == "0") {
                        $("#cmbIncident").addClass("is-invalid");
                        $(".priority-error").show();
                        isValid = false;
                        event.preventDefault();
                        } else {
                        $("#cmbIncident").removeClass("is-invalid").addClass('is-valid');
                        $(".priority-error").hide();
                        }

                    if (!$('#chkAgree').is(':checked')) {
                        $('#chkAgree').addClass('is-invalid');
                        return;
                        } else {
                        $('#chkAgree').removeClass('is-invalid');
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
