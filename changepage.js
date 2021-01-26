function homepage() {
    window.history.pushState("string", "home", "adminmain.php?page=adminhome");
    $("#main-content").load("adminhome.php");
}
function quizlistpage() {
    window.history.pushState("string", "kuizlist", "adminmain.php?page=adminkuizlist");
    $("#main-content").load("adminkuizlist.php");
}
function quizpage() {
    window.history.pushState("string", "kuiz", "adminmain.php?page=adminkuiz");
    $("#main-content").load("adminkuiz.php");
}
function resultpage() {
    window.history.pushState("string", "result", "adminmain.php?page=adminkeputusan");
    $("#main-content").load("adminresultlist.php");
}
function hometitle() {
    $("#title").load("hometitle.txt");
}
function kuiztitle() {
    $("#title").load("kuiztitle.php");
}

function studenthome() {
    $("#main-content").load("studenthome.php");
}
function studentresult() {
    $("#main-content").load("studentresult.php");
}
function studentkuizlist() {
    $("#main-content").load("studentkuizlist.php");
}
function studentjawabkuiz() {
    $("#main-content").load("studentjawabkuiz.php");
}

function refreshpage() {
    $("#main-content").load("adminkuizlist.php");

}
function destroysession() {
    window.location.href = "./logKeluar.php";
}