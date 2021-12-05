<?php
  include "cookie.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Education</title>
</head>
<body>
     <?php
       include "header.php";
     ?>
     <div class="post-contents">
       <?php
          include "connect.php";
          $sql = "SELECT * FROM posts ORDER BY id DESC";
          $query = mysqli_query($connect, $sql);
          if($rows = mysqli_num_rows($query) > 0){
            echo("<div class='posts'>");
            while($resulsts = mysqli_fetch_assoc($query)){
              $postedby = $resulsts['postedby'];
              $photo = "uploads/".$resulsts['photos'];
              $links = $resulsts['links'];
              $postids = $resulsts['id'];
              $postmessage = $resulsts['postMessages'];
              $postedtime = $resulsts['dates'];
              setcookie("postid", $resulsts['id'],time()+3600);
              setcookie("users", $resulsts['postedby'],time()+3600);
              // sub main div of the items
                echo("<div class='items'>");
                // top items to be displayed flex
                echo("<div class='top'><p><h3><strong>PostedBy: </strong>".$postedby."</h3></p><p><strong>Posted: </strong>".$postedtime."</p></div>");
                echo("<a href='".$links."' >Read more...</a>");
                // echo("id".$resulsts['id']);
                echo("<img src='".$photo."' width='600px' height='300px'>");
                echo("<p>'".$postmessage."'</p>");
                echo("<div class='tops'>");
                echo("<form action='#' method='post'><button onclick='return likes()'name='like' id='like'><img src='icons/likes.png' width='20px' title='like' height='20px'></button><input type='number' name='nums' id='nums' value=".$postids."></form>");
                $postidn = $_POST['nums'];
                $getlikes = "SELECT * FROM likes WHERE postid='".$postids."'";
                $getlikesquery = mysqli_query($connect,$getlikes);
                $rowslike = mysqli_num_rows($getlikesquery);
                echo("<p id='likeleft'>".$rowslike."</p>");
                // setcookie("likes",$rowslike,time() + (10 * 365 * 24 * 60 * 60));
                echo("<form action='#' id='form' method='post'>");
                echo("<input type='text' name='comment' id='comment' placeholder='type your comment' required >");
                echo("<input type='number' name='nums' id='nums' value=".$postids.">");
                echo("<input type='submit' value='Send' onclick='submit()'name='Sends'>");
                echo("</form>");
                // echo("<img src='icons/comment.png' onclick='comment()' title='comment' width='30px' heigh='30px'>");
                echo("</div>");
                echo("<form action='#' method='post'>");
                echo("<button name='seecomment'>See comments</button>");
                echo("<input type='number' name='nums' id='nums' value=".$postids.">");
                echo("</form>");
                if(isset($_POST['seecomment'])){
                  $post_id = $_POST['nums'];
                  $sqldata = "SELECT * FROM comments WHERE postid='".$post_id."'";
                  $querydata = mysqli_query($connect, $sqldata);
                  if($datarows = mysqli_num_rows($querydata) > 0){
                  echo("<div class='commentdata'>");
                  echo("<h3>Comments</h3>");
                  while($comments = mysqli_fetch_array($querydata)){
                    $commentby = $comments['username'];
                    $commentmessage = $comments['comments'];
                    echo("<p>");
                    echo("<strong>".$commentby."</strong>");
                    echo("<br>");
                    echo($commentmessage);
                    echo("</p>");
                  }
                  echo("</div>");
                 }else{
                   echo("0 comments");
                 }
                }
                echo("</div>");
            }
            echo("</div>");
          }
       ?>
       <?php
        //  if(isset($_POST['seecomment'])){
        //    $post_id = $_POST['nums'];
        //    $sqldata = "SELECT * FROM comments WHERE postid='".$post_id."'";
        //    $querydata = mysqli_query($connect, $sqldata);
        //    if($datarows = mysqli_num_rows($querydata) > 0){
        //    echo("<div class='commentdata'>");
        //    echo("<h3>Comments</h3>");
        //    while($comments = mysqli_fetch_array($querydata)){
        //      $commentby = $comments['username'];
        //      $commentmessage = $comments['comments'];
        //      echo("<p>");
        //      echo("<strong>".$commentby."</strong>");
        //      echo("<br>");
        //      echo($commentmessage);
        //      echo("</p>");
        //    }
        //    echo("</div>");
        //   }else{
        //     echo("0 comments");
        //   }
        //  }
       ?>
     </div>
     <!-- <script>
       function likes1(){
         let like = document.getElementById('like');
         like.style.color = "steelblue";
         if(like.style.color = "steelblue"){
          like.style.color = "red";
          return false;
         }else{
          return false;
         }
       }
     </script> -->
     <?php
     include "connect.php";
       if(isset($_POST['Sends'])){
        $postid = $_POST['nums'];
         $comment = trim($_POST['comment']);
         $usernames = $_COOKIE['user'];
         $sqls = "INSERT INTO comments(username,comments,	postid)
              VALUES('$usernames','$comment','$postid')";
         $querys = mysqli_query($connect,$sqls); 
         if($querys){
           echo("<script>alert('Comment posted')</script>");
         }else{
          echo("<script>alert('cannot post comment')</script>");
         }
      }
     ?>
     <?php
        if(isset($_POST['like'])){
          $like  = 1;
          $postidn = $_POST['nums'];
          $posts = $_COOKIE['user'];
          // echo($postidn);
          // echo($posts);
          $likesql = "SELECT * FROM likes WHERE users='".$posts."' AND postid='".$postidn."'";
          $likequery = mysqli_query($connect, $likesql);
          if($rows = mysqli_num_rows($likequery) === 0){
             $submitsql = "INSERT INTO likes(users,nums,postid)
             VALUES('$posts','$like',$postidn)";
             $submitquery = mysqli_query($connect, $submitsql);
             if($submitquery){
             }else{
               echo("<script>alert('Error submiting likes')</script>");
             }
          }else{

          }
        }
     ?>
     <?php
      //  $postidn = $_POST['nums'];
      //  $getlikes = "SELECT * FROM likes WHERE postid='".$postids."'";
      //  $getlikesquery = mysqli_query($connect,$getlikes);
      //  $rows = mysqli_num_rows($getlikesquery);
      //  echo("postlikes".$rows);
     ?>
     <?php
       include "footer.php";
     ?>
</body>
</html>
