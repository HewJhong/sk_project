<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
</head>
<body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>

<div id="container">
<p> Title </p>
<button type="button" onclick="add()" class="btn btn-primary btn-block btn-lg col-1"> + </button>
<script>
$('.delete').click(function() {
   $(this).closest('.list_product').remove()
});
</script>
</div>
<div class='list_product'>
    <div class='row'>
        <div class='delete'>x</div>
        <div class='title'>Standing Fan</div>
     </div>
</div>
<div class='list_product'>
    <div class='row'>
        <div class='delete'>x</div>
        <div class='title'>Standing Fan 2</div>
     </div>
</div>
<div class='list_product'>
    <div class='row'>
        <div class='delete'>x</div>
        <div class='title'>Standing Fan 3</div>
     </div>
</div>
<div class='list_product'>
    <div class='row'>
        <div class='delete'>x</div>
        <div class='title'>Standing Fan 4</div>
     </div>
</div>
<script>
$(.delete).append("x");
function add() {
var btn = document.createElement("BUTTON")
var textbox = document.createElement("P");
var text = document.createTextNode("Text");
textbox.appendChild(text);
var div = document.createElement("div");
btn.textContent = "Click";
div.classList.add("delete");
$(.delete).append("x");
var box = document.getElementById("container")
div.appendChild(btn);
div.appendChild(textbox);
box.appendChild(div);
}
</script>
<script>
$('.delete').click(function() {
   $(this).closest('.list_product').remove()
});
</script>
</body>
</html>