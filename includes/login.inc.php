<?php

if(isset($_POST['submit'])){

    include 'dbh.inc.php';

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    /**
     * Error handlers:
     * @1 - Check for empty fields 
     * @2 - Check if input characters are valid
     * @3 - Check if e-mail is valid
     * @4 - Check if the user was already taken in database
     * 
     * Plus:
     * @hash - hash password
     * @insert - insert user into the database
     */

     if(empty($uid) || empty($pwd)){

     }else{
         /**
          * Continue in: https://youtu.be/xb8aad4MRx8
          * At: 1:11:15
          */
     }

}else{
    header("Location: ../index.php?login=error");
    exit();
}