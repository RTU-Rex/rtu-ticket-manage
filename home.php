<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    include 'header.php';  
 ?>



<?php include 'message.php' ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Home</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <div onClick="ticketAll(1)" class="col-xl-2 col-md-2 mb-2" style="cursor: pointer">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Critical Priority</div>
                                            <div id="divCritical" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div onClick="ticketAll(2)" class="col-xl-2 col-md-2 mb-2" style="cursor: pointer">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                High Priority</div>
                                            <div id="divHigh" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div onClick="ticketAll(3)" class="col-xl-2 col-md-2 mb-2" style="cursor: pointer">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Moderate
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div id="divModerate" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div onClick="ticketAll(4)" class="col-xl-2 col-md-2 mb-2" style="cursor: pointer">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Low</div>
                                            <div id="divLow" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div onClick="ticketAll(0)" class="col-xl-2 col-md-2 mb-2" style="cursor: pointer">
                            <div class="card border-left-dark  shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-dark  text-uppercase mb-1">
                                                Open </div>
                                            <div id="divOther" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div onClick="ticketAll(-1)" class="col-xl-2 col-md-2 mb-2" style="cursor: pointer">
                            <div class="card border-left-secondary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                                All</div>
                                            <div id="divAll" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        


                    </div>
                     
                    <div id="divActiveTicket" class="row">
        
                       
                       
                    </div>

                     
                      
                </div>

                <!-- /.container-fluid -->             

    <?php   include 'footer.php';      ?>

    <script> 
  
    $(document).ready(function() {
        ticketAll(-1);
        ticketDash(-1);
   });

   function ticketAll(prio) {
    document.getElementById("divActiveTicket").innerHTML = "";
    
    $.ajax({
               async: false,
               type: "POST",
               url: 'controllers/homeControllers.php',
               data: { priority: prio,
                       gettickets: 1},
               success: function(data) {
                data = JSON.parse(data);
                if (data.length > 0) {
                    for (var i=0; i< data.length; i++ ) {
                     document.getElementById("divActiveTicket").innerHTML += "<div class='col-4'>"  +
                                                    "<div class='card shadow mb-4 fade-up' style='cursor: pointer' data-toggle='modal' data-target='#TicketModal' onClick='viewTicket("+ data[i].Id +")'>" +
                                                    " <div class='card-header py-3'>"  +
                                                    "<div class='row'>"  +
                                                    " <div class='col'>"  +
                                                    " <h5 class='m-0 font-weight-bold text-dark text-capitalize hover-danger'>"  +
                                                    " <i class='fas fa-ticket-alt mr-2'></i>"  +
                                                    " Ticket # "+ data[i].Id + " - " + data[i].IncidentName +
                                                    " </h5>"  +
                                                    "</div>"  +
                                                    "<div class='col-auto'>"  +
                                                    " <span class='badge " + "badge_class[badge_class_index]" + "'>" + data[i].Stas + "</span>"  +
                                                    " </div>"  +
                                                    "</div>"  +
                                                    "</div>"  +
                                                    "<div class='card-body ml-2'>" +
                                                    "<b>Requestor's Name:</b> "+ data[i].name +"<br>"+
                                                    "<b>Office/Department:</b> "+ data[i].Office +"<br>" +
                                                    "<b>Priority: </b>" + data[i].priorityName +
                                                    "<br><b> Description:</b> "+ data[i].description +
                                                    "<br><b> Assigned to:</b> "+ data[i].technicianName +
                                                    "<hr> <small class='mb-1'> Last udpate: "+ formatDate(data[i].lastUpdate) +
                                                    "</div>"+
                                                    "</div>"+
                                                    "</div>";
                    } 

                } else {
                    document.getElementById("divActiveTicket").innerHTML = "<div class='col-12'> NO PENDING TICKET </div>"
                }
                   
               }, 
               fail: function (e) {
                    document.getElementById("divActiveTicket").innerHTML = "<div class='col-12'> NO PENDING TICKET </div>";
                },
           });

   }

   function ticketDash(prio) {
    
    $.ajax({
               async: false,
               type: "POST",
               url: 'controllers/homeControllers.php',
               data: { priority: prio,
                       gettickets: 1},
               success: function(data) {
                data = JSON.parse(data);
                if (data.length > 0) {
                    var cri = 0;
                    var high = 0;
                    var mode = 0;
                    var low = 0;
                    var others = 0;
                    var all = 0;
                    for (var i=0; i< data.length; i++ ) {
                        if (data[i].prioId == 1) {
                            cri = cri + 1;
                        } else if (data[i].prioId == 2) {
                           high = high + 1 ;
                        } else if (data[i].prioId == 3) {
                           mode = mode + 1;
                        } else if (data[i].prioId == 4) {
                            low = low + 1;
                        } else {
                            others = others + 1;
                        }

                        all = all + 1;
                    } 

                    $('#divLow').html(low)
                    $('#divModerate').html(mode)
                    $('#divHigh').html(high)
                    $('#divCritical').html(cri)
                    $('#divOther').html(others)
                    $('#divAll').html(all)

                } 
                   
               }, 
           });

   }

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

    <script src="./js/ticketManagement.js"></script>

</body>

</html>

<?php 
}else{
     header("Location: login.php");
     exit();
}
 ?>