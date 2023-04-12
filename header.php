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

</head>
<script src ="js/ticketManagement.js"></script>
<script src="js/jquery-3.6.3.min.js"></script>  
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-primary sidebar sidebar-dark collapsed" id="accordionSidebar">
            
            <!-- Sidebar - Brand -->
            <a class="d-flex align-items-right justify-content-center" href="home.php" >
            <img src="../rtu-ticket-manage/img/rtulogo.png" alt="RTULogo" style="max-width: 60%;">
            </a>

            <?php include 'menu.php'; ?>
            
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                  
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                              
                                <span id="sCounts" class="badge badge-danger badge-counter"></span>
                            </a>
                        
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Ticket Notification
                                </h6>
                                <div id="divmessagetick">
                                   
                                </div>
                                <a class="dropdown-item text-center small text-gray-500" href="home.php">See all tickets</a>
                            </div>
                        </li> 

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-user-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['firstName'].' '.$_SESSION['lastName'] ?></span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <button class="dropdown-item" data-toggle="modal" data-target="#TicketModal" onclick="ResetPassword()">
                                    <i class="fas fa-unlock-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Manage Password
                                </button>
                                
                                <button class="dropdown-item" onclick="Logout()">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Log-out
                                </button>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <script> 

$(document).ready(function() {
    TicketHeader();
    ticketDashHeader(-1)
   });

  
function Logout() {
  $.ajax({
    async: false,
    type: "POST",
    url: 'controllers/loginControllers.php',
    data: {getLogout: 1},
    success: function(data) {
      console.log(data)
      data = JSON.parse(data);
      if (data == "1") {
        window.location.href('login.php');
      } else { 
        alert("error");
      }
    }
  });
  location.reload();
}

function ResetPassword() {
    $('#divTitle').html("RESET PASSWORD");
        $('#divMessage').html("<div id='error'></div><div class='form-group'><input type='text' class='form-control form-control-user' id='txtCurrent' placeholder='CURRENT PASSWORD'></div>" +
        "<div class='form-group'><input type='text' class='form-control form-control-user' id='txtNewP' placeholder='NEW PASSWORD'></div>" +  
        "<div class='form-group'><input type='text' class='form-control form-control-user' id='txtConfrimP' placeholder='CONFIRM PASSWORD'></div>" );
        $('#divButtons').html(" <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button><button type='button' class='btn btn-warning'  onclick='UpdatePass()' data-dismiss='modal'>Update</button>");
 }
 
function CheckPass(CPassword) {

var result = false;
    $.ajax({
    async: false,
    type: "POST",
    url: 'controllers/loginControllers.php',
    data: { pass: CPassword ,checkPass: 1},
    success: function(data) {
      data = JSON.parse(data);
      if (data == "1") {
      
        result =  true;
      } else { 
       
        result =  false;
      }
    }
  });

  return result;
}



 function UpdatePass() {
       
       $('#divTitle').html("RTU Ticketing Message");
       var text = $('#txtNewP').val();
       var confirm = $('#txtConfrimP').val();
      

        if ((text == confirm) && (text.length >= 8) && CheckPass($('#txtCurrent').val()) && !( text ==  $('#txtCurrent').val() ) ) {
            $.ajax({
               async: false,
               type: "POST",
               url: 'controllers/loginControllers.php',
               data: { password:  $('#txtNewP').val(),
                       updatePassHome: 1
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
          
            $('#error').html("Please make sure new and confirm password is match and alteast 8 character");
            $('#divButtons').html(" <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button><button type='button' class='btn btn-warning'  onclick='UpdatePass()' data-dismiss='modal'>Update</button>");

        }

   }

   function TicketHeader() {
    document.getElementById("divmessagetick").innerHTML = "";
    
    $.ajax({
               async: false,
               type: "POST",
               url: 'controllers/homeControllers.php',
               data: { priority: -1,
                       gettickets: 1},
                success: function(data) {
                    data = JSON.parse(data)
                    if (data.length > 0) {
                        if (data.length > 5) {
                            limit = 5;
                        } else {
                            limit =  data.length;
                        }
                        for (var i=0; i < limit; i++ ) {
                        document.getElementById("divmessagetick").innerHTML += " <a class='dropdown-item d-flex align-items-center' data-toggle='modal' data-target='#TicketModal' style='cursor: pointer' onClick='viewTicket("+ data[i].Id +")'> " +
                                                                                "<div class='font-weight-bold'>" +
                                                                                "<div class='text-truncate'> Ticket # "+ data[i].Id + " - " + data[i].title +" </div> " +
                                                                                "<div class='small text-gray-500'>"+ data[i].name +" · "+ formatDate(data[i].lastUpdate) +"</div></div></a>"
                       } 
                       
                    } else {
                        document.getElementById("divmessagetick").innerHTML = ""
                    
                    } 
                },
           });

   }

   function formatDate(dateString) {
      var date = new Date(dateString);
      var dateFormat = { 
        month: 'short', 
        day: 'numeric', 
        year: 'numeric' 
      };
      var timeFormat = {
        hour: 'numeric',
        minute: 'numeric',
        hour12: true
      
      };
      var formattedDate = date.toLocaleString('en-US', dateFormat);
      var formattedTime = date.toLocaleString('en-US', timeFormat);
      return formattedDate + " at " + formattedTime;
    }

   function ticketDashHeader(prio) {
    
    $.ajax({
               async: false,
               type: "POST",
               url: 'controllers/homeControllers.php',
               data: { priority: prio,
                       gettickets: 1},
               success: function(data) {
                data = JSON.parse(data);
                if (data.length > 0) {
                  
                    var all = 0;
                    for (var i=0; i< data.length; i++ ) {
                        all = all + 1;
                    } 

                    $('#sCounts').html(all);

                } else {

                    $('#sCounts').html("");
                }
                   
               }, 
           });

   }


  </script>