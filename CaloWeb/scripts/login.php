<?php


session_start();

if(isset($_POST['submit'])){
    
    
    include "../scripts/config.php" ;

    $email = mysqli_real_escape_string($conn, $_POST["email"]);
	$password = mysqli_real_escape_string($conn, $_POST["password"]);
    
    //$email = $_POST['email'];
    //$password = $_POST['password'];
  
    if (empty($email) || empty($password) ){
    
        header("Location: /pages/SignIn.php?login= Please fill in the blanks!");
        exit();
    }
    else{
        
        $sql= "SELECT  * from users WHERE email='$email'";
        $result= mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        echo $resultCheck ;
    }
    
    if ($resultCheck <1){
        header("Location: /pages/SignIn.php?login= Invalid account!");
        exit();
    }
    else{
        if ($row = mysqli_fetch_assoc($result)){
				$hashedPwdCheck = password_verify($password, $row['password']);

				if ($hashedPwdCheck == false){
					header("Location: /pages/SignIn.php?login= Invalid password!");
					exit();
				}
                elseif($hashedPwdCheck == true){
                    $_SESSION['u_email'] = $row['email'];
                    $_SESSION['u_first'] = $row['firstname'];
                    header("Location: /pages/MyPlans.php");
                    exit();
                }
        }
       
    } 
}


















?>