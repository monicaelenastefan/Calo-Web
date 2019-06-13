<?php

    include 'config.php';
        
        session_start();

        $Name = mysqli_real_escape_string($conn, $_GET['Name']);
        $_SESSION['Name'] = $Name;
        $Days = mysqli_real_escape_string($conn, $_GET['days']);

        $name = $_GET['color'];
        $name = $name[0]; 
        $Color = mysqli_real_escape_string($conn, $name);
        echo $Color;

        $name1 = $_GET['colors'];
        $name1 = $name1[0];
        $Colors = mysqli_real_escape_string($conn, $name1);
        echo $Colors;

        $StartDate = mysqli_real_escape_string($conn, $_GET['job']);

        $Kilograms = mysqli_real_escape_string($conn, $_GET['kilograms']);

        $Age = mysqli_real_escape_string($conn, $_GET['age']);
        echo $Age;

        $CurentWeight = mysqli_real_escape_string($conn, $_GET['currentWeight']);

        $name2 = $_GET['colors1'];
        $name2 = $name2[0];
        $Colors1 = mysqli_real_escape_string($conn, $name2);
        echo $Colors1;
        session_start();
        $temp = $_SESSION['u_first'];
        $temp = trim($temp);
        $sql = "SELECT email FROM users WHERE firstname like '$temp'";
        $FirstName = mysqli_query($conn,$sql);
        $FirstName = mysqli_fetch_array($FirstName);

        $FirstName1 = $FirstName[0];
        $FirstName1 = mysqli_real_escape_string($conn, $FirstName1);
       // echo $FirstName['email'];
        echo '<br>';

        $sql = "SELECT age FROM users WHERE firstname like '$temp'";
        $Age6 = mysqli_query($conn,$sql);
        $Age6 = mysqli_fetch_array($Age6);
    
       
        $Age1 = $Age6[0];
        $Age1 = mysqli_real_escape_string($conn, $Age1);
       // echo $Age['age'];
        echo '<br>';
    
        $sql = "SELECT height FROM users WHERE firstname like '$temp'";
        $Height = mysqli_query($conn,$sql);
        $Height = mysqli_fetch_array($Height);
    
        
        $Height1 = $Height[0];
        $Height1 = mysqli_real_escape_string($conn, $Height1);
        echo $Height['height'];
        echo '<br>';
    
        $sql = "SELECT weight FROM users WHERE firstname like '$temp'";
        $Weight = mysqli_query($conn,$sql);
        $Weight = mysqli_fetch_array($Weight);
    
        
        $Weight1 = $Weight[0];
        $Weight1 = mysqli_real_escape_string($conn, $Weight1);
       // echo $Weight['weight'];

    
    // foreach ($name as $color){ 
    //     echo $color."<br />";
    // }

    // $sql = "INSERT INTO myplans (firstname, days, activity, gender, Sdate, Ktolose, age, Cweight, restriction) VALUE ('$FirstName1', '$Days', '$Color', '$Colors', '$StartDate', '$Kilograms', '$Age', '$CurentWeight', '$Colors1');";
    // mysqli_query($conn, $sql);
    // // header("Location: MyPlans.php?Plan=success");
    

    if (empty($Name) || empty($FirstName1) || empty($Age1) || empty($Height1) || empty($Weight1) || empty($Days) || empty ($Color) || empty($Colors) || empty($StartDate) || empty($Kilograms) || empty($Age) || empty($CurentWeight) || empty($Colors1)){
        
        // header("Location: ../pages/MyPlans.php?Plan=success");
        header("Location: /pages/MyPlans.php?signup= Please fill in the blanks!");

        exit();
    }
    else{
        $sql = "INSERT INTO myplans1 (tablename, firstname, ageI, height ,weight, days, activity, gender, Sdate, Ktolose, age, Cweight, restriction) VALUE ('$Name', '$FirstName1', '$Age1', '$Height1', '$Weight1', '$Days', '$Color', '$Colors', '$StartDate', '$Kilograms', '$Age', '$CurentWeight', '$Colors1');";
        mysqli_query($conn, $sql);
        echo $Name;
        header("Location: /pages/MyPlans.php?signup= Plan create successfuly!");
        exit();
    }
    

?>