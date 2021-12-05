<?php
  include "cookie.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>
    <?php
      include "header.php";
    ?>
    <div class="content">
        <fieldset>
            <legend>Create a Post</legend>
            <form action="#" method="post" enctype="multipart/form-data">
                <label for="">Upload Photo
                    <br>
                    <input type="file" name="images" id="images">
                </label>
                <br>
                <label for="">Reference
                    <br>
                    <input type="url" name="articlelink" id="articlelink" placeholder="Enter Artical link">
                </label>
                <br>
                <label for="">Post Message
                    <br>
                    <textarea name="postmessage" id="postmessage" cols="30" rows="10"required></textarea>
                </label>
                <br>
                <br>
                <input type="submit" value="Create Post" name="create">
                <?php
                   if(isset($_POST['create'])){
                    include "connect.php";
                    $files = $_FILES['images'];
                    $urllinks = $_POST['articlelink'];
                    $postmessage = $_POST['postmessage'];
                     
                    $filetmpname = $_FILES['images']['tmp_name'];
                    $filename = $_FILES['images']['name'];
                    $filesize = $_FILES['images']['size'];
                    $fileerror = $_FILES['images']['error'];
                    $filetype = $_FILES['images']['type'];

                    // get extension
                    $fileextension = explode(".",$filename);
                    $Actualextension = strtolower(end($fileextension));
                    $accepted = array("jpg","jpeg","png");
                    if(in_array($Actualextension, $accepted)){
                      if($fileerror === 0){
                           if($filesize < 5000000){
                               $fname = "IMG".rand(1000, 1000000000);
                               $fullfilename = $fname.".".$Actualextension;
                               $filelocation = "uploads/".$fullfilename;
                               $postedby = $_COOKIE['user'];
                            //    move file
                            if(move_uploaded_file($filetmpname,$filelocation)){
                                $sql = "INSERT INTO posts(postedby,	photos,links,postMessages)
                                      VALUES('$postedby','$fullfilename','$urllinks','$postmessage')";
                                $query = mysqli_query($connect,$sql);
                                if($query){
                                    echo("<script>alert('Posted')</script>");
                                }else{
                                    echo("<script>alert('Error submitting your request')</script>");
                                }
                            }else{
                                echo("<script>alert('Error processing your image')</script>");
                            }
                           }else{
                            echo("<script>alert('File size too learge, please choose another file')</script>");
                           }
                      }else{
                        echo("<script>alert('Unknow file error preventing your file submission')</script>");
                      }
                    }else{
                        echo("<script>alert('Only 'jpg','jpeg' and 'png' allowed')</script>");
                    }
                    


                   }

                ?>
            </form>
        </fieldset>
    </div>
    <?php
      include "footer.php";
    ?>
</body>
</html>