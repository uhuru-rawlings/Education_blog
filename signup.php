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
        <legend>Sign-up form</legend>
        <form action="#" method="post">
            <label for="">Email 
                <br>
                <input type="email" name="useremail" id="useremail" placeholder="Enter email">
            </label>
            <br>
            <label for="">UserName
                <br>
                <input type="text" name="username" id="username" placeholder="Enter username">
            </label>
            <br>
            <label for="">Password 
                <br>
                <input type="password" name="userpassword" id="userpassword" placeholder="Enter  password">
            </label>
            <br>
            <label for="">Confirm Password
                <br>
                <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password">
            </label>
            <br>
            <br>
            <input type="submit" value="Register" onclick="return validate()" name="register">
        </form>
        <script>
            function validate(){
                let a = document.getElementById("userpassword");
                let b = document.getElementById("confirmpassword");
                if(a.value === b.value){

                }else{
                    alert('Password dont match');
                    return false;
                }
            }
        </script>
        <?php
          if(isset($_POST['register'])){
              include "connect.php";
              $useremail = $_POST['useremail'];
              $username = $_POST['username'];
              $userpassword = $_POST['userpassword'];
              $passwordhash = password_hash($userpassword, PASSWORD_DEFAULT);

              $verify = "SELECT * FROM userreg WHERE useremail='".$useremail."'";
              $queries = mysqli_query($connect,$verify);
              $rows = mysqli_num_rows($queries);

              if($rows > 0){
                  echo("<script>alert('User with same elready exists')</script>");
              }else{
                  $sql = "INSERT INTO userreg(useremail,username,passwords)
                       VALUES('$useremail','$username','$passwordhash')";
                  $query = mysqli_query($connect, $sql);
                  if($query){
                      header("location: login.php");
                  }else{
                      echo("<script>'Error execuring your request'</script>");
                  }
              }
          }
        ?>
    </fieldset>
</body>
</html>