<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>MyPlans</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="dialog.css">
  <link rel="stylesheet" href="MyPlans.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <header>
    <div class="container-header"> 
      <nav>
        <ul>
          <li><a href="MyProfile.html">My Profile</a><li>
          <li><a href="Timeline.html">Timeline</a><li>
          <li><a href="MyPlans.html">My Plans</a><li>
          <li><a href="Calo-Web.html">Sign Out</a><li>
          <div class="Username"><?php echo $_SESSION['u_email'];?> </div>
        </ul>
      </nav>
    </div>     
  </header>
  
  <div class="container">
    <div class="container-create-button">
      <div id="create-button">Create Plan</div>
    </div>
    <div class="container-plans">     
      <div class="plan">Sample</div>
      <div class="plan">Sample</div>
      <div class="plan">Sample</div>
    </div>  
  </div>

  <div class="bg-modal">   
    <div class="modal-content"> 
      <div class="container-form">
      <div class="input_data">
        <label for="name">Plan Name</label>
        <input type="text" id="name" placeholder="Sample..">
        <div class="container-field"><label for="days">Amount of days:</label>
        <input type="number" id="days" name="days" min="1" max="366"> </div>
  
      <div class="container-field">Choose your level of activity: 
        <label for="activity"> Sedentary </label>
        <input type="checkbox" id="activity">
    
        <label for="activity"> Light </label>
        <input type="checkbox" >
    
        <label for="activity"> Active </label>
        <input type="checkbox" >
    
        <label for="activity"> Very Active</label>
        <input type="checkbox" >
      </div>
   
      <div class="container-field">Gender:
        <label for="gender"> Male</label>
        <input type="checkbox" id="gender"> 
        <label for="gender"> Female </label>
        <input type="checkbox" >  
      </div>
      <div class="container-field"> 
        <label for="job"> Enter Start Date</label>
        <input  id="job">
      </div>
    
      <div class="container-field"> 
        <label for="goal">Amount of kilograms to lose:</label>
        <input type="number" id="goal" name="kilograms" min="1" max="150"> 
      </div>
    
      <div class="container-field"> 
        <label for="Age">Age:</label>
        <input type="number" id="Age" name="kilograms" min="1" max="100"> 
      </div>
    
      <div class="container-field">
        <label for="currentWeight">Current Weight:</label>
        <input type="number" id="currentWeight" name="currentWeight" min="1" max="300"> 
      </div>
    
      <div class="container-field">Choose restrictions: 
        <label for="restrictions"> None </label>
        <input type="checkbox" id="restrictions">
    
        <label for="restrictions"> Vegan </label>
        <input type="checkbox" >
    
        <label for="restrictions"> Vegetarian</label>
        <input type="checkbox" >
      </div>
      <form>
        <input type="button" value="CREATE" class="CreateButton" onclick="window.location.href='MyPlans.html'">
      </form>
    </div>  
  </div>
  <div class="close">+</div>  
  </div>
  </div>
  <div class="plan-modal">
    <div class="modal-content">
      <div class="container-form"> 
        <div class="container-plan-name"> Plan information: </div>
        <div class="container-plan-info"> 
          <table id="planInfo">
            <tr>
              <td> Name</td>
              <td> Sample </td>
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
</body>
</html>