<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    include 'header.php';  
 ?>

<?php include 'message.php' ?>


                <!-- Begin Page Content -->
                <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 mb-4">
                        <h1 class="h3 mb-2 text-gray-800">Report</h1>
                        <select id="reportType" class="form-control">
                            <option value="daily" selected>Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 mb-4">
                        <div class="card shadow mb-4 no-animation fade-up">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Ticket Summary</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-bar">
                                    <canvas id="myBarChartI"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow mb-4 no-animation fade-up">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Ticket Status</h6>
                            </div>
                            <div id="divStatusReport" class="card-body"></div>
                        </div>
                    </div>
                </div>
            </div>

                <!-- /.container-fluid -->

          

   

    <?php   include 'footer.php';      ?>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>

    <script> 
            $(document).ready(function() {
            $(document).ready(function() {
             // Function to load the report summary
            function loadReportSummary(reportType) {
                $.ajax({
                    type: "POST",
                    url: "controllers/reportControllers.php",
                    data: { getReportSummary: 1, reportType: reportType },
                    success: function (data) {
                        const name = [];
                        const numbers = [];
                        data = JSON.parse(data);
                        for (var i = 0; i < data.length; i++) {
                            name[i] = data[i].stas;
                            numbers[i] = data[i].numbers;
                        }

                        var ctx = document.getElementById('myBarChartI').getContext('2d');

                        var options = {
                            maintainAspectRatio: false,
                            responsive: true,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Number of Tickets'
                                    }
                                }],
                            }
                        };


                        var reportLabel = "";
                        if (reportType === 'daily') {
                            reportLabel = "Daily";
                        } else if (reportType === 'weekly') {
                            reportLabel = "Weekly";
                        } else if (reportType === 'monthly') {
                            reportLabel = "Monthly";
                        } else if (reportType === 'yearly') {
                            reportLabel = "Yearly";
                        }

                        var data = {
                            labels: name,
                            datasets: [{
                                label: reportLabel,
                                data: numbers,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        };

                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: data,
                            options: options
                        });
                    }
                });
            }

    // Load the report summary for the selected report type
    var reportType = $('#reportType').val();
    loadReportSummary(reportType);

    // Update the report summary when the report type is changed
    $('#reportType').on('change', function() {
        var reportType = $(this).val();
        loadReportSummary(reportType);
    });
});




        $.ajax({
               async: false,
               type: "POST",
               url: 'controllers/reportControllers.php',
               data: {getReport: 1},
               success: function(data) {
                data = JSON.parse(data);
                   for (var i=0; i< data.length; i++ ) {
                    var colorbar = "";
                    if (data[i].stas == 'OPEN - Unassign') {
                        colorbar = "bg-danger";
                    } else if (data[i].stas == 'Closed') {
                        colorbar = "bg-success";
                    } else if (data[i].stas == 'In Progress') {
                            colorbar = "bg-info";
                    } else if (data[i].stas == 'Resolved') {
                            colorbar = "bg-warning";
                    } else {
                            colorbar = "";
                    }

                     document.getElementById("divStatusReport").innerHTML += " <h4 class='small font-weight-bold'>"+ data[i].stas +" <span class='float-right'>"+ data[i].numbers +"%</span></h4>" +
                                    "<div class='progress mb-4'><div class='progress-bar "+ colorbar +"' role='progressbar' style='width: "+ data[i].numbers +"%' aria-valuenow='"+ data[i].numbers +"' aria-valuemin='0' aria-valuemax='100'></div>" +
                                    "</div>"; 
                    }
                
               }
           });

           $('#divLow').html("0")
           $('#divModerate').html("0")
           $('#divHigh').html("0")
           $('#divCritical').html("0")

           $.ajax({
               async: false,
               type: "POST",
               url: 'controllers/reportControllers.php',
               data: {getReportPrio: 1},
               success: function(data) {
                data = JSON.parse(data);
                   for (var i=0; i< data.length; i++ ) {
                        if (data[i].stas == 'Critical') {
                            $('#divCritical').html(data[i].numbers)
                        } else if (data[i].stas == 'High') {
                            $('#divHigh').html(data[i].numbers)
                        } else if (data[i].stas == 'Moderate') {
                            $('#divModerate').html(data[i].numbers)
                        } else {
                            $('#divLow').html(data[i].numbers)
                        }
                    }
                
               }
           });

   })

    </script>

</body>

</html>

<?php 
}else{
     header("Location: login.php");
     exit();
}
 ?>