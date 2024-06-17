<?php
    session_start();
    require "configsp.php";
?><!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <h1>Welcome to the student profile page</h1>
        <div id="error_div">
            <?php
                if(isset($_POST['drop_class'])){

                    $sql = "DELETE FROM tblstudentclasses WHERE username=? AND class_code=?";
                    $stmtinsert = $db->prepare($sql);
                    $result = $stmtinsert->execute([$_SESSION['username'], $_POST['drop_class']]);
                    if($result){
                        echo "$_POST[drop_class] CLASS DROPPED";
                    }else{
                        echo 'ERROR DROPING CLASS';
                    }

                }
            ?>
        </div>
        <?php
            if (isset($_SESSION['username'])) {

                $sql = "SELECT * FROM tblstudent WHERE username = :id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $_SESSION['username'], PDO::PARAM_STR);
                $stmt->execute();


                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <h2>Welcome to your profile <?=$row['fullName']?></h2>
                <div>User Name: <?=$row['username']?></div>
                <div>Phone Number: <?=$row['number']?></div>
                <div>Email Address: <?=$row['email']?></div>
                <?php
                $sql = "SELECT * FROM tblstudentclasses WHERE username = :id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':id', $_SESSION['username'], PDO::PARAM_STR);
                $stmt->execute();
                if($stmt->rowCount() == 0) {
                    echo "Not registered for any classes<br>";
                }
                else {
                    ?>
                    Class List:<br>
                    <form method="POST">
                        <ul>
                        <?php
                        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <li style='padding: 5px'>
                                <b><?=$row['class_code']?></b>
                                <button name='drop_class' value='<?=$row['class_code']?>'>
                                    Drop
                                </button>
                            </li>
                            <?php
                        } 
                        ?>
                        </ul>
                    </form>
                    <?php
                }
                ?>
                <div><a href="classes.php">Add Class</a></div>
                <div><a href="Logoutsp.php">Logout</a></div>
                <?php
            }
            else {
                echo '<a href="loginsp.php">Please log in to add/remove classes</a>';
            }
        ?>
    </body>
</html>
        
