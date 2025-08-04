
<?php
if ($_POST)
{
	header("Location:../config/login-exe.php?username=".$_POST['inputUserName']."");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>E-FORM-Login</title>
        <link href="css/styles.css" rel="stylesheet" />
        <!--script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script-->
		<script type="text/javascript">
			function validity_input(form){
			if (form.inputUserName.value == ""){
				alert("Username Domain is Empty !");
				form.inputUserName.focus();
				return (false);  		}
			else if (form.inputPassword.value == ""){
				alert("Password Domain is Empty !");
				form.inputPassword.focus();
				return (false);  		}
				return (true);
			}
		</script>		

    </head>
    <body class="bg-secondary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            
        <div class="col-lg-5"> 
          <div class="card shadow-lg border-0 rounded-lg mt-5"> 
            <div class="card-header"> 
              <h3 class="text-center font-weight-light my-4">E-FORM Login</h3>
            </div>
            <div class="card-body"> 
              <form action="" name="login" method="post" onSubmit="return validity_input(login)">
			 <font color="#FF0000"> <?php if (isset($err)) echo "<div class='errmsg'>". $err ."</div>"; ?></font>
                <div class="form-group"> 
                  <label class="small mb-1" for="inputUserName">User Name</label>
                  <input class="form-control py-4" name="inputUserName" id="inputUserName" type="text" placeholder="Enter User Name" />
                </div>
                <div class="form-group"> 
                  <label class="small mb-1" for="inputPassword">Password</label>
                  <input class="form-control py-4" name="inputPassword" id="inputPassword" type="password" placeholder="Enter password" />
                </div>
                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><!--a class="small" href="password.html">Forgot 
                  Password?</a-->
				   <input class="btn btn-primary"  type="submit" name="submit" value="Login">
				</div>
              </form>
            </div>
            <div class="card-footer text-center"> </div>
          </div>
        </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">IT Team</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
