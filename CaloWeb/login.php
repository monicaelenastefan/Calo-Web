<?php


session_start();

if(isset($_POST['submit'])){
    
    
    include "config.php" ;

    //$email = mysqli_real_escape_string($conn, $_POST["email"]);
	//$password = mysqli_real_escape_string($conn, $_POST["password"]);
    
    $email = $_POST['email'];
    $password = $_POST['password'];
  
    if (empty($email) || empty($password) ){
    
        header("Location: SignIn.php?login=empty");
        exit();
    }
    else{
        
        $sql= "SELECT * from users WHERE email='$email'";
        $result= mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        echo $resultCheck ;
    }
    
    if ($resultCheck <1){
        header("Location: SignIn.php?login=ue");
        exit();
    }
    else{
        $_SESSION['u_email'] = $row['email'];
				
        header("Location: MyPlans.php");
        exit();
    }
       
    
}


















?>