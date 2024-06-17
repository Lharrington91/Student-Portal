<?php
  session_start();
  require_once('configsp.php');
?><!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1/>"/>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </head>
  <!--
  tblstudent
  username, fullName, password, phoneNumber

  tblclasses
  class_code, class_name

  tblstudentclasses (bridge table)
  username, class_code
  -->

  <body>
    <h1>Welcome to the class add page</h1>
    <div id="error_div">
      <?php
          if(isset($_POST['add_class'])){
            $sql = "INSERT INTO tblstudentclasses (username, class_code) VALUES(?,?)";
            $stmtinsert = $db->prepare($sql);
            $result = $stmtinsert->execute([$_SESSION['username'], $_POST['add_class']]);
            if($result){
              echo 'USER PROFILE SAVED';
              $created = true;
            }else{
              echo 'ERROR SAVING DATA.';
            }

          }
      ?>
    </div>
    <?php
      if (isset($_SESSION['username'])) {
        ?>
        <form method="POST">
          <label>Select classes you want to add from the dropdown.</label><br>
          <select name="add_class">
            <option value=''>---Please pick a class---</option>
            <?php
              $username = $_SESSION['username'];

              $sql = "SELECT * FROM tblclasses WHERE class_code NOT IN (SELECT class_code FROM tblstudentclasses WHERE username=?);";
              $stmt = $db->prepare($sql);
              $stmt->execute([$username]);
              while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='$row[class_code]'>$row[class_name]</option>";
              }
            ?>
          </select>
          <button type="submit" name="submit">Register</button>
        </form>
        <a href="studentprofilepg.php">View profile</a>
        <?php
      } else {
        ?>
        <a href="loginsp.php">Please log in to add/remove classes</a>
        <?php
      }
    ?>
    <div>
      <a href="logoutsp.php"><span class="glyphicon glyphicon-earphone"></span> Logout</a>
    </div>
  </body>
</html>

