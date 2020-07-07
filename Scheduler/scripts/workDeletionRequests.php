<?php session_start ();?>
<?php include("../includes/Database.php"); ?>
<?php

              $SuperID=$_POST['SuperID'];
              $EventIndex=$_POST['index'];


              $sql = "delete from workweeksheet where ID =$SuperID and EventID='$EventIndex'";
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
