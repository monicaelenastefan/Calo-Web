<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Calo'Web</title>
	<meta charset="UTF-8">
  <link rel="stylesheet" href="../css/Timeline.css">
  <meta name="viewport" content="width=device-width, initial-scale=1"> 
</head>

<body>
  <header>
    <div class="container-header">  
      <nav>
        <ul>
          <li><a href="../pages/MyProfile.php">My Profile</a><li>
          <li><a href="../pages/Timeline.php">Timeline</a><li>
          <li><a href="../pages/MyPlans.php">MyPlans</a><li>
          <li><a href="../scripts/logout.php">Sign Out</a><li>
          <div class="Username"><?php echo $_SESSION['u_first'];?> </div>       
        </ul>
      </nav>
    </div>
  </header>	

	<div class="lists">	
		<div class="list">
			<h4>Sample:Week 1</h4>
		    <ul>
				  <li>Day 1: Monday(17.03.2019): 1320 kcal</li>
				  <li>Day 2: Tuesday(18.03.2019):1450 kcal</li>
				  <li>Day 3: Wednesday(19.03.2019): 1620 kcal</li>
				  <li>Day 4: Thursday(20.03.2019): 1550 kcal</li>
				  <li>Day 5: Friday(21.03.2019): 1750 kcal</li>
				  <li>Day 6: Saturday(22.03.2019): 1900 kcal</li>
				  <li>Day 7: Sunday(23.03.2019): 1100 kcal</li>
			  </ul>
			<footer>Average week: 1527 kcal</footer>
		</div>
		
		<div class="list">
			<h4>Sample:Week 2</h4>
			<ul>
				<li>Day 8: Monday(24.03.2019): 1400 kcal</li>
				<li>Day 9: Tuesday(25.03.2019): 1750 kcal</li>
				<li>Day 10: Wednesday(26.03.2019): 1900kcal</li>
			</ul>
			<footer>Average week:1683 kcal</footer>
		</div>
  </div>  
  <div class="bg-modal">   
    <div class="modal-content"> 
      <div class="food-list">
        <table id="food">
          <tr>
            <th> Food</th>
            <th> Portion </th>
            <th> Calories </th>
          </tr>
        
          <tr>
            <td> Food</td>
            <td> Portion </td>
            <td> Calories </td>
          </tr>
        
          <tr>
            <td> Food</td>
            <td> Portion </td>
            <td> Calories </td>
          </tr>

          <tr>
            <td> Food</td>
            <td> Portion </td>
            <td> Calories </td>
          </tr>
        
          <tr>
            <td> Food</td>
            <td> Portion </td>
            <td> Calories </td>
          </tr>
        
          <tr>
            <td> Food</td>
            <td> Portion </td>
            <td> Calories </td>
          </tr>

          <tr>
            <td> Food</td>
            <td> Portion </td>
            <td> Calories </td>
          </tr>
        
          <tr>
            <td> Food</td>
            <td> Portion </td>
            <td> Calories </td>
          </tr>
          
          <tr>
            <td> Food</td>
            <td> Portion </td>
            <td> Calories </td>
          </tr>
        
          <tr>
            <td> Food</td>
            <td> Portion </td>
            <td> Calories </td>
          </tr>
        
          <tr>
            <td> Food</td>
            <td> Portion </td>
            <td> Calories </td>
          </tr>
        
          <tr>
            <td> Food</td>
            <td> Portion </td>
            <td> Calories </td>
          </tr>
       
          <tr>
            <td> Food</td>
            <td> Portion </td>
            <td> Calories </td>
          </tr>
        
          <tr>
            <td> Food</td>
            <td> Portion </td>
            <td> Calories </td>
          </tr>

          <tr>
            <td> Food</td>
            <td> Portion </td>
            <td> Calories </td>
          </tr>
        
        <tr>
          <td> Food</td>
          <td> Portion </td>
          <td> Calories </td>
        </tr>
        
        <tr>
          <td> Food</td>
          <td> Portion </td>
          <td> Calories </td>
        </tr>
        
        <tr>
          <td> Food</td>
          <td> Portion </td>
          <td> Calories </td>
        </tr>
      </table>
      </div>
      <div class="container-buttons">
        <div id="add">Add </div>
        <div class="aec-button">Edit </div>
        <div class="aec-button">Delete </div>
      </div>
      <div class="close">+</div>
    </div>  
  </div>   
  <div class="add-item-modal">
    <div class="modal-content"> 
      <div class="border">
        <div class="container-field">Search for aliment: </div>
        <input type="text" placeholder="Search..">
        <div class="container-field"> <label for="portion">Portion size in grams: </label>
        <input type="number" id="portion" name="portion" min="0" max="5000"> </div>
        <div class="container-buttons-add"> 
          <div id="save"> Save</div>
          <div id="ex-button">Close </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var list= document.querySelectorAll(".list ul li");
    tab= [];
    for (var i = 0 ; i < list.length; i++) {
      console.log("test");
      list[i].addEventListener('click', function() {
        document.querySelector('.bg-modal').style.display= 'flex'; 
      });
      document.querySelector('.close').addEventListener('click', 
      function(){
        document.querySelector('.bg-modal').style.display= 'none'; 
      });
   } 
  
    var el=document.getElementById("add");
    el.addEventListener('click', function() {  
      document.querySelector('.add-item-modal').style.display= 'flex'; 
    });
    document.querySelector('#ex-button').addEventListener('click', 
    function(){
    document.querySelector('.add-item-modal').style.display= 'none';
    });
  </script>
</body>
</html>