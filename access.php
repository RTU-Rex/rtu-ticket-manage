<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['email'])) {
    include 'header.php';  
 ?>

<?php include 'message.php' ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                <div class="row">
                    <div class="col"><h1 class="h3 mb-2 text-gray-800">Access Management</h1> </div>
                    <div  class="col"> <button style="float:right;" class="btn btn-primary" data-toggle="modal" data-target="#TicketModal" onClick="NewAccess()"> New Access</button> 
                    <button style="float:right;" class="btn btn-warning" data-toggle="modal" data-target="#TicketModal" onClick="NewMenu()"> New Menu</button></div>


                </div>
              <br>

               

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Access Menu</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col"> Access Level : <select class='form-control' onchange="accessMenu()" style="width: 100%;" id='cmbAccess'></select></div>
                                <div class="col"> <button type='button' style="width: 20%; " onclick="deleteAccessName()" class='btn btn-danger'>Delete</button></div>
                            </div>
                           
                          
                        </div>
                            <div style="" class="row">
                                <div class="col-xl-5 col-md-5 mb-2" ><select class="select" style="float: right;width: 70%;" size="20" id="cmbAccessMenu"></select></div>
                                <div class="col-xl-2 col-md-2 mb-2" >
                                    <div class="row" style="margin-top: 40%;margin-bottom: 30%;">  
                                        <div class="col"><button type='button' style="width: 100%; " onclick="updateAccess()" class='btn btn-primary'>ADD</button></div>
                                    </div> 
                                    <div class="row">  
                                        <div class="col">  <button type='button' style="width: 100%;" onclick="deleteAccess()" class='btn btn-warning'>REMOVE</button> </div>
                                    </div> 
                                </div>
                                <div class="col-xl-5 col-md-5 mb-2" ><select class="select" style="float: left;width: 70%;" size="20" id="cmbMenu"></select></div>
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
       
        access();
        menu();
        accessMenu();

       

    });

    function access() {
        $.ajax({
            async: false,
            type: "POST",
            url: 'controllers/accessController.php',
            data: {getAccess: 1},
            success: function(data) {
                data = JSON.parse(data);
                $("#cmbAccess").empty();
                var cmbInc = document.getElementById("cmbAccess");
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

    function menu() {
        $.ajax({
            async: false,
            type: "POST",
            url: 'controllers/accessController.php',
            data: {getMenu: 1},
            success: function(data) {
                data = JSON.parse(data);
                $("#cmbMenu").empty();
                var cmbInc = document.getElementById("cmbMenu");
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

    function accessMenu() {
        $("#cmbAccessMenu").empty();
        $.ajax({
            async: false,
            type: "POST",
            url: 'controllers/accessController.php',
            data: {id: $("#cmbAccess").val(),getAccessMenu: 1},
            success: function(data) {
                data = JSON.parse(data);
              
                var cmbInc = document.getElementById("cmbAccessMenu");
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

    function updateAccess() {

      var checking = checkAccess();
      if (checking == 1) {
        $.ajax({
            async: false,
            type: "POST",
            url: 'controllers/accessController.php',
            data: { menuId: $('#cmbMenu').val(), 
                    AccessId: $('#cmbAccess').val(),
                    updateAccess: 1
                },
            success: function(data) {
                data = JSON.parse(data);
            }, 
            error: function (e) {
                alert(e);
            }
        });
      }
     accessMenu();
    }

    function checkAccess() {
       
        var checking = 1;
        $.ajax({
            async: false,
            type: "POST",
            url: 'controllers/accessController.php',
            data: { menuId: $('#cmbMenu').val(), 
                    AccessId: $('#cmbAccess').val(),
                    checkAccess: 1
                },
            success: function(data) {
                data = JSON.parse(data);
                if (data == 1) {
                    checking = 0;
                } else {
                    checking = 1;
                }
               
            }, 
            error: function (e) {
                alert(e);
            }
        });

      return checking; 
    
    }

    function deleteAccess() {
      
        $.ajax({
            async: false,
            type: "POST",
            url: 'controllers/accessController.php',
            data: { AccessId: $('#cmbAccessMenu').val(),
                    deleteAccess: 1
                },
            success: function(data) {
                data = JSON.parse(data);
            }, 
            error: function (e) {
                alert(e);
            }
        });

        accessMenu();
    
    }

    function NewAccess() {
        $('#divTitle').html("ADD ACCESS LEVEL");
        $('#divMessage').html("<div id='error'> </div><div class='form-group'><input type='text' class='form-control form-control-user' id='txtAccess' placeholder='Access Name'></div>" );
        $('#divButtons').html(" <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button><button type='button' class='btn btn-warning'  onclick='AddAccess()' data-dismiss='modal'>Create</button>");
    
    }

    function AddAccess() {


        if ( !($('#txtAccess').val() == '')) {
        $.ajax({
            async: false,
            type: "POST",
            url: 'controllers/accessController.php',
            data: { name: $('#txtAccess').val(), 
                    newAccess: 1
                },
            success: function(data) {
                data = JSON.parse(data);
                $("#divMessage").html(data);
            }, 
            error: function (e) {
                alert(e);
            }
        });
    
      } else {
        $('#error').html("Please Fill up the required fields");
        $('#divButtons').html(" <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button><button type='button' class='btn btn-warning'  onclick='AddAccess()' data-dismiss='modal'>Create</button>");

        }
        access();
        menu();
        accessMenu();
    } 

    function deleteAccessName() {
      
      $.ajax({
          async: false,
          type: "POST",
          url: 'controllers/accessController.php',
          data: { AccessId: $('#cmbAccess').val(),
                  deleteAccessName: 1
              },
          success: function(data) {
              data = JSON.parse(data);
          }, 
          error: function (e) {
              alert(e);
          }
      });

      access();
      menu();
      accessMenu();

  
  }

  function NewMenu() {
        $('#divTitle').html("CREATE MENU");
        $('#divMessage').html(  "<div class='form-group'><input type='text' class='form-control form-control-user' id='txtMenuName' placeholder='Menu Name'></div>"+
                                "<div class='form-group'><input type='text' class='form-control form-control-user' id='txtMenuURL' placeholder='Menu URL'></div>"+
                                "<div class='form-group'><input type='text' class='form-control form-control-user' id='txtMenuIcon' placeholder='Menu Icon'></div>"+
        "<div class='form-group'><select class='form-control form-control-user' onChange='hideText()' id='cmbMain'></select></div>"+
                              "<div class='form-group' id='newMain'><input type='text' class='form-control form-control-user' id='txtDepartment' placeholder='Department Name'></div>" );
        $('#divButtons').html(" <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button><button type='button' class='btn btn-warning'  onclick='CreateDept()' data-dismiss='modal'>Save</button>");
            

        var element = document.getElementById("newMain");
        element.style.visibility = "hidden";


        $.ajax({
            async: false,
            type: "POST",
            url: 'controllers/accessController.php',
            data: {getMainMenu: 1},
            success: function(data) {
                data = JSON.parse(data);
                $("#cmbMain").empty();
                var cmbInc = document.getElementById("cmbMain");
                var option = document.createElement("option");
                    option.text = 'SELECT DEPARTMENT';
                    option.value = 0;
                    cmbInc.add(option);
                for (var i=0; i< data.length; i++ ) {
                    var option = document.createElement("option");
                    option.text = data[i].name;
                    option.value = data[i].id;
                    cmbInc.add(option);
                }
                var option = document.createElement("option");
                    option.text = 'NEW DEPARTMENT';
                    option.value = -1;
                    cmbInc.add(option);
            }, 
            error: function (e) {
                alert(e);
            }
        });

    
    }

    function hideText() {
        if ($('#cmbMain').val() == -1) {
            var element = document.getElementById("newMain");
            element.style.visibility = "visible";
        } else {
            var element = document.getElementById("newMain");
            element.style.visibility = "hidden";

        }

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