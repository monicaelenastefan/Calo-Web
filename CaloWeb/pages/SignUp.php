<!DOCTYPE html>
<html lang="en">

<head>
  <title>SignUp to Calo'Web</title>
  <link rel="stylesheet" href="../css/SignUpSignIn.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <header>
    <div class="container-header"> 
      <nav>
        <ul>
          <li><a href="../pages/Features.html">Features</a><li>
          <li><a href="../index.html">Home</a><li>
          <li><a href="../pages/SignIn.php">Sign In</a><li>
          <li><a href="../pages/SignUp.php">Sign Up</a><li>       
        </ul>
      </nav>
    </div>      
  </header>
  
  <div class="container">
    <div class="left-wheel" ></div>
    <div class="right-wheel"></div>

    <div class="input_data">
      
      <form action="../scripts/createAccount.php" method="post" >
      
      First name: <input type="text" name="first" placeholder="Enter First Name here..."><br>
        
      Last name: <input type="text" name="last" placeholder="Enter Last Name here..."><br>
        
      E-mail: <input type="email" name="email" placeholder="Enter E-mail here..."><br>
        
      Password: <input type="Password" name="password" placeholder="Enter Password here..."><br>
        
      Confirm Password: <input type="Password" name="confirmpassword" placeholder="Confirm Password here..."><br>
        
      <div class="details">
        <div class="grid-item">Age:<input type="number" name="age"><br></div>
        
        <div class="grid-item">Weight(kg):<input type="number" name="weight"><br></div>
        
        <div class="grid-item">Height(cm):<input type="number" name="height"><br></div>
      </div>
      
        <input type="submit" name="submit" value="SUBMIT" class="SubmitButton">
    	</form>
        
        
        
        <?php
        
        if(@$_GET['signup']==true)
        {
        ?>
           <div  class="notification"> <?php echo $_GET['signup'] ?> 
           </div>
        <?php
        }
        
        ?>
        
    </div>   
  </div>
</body>
</html>
