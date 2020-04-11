<?php
   
$con=mysqli_connect("localhost","root","","moviesrating");
session_start();
//check connection
if (mysqli_connect_errno($con))
{
    echo "Failed to connect to MySQL:" . mysqli_connect_error();
}


?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>

    <!-- add library -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Link for css file -->
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <style>
    .error {color: #FF0000;}
body {
  background-image: url("assets/images/one.jpg");
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-size: 100% 100%;
    opacity: 10;
}
h4 {
    
    color: white;
}

h5 {
     background:grey;
    color: white;
}
h6{
    color:white;
    background:grey;
    opacity:0.9;
    height: 200px;
  width: 50%;
  position: relative;
  left: 400px;
  border: 3px solid ;
  padding-top:20px;
}
</style>

</head>
<body>
    <br>
    <div class="text-center">
        <div class="page-header">
            <h4>Welcome, <b class="text-danger"><?= htmlspecialchars($_SESSION["username"]); ?></b> to the <br>MOVIE FLIX</h4>
        </div>
        <hr>
        
        <h4> <?= htmlspecialchars($_SESSION["username"]); ?> <br><br>Your details:</h4>

        <!-- Below is MY SQL IMP QUERY AND LOGIC TO FETCH DATA FROM THE DATABASE AND DISPLAY IT ,TOOK ME 10 HOURS TO CREATE A CORRECT ONE -->

        <h6><?php $sql = "SELECT username, email, website, about, gender FROM users WHERE username = '" . $_SESSION['username'] . "' ";
        $result = $con->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo "Hello, ". $row['username'] . " Your Email id: (" . $row['email'] . ") <br><br> Webiste :" . $row['website'] . " <br><br> About You: " . $row['about'] . " <br><br>You're a " . $row['gender'] . " ";
        ?></h6>
       
       <br><br><br>
       <p>
            <a href="reset-password.php" class="btn btn-outline-warning">Change Your Password</a>
            <a href="logout.php" class="btn btn-outline-danger">Sign Out</a>
        </p>
        
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-7 col-lg-6 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <b><h5>Average rating of Movies & Shows</h5></b><br>
                            <h5>Given by You & Other users</h5></b><br>
                            AVENGERS: 
                        <?php $sql = "SELECT avg(avengers) FROM users";
        $result = $con->query($sql);
        $rating = $result->fetch_array(MYSQLI_NUM);
        echo $rating[0];
       ?>
       <br><br>
       INCEPTION: 
                        <?php $sql = "SELECT avg(inception) FROM users";
        $result = $con->query($sql);
        $rating = $result->fetch_array(MYSQLI_NUM);
        echo $rating[0];
       ?>
       <br><br>
       THE GODFATHER: 
                        <?php $sql = "SELECT avg(godfather) FROM users";
        $result = $con->query($sql);
        $rating = $result->fetch_array(MYSQLI_NUM);
        echo $rating[0];
       ?>
       <br><br>
       MR ROBOT: 
                        <?php $sql = "SELECT avg(mrrobot) FROM users";
        $result = $con->query($sql);
        $rating = $result->fetch_array(MYSQLI_NUM);
        echo $rating[0];
       ?>
       <br><br>
       X-FILES: 
                        <?php $sql = "SELECT avg(xfiles) FROM users";
        $result = $con->query($sql);
        $rating = $result->fetch_array(MYSQLI_NUM);
        echo $rating[0];
       ?>
       <br><br>
       FRIENDS: 
                        <?php $sql = "SELECT avg(friends) FROM users";
        $result = $con->query($sql);
        $rating = $result->fetch_array(MYSQLI_NUM);
        echo $rating[0];
       ?>
       <br><br>
  
 
   
                            <div class="embed-responsive embed-responsive-16by9">
                                <h5>Created by "Shivam Yadav"</h5><br>
                                <p>Made with ❤<p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>