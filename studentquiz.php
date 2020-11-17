<body>
<div id="container" class="collapsible_container" >
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
    var btn = document.createElement("BUTTON");
    btn.classList.add("collapsible");
    btn.textContent = "Click Me";
    var div = document.createElement("div");
    div.classList.add("content");
    var text_container = document.createElement("P");
    var text = document.createTextNode("Hello World");
    text_container.appendChild(text);
    div.appendChild(text_container)
    var container = document.getElementById("container");   
    container.appendChild(btn);
    container.appendChild(div);
    // btn.innerHMTL = "Click Me";
    </script>
</div>
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
</body>