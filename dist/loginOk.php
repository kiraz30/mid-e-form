<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

define('DOMAIN_FQDN', 'mandom.local');
define('LDAP_SERVER', '10.1.106.12');

if (@$_POST['submit'])
{
    $user = strip_tags($_POST['inputUserName']) .'@'. DOMAIN_FQDN;
    $pass = stripslashes($_POST['inputPassword']);

    $conn = ldap_connect("ldap://". LDAP_SERVER ."/");

    if (!$conn)
        $err = 'Could not connect to LDAP server';

    else
    {
        //define('LDAP_OPT_DIAGNOSTIC_MESSAGE', 0x0032);

        ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($conn, LDAP_OPT_REFERRALS, 0);

        $bind = @ldap_bind($conn, $user, $pass);

        ldap_get_option($conn, LDAP_OPT_DIAGNOSTIC_MESSAGE, $extended_error);

        if (!empty($extended_error))
        {
            $errno = explode(',', $extended_error);
            $errno = $errno[2];
            $errno = explode(' ', $errno);
            $errno = $errno[2];
            $errno = intval($errno);

            if ($errno == 532)
                $err = 'Unable to login : Password expired';
        }

        elseif ($bind)
        {
            $base_dn = array("CN=Users,DC=". join(',DC=', explode('.', DOMAIN_FQDN)), 
                "OU=Users,OU=People,DC=". join(',DC=', explode('.', DOMAIN_FQDN)));

            $result = ldap_search(array($conn,$conn), $base_dn, "(cn=*)");

            if (!count($result))
                $err = 'Unable to login : '. ldap_error($conn);

            else
            {
                foreach ($result as $res)
                {
                    $info = ldap_get_entries($conn, $res);

                    for ($i = 0; $i < $info['count']; $i++)
                    {
                        if (isset($info[$i]['userprincipalname']) AND strtolower($info[$i]['userprincipalname'][0]) == strtolower($user))
                        {
                            session_start();

                            $username = explode('@', $user);
                            $_SESSION['foo'] = 'bar';

                            // set session variables...

                            break;
                        }
                    }
                }
            }
        }
    }

    // session OK, redirect to home page
    if (isset($_SESSION['foo']))
    {
        header( 'Location:/' );
        exit();
    }

    elseif (!isset($err)) $err = 'Unable to login : '. ldap_error($conn);
 if (ldap_error($conn)=="Success") {
        header( "Location:../config/login-exe.php?username=".$_POST['inputUserName'] );
        exit();
    }
   ldap_close($conn);
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
			<link  href="../img/logoEform.png" rel="shortcut icon" />

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
                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0"><a href="" >
				<i class="fa-question-circle" title="Help"></i></a>
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
