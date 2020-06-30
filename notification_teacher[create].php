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
         body {
            background: #cccccc;
         }

         .text-theme {
            color: #3C4858;
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
                  Notification Panel
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

                     <div class="col-md-12 text-right my-card">
                        <span><a href="" class="mybutton mobile-block" data-toggle="modal" data-target="#add_notification" onmousedown="beep3.play()"><i class="fas fa-plus"></i> Add Notification</a></span>
                     </div>

                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mx-auto text-center  mb-3">
                        <div class="form text-center" style="padding: 30px;background-color: white;">
                           <div class="table-responsive">
                              <table class="table table-bordered text-theme" id="dataTable" width="100%" cellspacing="0">
                                 <thead>
                                    <tr>
                                       <th>Category</th>
                                       <th>Message</th>
                                       <th>Date</th>
                                       <th>Send To</th>
                                       <th>Update</th>
                                       <th>Delete</th>
                                    </tr>
                                 </thead>
                                 <tfoot>
                                 </tfoot>
                                 <tbody>
                                    <?php
                                      $q = "SELECT * FROM `notification` WHERE `creators_id`=6";
                                      $row = mysqli_query($con, $q);
                                      while($result=mysqli_fetch_array($row)){
                                       ?>
                                    <tr>
                                       <td class="text-left">
                                          <?php echo $result['category']; ?>
                                       </td>
                                       <td class="text-left">
                                          <?php echo $result['message']; ?>
                                       </td>
                                       <td>
                                          <?php echo date("d-m-Y H:i:s", strtotime($result['date'])); ?>
                                       </td>
                                       <td class="text-center">
                                          <?php 
                                             echo $result['send_category'];
                                        ?>
                                       </td>
                                       <td>
                                          <a href="" data-toggle="modal" name="update" id="update" data-target="#update_notification" class="mybutton-success mobile-block viewbutton" onclick="sendUpdate(<?php echo $result['notification_id'];?>)">Update</a>
                                       </td>
                                       <td>
                                          <a class="mybutton-danger mobile-block" href="" onclick="delete_notification(<?php echo $result['notification_id'];?>)"><i class="fas fa-trash"></i></a>
                                       </td>
                                    </tr>
                                 </tbody>
                                 <?php } ?>
                              </table>
                           </div>
                        </div>
                     </div>

                     <!-- /////// Main Content End /////// -->
                  </div>
               </div>
            </div>
            <!-- End of Main -->
         </main>


         <div class="modal fade" id="update_notification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel" style="color: #722942;"><b>Update Notification Message</b></h5>
                     <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                     </button>
                  </div>
                  <form action="back.php" method="post" enctype="multipart/form-data">

                     <div class="modal-body my-1 mx-2">
                        <div class="mx-auto  mb-3 text-left text-theme" style="">
                           <label>Update Category</label>
                           <select id="update_category" class="form-control" name="update_category" required>
                              <option disabled="" selected="" value="">Choose Category</option>
                              <option value="Fees">Fees</option>
                              <option value="Attendance">Attendance</option>
                              <option value="Exam">Exam</option>
                              <option value="Other">Other</option>
                           </select>
                        </div>
                        <div class="mx-auto mb-3 text-left text-theme">
                           <label>Message</label>
                           <textarea id="update_message" type="text" name="update_message" class="form-control" placeholder="Enter the Message" rows="6" required></textarea>
                        </div>

                        <input type="text" id="update_notification_id" name="update_notification_id" hidden />

                        <div class="modal-footer">
                           <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                           <button type="submit" name="update_notification_teacher" class="btn btn-primary" style="background-color: #ab47bc;">Update Notification</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>


         <div class="modal fade" id="add_notification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel" class="" style="color: #722942;"><b>Add Notification</b></h5>
                     <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                     </button>
                  </div>

                  <form action="back.php" method="post" enctype="multipart/form-data">
                     <div class="modal-body my-1 mx-2">
                        <div class="mx-auto  mb-3 text-left text-theme" style="">
                           <label>Select Category</label>
                           <select id="add_category" class="form-control" name="add_category" required>
                              <option disabled="" selected="" value="">Choose Category</option>
                              <option value="Fees">Fees</option>
                              <option value="Attendance">Attendance</option>
                              <option value="Exam">Exam</option>
                              <option value="Other">Other</option>
                           </select>
                        </div>
                        <div class="mx-auto mb-3 text-left text-theme">
                           <label>Send To</label><br />
                           <div class="mx-auto  mb-3 text-left text-theme">
                              <select id="receiver_category" class="form-control" name="receiver_category" required>
                                 <option value="2" selected>Student</option>
                                 <option value="3">Parent</option>
                              </select>
                           </div>
                           <div class="row">
                              <div class="col-6 border rounded p-1">
                                 <input type="radio" name="send_category" class="mx-2" id="send_category" value="1" />Whole Class
                              </div>
                              <div class="col-6 border rounded p-1">
                                 <input type="radio" name="send_category" class="mx-2" id="send_category" value="2" />Particular Student
                              </div>
                           </div>
                           <div id="senddiv" style='display:none'>
                              <select id="add_send_category" class="form-control" name="add_send_category[]" multiple required>
                                 <option disabled="" selected="" value="">Use Control to Choose Multiple</option>
                                 <?php
                                      $q = "SELECT `id`,`name` FROM `register` WHERE `class`=4";
                                      $row1 = mysqli_query($con, $q);
                                      while($result1=mysqli_fetch_array($row1)){
                                       ?>
                                 <option value="<?php echo $result1['id']; ?>"> <?php echo $result1['id']; ?> - <?php echo $result1['name']; ?></option>

                                 <?php } ?>
                              </select>
                           </div>
                        </div>
                        <script>
                           $(document).ready(function() {
                              $('input[name="send_category"]').click(function() {
                                 if ($(this).attr('id') == 'send_category' && $('input[name="send_category"]:checked').val() == '2') {
                                    $('#senddiv').show();
                                 } else {
                                    $('#senddiv').hide();
                                 }
                              });
                           });

                        </script>
                        <div class="mx-auto mb-3 text-left text-theme">
                           <label>Message</label>
                           <textarea id="add_message" type="text" name="add_message" class="form-control" placeholder="Enter the Message" rows="6" required></textarea>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="add_notification_teacher" class="btn btn-primary" style="background-color: #ab47bc;">Add Notification</button>
                     </div>

                  </form>
               </div>
            </div>
         </div>


      </div>
      <!-- footer -->
      <?php include 'footer2.php'; ?>
      <!-- //footer -->
      <!-- Footer scripts-->
      <?php include 'footer.php'; ?>
      <!-- footer scripts ends -->
      <?php include'animationscript.php'; ?>

      <script>
         function sendUpdate(id) {

            $.ajax({
               url: "back.php",
               method: "POST",
               data: {
                  data: "notification",
                  id: id
               },
               success: function(result) {

                  var data = JSON.parse(result)

                  $('#update_category').val(data['category'])
                  $('#update_message').val(data['message'])
                  $('#update_notification_id').val(data['notification_id'])
               }
            });
         }

         function delete_notification(id) {

            $.ajax({
               url: "back.php",
               method: "POST",
               data: {
                  delete: "notification",
                  id: id
               },
               success: function(result) {

               }
            });
            location.reload();
         }

      </script>

   </body>

   </html>
