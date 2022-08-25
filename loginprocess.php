<?php
  require "db.php";
  if (isset($_POST["login"])) 
  {

    $uid=$_POST["user1"];
    $pswd=$_POST["pass"];
    $type=$_POST["type"];

    if(empty($uid) || empty($pswd))
    {
      header("Location:Login.php?error=emptyfields");
      exit();
    }
    else if($stmt = $connection->prepare("SELECT * FROM user WHERE user_username=:user_username") )
    {
      
      $stmt->bindParam(':user_username', $uid, PDO::PARAM_STR);

        if (!$stmt->execute()) {
          header("Location:Login.php?error=sqlerror");
          exit();
        }
        else
        {
          if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
          {
              if($pswd !== $row["user_password"]){
                  header("Location:Login.php?error=wrongpass");
                  exit();
              }
              else if ($pswd == 'admin') {
                  session_start();
                    $_SESSION["username"] = $row["user_username"];
                    header("Location:production/index3.html");
              }
              else if ($pswd == $row["user_password"]) 
              {
                    // THIS CODELINE MONITOR EVERYTIME WHEN THE USER WAS LOGIN
                // $stmt = $connection->prepare("INSERT INTO loginform (user_ID, date_time) VALUES ((SELECT user_ID FROM user WHERE user_username=:user_username), current_timestamp())");
                // $stmt->bindParam(':user_username', $uid, PDO::PARAM_STR);
                // $stmt->execute();
                // $type = "BHW"
                $stmt = $connection->prepare("SELECT * FROM usertype WHERE usertype_name =:type");
                $stmt->bindParam(':type', $type, PDO::PARAM_STR);
                $stmt->execute();
                if($row1 = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                  switch($type){
                    case "BHW":
                      session_start();
                      $_SESSION["username"] = $row["user_firstname"];
                      $_SESSION["userID"] = $row["usertype_ID"];
                      $_SESSION["usertype"] = "BHW";
                      header("Location:production/index.php");
                      break;
                    case "Midwife":
                      session_start();
                      $_SESSION["username"] = $row["user_firstname"];
                      $_SESSION["userID"] = $row["usertype_ID"];
                      $_SESSION["usertype"] = "Midwife";
                      header("Location:production/index2.html");
                      break;
                    case "Nurse":
                      session_start();
                      $_SESSION["username"] = $row["user_firstname"];
                      $_SESSION["userID"] = $row["usertype_ID"];
                      $_SESSION["usertype"] = "Nurse";
                      header("Location:production/index3.html");
                      break;
                    default:
                      header("Location:Login.php?error=nouser");
                  }
                  // if ($type !== "BHW" || $type !== "Midwife" || $type !== "Nurse"){
                  //   header("Location:Login.php?error=nouser");
                  // }
                  // if($type == "BHW"){
                  //   session_start();
                  //   $_SESSION["username"] = $row["user_firstname"];
                  //   $_SESSION["userID"] = $row["usertype_ID"];
                  //   $_SESSION["usertype"] ="BHW";
                  //   header("Location:production/index.php");
                  // }
                  // else if ($type == "Midwife"){
                  //   session_start();
                  //   $_SESSION["username"] = $row["user_firstname"];
                  //   $_SESSION["userID"] = $row1["usertype_ID"];
                  //   $_SESSION["usertype"] ="Midwife";
                  //   header("Location:production/index2.html");
                  // }
                  // else if ($type == "Nurse"){
                  //   session_start();
                  //   $_SESSION["username"] = $row["user_firstname"];
                  //   $_SESSION["userID"] = $row1["usertype_ID"];
                  //   $_SESSION["usertype"] ="Nurse";
                  //   header("Location:production/index3.html");
                  // }
                  // else{
                  //   header("Location:Login.php?error=nouser");
                  // exit();
                  // }

                }
                else{
                  header("Location:Login.php?error=call");
                  exit();
                }
              }
          }
          else {
            header("Location:Login.php?error=wrong");
            exit();
          }
        }
    }
    else 
    {
      header("Location:Login.php?error=call");
      exit();
    }
      
    
  }
  else{
    header("Location:index.php");
    exit();
  }
?>
