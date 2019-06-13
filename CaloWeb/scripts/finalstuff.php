<?php

    include 'config.php';
        
        session_start();

        $Name = mysqli_real_escape_string($conn, $_GET['Name']);
        $Food = mysqli_real_escape_string($conn, $_GET['Name1']);
        $Gramaj = mysqli_real_escape_string($conn, $_GET['Name2']);

        echo $Name;
        echo $Food;
        echo $Gramaj;

        $email=$_SESSION['u_email'];


        // echo $Weight['weight'];

    
    // foreach ($name as $color){ 
    //     echo $color."<br />";
    // }

    // $sql = "INSERT INTO myplans (firstname, days, activity, gender, Sdate, Ktolose, age, Cweight, restriction) VALUE ('$FirstName1', '$Days', '$Color', '$Colors', '$StartDate', '$Kilograms', '$Age', '$CurentWeight', '$Colors1');";
    // mysqli_query($conn, $sql);
    // // header("Location: MyPlans.php?Plan=success");
    
//===================================================
    if (empty($Name) || empty($Food) || empty($Gramaj))
    {
        header("Location: /pages/Timeline.php?signup= Please fill in the blanks!");
        exit();
    }
    else
    {
        if(empty(mysqli_fetch_array(mysqli_query($conn,"SELECT * from food where name like '$Food'"))))
        {
            header("Location: /pages/Timeline.php?signup= No such food!");
            exit();
        }
        else 
        {
            if(empty(mysqli_fetch_array(mysqli_query($conn,"SELECT * from myplans1 where tablename like '$Name'"))))
            {
                header("Location: /pages/Timeline.php?signup=There is no plan with this name!");
                exit();
            }
            else 
            {
                if(!is_numeric($Gramaj))
                {
                    header("Location: /pages/Timeline.php?signup=Portion is not a number!");
                    exit();
                }
                else
                {
                    $start = mysqli_fetch_array(mysqli_query($conn,"SELECT Sdate from myplans1 where tablename like '$Name' and firstname like '$email'"));
                    $start1 = $start['Sdate'];
                    $azi=new DateTime(date("Y-m-d"));
                    $startd=new DateTime($start1);
                    if( $azi <  $startd)
                    {
                        header("Location: /pages/Timeline.php?signup=Your plan did not start yet!");
                        exit();
                    }
                    else
                    {
                        $s = mysqli_fetch_array(mysqli_query($conn,"SELECT days from myplans1 where tablename like '$Name' and firstname like '$email'"));
                        $sd=$s['days'];
                        $hei=date("Y-m-d",strtotime($startd."+".$sd." days"));
                        $ultimazi=new DateTime($hei);
                        if($azi>$ultimazi)
                        {
                            header("Location: /pages/Timeline.php?signup= Your plan expired!");
                            exit();
                        }
                        else
                        {
                            $email =  $_SESSION['u_email'];
                            $date = date("Y-m-d");
                            $sql = "INSERT INTO timeline (email, days, food, gramaj ,planname) VALUE ('$email', '$date', '$Food', '$Gramaj', '$Name');";
                            mysqli_query($conn, $sql);
                            header("Location: /pages/Timeline.php?signup= Added successfully!");
                            exit();
                        }
                    }
                }
                
            }
        }
        
    }
    

?>