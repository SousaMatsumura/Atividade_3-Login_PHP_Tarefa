<?php

session_start();

if(isset($_POST['submit'])){

    include 'dbh.inc.php';

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    /**
     * Error handlers:
     * @1 - Check for empty fields 
     * @2 - Check if user exist in database
     * @3 - Check password
     * 
     * Plus:
     * @de-hash - decrypt hashed password
     * @log-in - log in the user account
     */

     if(empty($uid) || empty($pwd)){
        //@1
        header("Location: ../index.php?login=empty");
        exit();
     }else{
         $sql = "SELECT * FROM users WHERE user_uid='$uid' OR user_email='$uid'";
         $result = mysqli_query($conn, $sql);
         $resultCheck = mysqli_num_rows($result);
         if($resultCheck < 1){
            //@2
            header("Location: ../index.php?login=error-user-not-found");
            exit();         
         }else{
             if($row = mysqli_fetch_assoc($result)){
                //@de-hash
                $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
                if($hashedPwdCheck == false){
                    //@3
                    header("Location: ../index.php?login=error-hashed-wrong");
                    exit();
                }elseif($hashedPwdCheck == true){
                    //@log-in
                    $_SESSION['u_id'] = $row['user_id'];
                    $_SESSION['u_name'] = $row['user_name'];
                    $_SESSION['u_email'] = $row['user_email'];
                    $_SESSION['u_uid'] = $row['user_uid'];
                    header("Location: ../index.php?login=success");
                    exit();
                }
             }
         }
     }

}else{
    header("Location: ../index.php?login=error-not-isset");
    exit();
}