<nav class="navbar navbar-expand-md navbar-dark bg-danger fixed-top">
 <img src="https://www.freeiconspng.com/uploads/fiery-comet-fireball-png-images-0.png" width="50" alt="Fiery Comet Fireball PNG Images" /></a><span class = "text-dark"><a class="nav-link" href="Home.php">Manga Events!</a></span>
 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon"></span>
 </button>

 <div class="collapse navbar-collapse" id="navbarsExampleDefault">
       <ul class="navbar-nav ml-auto">
         <li class="nav-item">
           <a class="nav-link" href="Admin.php">Test Admin</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="UserScheduler.php">Test Employee</a>
         </li>
         <li class ="nav-item login">
           <?php
           if(isset($_SESSION['Priority']))
           {
                echo "<li class='nav-link'>Welcome, ".$_SESSION['FName']."</li>";
                echo "<a class='nav-link' id='logout' href='#'>Sign Out</a>";
           }
          else {
           ?>
           <a class="nav-link" href="#" data-toggle="modal" data-target="#HelloModal"> LOGIN </a>
         <?php } ?>
         </li>
      </ul>
   </div>
 </nav>
