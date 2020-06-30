<?php

 include 'config.php';
  if(isset($_POST['add_notification_teacher'])){

    $category = $_POST['add_category'];
     $message = $_POST['add_message'];
     $creators_category = 1;
     $creators_id = $_POST['creators_id'];
     $class= $_POST['class_id'];
     
    $send_category = $_POST['send_category'];
$receiver_category = $_POST['receiver_category'];
    $add_send_category = implode(',',(array)$_POST['add_send_category']);
 if($send_category == 1 ){
        $add_send_category = "Whole Class";
     }
     
    $q = "INSERT INTO `notification`(`category`,`message`, `creators_category`,`creators_id`,`send_category`,`date`) VALUES ('$category','$message','$creators_category','$creators_id','$add_send_category',CURRENT_TIMESTAMP)";
    $result = mysqli_query($con, $q);
    if($result){
       $last_id = mysqli_insert_id($con);  
       if($add_send_category != "Whole Class" ){
          
          $array = explode(',',$add_send_category);
          foreach($array as $value){
            $q1 = "INSERT INTO `notification_log`(`notification_id`,`receiver_category`, `receiver_id`) VALUES ('$last_id','$receiver_category','$value')";
            $r1 = mysqli_query($con, $q1);
         }  
      }else{
          $q2 = "SELECT `id` FROM `register` WHERE `class`= '$class'";
          $r2 = mysqli_query($con, $q2);
          while($result=mysqli_fetch_array($r2)){
             $value = $result['id'];
             $q1 = "INSERT INTO `notification_log`(`notification_id`,`receiver_category`, `receiver_id`) VALUES ('$last_id','$receiver_category','$value')";
            $r1 = mysqli_query($con, $q1);
          }
       }
       
     header('location: notification_teacher.php?success');
    }
    else{
      header('location: notification_teacher.php?failure');
    }
  }

if(isset($_POST['update_notification_teacher'])) {
    
    $id = $_POST['update_notification_id'];
    $category = $_POST['update_category'];
    $message = $_POST['update_message'];

    $q3 = "UPDATE `notification` SET `category`='$category',`message`='$message',`date`=CURRENT_TIMESTAMP WHERE `notification_id` = '$id'";
    $res3 = mysqli_query($con, $q3);

    if($res3){
      header('location: notification_teacher.php?success');
    }else{
      header('location: notification_teacher.php?failure');
    }
  }

if(isset($_POST['data'])){
    if($_POST['data'] == 'notification'){
      if(isset($_POST['id']))
      {
        $id = $_POST['id'];
        $query = "SELECT `notification_id`,`category`,`message` FROM `notification` where `notification_id`='$id' ";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        echo json_encode($row);
      }

    }
  }

if(isset($_POST['delete'])){
    if($_POST['delete'] == 'notification'){
      if(isset($_POST['id']))
      {
        $id = $_POST['id'];
        $query = "DELETE FROM `notification` where `notification_id`='$id' ";
        $result = mysqli_query($con, $query);
         $query1 = "DELETE FROM `notification_log` where `notification_id`='$id' ";
        $result1 = mysqli_query($con, $query1);
        
      }

    }
  }

?>