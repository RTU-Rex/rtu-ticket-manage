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
                    <div class="col-md-4 mb-4">
                      
                    <button class= "btn btn-primary" onClick="exportdata()" style='float:right;'> Export Data <i class='fas fa-file-export'></i></button>
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

</body>

</html>

<?php 
}else{
     header("Location: login.php");
     exit();
}
 ?>