// for ticket management

function viewTicket(id) {
  var access = 0;
  var techid = 0;

    $("#divTitle").html("<div class = 'ml-2'>Ticket Journey</div>");

    $.ajax({
      async: false,
      type: "POST",
      url: "controllers/homeControllers.php",
      data: { ticketId: id, getTicketsJourney: 1 },
      success: function (data) {
        data = JSON.parse(data);
        for (var i = 0; i < data.length; i++) {
   
          $("#divMessage").html(
            "<div class='card shadow mb-4 no-animation'>" +
              "<div class='card-header py-3'>" +
              " <h5 class='m-0 font-weight-bold text-dark text-capitalize hover-danger'>"  +
              " <i class='fas fa-ticket-alt mr-2'></i>"  +
              " Ticket # "+ data[i].id + " - " + data[i].title + 
              " </h5>"  + "</div>" +
              "<div class='card-body'>"+
                "<small class='text-mute'>" +
                  " Created: " + formatDate(data[i].DateCreated) +
                  " by: " + "<b>" + data[i].name + "</b>" + " (" + data[i].email + ")" +
                  " located at: " + "<b>" + data[i].Office + "</b>" + " , " + "Issue: " + "<b>" + data[i].IncidentName + "</b> " +  data[i].file  +
                "</small>" +  
                "<div class='email-container mt-3'>" +
                  "<div class='text-dark'>" + data[i].description + "</div>" +
                "</div><hr><p class='mb-0 text-right'><small> Updated at: " +
                formatDate(data[i].dateModified) +
                "</p></hr>" +
              "</div>" +
            "</div>"
          );
          
          access = data[i].access;
        }
      
      },
    });
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
    
  $.ajax({
    async: false,
    type: "POST",
    url: "controllers/homeControllers.php",
    data: { ticketId: id, getTicketsJourneyHistory: 1 },
    success: function (data) {
      console.log(data);
      data = JSON.parse(data);
      if ( data != 0) {
        for (var i = 0; i < data.length; i++) {
          if (data[i].modifiedFrom == "User") {
            document.getElementById("divMessage").innerHTML +=
              "<div class='card border-right-warning shadow mb-4 no-animation '> " +
              "<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-right text-warning'>" +
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
              "<div class='card border-left-info shadow mb-4 no-animation conversation-card mb-3'> " +
              "<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-left text-info'>" +
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
          techid = data[i].technicianId;
        }

      }
    
    },
  });

  if (access == 2) {
    $("#divButtons").html(
      "<button type='button' class='btn btn-warning' onclick='replyTicket(" +
        id +
        ", " +
        techid +
        ", " +
        access +
        ")' id='btnUpdate'>Technical Report</button> <form target='_blank' action='TechnicalServiceReport.php' method='POST'><button type='submit' name='Print' value='"+ id +"' class='btn btn-danger'> PRINT</button></form>"
    );
  } else {
    $("#divButtons").html(
      "<button type='button' class='btn btn-primary' onclick='updateTicketview(" +
        id +
        ")'>Update Ticket</button>" +
        "<button type='button' class='btn btn-warning' onclick='replyTicket(" +
        id +
        ", " +
        techid +
        ", " +
        access +
        ")' id='btnUpdate'>Technical Report</button>"
    );
  }
}

function replyTicket(id, techId, access) {
  $("#divTitle").html("Technical Report");
  $("#divMessage").html(
      "<div id='error'> </div><div class='form-group'><h6 class='text-dark fs-5'><span class='required-indicator'>*</span><b>Action Taken </b></h6>"+
      "<textarea class='form-control' rows='5' id='txtdescription' placeholder='Description'></textarea></div>" +
      "<div  class='form-group'><h6 class='text-dark fs-5'><span class='required-indicator'>*</span><b>Status</b></h6>" +
      "<select class='form-control form-control-user' onChange='enableR()' id='cmbStatus'></select></div>" + "<hr>" +
      "<div class='form-group'><h6 class='text-dark fs-5'><b>Recommendation</b></h6>" +
      "<select onChange='hideText()' class='form-control form-control-user' id='cmbRecomend'></select></div>" + 
      "<div id='divRecomend' class='form-group'><textarea class='form-control' rows='5' id='txtrDes' placeholder='Recommendation'></textarea></div>" + "<hr>" +
      "<h6 class='text-dark fs-5'><span class='required-indicator'>*</span><b>Assigned to: </b></h6>"+
      "<div id='divTech' class='form-group'> <select class='form-control form-control-user' id='cmbTech'></select></div>" 
  );

  

  $.ajax({
    async: false,
    type: "POST",
    url: "controllers/indexControllers.php",
    data: { getTicketStatus: 1 },
    success: function (data) {
      data = JSON.parse(data);
      $("#cmbStatus").empty();
      var cmbStatus = document.getElementById("cmbStatus");
      for (var i = 0; i < data.length; i++) {

        if (access == 2) { 
            if (data[i].id == 2 || data[i].id == 3) {
              var option = document.createElement("option");
              option.text = data[i].name;
              option.value = data[i].id;
              cmbStatus.add(option);
            }

        } else {
          var option = document.createElement("option");
          option.text = data[i].name;
          option.value = data[i].id;
          cmbStatus.add(option);

        }
       
      }
    },
    error: function (e) {
      alert(e);
    },
  });

  $.ajax({
    async: false,
    type: "POST",
    url: "controllers/homeControllers.php",
    data: { getTech: 1 },
    success: function (data) {
      data = JSON.parse(data);
      $("#cmbTech").empty();
      var cmbInc = document.getElementById("cmbTech");
      for (var i = 0; i < data.length; i++) {
        var option = document.createElement("option");
        option.text = data[i].name;
        option.value = data[i].id;
        cmbInc.add(option);
      }
    },
    error: function (e) {
      alert(e);
    },
  });

  $.ajax({
    async: false,
    type: "POST",
    url: "controllers/homeControllers.php",
    data: { getRecomend: 1 },
    success: function (data) {
      data = JSON.parse(data);
      $("#cmbRecomend").empty();
      var cmbInc = document.getElementById("cmbRecomend");
      for (var i = 0; i < data.length; i++) {
        var option = document.createElement("option");
        option.text = data[i].name;
        option.value = data[i].id;
        cmbInc.add(option);
      }
    },
    error: function (e) {
      alert(e);
    },
  });

  if (techId != 0) {
    $("#cmbTech").val(techId);
    if (access != 2) {
      var element = document.getElementById("cmbTech");
      element.disabled = true;
    }
  }

  enableR();


  if (  $("#cmbRecomend").val() == 2) {
    var element = document.getElementById("divRecomend");
    element.style.visibility = "hidden";
  }
  

  $.ajax({
    async: false,
    type: "POST",
    url: "controllers/homeControllers.php",
    data: { ticketId: id, getTicketsJourneyHistory: 1 },
    success: function (data) {
      data = JSON.parse(data);
      if (data != 0) {
        for (var i = 0; i < data.length; i++) {
          $("#txtdescription").val(data[i].ticketMessage)
          $("#cmbStatus").val(data[i].ticketStatus) 
          $("#cmbRecomend").val(data[i].recomend)
          $("#txtrDes").val(data[i].recomendDes)
          if ( (data[i].ticketStatus == 3 || data[i].ticketStatus == 4 ) && access == 2) {
            var element = document.getElementById("cmbRecomend");
            var elementtext = document.getElementById("txtrDes");
            var elementtech = document.getElementById("cmbTech");
            var elementAction = document.getElementById("cmbStatus");
            var elementStatus = document.getElementById("txtdescription");
            element.disabled = true;
            elementtext.disabled = true;
            elementtech.disabled = true;
            elementAction.disabled = true;
            elementStatus.disabled = true;
  
            $("#divButtons").html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");
         } else if (data[i].ticketStatus == 4) {
            var element = document.getElementById("cmbRecomend");
            var elementtext = document.getElementById("txtrDes");
            var elementtech = document.getElementById("cmbTech");
            elementtext.disabled = true;
            elementtech.disabled = true;
            element.disabled = true;
  
            $("#divButtons").html(
              "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" +
                "<button type='button' class='btn btn-warning' onclick='updateTech(" +
                id +
                "," +
                techId +
                "," +
                access +
                ")' id='btnUpdate'>Send</button>"
            );
  
         } else {
  
          $("#divButtons").html(
            "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" +
              "<button type='button' class='btn btn-warning' onclick='updateTech(" +
              id +
              "," +
              techId +
              "," +
              access +
              ")' id='btnUpdate'>Send</button>"
          );
  
         }
  
  
        }
      } else {
        $("#divButtons").html(
          "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" +
            "<button type='button' class='btn btn-warning' onclick='updateTech(" +
            id +
            "," +
            techId +
            "," +
            access +
            ")' id='btnUpdate'>Send</button>"
        );
        
      }
   
    },
  });





 

 
}


function enableR() {
  var element = document.getElementById("cmbRecomend");
  var elementtext = document.getElementById("txtrDes");
  element.disabled = true;
  elementtext.disabled = true;
  if ( $("#cmbStatus").val() == 3) {
        var element = document.getElementById("cmbRecomend");
       var elementtext = document.getElementById("txtrDes");
        element.disabled = false;
        elementtext.disabled = false;
  }

}

function hideText() {
  if ($('#cmbRecomend').val() == 2) {
     
      var element = document.getElementById("divRecomend");
      element.style.visibility = "hidden";
  } else {
    var element = document.getElementById("divRecomend");
    element.style.visibility = "visible";

  }

}

function updateTech(id, techid, access) {
  $("#divTitle").html("RTU Ticketing Message");

  var desc = $("#txtdescription").val();

  if (!(desc.length < 5)) {
    var editTech = 0;
    if (techid == 0) {
      editTech = $("#cmbTech").val();
      editTechName = $("#cmbTech option:selected").text();
    } else {
      if (access != 2) {
        editTech = techid;
      } else {
        editTech = $("#cmbTech").val();
        editTechName = $("#cmbTech option:selected").text();
      }
    }

    var techName = "";
    var reqEmail = "";
    var rname = "";

    $.ajax({
      async: false,
      type: "POST",
      url: "controllers/homeControllers.php",
      data: {
        ticketId: id,
        cmbStatus: $("#cmbStatus").val(),
        txtdescription: $("#txtdescription").val(),
        cmbTech: editTech,
        recommend: $("#cmbRecomend").val() , 
        dRecomend: $("#txtrDes").val(),
        createJourney: 1,
      },
      success: function (data) {
        data = JSON.parse(data);

        if ($("#cmbStatus").val() == 3) {
          $.ajax({
            async: false,
            type: "POST",
            url: "controllers/homeControllers.php",
            data: { ticketId: id, getTicketsJourneyHistory: 1 },
            success: function (data) {
              console.log(data);
              data = JSON.parse(data);
              if (data != 0) {
                for (var i = 0; i < data.length; i++) {
                  techName = data[i].techName;
                  reqEmail = data[i].email;
                  rname = data[i].name;
                }
              }
             
            },
          });

          sendemail(
            reqEmail,
            "RTU-Ticketing Management - Ticket Number:" + id + " (Resolved)",
            "<html><body>Hi " +
              rname +
              "<br>Ticket is now resolved<br><h2><b>Ticket Number: " +
              id +
              "</b></h2><div style='padding-left: 3%;'>" +
              "<table style='border: 1px solid black; width: 30%;'><tr><td>Technician</td><td>" +
              techName +
              "</td></tr><tr><td>Description</td><td>" +
              $("#txtdescription").val() +
              "</td></tr>" +
              "</table></div>" +
              "<br>Thanks,<br><b>RTU Ticketing System</b></body></html>"
          );
          $("#divMessage").html(data);
          $("#divButtons").html(
            " <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button> <form target='_blank' action='TechnicalServiceReport.php' method='POST'><button type='submit' name='Print' value='"+ id +"' class='btn btn-danger'> PRINT</button></form>"
          );

        } else {
          $("#divMessage").html(data);
          $("#divButtons").html(
            " <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>"
          );

        }
      
      },
      error: function (e) {
        alert(e);
      },
    });
    location.reload();
  } else {
    $('#error').html("<div class='alert alert-danger'>Please fill out all required fields marked with an asterisk (*).</div>");
    $("#divButtons").html(
        "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>" +
          "<button type='button' class='btn btn-warning' onclick='updateTech(" +
          id +
          "," +
          techId +
          "," +
          access +
          ")' id='btnUpdate'>Send</button>"
      );
  }
}

function getOffice() {
  $.ajax({
    async: false,
    type: "POST",
    url: "controllers/indexControllers.php",
    data: { getOffice: 1, department: $("#cmbDepartment").val() },
    success: function (data) {
      data = JSON.parse(data);
      $("#cmbOffice").empty();
      var cmbOffice = document.getElementById("cmbOffice");
      var option = document.createElement("option");
      option.text = "SELECT OFFICE";
      option.value = 0;
      cmbOffice.add(option);
      for (var i = 0; i < data.length; i++) {
        var option = document.createElement("option");
        option.text = data[i].name;
        option.value = data[i].id;
        cmbOffice.add(option);
      }
    },
    error: function (e) {
      alert(e);
    },
  });
}

function updateTicketview(id) {
  $("#divTitle").html("<h4 class='text-dark text-center'><b> Ticket No " + id + " Form </b> </div> <br> </h4>");
  $("#divMessage").html("<div class = 'text-danger' id='error'> </div>" +
    "<div class='row'>" + "<br>" +
    "<div class='col-md-6'>" +
    "<div class='form-group'>" +
    "<label for='txtEmail'>Email Address</label>" +
    "<input type='email' class='form-control form-control-user form-floating' id='txtEmail' placeholder='Email Address' disabled>" +
    "</div>" +
    "<div class='form-group'>" +
    "<label for ='txtEmp'>Employee No.</label>" +
    "<input type='text' class='form-control form-control-user form-floating' id='txtEmp' placeholder='Employee Number' disabled>" +
    "</div>" +
    "<div class='form-group'>" +
    "<label for='txtEmpName'>Employee Name</label>" +
    "<input type='text' class='form-control form-control-user form-floating' id='txtEmpName' placeholder='Complete Name'disabled>" +
    "</div>" +
    "<div class='form-group'>" +
    "<label for='txtTitle'><span class='required-indicator'>*</span>Title</label>" +
    "<input type='text' class='form-control form-control-user form-floating' id='txtTitle' placeholder='Title'>" +
    "</div>" +
    "</div>" +
    "<div class='col-md-6'>" +
    "<div class='form-group'>" +
    "<label for='cmbPrio'><span class='required-indicator'>*</span>Priority</label>" +
    "<select class='form-control form-control-user form-floating' id='cmbPrio'></select>" +
    "</div>" +
    "<div class='form-group'>" +
    "<label for='cmbIncident'><span class='required-indicator'>*</span>Category</label>" +
    "<select class='form-control form-control-user form-floating' id='cmbIncident'></select>" +
    "</div>" +
    "<div class='form-group'>" +
    "<label for='cmbDepartment'>Office Under: </label>" +
    "<select class='form-control form-control-user form-floating' onchange='getOffice()' id='cmbDepartment'disabled></select>" +
    "</div>" +
    "<div class='form-group'>" +
    "<label for='cmbOffice'>Office/Department</label>" +
    "<select class='form-control form-control-user form-floating' id='cmbOffice'disabled></select>" +
    "</div>" +
    "</div>" +
    "<div class='col-md-12'>" +
    "<div class='form-group'>" +
    "<label for='txtdescription'><span class='required-indicator'>*</span>Description</label>" +
    "<textarea class='form-control form-floating' rows='5' id='txtdescription' placeholder='Description'></textarea>" +
    "</div>"
  );
  
  $("#divButtons").html(
    " <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button><button type='button' class='btn btn-warning'  onclick='updateTicket(" +
      id +
      ")' data-dismiss='modal'>Update</button>"
  );

  $.ajax({
    async: false,
    type: "POST",
    url: "controllers/homeControllers.php",
    data: { getPrio: 1 },
    success: function (data) {
      data = JSON.parse(data);
      $("#cmbPrio").empty();
      var cmbInc = document.getElementById("cmbPrio");
      for (var i = 0; i < data.length; i++) {
        var option = document.createElement("option");
        option.text = data[i].name;
        option.value = data[i].id;
        cmbInc.add(option);
      }
    },
    error: function (e) {
      alert(e);
    },
  });

  $.ajax({
    async: false,
    type: "POST",
    url: "controllers/indexControllers.php",
    data: { getIncident: 1 },
    success: function (data) {
      data = JSON.parse(data);
      $("#cmbIncident").empty();
      var cmbInc = document.getElementById("cmbIncident");
      for (var i = 0; i < data.length; i++) {
        var option = document.createElement("option");
        option.text = data[i].name;
        option.value = data[i].id;
        cmbInc.add(option);
      }
    },
    error: function (e) {
      alert(e);
    },
  });

  //Retrived Departments
  $.ajax({
    async: false,
    type: "POST",
    url: "controllers/indexControllers.php",
    data: { getDept: 1 },
    success: function (data) {
      data = JSON.parse(data);
      $("#cmbDepartment").empty();
      var cmbDept = document.getElementById("cmbDepartment");
      for (var i = 0; i < data.length; i++) {
        var option = document.createElement("option");
        option.text = data[i];
        option.value = data[i];
        cmbDept.add(option);
      }
    },
    error: function (e) {
      alert(e);
    },
  });

  //Retrived ticket deatils

  $.ajax({
    async: false,
    type: "POST",
    url: "controllers/homeControllers.php",
    data: { getTicketDetails: 1, ticketId: id },
    success: function (data) {
      data = JSON.parse(data);
      for (var i = 0; i < data.length; i++) {

        $("#txtEmail").val(data[i].email);
        $("#txtEmp").val(data[i].empId);
        $("#txtEmpName").val(data[i].name);
        $("#cmbPrio").val(data[i].priority);
        $("#cmbIncident").val(data[i].incident);
        $("#cmbDepartment").val(data[i].Department);
        getOffice();
        $("#cmbOffice").val(data[i].Offices);
        $("#txtTitle").val(data[i].title);
        $("#txtdescription").val(data[i].description);
      }
    },
    error: function (e) {
      alert(e);
    },
  });
}

function updateTicket(id) {
  $("#divTitle").html("<h4 class='text-dark text-center'><b> Ticket No " + id + " Form </b> </div> <br> </h4>");

  var title = $('#txtTitle').val()
  var desc = $('#txtdescription').val()

  if (!((title == '') || (desc == ''))) {  
    $.ajax({
        async: false,
        type: "POST",
        url: "controllers/homeControllers.php",
        data: {
          txtEmail: $("#txtEmail").val(),
          txtEmpName: $("#txtEmpName").val(),
          cmbIncident: $("#cmbIncident").val(),
          cmbDepartment: $("#cmbOffice").val(),
          txtTitle: $("#txtTitle").val(),
          txtdescription: $("#txtdescription").val(),
          cmbPrio: $("#cmbPrio").val(),
          ticketId: id,
          updateTicket: 1,
        },
        success: function (data) {
          data = JSON.parse(data);
          $("#divMessage").html(data);
          $("#divButtons").html(
            " <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>"
          );
        },
        error: function (e) {
          alert(e);
        },
      });
      location.reload();

  } else {
    $('#error').html("<div class='alert alert-danger'>Please fill out all required fields marked with an asterisk (*).</div>");
    $("#divButtons").html(
        " <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button><button type='button' class='btn btn-warning'  onclick='updateTicket(" +
          id +
          ")' data-dismiss='modal'>Update</button>"
      );
  }

 
}

function sendemail(recipient, subject, content) {
  $.ajax({
    async: false,
    type: "POST",
    url: "controllers/emailController.php",
    data: {
      recipient: recipient,
      content: content,
      subject: subject,
      sendEmail: 1,
    },
    success: function (data) {
      console.log(data);
    },
  });
}
