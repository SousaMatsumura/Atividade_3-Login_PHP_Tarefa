<?php

if(isset($_POST['submit'])){

    include_once 'dbh.inc.php';

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
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

     if(empty($name) || empty($email) || empty($uid) || empty($pwd)){
        //@1
        header("Location: ../signup.php?signup=empty");
        exit();
     }else{
         if(!preg_match("/^[a-zA-Z]*$/", $name)){
             //@2
             header("Location: ../signup.php?signup=invalid");
             exit();
         }else{
             if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                //@3
                header("Location: ../signup.php?signup=email");
                exit();
             }else{
                 $sql = "SELECT * FROM users WHERE user_uid='$uid'";
                 $result = mysqli_query($conn, $sql);
                 $resultCheck = mysqli_num_rows($result);

                 if($resultCheck > 0){
                     //@4
                    header("Location: ../signup.php?signup=usertaken");
                    exit();
                 }else{
                    //@hash
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    //@insert
                    $sql = "INSERT INTO users (user_name, user_email, user_uid, user_pwd) "
                       ."VALUES ('$name', '$email', '$uid', '$hashedPwd');";
                    mysqli_query($conn, $sql);
                    header("Location: ../signup.php?signup=success");
                    exit();
                 }
             }
         }
     }
}else{
    header("Location: ../signup.php");
    exit();
}