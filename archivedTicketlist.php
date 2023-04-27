<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    include 'header.php';  
?>

<?php include 'message.php' ?>

<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Archived Tickets</h1>
    <div class="card shadow mb-4 no-animation fade-up">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Archived Ticket List</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
            <button class= "btn btn-primary" style='float:right;' onclick="exportTableToCSV('archived_tickets.csv')"> Export Data <i class='fas fa-file-export'></i></button>
                <table class="table table-bordered table-striped" id="dataTable1" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col">Ticket ID</th>
                        <th scope="col">Status</th>
                        <th scope="col">Description</th>
                        <th scope="col">Priority</th>
                        <th scope="col">Office</th>
                        <th scope="col">Assigned To</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Last Update</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php
                        include "./controllers/dbConnect.php";   
                        $sql = "SELECT CASE WHEN Isnull(b.technicianId) then 'Unassign' ELSE c.statusName END Stas,
                                a.title, description, e.IncidentName, a.Id, IFNULL(f.priorityName, '---') as priorityName, g.Office,
                                IFNULL(CONCAT(d.lastName,', ',d.firstName),'---') Assigned, a.name,
                                CASE WHEN ISNULL(b.datemodified) then a.DateCreated else b.datemodified end lastUpdate
                                FROM tblTicket a 
                                LEFT JOIN  (SELECT *, ROW_NUMBER() OVER(PARTITION BY ticketId ORDER by dateModified DESC) AS row_num 
                                            FROM `tblTicketHistory`) b on a.Id = b.ticketId and row_num = 1
                                LEFT JOIN tblStatus c on c.id = b.ticketStatus
                                LEFT JOIN tblUser d on d.id = b.technicianId
                                LEFT JOIN tblIncident e on e.id = a.incident
                                LEFT JOIN tblPriority f on f.id = a.priority
                                LEFT JOIN tblDepartment g on g.id = a.department
                                WHERE a.isArchived = 1;";
                     
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) >= 1) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr><td><b>'.$row['Id'].'</b></td>';
                                echo '<td>'.$row['Stas'].'</td>';
                                echo '<td>'.$row['description'].'</td>';
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
                                echo '<td>'.date('M d, Y h:i A', strtotime($row['lastUpdate'])).'</td>';
                                echo '<td><button class="btn btn-danger" onClick="unarchiveTicket('.$row['Id'].')">Unarchive</button></td>';
                                echo '</tr>';
                                                              
                             }           
                               } else {
                            echo "No archived tickets found.";
                        }
         
                                    ?>
                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  
                   </div>

                   <?php   include 'footer.php';      ?>
 
      <script src="./js/ticketManagement.js"></script>
            <!-- Page level plugins -->
      <script src="vendor/datatables/jquery.dataTables.min.js"></script>
      <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script> 
    $(document).ready(function() {
        $('#dataTable1').DataTable(); 
    });
    

    function unarchiveTicket(ticketId) {
    if (confirm("Are you sure you want to unarchive this ticket?")) {
        $.ajax({
            url: "controllers/homeControllers.php",
            type: "POST",
            data: { unarchiveTickets: true, id: ticketId },
            success: function() {
                location.reload();

            }
        });
    } }

    function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("#dataTable1 tbody tr");

    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td");

        for (var j = 0; j < cols.length; j++)
            row.push(cols[j].innerText);

        csv.push(row.join(","));
    }

    downloadCSV(csv.join("\n"), filename);
}

    function downloadCSV(csv, filename) {
        var csvFile;
        var downloadLink;

        csvFile = new Blob([csv], {type: "text/csv"});
        downloadLink = document.createElement("a");
        downloadLink.download = filename;
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = "none";
        document.body.appendChild(downloadLink);
        downloadLink.click();
    }



        <?php 
            }else{
                header("Location: login.php");
                exit();
           }
            ?>
          

      </script>