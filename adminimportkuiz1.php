<?php
echo "
<div class=quiz-form-div>
    <table style='width:100%'>
        <tr style='text-align:center;'>
            <th>No. Soalan</th>
            <th>Soalan</th>
            <th>Pilihan</th>
            <th>Jawapan</th>
            <th>Id Topik</th>
        </tr>
";
if (isset($_POST["upload"])){
    $CSVfp = fopen($_FILES['file']['tmp_name'], "r");
}

if($CSVfp !== FALSE) {
    while($data = fgetcsv($CSVfp)) {
        $nosoal = $data[0];
        $soal = $data[1];
        $pilih = $data[2];
        $jaw = $data[3];
        $idtopik = $data[4];
        echo "
        <tr class=item>
            <td>$nosoal</td>
            <td>$soal</td>
            <td>$pilih</td>
            <td>$jaw</td>
            <td>$idtopik</td>
        </tr>
        ";
    }
}
echo "
</table>
</div>
";
echo "
<br>
<div class='text-center'>
<button id='importkuiz-btn' class='btn btn-primary noprint' type='button' style='margin-bottom: 20px' data-toggle='modal' data-target='#importSuccessModal'>Import</button>
</div>
";
echo "<div id='responsecontainer'></div>";
?>
<script>
    $(document).ready(function () {
        $(document).on("click", "#importkuiz-btn", function() {
            console.log("imported");
            $.ajax({
                type: "GET",
                url: "adminimportkuizdb.php",
                dataType: "html",
                success: function(response) {
                    $("#responsecontainer").html(response);
                }
            }); 
        });
    });

</script>