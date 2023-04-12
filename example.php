


<html>
    <script src="js/jquery-3.6.3.min.js"></script>  
<body>

    <input id="fileupload" type="file" name="fileupload" />
<button id="upload-button" type="submit" onclick="uploadfile()"> Upload </button>
<script>
   function uploadfile(){
  var filename = $('#filename').val();                    //To save file with this name
  var file_data = $('.fileToUpload').prop('files')[0];    //Fetch the file
  var form_data = new FormData();
  form_data.append("file",file_data);
  form_data.append("filename",filename);
  //Ajax to send file to upload
  $.ajax({
      url: "load.php",                      //Server api to receive the file
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