<?php require_once 'authController.php'; ?>
<!DOCTYPE html>
<html>
<head>
</head>
<style>
  .container {
    width: 100%;
    margin-top: 50px;
  }

  .content-title {
    font-size: 30px;
  }

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
<div id="container" class="container" >
<p class="content-title text-center">User Information</p>
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
    // var btn = document.createElement("BUTTON"); //create button
    // btn.classList.add("collapsible");  //add class - collapsible
    // var btn_div = document.createElement("div") // create div
    // btn_div.classList.add("content");  //add class - content
    // var text_content = document.createElement("p") // create p
    // var text = document.createTextNode("Hello World"); // create text node for p
    // text_content.appendChild(text)  //append text_content with text
    // btn_div.appendChild(text_content);  // append btn_div with text_content
    // btn.appendChild(btn_div);  //append btn with btn_div
    // var container = document.getElementById("container");  //get container
    // container.appendChild(btn); // append btn to container
    // btn.innerHTML = "CLICK ME";    // add text to btn
    var btn = document.createElement("BUTTON");
    btn.classList.add("collapsible");
    var div = document.createElement("div");
    div.classList.add("content");
    var text_container = document.createElement("P");
    var text = document.createTextNode("Hello World");
    text_container.appendChild(text);
    div.appendChild(text_container)
    var container = document.getElementById("container");   
    container.appendChild(btn);
    container.appendChild(div);
    btn.innerHMTL = "Click Me";
    </script>
</div>
</body>
</html>
<!-- <h1>This is student home. Success! <?php echo $_SESSION['role']?> <?php echo $_SESSION['username'];?></h1> -->
