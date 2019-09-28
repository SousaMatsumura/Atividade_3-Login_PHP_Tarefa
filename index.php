<?php
    include_once 'header.php';
?>

<section class="main-container">
    <div class="main-wrapper">
        <h2>Home</h2>
        <?php
            if(isset($_SESSION['u_id'])){
                echo "You are logged in!";
            }else{
                echo "You aren't logged yet... \n If you already heva a account be free to login. If you haven't, sign up this system for free! ";
            }
        ?>
    </div>
</section>

<?php
    include_once 'footer.php';
?>
