<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Document</title>
</head>
<body>
    <fieldset>
        <legend>Login form</legend>
        <form action="#" method="post">
            <label for="">UserEmail
                <br>
                <input type="email" name="useremail" id="username" placeholder="Enter useremail">
            </label>
            <br>
            <label for="">Password 
                <br>
                <input type="password" name="userpassword" id="userpassword" placeholder="Enter email">
            </label>
            <br>
            <br>
            <input type="submit" value="Login" name="login">
        </form>
    </fieldset>
    <?php
      if(isset($_POST['login'])){
          include "connect.php";
          $username = mysqli_real_escape_string($connect, $_POST['useremail']);
          $userpassword = trim($_POST['userpassword']);

          $sql = "SELECT * FROM userreg WHERE useremail='".$username."'";
          $query = mysqli_query($connect, $sql);
          $rows = mysqli_num_rows($query);
          if($rows > 0){
            while($result = mysqli_fetch_array($query)){
                $pass= $result['passwords'];
                if(password_verify($userpassword, $pass)){
                    setcookie("user",$_POST['useremail'],time()+3600);
                    header("location: index.php");
                }else{
                    echo("<script>alert('Wrong password')</script>");
                }
            }
          }else{
              echo("<script>alert('Useremail dont exist')</script>");
          }
      }
    ?>
</body>
</html>