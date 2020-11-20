<?php require_once "authController.php"?>
<html>
<head>
<title>Document</title>

<script src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript">
 $("#insert-more").click(function () {
     $("#JTable").each(function () {
         var tds = '<tr>';
         jQuery.each($('tr:last td', this), function () {
             tds += '<td>' + $(this).html() + '</td>';
         });
         tds += '</tr>';
         if ($('tbody', this).length > 0) {
             $('tbody', this).append(tds);
         } else {
             $(this).append(tds);
         }
     });
});
</script>
</head>
<body>
<form name="items" method="post">
<table id="JTable" style="margin-left:50px;">
    <thead>
        <th class="tblfldname">Product</th>
        <th class="tblfldname">Quantity</th>
        <th class="tblfldname">Price</th>
    </thead>
    <tbody>
        <tr>
            <td>
            <input type="text" name="pname[]" style="width:150px; padding:4px;" />
            </td>
            <td>
              <input type="text" name="qty[]" style="width:150px; padding:4px;" />
            </td>
            <td>
              <input type="text" name="price[]" class="price" style="width:150px; padding:4px;" />
            </td>
        </tr>
    </tbody>
</table>
<table id="JTable" style="margin-left:50px;">
    <tbody>
        <tr>
            <td>
            <input type="text" name="pname[]" style="width:150px; padding:4px;" />
            </td>
            <td>
              <input type="text" name="qty[]" style="width:150px; padding:4px;" />
            </td>
            <td>
              <input type="text" name="price[]" class="price" style="width:150px; padding:4px;" />
            </td>
        </tr>
    </tbody>
    <input type="submit" name="submit" />
</table>
</form>
</body>
</html>