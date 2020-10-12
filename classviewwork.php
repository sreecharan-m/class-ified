<?php

session_start();
$type = $_SESSION['type'];
$id = $_GET['id'];

if($type == "instructor")
{
    header('location: classviewworkinstructor.php?id=' . $id);
}
else {

    header('location: classviewworkattendee.php?id=' . $id);
}

?>