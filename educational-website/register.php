<?php
// Include the file that contains the database connection.
include 'connect.php';

// Handling sign-up form submission.
if(isset($_POST['signUp'])){
    // Retrieve form data.
    $firstName=$_POST['fName'];
    $lastName=$_POST['lName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    // Encrypt the password using md5 hashing.
    $password=md5($password);

    // Check if the email already exists in the database.
    $checkEmail="SELECT * From users where email='$email'";
    $result=$conn->query($checkEmail);
    if($result->num_rows>0){
        // If email exists, display an error message.
        echo "Email Address Already Exists !";
    }
    else{
        // If email doesn't exist, insert new user data into the database.
        $insertQuery="INSERT INTO users(firstName,lastName,email,password)
                      VALUES ('$firstName','$lastName','$email','$password')";
        if($conn->query($insertQuery)==TRUE){
            // Redirect user to index.php after successful sign-up.
            header("location: index.php");
        }
        else{
            // If there's an error during insertion, display the error message.
            echo "Error:".$conn->error;
        }
    }
}

// Handling sign-in form submission.
if(isset($_POST['signIn'])){
   // Retrieve form data.
   $email=$_POST['email'];
   $password=$_POST['password'];
   // Encrypt the password using md5 hashing.
   $password=md5($password);
   
   // Check if the email and password match in the database.
   $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
       // If email and password match, start a new session.
       session_start();
       $row=$result->fetch_assoc();
       // Store user's email in session variable.
       $_SESSION['email']=$row['email'];
       // Redirect user to homepage.php after successful sign-in.
       header("Location: homepage.php");
       // Exit script execution after redirection.
       exit();
   }
   else{
       // If email and password don't match, display an error message.
       echo "Not Found, Incorrect Email or Password";
   }
}
?>
