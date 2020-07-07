<?php session_start ();?>
<?php include("../includes/Database.php"); ?>
<?php

              $EventIndex=$_POST['EventIndex'];
              $Requests=$_POST['VDRequest'];
              $ObservedName=$_POST['ObservedName'];


              $sql = "Insert into datachanger (EventIndex, VDRequestIndex, ObservedName) VALUES ($EventIndex, $Requests, '$ObservedName' );";
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
