<?php session_start(); ?>
<?php
      if(!isset($_SESSION['Priority']) || $_SESSION['Priority'] != "Server" && $_SESSION['Priority'] != "Preparers")
      {
      echo "<script>
      window.alert('hehe Nope');
      location.href='Home.php?Priority=Denied'; </script>";
      }
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php include("includes/database.php");?>
    <?php include("includes/Navbar.php"); ?>
    <?php include("includes/Header.php"); ?>
    <?php include("includes/Submit.php"); ?>
    <title> Scheduler</title>
    <style>
          #Submission
          {
            background-color: white;
            color: black;
            border: 2px solid #f44336;
          }

          #Submission:hover
          {
            background-color: #f44336;
            color: white;
          }
    </style>
  </head>
  <body>
    <br>
    <br>
    <br>

    <main role="main" class="container" >
        <section>
          <h1 class='text-white ' style='text-align:center' ><span><?php echo $_SESSION['Priority'] ?> Scheduler</span></h1>
          <table class = "table table-striped table-hover table-bordered table-sm "style='border:1px solid white; width:1100px'>

            <tr>
              <td class = "FormCollaspe" style='text-align:center; border:1px solid white 'colspan='9'>Vacation Requests:</td>
            </tr>
            <tr  class = "FormSub">
              <td style='text-align:center; border:1px solid white'colspan='9'>Click on the shift you want and Hit Submit:
              </br>
              <button id= "Submission" class="button">Submit</button> </td>
            </tr>







            <tr>
              <td class = "PrepCollaspe" style='text-align:center; border:1px solid white 'colspan='9'>Preparer</td>
            </tr>
            <tr  class = "PrepSub">
              <td style='border:1px solid white'>Names</th>
              <td style='border:1px solid white'colspan='7'>Weekly Events</th>
              <td style='border:1px solid white'>Total Events</th>
            </tr>

            <tr class = "PrepSub">
                <td style='border:1px solid white'></td>
              <?php if (isset($_SESSION['FName']))
              {
                $sql = "SELECT * FROM events ORDER BY events.Date ASC";
                $results = $smeConn->query($sql);
                while($row = $results->fetch_assoc())
                {
                  echo"  <td  style='border:1px solid white'>".$row['Name']." <br>".$row['Date']."</td> ";
                }
              }
              ?>
              <td style='border:1px solid white'></td>
            </tr>
            <!-- Recusively Lists all events in the Database -->




            <?php if (isset($_SESSION['FName']))
            {
              $result = mysqli_query($smeConn, 'SELECT * FROM Events');
              $EventNum = mysqli_num_rows($result);

             // Gets the number of events and set it as a limit to how many
             // cells are used

              $sql2 = "Select date from events ";
              $results2 = $smeConn->query($sql2);
              $EventDates = array();

              while(($row2 =  mysqli_fetch_array($results2)))
              {
                  $EventDates[] = $row2['date'];
              }
              sort ($EventDates);

              //echo implode(', ', $EventDates);
              //echo("</br>");

              // Creates an array of dates of events
              // to compare vacation days with

              $ValueCounter = 0;

              $sql = "select * from general where Priority = 'Preparers'";
              $results = $smeConn->query($sql);
              while($row = $results->fetch_assoc())
              {
                $USERID = $row['ID'];
                $SuperName = $row['FirstName'];
                echo "<tr class = 'PrepSub'>";
                echo"  <td style='border:1px solid white'>".$row['FirstName']." ".$row['LastName']."<br>".$row['Phone']."</td> ";

                $sql3 = "Select vacations from vacationdays where id = $USERID";
                $results3 = $smeConn->query($sql3);
                $VacayDates = array();

                while(($row3 =  mysqli_fetch_array($results3)))
                {
                    $VacayDates[] = $row3['vacations'];
                }
                sort ($VacayDates);


                //echo implode(', ', $VacayDates);
                //echo"</br>";
                // Creates an array of dates of vacation days for each user
                // to compare vacation days with

                $Matches=array_values(array_intersect($EventDates,$VacayDates));
                //echo implode(", ",$Matches);
                //echo "</br>";

                // Finds the similarities, or the Vacation Days

                //echo var_dump($VacayDates);
                //echo "</br>"


                $Y = 0;
                $X = 0;
                $VDayNum = 0;
                while($X < $EventNum ) // Sets limit of cells to whatever Number of Events isempty($VacayDates)
                {


                  if(empty($Matches))// Good
                  {
                    echo "<td style=' border:1px solid white'></td>";
                  }
                  else if($Y < count($Matches) && $Matches[$Y] == $EventDates[$X])
                  {
                      echo "<td value=1 style='background-color:blue; border:1px solid white '>O</td>";
                      $Y++;
                      $VDayNum++;
                  }
                  else // Goodish
                  {
                    echo "<td value=$ValueCounter  Supervalue =$X   FinalValue =  $SuperName Class= 'Alterable' style=' border:1px solid white'></td>";
                  }

                  $X++;
                  $ValueCounter++;



                }
                echo "<td style=' border:1px solid white'>$VDayNum </td>";
                echo "</tr>";
              }


            }
            ?>

            <tr class= "PrepSub">
              <td style='border:1px solid white'>col 1</td>
              <td style='border:1px solid white'>col 2</td>
              <td style='border:1px solid white'>Col 3</td>
              <td style='border:1px solid white'>col 1</td>
              <td style='border:1px solid white'>col 2</td>
              <td style='border:1px solid white'>Col 3</td>
              <td style='border:1px solid white'>col 1</td>
              <td style='border:1px solid white'>col 2</td>
              <td style='border:1px solid white'>Col 3</td>
            </tr>









            <tr>
              <td class = "ServCollaspe"style='text-align:center; border:1px solid white 'colspan='9'>Server</td>
            </tr>
            <tr  class = "ServSub">
              <td style='border:1px solid white'>Names</th>
              <td style='border:1px solid white'colspan='7'>Weekly Events</th>
              <td style='border:1px solid white'>Total Events</th>
            </tr>
            <tr class = "ServSub">
                <td style='border:1px solid white'></td>
              <?php if (isset($_SESSION['FName']))
              {
                $sql = "SELECT * FROM events ORDER BY events.Date ASC";
                $results = $smeConn->query($sql);
                while($row = $results->fetch_assoc())
                {
                  echo"  <td style='border:1px solid white'>".$row['Name']." <br>".$row['Date']."</td> ";
                }
              }
              ?>
              <td style='border:1px solid white'></td>
            </tr>
            <!-- Recusively Lists all events in the Database -->







            <?php if (isset($_SESSION['FName']))
            {
              $result = mysqli_query($smeConn, 'SELECT * FROM Events');
              $EventNum = mysqli_num_rows($result);

             // Gets the number of events and set it as a limit to how many
             // cells are used

              $sql2 = "Select date from events ";
              $results2 = $smeConn->query($sql2);
              $EventDates = array();

              while(($row2 =  mysqli_fetch_array($results2)))
              {
                  $EventDates[] = $row2['date'];
              }
              sort ($EventDates);

              //echo implode(', ', $EventDates);
              //echo("</br>");

              // Creates an array of dates of events
              // to compare vacation days with
              $ValueCounter =0;

              $sql = "select * from general where Priority = 'Server'";
              $results = $smeConn->query($sql);
              while($row = $results->fetch_assoc())
              {
                $USERID = $row['ID'];
                $SuperName = $row['FirstName'];
                echo "<tr class = 'ServSub'>";
                echo"  <td style='border:1px solid white'>".$row['FirstName']." ".$row['LastName']."<br>".$row['Phone']."</td> ";

                $sql3 = "Select vacations from vacationdays where id = $USERID";
                $results3 = $smeConn->query($sql3);
                $VacayDates = array();

                while(($row3 =  mysqli_fetch_array($results3)))
                {
                    $VacayDates[] = $row3['vacations'];
                }
                sort ($VacayDates);


                //echo implode(', ', $VacayDates);
                //echo"</br>";
                // Creates an array of dates of vacation days for each user
                // to compare vacation days with

                $Matches=array_values(array_intersect($EventDates,$VacayDates));
                //echo implode(", ",$Matches);
                //echo "</br>";

                // Finds the similarities, or the Vacation Days

                //echo var_dump($VacayDates);
                //echo "</br>"


                $Y = 0;
                $X = 0;
                $VDayNum = 0;
                while($X < $EventNum ) // Sets limit of cells to whatever Number of Events isempty($VacayDates)
                {
                  if(empty($Matches))// Good
                  {
                    echo "<td value = 0 Class='Alterable' style=' border:1px solid white'></td>";
                  }
                  else if($Y < count($Matches) && $Matches[$Y] == $EventDates[$X])
                  {
                      echo "<td value=1 style=' background-color:blue; border:1px solid white'>O</td>";
                      $Y++;
                      $VDayNum ++;
                  }
                  else // Goodish
                  {
                    echo "<td value=$ValueCounter  Supervalue =$X FinalValue =  $SuperName Class= 'Alterable' style='border:1px solid white'></td>";
                  }

                  $X++;
                  $ValueCounter++;
                }
                echo "<td style=' border:1px solid white'>$VDayNum</td>";
                echo "</tr>";
                }


                }
                ?>

            <tr class= "ServSub">
              <td style='border:1px solid white'>col 1</td>
              <td style='border:1px solid white'>col 2</td>
              <td style='border:1px solid white'>Col 3</td>
              <td style='border:1px solid white'>col 1</td>
              <td style='border:1px solid white'>col 2</td>
              <td style='border:1px solid white'>Col 3</td>
              <td style='border:1px solid white'>col 1</td>
              <td style='border:1px solid white'>col 2</td>
              <td style='border:1px solid white'>Col 3</td>
            </tr>
          </table>
        </section>
    </main>
  <?php include("includes/Footer.php"); ?>
  <script>
    $(document).ready(function(){

      var VDRequest;
      var EventIndex;
      var ObservedName;

      $(".PrepCollaspe").click(function(){
          $('.PrepSub').toggle();
      });
      $(".ServCollaspe").click(function(){
        $('.ServSub').toggle();
      });
      $(".FormCollaspe").click(function(){
        $('.FormSub').toggle();
      });

      $(".ServSub td.Alterable").click(function(){
        <?php if($_SESSION['Priority'] == "Server") { ?>
        $(this).css('background-color', 'red');
        var EventIndex = $(this).attr('SuperValue');
        var VDRequest = $(this).attr('value');
        var ObservedName = $(this).attr('FinalValue');
        <?php } ?>

        $("#Submission").click(function(){
                $.ajax({
                  type:"POST",
                  url:"scripts/VRequests.php",
                  data:
                  {
                    EventIndex :  EventIndex,
                    VDRequest :  VDRequest,
                    ObservedName:  ObservedName
                  },
                  success:function(response)
                  {
                        window.alert(response);
                  },
                  error:function(){
                        window.alert("Failure");
                  }
                });//end ajax
              });//end logout cli



      });

      $(".PrepSub td.Alterable").click(function(){
        <?php if($_SESSION['Priority'] == "Preparers") { ?>
        $(this).css('background-color', 'red');
        var EventIndex = $(this).attr('SuperValue');
        var VDRequest = $(this).attr('value');
        var ObservedName = $(this).attr('FinalValue');
        <?php } ?>

        $("#Submission").click(function(){
                $.ajax({
                  type:"POST",
                  url:"scripts/VRequests.php",
                  data:
                  {
                    EventIndex :  EventIndex,
                    VDRequest :  VDRequest,
                    ObservedName:  ObservedName
                  },
                  success:function(response)
                  {
                        window.alert(response);
                  },
                  error:function(){
                        window.alert("Failure");
                  }
                });//end ajax
              });//end logout cli

      });



    });
  </script>
  </body>


</html>
