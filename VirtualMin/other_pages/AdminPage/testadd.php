<?php
session_start();


else if(isset($_POST['deleteuser_btn']))
{
    $user_id = mysqli_real_escape_string($conn, $_POST['user_ids']);


    $delete_query = "DELETE FROM user WHERE user_id = $user_id";
    $delete_query_run = mysqli_query($conn, $delete_query);

    if($delete_query_run)
    {
        echo 200; // Success response code
    }
    else
    {
        echo 500; // Error response code
    }
}
?>