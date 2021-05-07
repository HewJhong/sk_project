var fontSizeChange = 0

function markcorrect(id) {
    // var prefix = "#";
    // var element = id;
    // var elementid = prefix.concat(element);
    var element = document.getElementById("2");
    element.classList.add('bg-warning')
}

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

function markcorrect(id) {
  // var prefix = "#";
  // var element = id;
  // var elementid = prefix.concat(element);
  var element = document.getElementById("2");
  element.classList.add('bg-warning')
}

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

function increaseFontSizeBy1px() {
  all = document.querySelectorAll('a, h1, h2, h3, h4, h5');
  for (var i=0, max=all.length; i < max; i++){
      txt = document.querySelectorAll('a, h1, h2, h3, h4, h5')[i];
      style = window.getComputedStyle(txt, null).getPropertyValue('font-size');
      currentSize = parseFloat(style);
      fontSizeChange = fontSizeChange + 1;
      txt.style.fontSize = (currentSize + 1) + 'px';
  }
}

function decreaseFontSizeBy1px() {
  all = document.querySelectorAll('a, h1, h2, h3, h4, h5');
  for (var i=0, max=all.length; i < max; i++){
      txt = document.querySelectorAll('a, h1, h2, h3, h4, h5')[i];
      style = window.getComputedStyle(txt, null).getPropertyValue('font-size');
      currentSize = parseFloat(style);
      fontSizeChange = fontSizeChange - 1;
      txt.style.fontSize = (currentSize - 1) + 'px';
  }
}


// function increaseFontSizeBy1px() {
//   all = document.querySelectorAll('a, h1, h2, h3, h4, h5');
//   for (var i=0, max=all.length; i < max; i++){
//       txt = document.querySelectorAll('a, h1, h2, h3, h4, h5')[i];
//       style = window.getComputedStyle(txt, null).getPropertyValue('font-size');
//       currentSize = parseFloat(style);
//       fontSizeChange = fontSizeChange + 1;
//       txt.style.fontSize = (currentSize + 1) + 'px';
//   }
// }

// function decreaseFontSizeBy1px() {
//   all = document.querySelectorAll('a, h1, h2, h3, h4, h5');
//   for (var i=0, max=all.length; i < max; i++){
//       txt = document.querySelectorAll('a, h1, h2, h3, h4, h5')[i];
//       style = window.getComputedStyle(txt, null).getPropertyValue('font-size');
//       currentSize = parseFloat(style);
//       fontSizeChange = fontSizeChange - 1;
//       txt.style.fontSize = (currentSize - 1) + 'px';
//   }
// }

function setFontSize() {
  $.ajax({
    url: "fontSize.php",
    method: "GET",
    success: function(data){
      console.log(data);
    }
  });
  all = document.querySelectorAll('a, h1, h2, h3, h4, h5');
  for (var i=0, max=all.length; i < max; i++){
      txt = document.querySelectorAll('a, h1, h2, h3, h4, h5')[i];
      style = window.getComputedStyle(txt, null).getPropertyValue('font-size');
      currentSize = parseFloat(style);
      txt.style.fontSize = (currentSize + data) + 'px';
  }
}

