<?php
session_start();
//include("database.php");
    $connection = mysqli_connect('127.0.0.1','root','y2jrpdwk','bd_crm') or die(mysqli_error($connection));
//var_dump($_SESSION);
//if (!isset($_SESSION['user'])) {
//    $_SESSION['user'] = session_id();
//}
//$uid = $_SESSION['user'];  // set your user id settings
$uid = $_SESSION['ID'];  // set your user id settings
$datetime_string = date('c', time());
//$_GET['view'] = 1;
if (isset($_POST['action']) or isset($_GET['view'])) {
    if (isset($_GET['view'])) {
        header('Content-Type: application/json');
        $start = mysqli_real_escape_string($connection, $_GET["start"]);
        $end = mysqli_real_escape_string($connection, $_GET["end"]);

        $result = mysqli_query($connection, "SELECT `id`, `start` ,`end` ,`title` FROM  `events` where (date(start) >= '$start' AND date(start) <= '$end') and uid='" . $uid . "'");
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = $row;
        }
        echo json_encode($events);
        exit;
    } elseif ($_POST['action'] == "add") {
        mysqli_query($connection, "INSERT INTO `events` (
                    `title` ,
                    `start` ,
                    `end` ,
                    `uid` 
                    )
                    VALUES (
                    '" . mysqli_real_escape_string($connection, $_POST["title"]) . "',
                    '" . mysqli_real_escape_string($connection, date('Y-m-d H:i:s', strtotime($_POST["start"]))) . "',
                    '" . mysqli_real_escape_string($connection, date('Y-m-d H:i:s', strtotime($_POST["end"]))) . "',
                    '" . mysqli_real_escape_string($connection, $uid) . "'
                    )");
        header('Content-Type: application/json');
        echo '{"id":"' . mysqli_insert_id($connection) . '"}';
        exit;
    } elseif ($_POST['action'] == "update") {
        mysqli_query($connection, "UPDATE `events` set 
            `start` = '" . mysqli_real_escape_string($connection, date('Y-m-d H:i:s', strtotime($_POST["start"]))) . "', 
            `end` = '" . mysqli_real_escape_string($connection, date('Y-m-d H:i:s', strtotime($_POST["end"]))) . "' 
            where uid = '" . mysqli_real_escape_string($connection, $uid) . "' and id = '" . mysqli_real_escape_string($connection, $_POST["id"]) . "'");
        exit;
    } elseif ($_POST['action'] == "delete") {
        mysqli_query($connection, "DELETE from `events` where uid = '" . mysqli_real_escape_string($connection, $uid) . "' and id = '" . mysqli_real_escape_string($connection, $_POST["id"]) . "'");
        if (mysqli_affected_rows($connection) > 0) {
            echo "1";
        }
        exit;
    }
}
?>