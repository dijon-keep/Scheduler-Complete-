<?php session_start ();?>
<?php include("../includes/Database.php"); ?>
<?php

              $DeniedRequest=$_POST['DeniedRequest'];



              $sql = "delete from datachanger where ObservedName = '$DeniedRequest';";
              $results=$smeConn->query($sql);

              if ($smeConn->query($sql) === TRUE)
              {
                    echo "New record created successfully";
              }
              else
              {
                  echo "Error: " . $sql . "<br>" . $smeConn->error;
              }






?>
