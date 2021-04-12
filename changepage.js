function homepage() {
    window.history.pushState("string", "home", "adminmain.php?page=adminhome");
    $("#main-content").load("adminhome.php");
}
function kuizlistpage() {
    window.history.pushState("string", "kuizlist", "adminmain.php?page=adminkuizlist");
    $("#main-content").load("adminkuizlist.php");
}
function kuizpage() {
    window.history.pushState("string", "kuiz", "adminmain.php?page=adminkuiz");
    $("#main-content").load("adminkuiz.php");
}
function resultpage() {
    window.history.pushState("string", "result", "adminmain.php?page=adminkeputusan");
    $("#main-content").load("adminresultlist.php");
}
function studentlistpage() {
    window.history.pushState("string", "result", "adminmain.php?page=adminstudentlist");
    $("#main-content").load("adminstudentlist.php");
}
// TITLES
// ADMIN
function hometitle() {
    $("#title").load("titles/hometitle.php");
}
function kuiztitle() {
    $("#title").load("titles/kuiztitle.php");
}
function senaraimuridtitle() {
    $("#title").load("titles/senaraimuridtitle.php");
}
function senaraikuiztitle() {
    $("#title").load("titles/senaraikuiztitle.php");
}
function keputusanmuridtitle() {
    $("#title").load("titles/keputusanmuridtitle.php");
}
// MURID
function studentkuiztitle() {
    $("#title").load("titles/studentkuiztitle.php");
}
function keputusankuiztitle() {
    $("#title").load("titles/keputusankuiztitle.php");
}
function kadlaporantitle() {
    $("#title").load("titles/kadlaporantitle.php");
}
//TITLES

function studenthome() {
    window.history.pushState("string", "result", "studentmain.php?page=studenthome");
    $("#main-content").load("studenthome.php");
}
function studentresult() {
    window.history.pushState("string", "result", "studentmain.php?page=studentresult");
    $("#main-content").load("studentresult.php");
}
function studentreportcard() {
    window.history.pushState("string", "result", "studentmain.php?page=studentreportcard");
    $("#main-content").load("studentreportcard.php");
}
function studentkuizlist() {
    window.history.pushState("string", "result", "studentmain.php?page=studentkuizlist");
    $("#main-content").load("studentkuizlist.php");
}
function studentjawabkuiz() {
    window.history.pushState("string", "result", "studentmain.php?page=studentjawabkuiz");
    $("#main-content").load("studentjawabkuiz.php");
}

function refreshpage() {
    $("#main-content").load("adminkuizlist.php");

}
function destroysession() {
    window.location.href = "logKeluar.php";
}