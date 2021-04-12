<?php require_once 'authController.php'?>
<!DOCTYPE html>
<html>
<head>
<script src="changepage.js"></script>
</head>
<script>
$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "adminstudentlistdb.php",
        dataType: "html",
        success: function(response) {
            $("#responsecontainer").html(response);
        }
    });

    $(document).on('click', '.info-btn', function() {
        var id = this.id;
        $.ajax({
            type: "POST",
            url: "adminstudentinfodb.php",
            data: {
            'id': id,
            }, 
            success: function(response) {
                $("#responsecontainer").html(response);
            }
        });
    });
});

function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

$(document).on("click", "#createpdf-btn", function () {
            html2canvas($('#myTable')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("Table.pdf");
                }
            });
        });
</script>
<body>
<div id="responsecontainer">
</div>
<div class="text-center">
<button id='createpdf-btn' class="btn btn-primary" type='button' onclick='makePDF()'>Cetak Senarai Murid</button>
</div>
</body>
</html>