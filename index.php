<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>The Catholic Church</title>

   <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="assets/css/css/main.css" />
   <link rel="stylesheet" href="assets/css/css/etgcustom.css" />
   <link href="assets/css/css/plugins.css" rel="stylesheet" type="text/css">
   
   <script src="etgjs/pageredirect.js"></script>
 	<script type="text/javascript" src="js/jquery.min.js"></script>
   <!-- END THEME STYLES -->

</head>

<body>
    <div id="login-background">
        <img src="assets/headers/header.png" alt="Login Background" class="animation-pulseSlow" />
    </div>
    
    <div id="login-container" class="animation-fadeIn">

        <div id="busyIndicator">
            <img src="assets/img/ajax-loader.gif" />
        </div>
        <div id="bodysection">
             <div class="login-title text-center">
                <h1>
                    <img src="assets/img/church_logo.png" /><br />
                    <small><strong>Login</strong> </small></h1>
            </div>
            <div class="block remove-margin" id="content">
                <div class="form-group">
                    <div class="col-xs-12">
                        
                            
                            
                            
                    		<?php 
							if(isset($_GET['msg'])){
								echo "<div class='alert alert-danger alert-dismissable' data-bind='visible: ErrorDivVisible'>";
								echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>";
								echo "<strong>Warning!</strong>";
								echo "<br />";
								$msg = $_GET['msg'];  //GET the message
								
								
								if($msg!='') echo $msg; //If message is set echo it
								
								echo "</div>";
							}
							else
							{
							}
							?>
                        
                    </div>
                </div>

				<form action="login.php" method="POST" name="loginn" id="loginn">
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                            <input type="text" id="username" name="username" class="form-control input-lg"
                                placeholder="Username"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                            <input type="password" id="password" name="password" class="form-control input-lg"
                                placeholder="Password" />
                        </div>
                    </div>
                </div>
                <div class="form-group form-actions">
                    <div class="col-xs-6">
                    </div>
                    <div class="col-xs-6 text-right">
                        <button type="submit" class="btn btn-sm btn-primary"><b>Sign In</b></button>
                    </div>
                </div>
                 </form>
                <script src="etgjs/animationsettings.js"></script>
                
            </div>
        </div>

    </div>
    
</body>
</html>