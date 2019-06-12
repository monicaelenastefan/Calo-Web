<?php
session_start();

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
        $data=mysqli_fetch_assoc($result);
      
        //  $result = mysqli_num_rows($result);
        //echo $data['total'];


      for($i = 1; $i <= $data['total']; $i++){
      ?>         
       <div class="plan">Sample</div> 
      <?php   
            }
       ?>
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
              <td> Name</td>
              <td> <?php echo $_SESSION['Name'];?> </td>
            </tr>
            
            <tr>
              <td> Start Date</td>
              <td> 17/3/2019 </td>
            </tr> 
      
            <tr>
              <td> Duration</td>
              <td> 10 days </td>
            </tr>
            
            <tr>
              <td> Weight on StartDate</td>
              <td> 101 kg </td>  
            </tr>
            
            <tr>
              <td> Restrictions </td>
              <td> None </td>  
            </tr>
          </table>
        </div>
        <div class="container-buttons"> 
          <div class="aec-button">Export to XML </div>
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

<script>
  function myFunction(){
// var div = document.createElement("div");
// div.style.width = "100px";
// div.style.height = "100px";
// div.style.background = "red";
// div.style.color = "white";
// div.innerHTML = "Hello";
// document.getElementById("CevaNou").appendChild(div);

var elmnt = document.getElementById("plan");
  var cln = elmnt.cloneNode(true);

  var element = document.getElementById("CevaNou");
  element.appendChild(cln);

  }
</script>



</body>
</html>




