<?php
  include "cookie.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <title>Document</title>
</head>
<body>
    <footer>
        <div class="rows">
            <h4>Social Links</h4>
            <a href="#"><img src="icons/facebook.png"  width="30px" title="facebook" height="30px" alt=""> facebook</a>
            <br>
            <a href="#"><img src="icons/instagram.png" width="30px" title="instagram" height="30px"  alt=""> Instagram</a>
            <br>
            <a href="#"><img src="icons/linkedln.png" width="30px" title="linkedln" height="30px"  alt=""> Linkdln</a>
            <br>
            <a href="#"><img src="icons/twitter.png"  width="30px" title="twitter" height="30px" alt=""> Twitter</a>
        </div>
        <div class="rows">
            <h4>Services</h4>
            <p>Education material</p>
            <p>Online library</p>
            <p>Online Research</p>
        </div>
        <div class="rows">
            <h4>Sign-up to out Newslatter</h4>
            <form action="#" method="post">
                <input type="email" name="usermail" id="usermail" placeholder="enter Email" required>
                <br>
                <input type="submit" value="Sign-up" name="signup">
            </form>
        </div>
        <?php
           if(isset($_POST['signup'])){
               include "connect.php";
               $usermail = mysqli_real_escape_string($connect, $_POST['usermail']);
               $sql = "INSERT INTO newslatter(useremail)
                       VALUES('$usermail')";
               $query = mysqli_query($connect, $sql);
               if($query){
                   echo("<script>alert('Thank you for signing up, request submitted succesfully')</script>");
               }else{
                echo("<script>alert('Error submitting your request reload and try again')</script>");
               }
           }
        ?>
    </footer>
</body>
</html>