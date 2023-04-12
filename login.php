<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RTU Ticketing System</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="x-icon" href="../rtu-ticket-manage/img/rtulogo.png">

    <style>

	body{
		width: 100%;
	    height: calc(100%);
	    position: fixed;
	    top: 0;
	    left: 0;
        background-color: #265999 ;
	}
	main#main{
		width:100%;
		height: calc(100%);
		display: flex;
	}

</style>
</head>
<script src="js/jquery-3.6.3.min.js"></script>
<body >

<div class="modal fade" id="TicketModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" >
        <h5 class="modal-title font-weight-bold text-primary" id="ticketModalLabel"><div id="divTitle"></div></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="divMessage" class="modal-body">
      </div>
      <div id = "divButtons" class="modal-footer">
       
      </div>
    </div>
  </div>
</div>


    <main id="main" > 
        <!-- Outer Row -->
        <div class="container align-self-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                <div class="card shadow-sm no-animation fade-up">
                    <div class="card-body  p-5">
                    <div class="row align-items-center mb-4">
                        <div class="col-md-4 text-center">
                        <img src="../rtu-ticket-manage/img/rtulogo.png" class="img-fluid" alt="RTU Logo">
                        </div>
                        <div class="col-md-8">
                        <h1 class="h2 mb-0"><b>Rizal Technological University</b></h1>
                        <p class="lead mb-0">Ticketing Management System</p>
                        </div>
                    </div>
                    <form class="user">
                        <div class="form-group">
                        <label for="txtEmail" class="font-weight-bold text-primary">E-mail</label>
                        <input type="email" class="form-control form-control-user" id="txtEmail" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                        <label for="txtpassword" class="font-weight-bold text-primary">Password</label>
                        <input type="password" class="form-control form-control-user" id="txtpassword">
                        <input type="checkbox" id="showPassword"> Show Password <br>
                        <a href="#" onclick="forgetPass()" data-toggle="modal" data-target="#TicketModal" class="text-secondary small">Forgot password?</a>
                        </div>
                        <button id="login-btn" onclick="getUserDetails()" type="button" data-toggle="modal" data-target="#TicketModal" class="btn btn-primary btn-block">Login</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            </div>
            </main>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script> 
    $(document).ready(function(){
    $('#showPassword').click(function(){
        if($(this).is(':checked')){
            $('#txtpassword').attr('type', 'text');
        }else{
            $('#txtpassword').attr('type', 'password');
        }
    });
    });
       function getUserDetails() {
                $('#divTitle').html("RTU Ticketing Message");
                $.ajax({
                    async: false,
                    type: "POST",
                    url: 'controllers/loginControllers.php',
                    data: {
                        txtEmail: $('#txtEmail').val(),
                        txtpassword: $('#txtpassword').val(),
                        getLoginDetails: 1
                    },
                    success: function (data) {
                        console.log(data)
                        data = JSON.parse(data);
                        if (data == "1") {
                            window.location.href = "home.php";
                            $('#divButtons').html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");
                        } else {
                            $('#divMessage').html(data);
                            $('#divButtons').html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");
                        }

                    }
                })
            }

            $(document).ready(function() {
                $('#txtpassword').keypress(function(event) {
                    if (event.keyCode === 13) {
                        $('#login-btn').click();
                    }
                });
            });


    function forgetPass() {
    
        $('#divTitle').html("Forgot Password"); 
        $('#divMessage').html("<p class='mb-0'><b class='text-dark'>Enter your email address</p></b> <div class='form-group'> " +
                                "<input type='email' class='form-control form-control-user' id='txtUsername' placeholder='Email address'></div>");
        $('#divButtons').html(" <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button> <button type='button' onclick='OTPPass()' class='btn btn-primary' data-dismiss='modal'>Submit</button>");
          
    }

    function OTPPass() {
        let email = $('#txtUsername').val();
        $.ajax({
                async: false,
                type: "POST",
                url: 'controllers/loginControllers.php',
                data: { txtEmail: email, 
                        isEmailValid: 1
                    },
                success: function(data) {
                    data = JSON.parse(data);
                    console.log(data);
                    if (data[0].id != "0") {
                        $('#divTitle').html("Code Verification"); 
                        $('#divMessage').html("<div id='error'></div></div><p class='mb-0'><b class='text-dark'>Enter OTP</b> "+ email +"</p> <div class='form-group'> " +
                                              "<input class='form-control form-control-user' id='txtOTP' placeholder='Enter OTP'></div>" +
                                              "<div class='alert alert-info' role='alert'>" +
                                                "<i class='fas fa-info-circle'></i> We've sent you the password reset OTP, please check your email.</div>"+
                                                "</div>");
                        var OTPs = OTPGenerate(data[0].id);
                        $('#divButtons').html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button> <button type='button' class='btn btn-primary' onClick='NewPassword("+ data[0].id +")' data-dismiss='modal'>Verify</button>");
                        sendemail(email,"RTU-Ticketing Management - Reset Password","Hi "+data[0].name+"<br>Here's the OTP for request of password reset.<br><h2><b>"+ OTPs +"</b></h2>Thanks,<br><b>RTU Ticketing System</b>");
                    
                    } else { 
                        $('#divMessage').html("Invalid Email Address!");

                        $('#divButtons').html(" <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");
                    }
                  
                }
            })          
    }

    function NewPassword(ids) {
       
        $('#divTitle').html("RTU Ticketing Message"); 
        $.ajax({
                async: false,
                type: "POST",
                url: 'controllers/loginControllers.php',
                data: { id: ids, 
                        otpcode:  $('#txtOTP').val(),
                        getVerifyOTP: 1
                    },
                success: function(data) {
                    console.log(data);                                        
                    data = JSON.parse(data);
                    if (data == "1") {
                        $('#divMessage').html("<div id='error'> </div>New Password <div class='form-group'> " +
                                              "<input type='password' class='form-control form-control-user' id='txtNewPass' placeholder='New Password'></div>"+
                                              "Confirm Password<div class='form-group'> " +
                                              "<input type='password' class='form-control form-control-user' id='txtOldPass' placeholder='Confirm Password'></div>");
                      
                        $('#divButtons').html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button><button type='button' class='btn btn-warning' onClick='UpdatePass("+ ids +")' data-dismiss='modal'>Update</button>");
                    } else { 
                        $('#error').html(data);
                        $('#divButtons').html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button> <button type='button' class='btn btn-warning' onClick='NewPassword("+ ids +")' data-dismiss='modal'>Verify</button>");
                    }
                  
                }
            })

    }

    function UpdatePass(ids) {
       
       $('#divTitle').html("RTU Ticketing Message");
       let text = $('#txtNewPass').val();
       let confirm = $('#txtOldPass').val();

        if ((text == confirm) && (text.length >= 8)) {
            $.ajax({
               async: false,
               type: "POST",
               url: 'controllers/loginControllers.php',
               data: { id: ids, 
                       password:  $('#txtNewPass').val(),
                       updatePass: 1
                   },
               success: function(data) {
                   console.log(data);                                        
                   data = JSON.parse(data);
                   if (data == "1") {
                       $('#divMessage').html("You successfully reset your password.");
                       $('#divButtons').html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");
                   } else { 
                       $('#error').html(data);
                     
                   }
                 
               }
           })
        } else {
          
            $('#error').html("<div class='alert alert-danger'>Please make sure new and confirm password is match and alteast 8 character");
            $('#divButtons').html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button><button type='button' class='btn btn-warning' onClick='UpdatePass("+ ids +")' data-dismiss='modal'>Update</button>");

        }

   }





    function OTPGenerate(id) {
        let OTPs = 0;
        $.ajax({
                async: false,
                type: "POST",
                url: 'controllers/loginControllers.php',
                data: { id: id, 
                        GetOTP: 1
                    },
                success: function(data) {
                    data = JSON.parse(data);
                    console.log(data);
                    OTPs = data;        
                }
            })
        return OTPs;     
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


    </script>

</body>

</html>
