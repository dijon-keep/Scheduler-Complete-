<?php session_start ();?>
<?php include("../includes/Database.php"); ?>
<?php

              $SuperID=$_POST['SuperID'];
              $EventIndex=$_POST['index'];
              $Wages=$_POST['Wages'];
              $Hours=$_POST['Hours'];
              $FName=$_POST['FName'];
              $LName=$_POST['LName'];
              $Priority=$_POST['Priority'];



              $sql = "insert into workweeksheet values ($Wages, $Hours, $SuperID, $EventIndex, $FName, $LName, 'Woah')";
              $results=$smeConn->query($sql);

              if ($smeConn->query($sql) === TRUE)
              {
                    echo "Updated: Please Refresh!";
              }
              else
              {
                  echo "Error: " . $sql . "<br>" . $smeConn->error;
              }






?>
