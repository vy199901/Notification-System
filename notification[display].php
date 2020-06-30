<?php include 'variables.php'; ?>
<!doctype html>
<html lang="en">
   <head>
      <title><?php echo $company." | ".$title; ?></title>
      <!-- Include Head -->
      <?php include 'head.php'; ?>
      <!-- sound effect -->
      <?php include 'soundscript.php'?>
      <!-- sound effect end -->
      <style type="text/css">
         body{
         background:#cccccc;
         }
      </style>
   </head>
   <body>
      <div class="wrapper">
         <div class="header">
            <!-- Include Navbar -->
            <?php include 'navbar.php'; ?>
            <!-- subject name -->
            <div class="text-center subjecttitle animatedParent animateOnce">
               <div class=" animated bounceInDown">
                     <img class="subjecttitleimg img-responsive" src="images/analytics.png">
                     Notification
               </div>
            </div>
            <!-- //subject name -->
         </div>
         <main role="main" class="main container-fluid main-raised">
            <!-- All Content Starts From Here -->
            <div class="subjectcontainer">
               <div class="container animatedParent animateOnce">
                  <div class="row animated bounceInUp slowest">
                     <!-- Main Content Goes Here -->
                     <?php
                        $q = "SELECT * FROM `notification`";
//                    .
//                     Modify the query to display only the required records here use a join query here
//                     .
                        $result = mysqli_query($con, $q);
                        while($row = mysqli_fetch_array($result)){
                         ?>
                     <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12 card-custom mt-5">
                        <div class="card" style="padding: 3%;">
                           
                              <div class="mycardtitle">
                                 <h5 style=""><span>Category - <b><?php echo $row['category']; ?></b></span></h5>
                                 <?php echo $row['message']; ?>
                              </div>
                             
                           <div class="text-right">
                                 <button type="submit" class="btn btn-styled coursebutton" onmousedown="beep3.play()"><i class="fas fa-comment-slash"></i> Dismiss</button>
                              </div>
                        
                        </div>
                     </div>
                     <?php } ?>
                     <!-- /////// Main Content End /////// -->
                  </div>
               </div>
            </div>
            <!-- End of Main -->
         </main>
      </div>
      <!-- footer -->
      <?php include 'footer2.php'; ?>
      <!-- //footer -->
      <!-- Footer scripts-->
      <?php include 'footer.php'; ?>
      <!-- footer scripts ends -->
      <?php include'animationscript.php'; ?>
   </body>
</html>