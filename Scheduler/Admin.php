<?php session_start(); ?>
<?php
      if(!isset($_SESSION['Priority']) || $_SESSION['Priority'] != "Admin")
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
    <title> Administration Page</title>
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
      #fixed
      {
        width:20px;
      }
    </style>
  </head>
  <body>
    <br>
    <br>
    <br>

    <main role="main" class="container" >
        <section>
          <h1 class='text-white ' style='text-align:center' ><span><?php echo $_SESSION['Priority'] ?> Console</span></h1>
          <?php   echo "Requests:"; ?>
          <?php

              $sql = "Select ObservedName from datachanger;";
              $result=$smeConn->query($sql);
              $row=$result->fetch_assoc();
              while($row=$result->fetch_assoc())
                {
                echo "</br>";
                $Name = $row['ObservedName'];
          	    echo $row['ObservedName'];
                echo "    <input type='radio' name='choice' id='$Name' value='Accept' /> Accept
                          <input type='radio' name='choice' id='$Name' value='Decline' /> Decline";

                }
          ?>
          <table class = "table table-striped table-hover table-bordered table-sm "style='border:1px solid white; width:1100px'>

            <tr>
              <td class = "FormCollaspe0" style='text-align:center; border:1px solid white 'colspan='9'>Delete Pre-Existing Submissions </td>
            </tr>
            <tr  class = "FormSub0">
              <td style='text-align:center; border:1px solid white'colspan='9'>Click on the shift you want and Hit Submit:
              </br>
              <button id= "Submission0" class="button">Submit</button> </td>
            </tr>

            <tr>
              <td class = "FormCollaspe" style='text-align:center; border:1px solid white 'colspan='9'>Vacation Requests:</td>
            </tr>
            <tr  class = "FormSub">
              <td style='text-align:center; border:1px solid white'colspan='9'>Click on the Request you want to delete and hit Submit HERE:
              </br>
              <button id= "Submission" class="button">Submit</button> </td>
            </tr>

            <tr>
              <td class = "FormCollaspe2" style='text-align:center; border:1px solid white 'colspan='9'>Delete Scheduled Shifts Requests:</td>
            </tr>
            <tr  class = "FormSub2">
              <td style='text-align:center; border:1px solid white'colspan='9'>Click One shift you want to delete and press the button :
              </br>
              <button id= "Submission2" class="button">Submit</button> </td>
            </tr>

            <tr>
              <td class = "FormCollaspe3" style='text-align:center; border:1px solid white 'colspan='9'>Add Shifts to Schedule:</td>
            </tr>
            <tr  class = "FormSub3">
              <td style='text-align:center; border:1px solid white'colspan='9'>Click One shift you want to delete and press the button :
              </br>
              <button id= "Submission3" class="button">Submit</button> </td>
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


                $sql4 = "Select EventID from workweeksheet where id = $USERID";
                $results4 = $smeConn->query($sql4);
                while(($row4 =  mysqli_fetch_array($results4)))
                {
                    $WorkDays[] = $row4['EventID']-1 ;
                }
                sort ($WorkDays); // since eveytrhin is ordered, 1-7 or however many events, if we subtract
                                  // 1 from the event id we will have the index of the event days.


                $WorkDates = array();
                foreach ($WorkDays as &$value)
                {
                    $WorkDates[] = $EventDates[$value];
                }

                //echo implode(", ",$WorkDates);
                //echo "</br>";
                $Matches2=array_values(array_intersect($WorkDates,$EventDates));


                // Creates an array of dates of vacation days for each user
                // to compare vacation days with

                $Matches=array_values(array_intersect($EventDates,$VacayDates));
                //echo implode(", ",$Matches);
                //echo "</br>";

                // Finds the similarities, or the Vacation Days

                $Z = 0;
                $Y = 0;
                $X = 0;
                $VDayNum = 0;
                while($X < $EventNum ) // Sets limit of cells to whatever Number of Events isempty($VacayDates)
                {
                  if(empty($Matches))// If there is nothing in the array, just skip
                  {
                    echo "<td style=' border:1px solid white'></td>";
                  }
                  else if($Y < count($Matches) && $Matches[$Y] == $EventDates[$X])
                  {

                      echo "<td value=1 Class= 'AdminAlterable' IDValue =$USERID  Supervalue ='$Matches[$Y]'  style='background-color:blue; border:1px solid white '>O</td>";
                      $Y++;
                      $VDayNum++;

                  }
                  else if($Z < count($WorkDays) && $Matches2[$Z] == $EventDates[$X])
                  {
                      echo "<td value=1 Class= 'AdminDeleteable' IDValue =$USERID  NameValue =$X  style='background-color:yellow; border:1px solid white '>X</td>";
                      $Z++;

                  }
                  else // Goodish
                  {
                    echo "<td value=0 Class= 'AlterableAddable' IDValue =$USERID  Eventinfo =$X  style=' border:1px solid white'></td>";
                  }

                  $X++;

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

                $sql4 = "Select EventID from workweeksheet where id = $USERID";
                $results4 = $smeConn->query($sql4);
                $WorkDays = array();

                while(($row4 =  mysqli_fetch_array($results4)))
                {
                    $WorkDays[] = $row4['EventID'] - 1;
                }
                sort ($WorkDays); // since eveytrhin is ordered, 1-7 or however many events, if we subtract
                                  // 1 from the event id we will have the index of the event days.

                $sql5 = "Select * from workweeksheet where id = $USERID";
                $results5 = $smeConn->query($sql5);

                while($row5 = $results5->fetch_assoc())
                {
                    $Wages = $row5['Wages'];
                    $Hours = $row5['Hours'];
                    $FirstName = $row5['FirstName'];
                    $LastName = $row5['LastName'];
                    $Priority = $row['Priority'];
                    $USERID = $row['ID'];
                }




                $WorkDates = array();
                foreach ($WorkDays as &$value)
                {
                    $WorkDates[] = $EventDates[$value];
                }

                //echo implode(", ",$WorkDates);
                //echo "</br>";
                $Matches2=array_values(array_intersect($WorkDates,$EventDates));

                // Creates an array of dates of vacation days for each user
                // to compare vacation days with

                $Matches=array_values(array_intersect($EventDates,$VacayDates));
                //echo implode(", ",$Matches);
                //echo "</br>";

                // Finds the similarities, or the Vacation Days

                //echo var_dump($VacayDates);
                //echo "</br>"


                $Z = 0;
                $Y = 0;
                $X = 0;
                $VDayNum = 0;
                while($X < $EventNum ) // Sets limit of cells to whatever Number of Events isempty($VacayDates)
                {
                  if(empty($Matches))// If there is nothing in the array, just skip
                  {
                    echo "<td style=' border:1px solid white'></td>";
                  }
                  else if($Y < count($Matches) && $Matches[$Y] == $EventDates[$X])
                  {

                      echo "<td value=1 Class= 'AdminAlterable' IDValue =$USERID  Supervalue ='$Matches[$Y]'  style='background-color:blue; border:1px solid white '>O</td>";
                      $Y++;
                      $VDayNum++;

                  }
                  else if($Z < count($WorkDays) && $Matches2[$Z] == $EventDates[$X])
                  {
                      echo "<td value=1 Class= 'AdminDeleteable' IDValue =$USERID  NameValue =$X  style='background-color:yellow; border:1px solid white '>X</td>";
                      $Z++;

                  }
                  else // Goodish
                  {
                    echo "<td value=0 Class='AlterableAddable' IDValue =$USERID  Eventinfo =$X WageValue=$Wages
HourValue = $Hours Name = $FirstName LName = $LastName PValue = $Priority style='border:1px solid white'></td>";
                  }

                  $X++;

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


  </body>
    <?php include("includes/Footer.php"); ?>
    <script>
      $(document).ready(function(){

        var AdminPermission;

        var SuperID; // ID which will help us find in vacation Dayts
        var EventIndex;


        $(".PrepCollaspe").click(function(){
            $('.PrepSub').toggle();
        });
        $(".ServCollaspe").click(function(){
          $('.ServSub').toggle();
        });
        $(".FormCollaspe").click(function(){
          $('.FormSub').toggle();
        });
        $(".FormCollaspe0").click(function(){
          $('.FormSub0').toggle();
        });
        $(".FormCollaspe2").click(function(){
          $('.FormSub2').toggle();
        });
        $(".FormCollaspe3").click(function(){
          $('.FormSub3').toggle();
        });



        "<td value=0 Class='AlterableAddable' IDValue =$USERID  Eventinfo =$X WageValue=$Wages
              HourValue = $Hours Name = $FirstName LName = $LastName PValue = $Priority style='border:1px solid white'></td>";

        $(".PrepSub td.AlterableAddable").click(function(){
          $(this).css('background-color', 'green');
          var SuperID = $(this).attr('IDValue');
          var index = $(this).attr('Eventinfo') +1;
          var Wages = $(this).attr('WageValue');
          var Hours = $(this).attr('HourValue');
          var FName = $(this).attr('Name');
          var LName = $(this).attr('Lname');
          var Priority = $(this).attr('PValue');
          $("#Submission3").click(function(){
                  $.ajax({
                    type:"POST",
                    url:"scripts/AdminAdditions.php",
                    data:
                    {
                      SuperID :  SuperID,
                      index :  index,
                      Wages :  Wages,
                      Hours :  Hours,
                      FName :  FName,
                      LName :  LName,
                      Priority :  Priority

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

        $(".PrepSub td.AdminDeleteable").click(function(){
          $(this).css('background-color', 'Pink');
          var SuperID = $(this).attr('IDValue');
          var index = $(this).attr('NameValue');

          $("#Submission2").click(function(){
                  $.ajax({
                    type:"POST",
                    url:"scripts/workDeletionRequests.php",
                    data:
                    {
                      SuperID :  SuperID,
                      index :  index

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

        $(".PrepSub td.AdminAlterable").click(function(){
          $(this).css('background-color', 'Purple');
          var SuperID = $(this).attr('IDValue');
          var EventIndex = $(this).attr('SuperValue');
            $("#Submission0").click(function(){
                    $.ajax({
                      type:"POST",
                      url:"scripts/DeletionRequests.php",
                      data:
                      {
                        SuperID :  SuperID,
                        EventIndex :  EventIndex

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









        $(".ServSub td.AlterableAddable").click(function(){
          $(this).css('background-color', 'green');
        });

        $(".ServSub td.AdminDeleteable").click(function(){
          $(this).css('background-color', 'Pink');
          var SuperID = $(this).attr('IDValue');
          var index = $(this).attr('NameValue');
          $("#Submission2").click(function(){
                  $.ajax({
                    type:"POST",
                    url:"scripts/workDeletionRequests.php",
                    data:
                    {
                      SuperID :  SuperID,
                      index :  index

                    },
                    success:function(response)
                    {
                          window.alert(response);
                    },
                    error:function(){
                          window.alert("Failure");
                    }
                  });//end ajax
                });//end logout cli;
        });

        $(".ServSub td.AdminAlterable").click(function(){
          $(this).css('background-color', 'Purple');
          var SuperID = $(this).attr('IDValue');
          var EventIndex = $(this).attr('SuperValue');
              $("#Submission0").click(function(){
                      $.ajax({
                        type:"POST",
                        url:"scripts/DeletionRequests.php",
                        data:
                        {
                          SuperID :  SuperID,
                          EventIndex :  EventIndex

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







        $("input[value='Accept']").change(function(){

          var DeniedRequest = $(this).attr('id');
          if($(this).val() == "Accept")
                  {
                    $("#Submission").click(function(){
                      $.ajax({
                        type:"POST",
                        url:"scripts/AdminRequests.php",
                        data:
                        {
                          DeniedRequest : DeniedRequest
                        },
                        success:function(response)
                        {
                              window.alert(response);
                        },
                        error:function(){
                              window.alert("Failure");
                        }
                      });//end ajax
                          });//end logout cli $(this).attr('id')
                  }
        });








      });
    </script>

</html>
