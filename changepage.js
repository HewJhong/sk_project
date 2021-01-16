function homepage() {
    $("#main-content").load("adminhome.php");
}
function quizlistpage() {
    $("#main-content").load("adminkuizlist.php");
}
function quizpage() {
    $("#main-content").load("adminkuiz.php");
}
function resultpage() {
    $("#main-content").load("adminrekodlist.php");
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