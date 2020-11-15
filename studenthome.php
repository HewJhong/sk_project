<?php require_once 'authController.php'; ?>
<!DOCTYPE html>
<html>
<head>
</head>
<style>
    .collapsible {
  background-color: #777;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active, .collapsible:hover {
  background-color: #1386FC;
}

.content {
  padding: 0 18px;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  background-color: #f1f1f1;
}
</style>
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>
<body>
<div id="container" class="container" style="margin: 20px">
<p>Collapsible Set:</p>
    <button class="collapsible">Check username</button>
    <div class="content">
    <p><?php echo $_SESSION['username']?></p>
    </div>
    <button class="collapsible">Check role</button>
    <div class="content">
    <p><?php echo $_SESSION['role']?></p>
    </div>
    <button class="collapsible">Check Telephone Number</button>
    <div class="content">
    <p><?php echo $_SESSION['notel']?></p>
    </div>
    <script>
    var btn = document.createElement("BUTTON");   // Create a <button> element
    btn.innerHTML = "CLICK ME";                   // Insert text
    document.getElementById("container").appendChild(btn);               // Append <button> to <body>
    </script>
</div>
</body>
</html>
<!-- <h1>This is student home. Success! <?php echo $_SESSION['role']?> <?php echo $_SESSION['username'];?></h1> -->
