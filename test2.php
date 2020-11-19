<!DOCTYPE html>
<html>
<head>
<style>
.democlass {
  color: red;
}
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
</head>
<body>

<h1>Hello World</h1>
<div class="someclass" id="someclass">X 
<p class="delete" id="delete">x</p>
</div>
<p>Click the button to add a class attribute with the value of "democlass" to the h1 element.</p>

<button class="delete" onclick="myFunction()">Try it</button>
<button onclick="myFunctionClear()">Remove</button>

<script>
function myFunction() {
  document.getElementsByTagName("H1")[0].setAttribute("class", "democlass"); 
}
function myFunctionClear() {
  document.getElementsByTagName("H1")[0].setAttribute("class", ""); 
}

</script>
<script>
$('.delete').click(function() {
   $(this).closest('.someclass').remove()
});
</script>
</body>
</html>
