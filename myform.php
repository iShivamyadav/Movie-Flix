<?php

    // include config file
    require_once "assets/connection.php";

   // define variables and initialize with empty values
    $username = $password = $confirm_password = $email = $website = $about = $gender = $avengers = $inception = $godfather = $mrrobot = $xfiles = $friends = "";

    $username_err = $password_err = $confirm_password_err = $email_err = $website_err = $about_err = $gender_err = $avengers_err = $inception_err = $godfather_err = $mrrobot_err = $xfiles_err = $friends_err = "";

    //PHP to process the submit data:

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
    
        // Validate username
        if(empty(trim($_POST["username"])))
        {
            $username_err = '<p class="text-danger">Please enter a username.</p>';
        } 
        else
        {
            // prepare a select statement
            $sql = "SELECT id FROM users WHERE username = ?";
            
            if($stmt = mysqli_prepare($connection, $sql))
            {
                // bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // set parameters
                $param_username = trim($_POST["username"]);
                
                // attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1)
                    {
                        $username_err = '<p class="text-danger">This username is already taken.</p>';
                    } 
                    else
                    {
                        $username = trim($_POST["username"]);
                    }
                } 
                else
                {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            
            // close statement
            mysqli_stmt_close($stmt);
        }

                // validate password
                if(empty(trim($_POST["password"])))
                {
                    $password_err = '<p class="text-danger">Please enter a password.</p>';     
                } 
                elseif(strlen(trim($_POST["password"])) < 6)
                {
                    $password_err = '<p class="text-danger">Password must have atleast 6 characters.</p>';
                } 
                else
                {
                    $password = trim($_POST["password"]);
                }

        // validate confirm password

        if(empty(trim($_POST["confirm_password"])))
        {
            $confirm_password_err = '<p class="text-danger">Please confirm password.</p>';     
        } 
        else
        {
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password))
            {
                $confirm_password_err = '<p class="text-danger">Password did not match.</p>';
            }
        }

        // validate EMAIL

        if(empty(trim($_POST["email"])))
        {
            $email_err = '<p class="text-danger">Please enter Email Address.</p>';     
        } 
        else
        {
            $email = trim($_POST["email"]);
          
        }

        //Validate Website
        if(empty(trim($_POST["website"])))
        {
            $website_err = '<p class="text-danger">Please enter your Website.</p>';     
        } 
        else
        {
            $website = trim($_POST["website"]);
          
        }

        //About Validate

        if(empty(trim($_POST["about"])))
        {
            $about_err = '<p class="text-danger">Please describe one line about yourself.</p>';     
        } 
        else
        {
            $about = trim($_POST["about"]);
          
        }

        //Validate Gender 
        if(empty(trim($_POST["gender"])))
        {
            $gender_err = '<p class="text-danger">Please select your Gender.</p>';     
        } 
        else
        {
            $gender = trim($_POST["gender"]);
          
        }

        //Validating Movies Ratings

        //avengers

        if(empty(trim($_POST["avengers"])))
        {
            $avengers_err = '<p class="text-danger">Please rate Avengers Movie.</p>';     
        } 
        else
        {
            $avengers = trim($_POST["avengers"]);
          
        }
        //inception

        if(empty(trim($_POST["inception"])))
        {
            $inception_err = '<p class="text-danger">Please rate Inception.</p>';     
        } 
        else
        {
            $inception = trim($_POST["inception"]);
          
        }

        //Godfather
        if(empty(trim($_POST["godfather"])))
        {
            $godfather_err = '<p class="text-danger">Please rate Godfather.</p>';     
        } 
        else
        {
            $godfather = trim($_POST["godfather"]);
          
        }

        //VALIDATIONS OF TV SHOWS RATING

        // MR ROBOT
        if(empty(trim($_POST["mrrobot"])))
        {
            $mrrobot_err = '<p class="text-danger">Please rate MR ROBOT TV SERIES.</p>';     
        } 
        else
        {
            $mrrobot = trim($_POST["mrrobot"]);
          
        }

        //x files
        if(empty(trim($_POST["xfiles"])))
        {
            $xfiles_err = '<p class="text-danger">Please rate XFILES.</p>';     
        } 
        else
        {
            $xfiles = trim($_POST["xfiles"]);
          
        }

        //friends
        if(empty(trim($_POST["friends"])))
        {
            $friends_err = '<p class="text-danger">Please rate FRIENDS.</p>';     
        } 
        else
        {
            $friends = trim($_POST["friends"]);
          
        }

    // check input errors before inserting in database

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($website_err) && empty($about_err) && empty($gender_err) && empty($avengers_err) && empty($inception_err) && empty($godfather_err) && empty($mrrobot_err) && empty($xfiles_err) && empty($friends_err))
                {
                    
                    // prepare an insert statement
                    $sql = "INSERT INTO users (username, password, email, website, about, gender, avengers, inception, godfather, mrrobot, xfiles, friends ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    
                    if($stmt = mysqli_prepare($connection, $sql))
                    {
                        // bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "ssssssssssss", $param_username, $param_password, $param_email, $param_website, $param_about, $param_gender, $param_avengers, $param_inception, $param_godfather, $param_mrrobot, $param_xfiles, $param_friends );
                        
                        // Set parameters
                        $param_username = $username;
                        $param_password = password_hash($password, PASSWORD_DEFAULT);
                        $param_email = $email;
                        $param_website = $website;
                        $param_about = $about;
                        $param_gender = $gender;
                        $param_avengers = $avengers;
                        $param_inception = $inception;
                        $param_godfather = $godfather;
                        $param_mrrobot = $mrrobot;
                        $param_xfiles = $xfiles;
                        $param_friends = $friends;

                        
                        // attempt to execute the prepared statement
                        if(mysqli_stmt_execute($stmt))
                        {
                            // redirect to Welcome page
                            header("location: welcome.php");
                        } else{
                            echo "Something went wrong. Please try again later.";
                        }
                    }
                    
                    // close statement
                    mysqli_stmt_close($stmt);
                }
                
                // close connection
                mysqli_close($connection);
  }
?>














<!DOCTYPE HTML>  
<html>
<head>
<title>MOVIEFLIX : SIGN UP & RATING FORM OF MOVIES</title> <!-- Include CSS File Here-->
    <!-- add library -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    <!-- add styles css -->
<style>
       

.error {color: #FF0000;}
body {
  background-image: url("assets/images/login.jpg");
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-size: 100% 100%;
    opacity: 10;
}
</style>
</head>
<body>  
<div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <div class="wrapper">
                            <h2 class="text-center">MOVIE FLIX:
                            FOR MOVIES & SHOWS RATING WITH SIGNUP</h2>
                           <h5> <p class="text-center">Please fill this form to create an account and rate Movies & shows </p> </h5>
                            <hr>
                            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group <?= (!empty($username_err)) ? 'has-error' : ''; ?>">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control"placeholder="Enter username" value="<?= $username; ?>">
                                    <span class="help-block"><?= $username_err; ?></span>
                                </div>

                                <div class="form-group <?= (!empty($password_err)) ? 'has-error' : ''; ?>">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" placeholder="Enter password" value="<?= $password; ?>">
                                    <span class="help-block"><?= $password_err; ?></span>
                                </div>
                                </div>
                                <div class="form-group <?= (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Enter confirm password" value="<?php echo $confirm_password; ?>">
                                    <span class="help-block"><?= $confirm_password_err; ?></span>
                                </div>
                                <div class="form-group <?= (!empty($email_err)) ? 'has-error' : ''; ?>">
                                    <label>EMAIL</label>
                                    <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?= $email; ?>">
                                    <span class="help-block"><?= $email_err; ?></span>
                                </div>
                                <div class="form-group <?= (!empty($website_err)) ? 'has-error' : ''; ?>">
                                    <label>WEBSITE</label>
                                    <input type="text" name="website" class="form-control" placeholder="Enter Website" value="<?= $website; ?>">
                                    <span class="help-block"><?= $website_err; ?></span>
                                </div>
                                <div class="form-group <?= (!empty($about_err)) ? 'has-error' : ''; ?>">
                                    <label>ABOUT YOU</label>
                                    <input type="text" name="about" class="form-control" placeholder="Enter About you" value="<?= $about; ?>">
                                    <span class="help-block"><?= $about_err; ?></span>
                                </div>
                                <div class="form-group <?= (!empty($gender_err)) ? 'has-error' : ''; ?>">
                                    <label>GENDER</label>
                                    <br>
                                    <input type="radio" name="gender"
                                    <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female <br><br>
                                    <input type="radio" name="gender" 
                                    <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male <br><br>
                                    <input type="radio" name="gender" 
                                    <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other
                                    <span class="help-block"><?= $gender_err; ?></span>
                                </div>

<h5>##RATE THE MOVIES BELOW FROM 1-5##</h5>
<div class="form-group <?= (!empty($avengers_err)) ? 'has-error' : ''; ?>">
                                    <label>AVENGERS</label>
                                    <br>
                                    <input type="radio" name="avengers"
                                    <?php if (isset($avengers) && $avengers=="1") echo "checked";?> value="1">1
                                    <input type="radio" name="avengers" 
                                    <?php if (isset($avengers) && $avengers=="2") echo "checked";?> value="2">2 
                                    <input type="radio" name="avengers" 
                                    <?php if (isset($avengers) && $avengers=="3") echo "checked";?> value="3">3
                                    <input type="radio" name="avengers" 
                                    <?php if (isset($avengers) && $avengers=="4") echo "checked";?> value="4">4
                                    <input type="radio" name="avengers" 
                                    <?php if (isset($avengers) && $avengers=="5") echo "checked";?> value="5">5
                                    <span class="help-block"><?= $avengers_err; ?></span>
                                </div>
                                <div class="form-group <?= (!empty($inception_err)) ? 'has-error' : ''; ?>">
                                    <label>INCEPTION</label>
                                    <br>
                                    <input type="radio" name="inception"
                                    <?php if (isset($inception) && $inception=="1") echo "checked";?> value="1">1
                                    <input type="radio" name="inception" 
                                    <?php if (isset($inception) && $inception=="2") echo "checked";?> value="2">2 
                                    <input type="radio" name="inception" 
                                    <?php if (isset($inception) && $inception=="3") echo "checked";?> value="3">3
                                    <input type="radio" name="inception" 
                                    <?php if (isset($inception) && $inception=="4") echo "checked";?> value="4">4
                                    <input type="radio" name="inception" 
                                    <?php if (isset($inception) && $inception=="5") echo "checked";?> value="5">5
                                    <span class="help-block"><?= $inception_err; ?></span>
                                </div>
<br>
<div class="form-group <?= (!empty($godfather_err)) ? 'has-error' : ''; ?>">
                                    <label>GODFATHER</label>
                                    <br>
                                    <input type="radio" name="godfather"
                                    <?php if (isset($godfather) && $godfather=="1") echo "checked";?> value="1">1
                                    <input type="radio" name="godfather" 
                                    <?php if (isset($godfather) && $godfather=="2") echo "checked";?> value="2">2 
                                    <input type="radio" name="godfather" 
                                    <?php if (isset($godfather) && $godfather=="3") echo "checked";?> value="3">3
                                    <input type="radio" name="godfather" 
                                    <?php if (isset($godfather) && $godfather=="4") echo "checked";?> value="4">4
                                    <input type="radio" name="godfather" 
                                    <?php if (isset($godfather) && $godfather=="5") echo "checked";?> value="5">5
                                    <span class="help-block"><?= $godfather_err; ?></span>
                                </div>
<br>
<h5>RATE AMONG THE TOP TV SERIES</h5>
<br><br>
<div class="form-group <?= (!empty($mrrobot_err)) ? 'has-error' : ''; ?>">
                                    <label>MR ROBOT</label>
                                    <br>
                                    <input type="radio" name="mrrobot"
                                    <?php if (isset($mrrobot) && $mrrobot=="1") echo "checked";?> value="1">1
                                    <input type="radio" name="mrrobot" 
                                    <?php if (isset($mrrobot) && $mrrobot=="2") echo "checked";?> value="2">2 
                                    <input type="radio" name="mrrobot" 
                                    <?php if (isset($mrrobot) && $mrrobot=="3") echo "checked";?> value="3">3
                                    <input type="radio" name="mrrobot" 
                                    <?php if (isset($mrrobot) && $mrrobot=="4") echo "checked";?> value="4">4
                                    <input type="radio" name="mrrobot" 
                                    <?php if (isset($mrrobot) && $mrrobot=="5") echo "checked";?> value="5">5
                                    <span class="help-block"><?= $mrrobot_err; ?></span>
                                </div>
<br>
<div class="form-group <?= (!empty($xfiles_err)) ? 'has-error' : ''; ?>">
                                    <label>X FILES</label>
                                    <br>
                                    <input type="radio" name="xfiles"
                                    <?php if (isset($xfiles) && $xfiles=="1") echo "checked";?> value="1">1
                                    <input type="radio" name="xfiles" 
                                    <?php if (isset($xfiles) && $xfiles=="2") echo "checked";?> value="2">2 
                                    <input type="radio" name="xfiles" 
                                    <?php if (isset($xfiles) && $xfiles=="3") echo "checked";?> value="3">3
                                    <input type="radio" name="xfiles" 
                                    <?php if (isset($xfiles) && $xfiles=="4") echo "checked";?> value="4">4
                                    <input type="radio" name="xfiles" 
                                    <?php if (isset($xfiles) && $xfiles=="5") echo "checked";?> value="5">5
                                    <span class="help-block"><?= $xfiles_err; ?></span>
                                </div>
<br>
<div class="form-group <?= (!empty($friends_err)) ? 'has-error' : ''; ?>">
                                    <label>FRIENDS</label>
                                    <br>
                                    <input type="radio" name="friends"
                                    <?php if (isset($friends) && $friends=="1") echo "checked";?> value="1">1
                                    <input type="radio" name="friends" 
                                    <?php if (isset($friends) && $friends=="2") echo "checked";?> value="2">2 
                                    <input type="radio" name="friends" 
                                    <?php if (isset($friends) && $friends=="3") echo "checked";?> value="3">3
                                    <input type="radio" name="friends" 
                                    <?php if (isset($friends) && $friends=="4") echo "checked";?> value="4">4
                                    <input type="radio" name="friends" 
                                    <?php if (isset($friends) && $friends=="5") echo "checked";?> value="5">5
                                    <span class="help-block"><?= $friends_err; ?></span>
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-outline-success" value="Submit">
                                    <input type="reset" class="btn btn-outline-danger float-right" value="Reset">
                                </div>
                                <p>Already have an account? <a href="login.php">Login here</a>.</p>
                            </form>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>