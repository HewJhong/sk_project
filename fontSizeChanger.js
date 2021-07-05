// page zoom
function reloadToCurrentZoom(){
    currentZoom = parseInt(getCookie("currentZoom"));
    document.body.style.zoom = currentZoom + "%";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
        c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
        }
    }
    return "";
}

function increaseFontSize(){
    currentZoom = parseInt(getCookie("currentZoom"));
    console.log(currentZoom);
    if (currentZoom >= 125){
        //
    }else{
        zoomIn = currentZoom+5;
        document.body.style.zoom = zoomIn + "%";
        document.cookie = "currentZoom=" + zoomIn;
        if (currentZoom == 100){
            document.getElementById("main-content").style.height = 91.2 + "%";
        } else if (currentZoom == 95) {
            document.getElementById("main-content").style.height = 92 + "%";
        } else if (currentZoom == 90) {
            document.getElementById("main-content").style.height = 93 + "%";
        } else if (currentZoom == 85) {
            document.getElementById("main-content").style.height = 94 + "%";
        } else {
            document.getElementById("main-content").style.height = 90.5 + "%"
        }
    }
}

function decreaseFontSize(){
    currentZoom = parseInt(getCookie("currentZoom"));
    console.log(currentZoom);
    if (currentZoom <= 85){
        //
    }else{
        zoomOut = currentZoom-5;
        document.body.style.zoom = zoomOut + "%";
        document.cookie = "currentZoom=" + zoomOut;
        if (currentZoom == 100){
            document.getElementById("main-content").style.height = 91.2 + "%";
        } else if (currentZoom == 95) {
            document.getElementById("main-content").style.height = 92 + "%";
        } else if (currentZoom == 90) {
            document.getElementById("main-content").style.height = 93 + "%";
        } else if (currentZoom == 85) {
            document.getElementById("main-content").style.height = 94 + "%";
        }
    }
}
