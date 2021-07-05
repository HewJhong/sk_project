<!DOCTYPE html>
<html>
<head>
	<script>
		$(document).ready(function() {
			$("#import-btn").click(function () {
				var file_data = $('#upload').prop('files')[0]; 
				var form_data = new FormData();
				form_data.append('file', file_data);
				$.ajax({
					type: "POST",
					cache: false,
					contentType: false,
					processData: false,
					url: "adminimportkuizpreview.php",
					data: form_data,
					success: function(response){
						$("#responsecontainer").html(response);
					}
				});
			});
			$(document).on("click", "#import-data-btn", function () {
				console.log("Button clicked");
				var file_data = $('#upload').prop('files')[0];
				var form_data = new FormData();
				form_data.append('file', file_data);
				$.ajax ({
					type: "POST",
					cache: false,
					contentType: false,
					processData: false,
					url: "adminimportkuizdb.php",
					data: form_data,
					success: function(response){
						console.log(response);
					}
				});
			});
		});	
	</script>
</head>
<body>
<div class=quiz-form-div>
<div align=center>
        <input class="inputfile" id='upload' type="file" name="file" accept=".csv"/>
		<br>
        <button class="btn btn-primary" id="import-btn" type="submit" name="csv_upload_btn">Upload</button>
</div>
<br>
<div id="responsecontainer"></div>
</div>
</body>
</html>