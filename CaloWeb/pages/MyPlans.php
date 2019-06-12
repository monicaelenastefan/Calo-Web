<?php
session_start();
$_SESSION['count'] = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  
  <title>MyPlans</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/MyPlans.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <header>
    <div class="container-header"> 
      <nav>
        <ul>
          <li><a href="../pages/MyProfile.php">My Profile</a><li>
          <li><a href="../pages/Timeline.php">Timeline</a><li>
          <li><a href="../pages/MyPlans.php">My Plans</a><li>
          <li><a href="../scripts/logout.php">Sign Out</a><li>
          <div class="Username"><?php echo $_SESSION['u_first'];?> </div>
        
        </ul>
      </nav>
    </div>     
  </header>
  
  <div class="container">
    <div class="container-create-button">
    <div>
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
      <div id="create-button" >Create Plan</div>
    </div>
 

    <div class="container-plans" id="CevaNou"> 
      <?php
      include_once '../scripts/config.php';
      $email = $_SESSION['u_email'];
      $sql= "SELECT count(*) as total from myplans1 WHERE firstname like '$email'";
        $result = mysqli_query($conn, $sql);
       // echo $result;
         $data=mysqli_fetch_assoc($result);
      
        //  $result = mysqli_num_rows($result);
        //echo $data['total'];
        $_SESSION['date'] = $data['total'];

     
      ?>         
       <div class="plan">Plans</div> 
     
    </div>  
  </div>
  <form action="../scripts/generatePlans.php" method="get">

  <div class="bg-modal">   
    <div class="modal-content"> 
      <div class="container-form">
      <div class="input_data">
        <label for="name">Plan Name</label>
        <input type="text" id="name" name="Name" placeholder="Sample..">
        <div class="container-field"><label for="days">Amount of days:</label>
        <input type="number" id="days" name="days" min="1" max="366"> </div>
  
      <div class="container-field">Choose your level of activity: 
        <!-- <label for="activity"> Sedentary </label>
        <input type="checkbox" id="activity"> -->

        <label>Light<input type="checkbox" name="color[]" id="color" value="Light"></label>
        <label>Active<input type="checkbox" name="color[]" id="color" value="Active"></label>
        <label>Very Active<input type="checkbox" name="color[]" id="color" value="Very Active"></label>

    
        <!-- <label for="activity"> Light </label>
        <input type="checkbox" >
    
        <label for="activity"> Active </label>
        <input type="checkbox" >
    
        <label for="activity"> Very Active</label>
        <input type="checkbox" > -->
      </div>
   
      <div class="container-field">Gender:
      <label>Male<input type="checkbox" name="colors[]" id="color" value="Male"></label>
      <label>Female<input type="checkbox" name="colors[]" id="color" value="Female"></label>

        <!-- <label for="gender"> Male</label>
        <input type="checkbox" id="gender"> 
        <label for="gender"> Female </label>
        <input type="checkbox" >   -->
      </div>
      <div class="container-field"> 
        <label for="job"> Enter Start Date</label>
        <input type="date" id="job" name="job">
      </div>
    
      <div class="container-field"> 
        <label for="goal">Amount of kilograms to lose:</label>
        <input type="number" id="goal" name="kilograms" min="1" max="150"> 
      </div>
    
      <div class="container-field"> 
        <label for="Age">Age:</label>
        <input type="number" id="Age" name="age" min="1" max="100"> 
      </div>
    
      <div class="container-field">
        <label for="currentWeight">Current Weight:</label>
        <input type="number" id="currentWeight" name="currentWeight" min="1" max="300"> 
      </div>
    
      <div class="container-field">Choose restrictions: 

      <label>None<input type="checkbox" name="colors1[]" id="color" value="None"></label>
      <label>Vegan<input type="checkbox" name="colors1[]" id="color" value="Vegan"></label>
      <label>Vegetarian<input type="checkbox" name="colors1[]" id="color" value="Vegetarian"></label>

        <!-- <label for="restrictions"> None </label>
        <input type="checkbox" id="restrictions">
    
        <label for="restrictions"> Vegan </label>
        <input type="checkbox" >
    
        <label for="restrictions"> Vegetarian</label>
        <input type="checkbox" > -->
      </div>
      
        <input type="submit" name="submit" value="CREATE" class="CreateButton" onclick="myFunction();" />
      </form>
      

    </div>  
  </div>
  <div class="close">+</div>  
  </div>
  </div>
  
  <div class="plan-modal">
    <div class="modal-content" >
      <div class="container-form"> 
        <div class="container-plan-name"> Plan information: </div>
        <div class="container-plan-info"  >
    
        <table id="planInfo">
            <tr>
            <?php
  while($_SESSION['count'] <= $_SESSION['date']){
  ?>
              <td> Name</td>
              <td> <?php 
              include_once '../scripts/config.php';
              
              $email = $_SESSION['u_email'];
              $sql= "SELECT tablename from myplans1 WHERE firstname like '$email'";
              $result = mysqli_query($conn, $sql);
              $i = 1; 

              while($row = $result->fetch_assoc()) {
                //echo $_SESSION['linie'];
                if($i === $_SESSION['count']){
                 
                  echo $row["tablename"];
                  break;
                }
                else $i = $i + 1;  
              // echo $i;
            }

        
        ?> </td>
            </tr>
            
            <tr>
              <td> Start Date</td>
              <td> <?php 
              include_once '../scripts/config.php';
              
              $email = $_SESSION['u_email'];
              $sql= "SELECT Sdate from myplans1 WHERE firstname like '$email'";
              $result = mysqli_query($conn, $sql);
              $i = 1; 

              while($row = $result->fetch_assoc()) {
                if($_SESSION['count'] === $i){
                  
                  echo $row["Sdate"];
                  break;
                }
                else $i = $i + 1;  
               
            }
        
        ?> </td>
            </tr> 
      
            <tr>
              <td> Duration</td>
              <td> <?php 
              include_once '../scripts/config.php';
              
              $email = $_SESSION['u_email'];
              $sql= "SELECT days from myplans1 WHERE firstname like '$email'";
              $result = mysqli_query($conn, $sql);
              $i = 1; 

              while($row = $result->fetch_assoc()) {
                if($_SESSION['count'] === $i){
                  
                  echo $row["days"];
                  break;
                }
                else $i = $i + 1;  
               
            }
        
        ?> </td>
            </tr>
            
            <tr>
              <td> Weight on StartDate</td>
              <td> <?php 
              include_once '../scripts/config.php';
              
              $email = $_SESSION['u_email'];
              $sql= "SELECT weight from myplans1 WHERE firstname like '$email'";
              $result = mysqli_query($conn, $sql);
              $i = 1; 

              while($row = $result->fetch_assoc()) {
                if($_SESSION['count'] === $i){
                  
                  echo $row["weight"];
                  break;
                }
                else $i = $i + 1;  
               
            }
        
        ?> </td>  
            </tr>
            
            <tr>
              <td> Restrictions </td>
              <td> <?php 
              include_once '../scripts/config.php';
              
              $email = $_SESSION['u_email'];
              $sql= "SELECT restriction from myplans1 WHERE firstname like '$email'";
              $result = mysqli_query($conn, $sql);
              $i = 1; 

              while($row = $result->fetch_assoc()) {
                if($_SESSION['count'] === $i){
                  
                  echo $row["restriction"];
                  break;
                }
                else $i = $i + 1;  
               
            }
        
        ?> </td>  
            </tr>
            <?php 
            // $count = $_SESSION['count'];
            // $count = $count - 1;
            // $_SESSION['count'] = $count;
            $_SESSION['count'] = $_SESSION['count'] + 1;
           
          }
            ?>
          </table>
        </div>
        <div class="container-buttons"> 
          <form class="" action="Functie.php" method="post">
          <!-- <div class="aec-button">Export to XML</div> -->
          <button type="submit" class="aec-button" name="button">Export to XML</button>
          </form>
        </div>
      </div>
      <div class="close-plan">+</div>
    </div>
  </div>
  <script>
    var list= document.getElementById("create-button");
    tab= [];
   
    console.log("test");
    list.addEventListener('click', function() {
      document.querySelector('.bg-modal').style.display= 'flex'; 
    });
    document.querySelector('.close').addEventListener('click', 
    function(){
      document.querySelector('.bg-modal').style.display= 'none';
    });

    var plan=document.querySelectorAll(".plan");
    
   for ( var i = 0; i< plan.length ; i++){
      plan[i].addEventListener('click', function() {
        document.querySelector('.plan-modal').style.display= 'flex'; 
      });
    }   
      document.querySelector('.close-plan').addEventListener('click', 
      function(){
        document.querySelector('.plan-modal').style.display= 'none';
    });
  </script>





</body>
</html>




