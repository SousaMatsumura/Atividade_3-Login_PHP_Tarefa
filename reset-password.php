<?php
   require "header.php"
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>Reset your password</h2>
        <p>An e-mail will be send to you with instructions on how to reset your password. </p>
    </div>
    <form action="includes/reset-request.inc.php" method="POST">
        <input type="text" name="email" placeholder="Enter your e-mail address...">
        <button type="submit" name="reset-request-submit">Receive new password by email</button>
    </form>

    <?php
        if(isset($_GET["reset"])){
            if($_GET["reset"] == "success"){
                echo "<p>Check your e-mail!</p>";
            }
        }
    ?>
</section>


<?php
    include_once 'footer.php';
?>