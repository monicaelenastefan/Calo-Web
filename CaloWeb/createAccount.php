<?php

    if(isset($_POST['submit'])){
        
        include_once 'config.php';
        $first=mysqli_real_escape_string($conn, $_POST['first']);
        $last=mysqli_real_escape_string($conn, $_POST['last']);
        $email=mysqli_real_escape_string($conn, $_POST['email']);
        $password=mysqli_real_escape_string($conn, $_POST['password']);
        $confirmpassword=mysqli_real_escape_string($conn, $_POST['confirmpassword']);
        $age= mysqli_real_escape_string($conn, $_POST['age']);
        $weight=mysqli_real_escape_string($conn, $_POST['weight']);
        $height=mysqli_real_escape_string($conn, $_POST['height']);
        
        
        //verificam daca sunt campuri libere
        
        if (empty($first) || empty($last) || empty($email) || empty($password) || empty($age) || empty($weight) || empty ($height)){
        
            header("Location: SignUp.php?signup= Please fill in the blanks!");
            exit();
        }
        else{
            //verificam daca datele sunt introduse corect
            if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
                header("Location: SignUp.php?signup= Invalid First Name or Last Name!");
                exit();
            }
            else{
                //verificam daca email-ul este valid
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				header("Location: SignUp.php?signup= Invalid E-mail!");
				exit();
                }
                else{
                    //verificam unicitatea email-ului
                    $sql = "SELECT * FROM users WHERE email = '$email'";
                    $result = mysqli_query($conn,$sql);
                    $resultCheck = mysqli_num_rows($result);
            
                    if ($resultCheck > 0){
					header("Location: SignUp.php?signup= This account already exists!");
					exit();
                    }
                    else{
                        //verificam daca parola e aceeasi cu cea confirmata
                        if($password == $confirmpassword){
                            //hash pass
                            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                            //Toate datele de pana acum au fost introduse corecte
                            //Introducem datele in baza de date
                            $sql = "INSERT INTO users (firstname, lastname, email, password, age, weight, height) VALUE ('$first', '$last', '$email', '$hashedPwd', '$age', '$weight', '$height');";
                            mysqli_query($conn, $sql);
                            header("Location: SignUp.php?signup=Your account has been created!");
                            exit();
                        }
                        else{
                            header("Location: SignUp.php?signup= Passwords do not match!");
                            exit();
                        }
                    }    
                }       
            }
        }
    }
    else{
        header("Location: SignUp.php?signup=sub");
        exit();
    }
    
?>
    