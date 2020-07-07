<?php session_start ();?>
<?php include("../includes/Database.php"); ?>
<?php

              $SuperID=$_POST['SuperID'];
              $EventIndex=$_POST['EventIndex'];


              $sql = "delete from vacationdays where ID =$SuperID and Vacations='$EventIndex'";
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
