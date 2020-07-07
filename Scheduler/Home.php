<?php session_start(); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <?php include("includes/Header.php"); ?>
    <title>Magma Events!</title>
  </head>
  <header>
        <?php include("includes/NavBar.php"); ?>
  </header>
  <body>
    <main role="main" class="container" >
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                      </ol>

                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img class="d-block w-100" src="images/Fire_One.jpg" alt="First slide">
                          <div class="carousel-caption d-none d-md-block">
                            <h5>First</h5>
                            <p>Some Example</p>
                          </div>
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="images/FIre_Two.jpg" alt="Second slide">
                          <div class="carousel-caption d-none d-md-block">
                            <h5>Second</h5>
                            <p>Some Example</p>
                          </div>
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="images/Fire_Three.jpg" alt="Third slide">
                          <div class="carousel-caption d-none d-md-block">
                            <h5>Third</h5>
                            <p>Some Example</p>
                          </div>
                        </div>
                      </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only ">Previous</span>
                  </a>

                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
        </div>

      </br>

        <section name='services' style='text-align:center'>
          <h3 class='text-primary'>Services</h3>
          <div class='row justify-content-center'>
            <div class='card col-10 col-md-5 col-xl-3 mx-auto my-3'>

            <div class='card-body'>
                <h5 class='card-title'>Register</h5>
                <p class='card-text'>Register event participants with professional easy to use online forms</p>
              </div>
            </div>

            <div class='card col-10 col-md-5 col-xl-3 mx-auto my-3'>

              <div class='card-body'>
                <h5 class='card-title'>Collect</h5>
                <p class='card-text'>Payments are processed securely and sent to your payment processing account immediately. No waiting till the event date.</p>
              </div>
            </div>

            <div class='card col-10 col-md-5 col-xl-3 mx-auto my-3'>

              <div class='card-body'>
                <h5 class='card-title'>Promote</h5>
                <p class='card-text'>Create offers that are delivered during registration.</p>
              </div>
            </div>
            <!-- Force next columns to break to new line at md breakpoint and up -->
            <div class="w-100 d-none d-xl-block"></div>
            <div class='card col-10 col-md-5 col-xl-3 mx-auto my-3'>

              <div class='card-body'>
                <h5 class='card-title'>Fundraise</h5>
                <p class='card-text'>Fundraising software to help with collecting donations and automate everything from payment reminders to attendee notifications.</p>
              </div>
            </div>
            <div class='card col-10 col-md-5 col-xl-3 mx-auto my-3'>

              <div class='card-body'>
                <h5 class='card-title'>Manage</h5>
                <p class='card-text'>Automatic reminders sent to your attendees with event details to reduce no shows for your event.</p>
              </div>
            </div>
            <div class='card col-10 col-md-5 col-xl-3 mx-auto my-3'>

              <div class='card-body'>
                <h5 class='card-title'>Report</h5>
                <p class='card-text'>Easily download & print attendee details in CSV or PDF. See insights on real-time traffic, ticket sales and revenues for each event.</p>
              </div>
            </div>
          </div>
        </section>
    </main>

  </body>
      <?php include("includes/Footer.php"); ?>
</html>
