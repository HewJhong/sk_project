<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>

<div id="container" class="container">
<p> Title </p>
<button type="button" onclick="add()" class=""> + </button>
<br>
</div>
<div class='content'>
    <div class='row'>
        <div class='delete'>x</div>
        <div class='title'>Text</div>
     </div>
</div>
<div class='content'>
    <div class='row'>
        <div class='delete'>x</div>
        <div class='title'>Text 2</div>
     </div>
</div>
<div class='content'>
    <div class='row'>
        <div class='delete'>x</div>
        <div class='title'>Text 3</div>
     </div>
</div>
<script>
function add() {
    var div1 = document.createElement("div");
    var div2 = document.createElement("div");
    var br = document.createElement("br");
    div1.textContent = "Outside Div";
    div1.classList.add("content");
    div2.textContent = "Delete";
    div2.classList.add("delete");
    div1.appendChild(div2);
    div1.appendChild(br);
    var container = document.getElementById("container");
    container.appendChild(div1);
}
</script>
<script>
$(document).on('click','.delete',function() {
   $(this).closest('.content').remove();
});
</script>
</body>
</html>