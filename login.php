<?php
//  session_start();
//  if (isset($_SESSION["userID"]) && $_SESSION["uc"]=="BHW") {
//    header("Location:mainpage.php");
//  }
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/login.css">

	<title>BAHS Login</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5">Login</h5>
            <form action="loginprocess.php" method="post">
                <?php
                    if(isset($_GET["error"]))
                    {
                      if ($_GET["error"]=="emptyfields") {
                        echo "<p class=login_error >Fill in all the fields</p>";
                      }
                      else if ($_GET["error"]=="wrongpass") {
                        echo "<p class=login_error alert-danger>Password does not match</p>";
                      }
                      else if ($_GET["error"]=="wrong") {
                        echo "<p class=login_error alert-danger>Username or Password doesn' exist</p>";
                      }
                      else if ($_GET["error"]=="nouser") {
                       echo "<p class=login_error>No User Found!</p>";
                      }
                      else if ($_GET["error"]=="notuser") {
                        echo "<p class=login_error>Only BHW user can login!</p>";
                        // di ni mogana 
                       }
                      else if ($_GET["error"]=="call") {
                        echo "<p class=login_error>Something went wrong!</p>";
                       }
                    }
                    else if (isset($_GET["login"])) {
                       if ($_GET["login"]=="success") {
                       echo "<p class=login_success>Login Succesful!</p>";
                         }
                    }
                ?>
              <div class="form-floating mb-3">
                <input type="username"
                       class="form-control"
                       id="floatingInput"
                       name="user1"
                       placeholder="Username">
                <label for="floatingInput">Username</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password"
                       class="form-control"
                       id="floatingPassword"
                       name="pass"
                       placeholder="Password">
                <label for="floatingPassword">Password</label>
              </div>
              
              <div class="form-group col-md-12">
                <label for="title" class="form-label">User Type:</label>
										<select name="type" id="usertypename" class="custom-select">  
                      <!-- <option selected>Select type of User</option> -->
											<option value="BHW"> BHW </option>
											<option value="Nurse"> Midwife </option>
											<option value="Midwife"> Nurse </option>		
                    </select>
              </div>

              <div class="form-check mb-3">
                <input class="form-check-input"
                       type="checkbox"
                       value=""
                       id="rememberPasswordCheck">
                <label class="form-check-label" for="rememberPasswordCheck">
                  Remember password
                </label>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="login">Login</button>
              </div>
              <hr class="my-4">
              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>