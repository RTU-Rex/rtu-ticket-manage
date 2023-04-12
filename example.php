


<html>
    <script src="js/jquery-3.6.3.min.js"></script>  
<body>

    <input type="file" class="fileToUpload form-control" ></input><br>
    <input type="text" placeholder="File name" id="filename" class="form-control"/><br>
    <button class="btn btn-success" onclick="uploadfile(12)">Upload</button>
<script>
function uploadfile(id){
  var filename = $('#filename').val();                    //To save file with this name
  var file_data = $('.fileToUpload').prop('files')[0];    //Fetch the file
  var form_data = new FormData();
  form_data.append("file",file_data);
  form_data.append("filename",id);
  //Ajax to send file to upload
  $.ajax({
      url: "upload.php",                      //Server api to receive the file
             type: "POST",
             dataType: 'script',
             cache: false,
             contentType: false,
             processData: false,
             data: form_data,
          success:function(dat2){
            if(dat2==1) alert("Successful");
            else alert("Unable to Upload");
          }
    });
}
</script>
</body>



</html>