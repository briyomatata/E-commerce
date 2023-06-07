<?php

require_once("connection.php");
require_once("functions.php");
require_once("sessions.php");
?>

<?php
//Validation for the categories code 
if(isset($_POST["Submit"])){
    $Title = ($_POST["Title"]);
    $Category = ($_POST["Category"]);
    $Post = ($_POST["Post"]);
    date_default_timezone_set("Africa/Nairobi");
    $CurrentTime=time();
   // $DateTime = strftime("%Y-%m-%d %H:%M:%S", $CurrentTime);
$DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
$DateTime;
$Image =$_FILES["Image"]['name'];
$Target ="Uploads/".basename($_FILES["Image"]['name']); //this code saves the pictures into the local databases
if(empty($Title)){
    $_SESSION["ErrorMessage"] ="Product Name Can't Be Empty";
    Redirect_to("add-product.php");
      
}elseif(strlen($Title)<"2"){
    $_SESSION["ErrorMessage"] ="Title Should Be At-least 2 Characters";
    Redirect_to("add-product.php");
}
else{
    global $conn;
    //the data should be arrange according to the way it is in the database
    $Query = "INSERT INTO goods(datetime,name,category,image,description) VALUES('$DateTime','$Title' ,'$Category', '$Image', '$Post')";
    $Execute = mysqli_query($conn,$Query);
    move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);
    if($Execute){
        $_SESSION["SuccessMessage"] = "Post Added Successfully";
        Redirect_to("top.php");
    }
    else{
        $_SESSION["ErrorMessage"] ="Something Went Wrong...Try Again";
    Redirect_to("add-product.php");
    }
}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Post</title>
    <link rel="stylesheet" href="do.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" >
</head>

<style>
    .FieldInfo{
color: rgb(251, 174, 44);
font-family: Bitter,Georgia, 'Times New Roman', Times, serif;
font-size: 1.5rem;
}
</style>
<body>

<div class="container-fluid">
       

        <div class="col-sm-10">
            <h1>Add New Product</h1>
           
            <form action="add-product.php" method="post" enctype="multipart/form-data">
                
                <fieldset>
                <div class="formgroup">
                    <label for="title"><span class ="FieldInfo">Product  Name:</span></label>
                    <input class="form-control" type="text" name="Title" id="title" placeholder="Product Name" required>
                    </div>

                    <div class="formgroup">
                    <label for="categoryselect"><span class ="FieldInfo">Category:</span></label>
                    <select class ="form-control"  name="Category" id="categoryselect">
                    <?php   

global $conn;
$ViewQuery = "SELECT * FROM categories";
$Execute = mysqli_query($conn, $ViewQuery);
while($DataRows = mysqli_fetch_array($Execute)){
    $Id = $DataRows["catid"];
    $CategoryName = $DataRows["category_name"];
?>

<option>
    <?php
    echo $CategoryName;
    ?>
</option>

<?php }?>
                    </select>
                    </div>

                    <div class="formgroup">
                    <label for="imageselect"><span class ="FieldInfo">Select Image:</span></label>
                    <input class="form-control" type="file" name="Image" id="imageselect" >
                    </div>

                    <div class="formgroup">
                    <label for="postarea"><span class ="FieldInfo">Description:</span></label>
                    <textarea class="form-control" name="Post" id="postarea" required ="true"></textarea>
                    </div>

                    <br>
                    <input class ="btn btn-success btn-lock" type="submit" name = "Submit" value ="Add New Product">
                </fieldset>
            </form>
            <br>
            

     

  
    </div>
</div>
        </div>


<!-- <div id="Footer">
    <p>Created By | Briyoo | &copy;2023-2025 ---All rights reserved</p>
</div> -->


    
</body>
</html>