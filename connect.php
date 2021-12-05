<?php
  $connect = mysqli_connect("127.0.0.1","root","","Education");
  if($connect){

  }else{
      echo("<script>alert('Unable to connect to the server')</script>");
  }
?>