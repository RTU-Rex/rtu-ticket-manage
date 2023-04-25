// for ticket management

function viewTicket(id) {
  var access = 0;
  var techid = 0;
  var status = 0;

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
              " Ticket # "+ data[i].id + " - " + data[i].IncidentName + 
              " </h5>"  + "</div>" +
              "<div class='card-body'>"+
                "<small class='text-mute'>" +
                  " Created: " + formatDate(data[i].DateCreated) +
                  " by: " + "<b>" + data[i].name + "</b>" + " (" + data[i].email + ")" +
                  " located at: " + "<b>" + data[i].Office + "</b>" + data[i].file  +
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
        if (data[i].ticketStatus != 4) { 
          if (data[i].modifiedFrom == "User") {
            document.getElementById("divMessage").innerHTML +=
              "<div class='card border-right-warning shadow mb-4 no-animation '> " +
              "<div class='card-header py-3'><h6 class='m-0 font-weight-bold text-right text-warning'>" +
              data[i].Tech +
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

        }
        
          techid = data[i].technicianId;
          status = data[i].ticketStatus;
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
        ")' id='btnUpdate'>Technical Report</button>"
    );
  } else {

    if (status == 4) {
      $("#divButtons").html(
          "<button type='button' class='btn btn-warning' onclick='replyTicket(" +
          id +
          ", " +
          techid +
          ", " +
          access +
          ")' id='btnUpdate'>Re-open</button>"
      );

    } else {
      $("#divButtons").html(
        "<button type='button' class='btn btn-primary' onclick='updateTicketview(" +id +", "+ status +", "+ techid + ")'>Update Ticket</button>" +
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
}

function replyTicket(id, techId, access) {
  $("#divTitle").html("Technical Report");
  $("#divMessage").html(
      "<div id='error'> </div>" + "<div class='row'>" +
      "<div class='col-md-6'><div class='form-group'><h6 class='text-dark fs-5'><b>Serial Number </b></h6> "+
      "<input type='text' class='form-control' id='txtSerialNumber' placeholder='Serial Number'></div></div>" +
      "<div class='col-md-6'><div class='form-group'><h6 class='text-dark fs-5'><b>Property Number </b></h6>"+
      "<input type='text' class='form-control' id='txtPropertyNumber' placeholder='Property Number'></div></div></div>" +
      "<div class='form-group'><hr><h6 class='text-dark fs-5'><span class='required-indicator'>*</span><b>Action Taken </b></h6>"+
      "<textarea class='form-control' rows='5' id='txtdescription' placeholder='Description'></textarea></div>" +
      "<div class='form-group'><h6 class='text-dark fs-5'><span class='required-indicator'>*</span><b>Status</b></h6>" +
      "<select class='form-control form-control-user' onChange='enableR()' id='cmbStatus'></select></div>" + "<hr>" +
      "<div class='form-group'><h6 class='text-dark fs-5'><b>Recommendation</b></h6>" +
      "<select onChange='hideText()' class='form-control form-control-user' id='cmbRecomend'></select></div>" + 
      "<div id='divRecomend' class='form-group'><textarea class='form-control' rows='5' id='txtrDes' placeholder='Recommendation'></textarea></div>" + "<hr>" +
      "<h6 class='text-dark fs-5'><span class='required-indicator'>*</span><b>Assigned to: </b></h6>"+
      "<div id='divTech' class='form-group'> <select class='form-control form-control-user' id='cmbTech'></select></div>" +
      "<h6 class='text-dark fs-5'><b>Technicians: </b></h6>"+
      "<div id='cmbtechsdiv' class='form-group'><select class='select' style='width: 100%;' size='5' id='cmbtechs'></select></div>"+
      "<div id='cmbTechsfildiv' class='form-group row'><div class='col-8'><select class='form-control form-control-user' id='cmbTechsfil'></select></div><div class='col-4'><button type='button' onclick='updateAccess("+ id +")' class='btn btn-primary'>ADD</button><button type='button' onclick='deleteAccess("+ id +")' class='btn btn-warning'>REMOVE</button></div></div>"
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
    data: { getTech: 1 },
    success: function (data) {
      data = JSON.parse(data);
      $("#cmbTechsfil").empty();
      var cmbInc = document.getElementById("cmbTechsfil");
      for (var i = 0; i < data.length; i++) {
        if (data[i].id != techId) {
          var option = document.createElement("option");
          option.text = data[i].name;
          option.value = data[i].id;
          cmbInc.add(option);
        }
       
      }
    },
    error: function (e) {
      alert(e);
    },
  });

  techs(id)

  

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
      element.disabled = false;
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
          $("#txtPropertyNumber").val(data[i].property_number)
          $("#txtSerialNumber").val(data[i].serial_number)
          
          if ( (data[i].ticketStatus == 3 || data[i].ticketStatus == 4 ) && access == 2) {
            var element = document.getElementById("cmbRecomend");
            var elementtext = document.getElementById("txtrDes");
            var elementtech = document.getElementById("cmbTech");
            var elementStatus = document.getElementById("cmbStatus");
            var elementProperty = document.getElementById("txtPropertyNumber");
            var elementSerial = document.getElementById("txtSerialNumber");
            element.disabled = true;
            elementtext.disabled = true;
            elementtech.disabled = true;
            elementStatus.disabled = true;
            elementProperty.disabled=true;
            elementSerial.disabled=true;

          $("#divButtons").html("<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>");
          
         } else if (data[i].ticketStatus == 3) {
          var elementStatus = document.getElementById("txtdescription");
          var elementProperty = document.getElementById("txtPropertyNumber");
          var elementSerial = document.getElementById("txtSerialNumber");
          elementProperty.disabled=true;
          elementSerial.disabled=true;
          elementStatus.disabled = true;
            $("#divButtons").html("<form target='_blank' action='TechnicalServiceReport.php' method='POST'><button type='submit' name='Print' value='"+ id +"' class='btn btn-danger'> Print </button></form>" +
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

          if ((data[i].ticketStatus == 5 || data[i].ticketStatus == 1)  && access == 2) {
            var elementtech = document.getElementById("cmbTech");
            var elementAction = document.getElementById("cmbStatus");
            var elementStatus = document.getElementById("txtdescription");
            var elementProperty = document.getElementById("txtPropertyNumber");
            var elementSerial = document.getElementById("txtSerialNumber");
            var elementrecom = document.getElementById("cmbRecomend");
            var elementrecomD = document.getElementById("txtrDes");
            elementProperty.disabled=false;
            elementSerial.disabled=false;
            elementtech.disabled = true;
            elementAction.disabled = false;
            elementStatus.disabled = false;
            elementrecom.disabled = false;
            elementrecomD.disabled = false;
          } else if (data[i].ticketStatus == 5) {
            var elementtech = document.getElementById("cmbTech");
            var elementAction = document.getElementById("cmbStatus");
            var elementStatus = document.getElementById("txtdescription");
            elementtech.disabled = false;
            elementAction.disabled = false;
            elementStatus.disabled = false;
          }
  
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

function checkAccess(id) {
       
  var checking = 1;
  $.ajax({
      async: false,
      type: "POST",
      url: 'controllers/homeControllers.php',
      data: { id: id, 
              tech: $('#cmbTechsfil').val(),
              checkTechExist: 1
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

function updateAccess(id) {
  var checking = checkAccess(id);
  if (checking == 1) { 
    $.ajax({
      async: false,
      type: "POST",
      url: 'controllers/homeControllers.php',
      data: { ticketId: id, 
              tech: $('#cmbTechsfil').val(),
              updateTechs: 1
          },
      success: function(data) {
          data = JSON.parse(data);
      }, 
      error: function (e) {
          alert(e);
      }
  });

  }
   
    techs(id);

}

function deleteAccess(id) {
      
  $.ajax({
      async: false,
      type: "POST",
      url: 'controllers/homeControllers.php',
      data: { id: $('#cmbtechs').val(),
              DeleteTechs: 1
          },
      success: function(data) {
          data = JSON.parse(data);
      }, 
      error: function (e) {
          alert(e);
      }
  });

  techs(id)

}
function techs(id) {
  $.ajax({
    async: false,
    type: "POST",
    url: "controllers/homeControllers.php",
    data: { ticketId: id,getTechs: 1 },
    success: function (data) {
      data = JSON.parse(data);
      $("#cmbtechs").empty();
      var cmbInc = document.getElementById("cmbtechs");
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

}



function enableR() {
  var element = document.getElementById("cmbRecomend");
  var elementtext = document.getElementById("txtrDes");
  element.disabled = true;
  elementtext.disabled = true;
  if ( $("#cmbStatus").val() == 3 ||$("#cmbStatus").val() == 2 ) {
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
        propertyNumber: $('#txtPropertyNumber').val(),
        serialNumber: $('#txtSerialNumber').val(),
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
                  dcreated = data[i].dateCreated;
                  dresolvedat = data[i].dateModified;
                }
              }
             
            },
          });

          sendemail(
            reqEmail,
            "RTU-Ticketing Management System - Ticket Number:" + id + " (Resolved)",
            "<html><body>Hi, " + rname +
              "<br><br>Your issue has been resolved. If the issue reoccurred again please contact our admin/help desk for re-opening of ticket.<br><br>" +
              "<b>Ticket Created at:</b> " + dcreated + "<br>" + 
              "<b>Resolved at </b>" + dresolvedat + "<br>" +
              "<b>Ticket Number:</b> " + id + "<br>" +
              "<b>Action Taken:</b> " +  $("#txtdescription").val() + "<br>" +
              "<b>Resolved by: </b>" +  techName + "<br></div>" +
              "<br>Thank you! <br><b> MIC Technical Division</b></body></html>"
          );
          $("#divMessage").html(data);
          $("#divButtons").html(
            " <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>"
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

function updateTicketview(id,status,techid) {
  $("#divTitle").html("<h4 class='text-dark text-center'><b> Ticket No " + id + " Form </b> </div> <br> </h4>");
  $("#divMessage").html("<div class = 'text-danger' id='error'> </div>" +"<a href='#' id='edit-link'>Edit</a> | <a href='#' id='save-link'>Disable</a>" + "<h5> <b>Contact Information</b></h5>" + 
    "<div class='row'>" + "<br>" +
    "<div class='col-md-6'>" +
    "<div class='form-group'><label class ='text-dark'>Email</label><input type='email' class='form-control' id='txtEmail' placeholder='Enter Email Address' disabled><small class='text-danger' id='txtEmail-error'></small></div>" +
    "<div class='form-group'><label class ='text-dark'>Employee No. (ex. D-11-12-123)</label><input type='text' class='form-control' id='txtEmp' placeholder='Enter Employee Number' disabled><small class='text-danger' id='txtEmp-error'></small></div>" +
    "<div class='form-group'><label class ='text-dark'>Employee Name</label><input type='text' class='form-control' id='txtEmpName' placeholder='Complete Name' disabled><small class='text-danger'></small></div>" +
    "</div>" +
    "<div class='col-md-6'>" +
    "<div class='form-group'><label class ='text-dark'>Office Under</label><select class='form-control ' onchange='getOffice()' id='cmbDepartment' disabled></select><small class='office-error text-danger' style='display: none;'>Please select Office</small></div>" +
    "<div class='form-group'><label class ='text-dark'>Department</label><select class='form-control' id='cmbOffice' disabled></select></div>" +
    "<div class='form-group'><label class ='text-dark'>Title/Position</label><input type='text' class='form-control' id='txtTitle' placeholder='Position/Title' disabled></div>" + 
    "</div>" + 
    "<div class='col-md-12'>" + "<hr><h5> <b>Ticket Information</b> </h5>" + 
            "<div class='form-group'>" +
            "<label for='cmbPrio'><span class='required-indicator'>*</span>Priority</label>" +
            "<select class='form-control form-control-user form-floating' id='cmbPrio'></select>" +
            "</div>" +
            "<div class='form-group'>" +
            "<label for='cmbStatus'><span class='required-indicator'>*</span>Status</label>" +
            "<select class='form-control form-control-user form-floating' id='cmbStatus'></select>" +
            "</div>" +
            "<div class='form-group'>" +
            "<label for='cmbTech'><span class='required-indicator'>*</span>Technician</label>" +
            "<select class='form-control form-control-user form-floating' id='cmbTech'></select>" +
            "</div>" +
            "<div class='form-group'><label class ='text-dark'>Category of the issue</label><select class='form-control' id='cmbIncident' disabled></select></div>" +
            "<div class='form-group'><label class ='text-dark'>Description of the issue</label><textarea class='form-control' rows='5' id='txtdescription' placeholder='Provide a detailed description of the issue you are experiencing.'disabled></textarea><small class='text-danger' id='txtdescription-error'></small></div>" +
            "<div class='form-group'><label class ='text-dark'>Attachment</label> <input type='file' class='fileToUpload form-control' ></input><br></div>" +
            "<div class='form-group'>"
  );
  
  $("#divButtons").html(
    " <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button><button type='button' class='btn btn-warning'  onclick='updateTicket(" +
      id +
      ")' data-dismiss='modal'>Update</button>"
  );

  document.getElementById('edit-link').addEventListener('click', function() {
    // Enable the disabled fields
    document.getElementById('txtEmail').disabled = false;
    document.getElementById('txtEmp').disabled = false;
    document.getElementById('txtEmpName').disabled = false;
    document.getElementById('cmbDepartment').disabled = false;
    document.getElementById('cmbOffice').disabled = false;
    document.getElementById('txtTitle').disabled = false;
    document.getElementById('txtdescription').disabled = false;
    document.getElementById('cmbIncident').disabled = false;
  });

  document.getElementById('save-link').addEventListener('click', function() {
    // Enable the disabled fields
    document.getElementById('txtEmail').disabled = true;
    document.getElementById('txtEmp').disabled = true;
    document.getElementById('txtEmpName').disabled = true;
    document.getElementById('cmbDepartment').disabled = true;
    document.getElementById('cmbOffice').disabled = true;
    document.getElementById('txtTitle').disabled = true;
    document.getElementById('txtdescription').disabled = true;
    document.getElementById('cmbIncident').disabled = true;
  });


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
      
          var option = document.createElement("option");
          option.text = data[i].name;
          option.value = data[i].id;
          cmbStatus.add(option);
       
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
        $("#cmbTech").val(techid);
        $("#cmbStatus").val(status);
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

  if (!((desc == ''))) {  
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
        },
        error: function (e) {
          alert(e);
        },
      });

      $.ajax({
        async: false,
        type: "POST",
        url: "controllers/homeControllers.php",
        data: {
          ticketId: id,
          cmbStatus: $("#cmbStatus").val(),
          txtdescription: 'Ticket is updated',
          cmbTech: $("#cmbTech").val(),
          recommend: 0 , 
          dRecomend: '',
          propertyNumber: '',
          serialNumber: '',
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
                    dcreated = data[i].dateCreated;
                    dresolvedat = data[i].dateModified;
                  }
                }
               
              },
            });
  
            sendemail(
              reqEmail,
              "RTU-Ticketing Management System - Ticket Number:" + id + " (Resolved)",
              "<html><body>Hi, " + rname +
                "<br><br>Your issue has been resolved. If the issue reoccurred again please contact our admin/help desk for re-opening of ticket.<br><br>" +
                "<b>Ticket Created at:</b> " + dcreated + "<br>" + 
                "<b>Resolved at </b>" + dresolvedat + "<br>" +
                "<b>Ticket Number:</b> " + id + "<br>" +
                "<b>Action Taken:</b> " +  $("#txtdescription").val() + "<br>" +
                "<b>Resolved by: </b>" +  techName + "<br></div>" +
                "<br>Thank you! <br><b> MIC Technical Division</b></body></html>"
            );
            $("#divMessage").html(data);
            $("#divButtons").html(
              " <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>"
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
