<?php session_start ();?>
<?php include("../includes/Database.php"); ?>
<?php
      $Username=$_POST['Username'];
      $Password=$_POST['Password'];

      $sql = "select * from general where Username =\"$Username\" and Password =\"$Password\" limit 1";
      $results=$smeConn->query($sql);


      if ($results->num_rows>0)
      {
        $row=$results->fetch_assoc();
        $_SESSION['Priority']=$row['Priority'];
        $_SESSION['ID']=$row['ID'];
        $_SESSION['FName']=$row['FirstName'];
        $_SESSION['Phone']=$row['Phone'];
        $_SESSION['Hours']=$row['Hours'];
        $_SESSION['VDays']=$row['VacationDays'];


        echo $row['Priority'];
      }
      else
      {
        echo 0;
      }






?>
