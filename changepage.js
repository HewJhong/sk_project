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
function destroysession() {
    window.location.href = "./logKeluar.php";
}