<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    include 'header.php';  
 ?>

<?php include 'message.php' ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                <div class="row">
                    <div class="col"><h1 class="h3 mb-2 text-gray-800">User Management</h1> </div>
                    <div  class="col"> <button style="float:right;" class="btn btn-warning" data-toggle="modal" data-target="#TicketModal" onClick="NewUser()">NEW USER</button></div>

                </div>

                <br/>
                   

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4 no-animation fade-up">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">User List</h6>
                        </div>
                        <div class="card-body">
                            <div id="divTable" class="table-responsive">
                                <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th class="sortable" >ID<i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                        <th class="sortable" >ACCESS<i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                        <th class="sortable" >EMAIL<i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                        <th class="sortable" >FIRST NAME<i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                        <th class="sortable" >LAST NAME<i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                        <th class="sortable" >CONTACT NUMBER<i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                        <th class="sortable" >STATUS<i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                        <th class="sortable" >DATE CREATED<i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                        <th class="sortable" >EMPSTATUS<i class="fas fa-sort float-right" style='cursor: pointer'></i></th>
                                           

                                       
                                        </tr>
                                    </thead>
                                   
                                    <tbody>

                                    <?php   
                                    
                                    include "./controllers/dbConnect.php";   
                                     $sql = "SELECT a.Id, 
                                                    email, b.accessName , firstName, lastName, IFNULL(contactNumber,'-----') contactNumber , 
                                                    CASE WHEN a.isActive = 1 THEN 'ACTIVE' ELSE 'INACTIVE' END isActive, dateCreated , CASE WHEN isOJT = 0 THEN 'REGULAR' ELSE 'OJT' END empstat
                                            FROM tblUser a 
                                            LEFT JOIN tblAccess b on a.accessId = b.id;";
                     
                         $result = mysqli_query($conn, $sql);
                        
                         if (mysqli_num_rows($result) >= 1) {
                          
                             while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr><td><button class="btn btn-link" data-toggle="modal" data-target="#TicketModal" onClick="editUser('.$row['Id'].')">'.$row['Id'].'</button></td>';
                                echo '<td>'.$row['accessName'].'</td>';
                                echo '<td>'.$row['email'].'</td>';
                                echo '<td>'.$row['firstName'].'</td>';
                                echo '<td>'.$row['lastName'].'</td>';
                                echo '<td>'.$row['contactNumber'].'</td>';
                                echo '<td>'.$row['isActive'].'</td>';
                                echo '<td>'.$row['dateCreated'].'</td>'; 
                                echo '<td>'.$row['empstat'].'</td></tr>';                               
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

    function editUser(id) {
        $('#divTitle').html("UPDATE USER");
        $('#divMessage').html("<div class='form-group'><input type='text' class='form-control form-control-user' id='txtUserEmail' placeholder='Email'></div>"+
        "<div class='form-group'><input type='text' class='form-control form-control-user' id='txtUserFirstName' placeholder='First Name'></div>"+
        "<div class='form-group'><input type='text' class='form-control form-control-user' id='txtUserLastName' placeholder='Last Name'></div>"+
        "<div class='form-group'><input type='text' class='form-control form-control-user' id='txtUserContact' placeholder='Contact Number'></div>"+  
        "<div class='form-group'><select class='form-control form-control-user' id='cmbStatus'><option value=1>ACTIVE</option><option value=0>INACTIVE</option></select></div>" +                   
        "<div class='form-group'><select class='form-control form-control-user' id='cmbEmpStatus'><option value=0>REGULAR</option><option value=1>OJT</option></select></div>" +
        "<div class='form-group'><select class='form-control form-control-user' id='cmbAccess'></select></div>" );
        $('#divButtons').html(" <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button><button type='button' class='btn btn-warning'  onclick='updateUser("+ id +")' data-dismiss='modal'>Update</button>");
            

        $.ajax({
            async: false,
            type: "POST",
            url: 'controllers/userControllers.php',
            data: {getAccess: 1},
            success: function(data) {
                data = JSON.parse(data);
                $("#cmbAccess").empty();
                var cmbInc = document.getElementById("cmbAccess");
                var option = document.createElement("option");
                    option.text = "SELECT ACCESS LEVEL";
                    option.value = 0;
                    cmbInc.add(option);
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

        $.ajax({
            async: false,
            type: "POST",
            url: 'controllers/userControllers.php',
            data: {getUserDetails: 1, userId: id},
            success: function(data) {
                data = JSON.parse(data);
                for (var i=0; i< data.length; i++ ) {
                    $('#txtUserEmail').val(data[i].email) 
                    $('#txtUserFirstName').val(data[i].firstName) 
                    $('#txtUserLastName').val(data[i].lastName) 
                    $('#txtUserContact').val(data[i].contactNumber)
                    $('#cmbStatus').val(data[i].isActive) 
                    $('#cmbAccess').val(data[i].accessId) 
                    $('#cmbEmpStatus').val(data[i].isOJT) 

                }
                
            }, 
            error: function (e) {
                alert(e);
            }
        });
    
    }

    function NewUser() {
        $('#divTitle').html("NEW USER");
        $('#divMessage').html("<div class='form-group'><input type='text' class='form-control form-control-user' id='txtUserEmail' placeholder='Email'></div>"+
        "<div class='form-group'><input type='text' class='form-control form-control-user' id='txtUserFirstName' placeholder='First Name'></div>"+
        "<div class='form-group'><input type='text' class='form-control form-control-user' id='txtUserLastName' placeholder='Last Name'></div>"+
        "<div class='form-group'><input type='text' class='form-control form-control-user' id='txtUserContact' placeholder='Contact Number'></div>"+                     
        "<div class='form-group'><select class='form-control form-control-user' id='cmbStatus'><option value=1>ACTIVE</option><option value=0>INACTIVE</option></select></div>" +
        "<div class='form-group'><select class='form-control form-control-user' id='cmbEmpStatus'><option value=0>REGULAR</option><option value=1>OJT</option></select></div>" +
        "<div class='form-group'><select class='form-control form-control-user' id='cmbAccess'></select></div>" );
        $('#divButtons').html(" <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button><button type='button' class='btn btn-warning'  onclick='NewUserAccess()' data-dismiss='modal'>Update</button>");
            

        $.ajax({
            async: false,
            type: "POST",
            url: 'controllers/userControllers.php',
            data: {getAccess: 1},
            success: function(data) {
                data = JSON.parse(data);
                $("#cmbAccess").empty();
                var cmbInc = document.getElementById("cmbAccess");
                var option = document.createElement("option");
                    option.text = "SELECT ACCESS LEVEL";
                    option.value = 0;
                    cmbInc.add(option);
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

    
    }

    function NewUserAccess() {
        $('#divTitle').html("RTU Ticketing Message"); 
            $.ajax({
                async: false,
                type: "POST",
                url: 'controllers/userControllers.php',
                data: { txtEmail: $('#txtUserEmail').val(), 
                        txtUserFirstName: $('#txtUserFirstName').val(),
                        txtUserLastName: $('#txtUserLastName').val(),
                        txtUserContact: $('#txtUserContact').val(),
                        cmbStatus: $('#cmbStatus').val(),
                        cmbAccess: $('#cmbAccess').val(),
                        cmbEmpStatus: $('#cmbEmpStatus').val(),
                        addUser: 1
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


    function updateUser(id) {
        $('#divTitle').html("RTU Ticketing Message"); 
        $.ajax({
            async: false,
            type: "POST",
            url: 'controllers/userControllers.php',
            data: { txtEmail: $('#txtUserEmail').val(), 
                    txtUserFirstName: $('#txtUserFirstName').val(),
                    txtUserLastName: $('#txtUserLastName').val(),
                    txtUserContact: $('#txtUserContact').val(),
                    cmbStatus: $('#cmbStatus').val(),
                    cmbAccess: $('#cmbAccess').val(),
                    cmbEmpStatus: $('#cmbEmpStatus').val(),
                    userId: id,
                    updateUser: 1
                },
            success: function(data) {
                data = JSON.parse(data);
                $('#divMessage').html(data);
                $('#divButtons').html(" <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");
            }, 
            error: function (e) {
                alert(e);
            }
        });
     
    
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