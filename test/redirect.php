<?php

session_start();
$type = $_SESSION['type'];
$id = $_GET['id'];

if($type == "instructor")
{
    header('location: instructor_test_view.php?id=' . $id);
}
else {

    header('location: attendee_test_home.php?id=' . $id);
}

?>