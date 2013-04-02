<?
session_start();
if(isset($_SESSION['login'])){
  header("Location: http://localhost/wordpress/news");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>LUMS Carpooling System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Abdul Aleem Khan">
    
	<link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">
	
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
	<?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>
	<?php
	$flag = 0;
	$message = "";
		if(isset($_REQUEST['submit'])){
			$type = $_REQUEST['dowhat'];
			$flag = $type;
			connect_db();
			$userid = $_REQUEST["userid"];
			$password = $_REQUEST["password"];
			if($type == 0 .""){
				if($userid !="" && $password !=""){
					if(login_query($userid, $password)){
						$_SESSION['login'] = true;
						$_SESSION['userid'] = $userid;
						header("Location: http://localhost/wordpress/news");
					}else{
						$message = "Invalid Username or Password!";
					}
				}
			}elseif($type == 1 .""){
				$name = $_REQUEST["username"];
				if($name != "" && $userid !="" && $password !=""){	
					if(signup_query($userid, $name, $password)){
						$_SESSION['login'] = true;
						$_SESSION['userid'] = $userid;
						header("Location: http://localhost/wordpress/news");
					}else{
						$message = "Information is not sufficient!";
					}
				}	
			}else{
				$message = "Something went wrong! Please Try Again.";
			}
		}

	?>
	
	
	
	  <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
  </head>

  <body>
	
    <div class="container">
		
		<div id="form-div">
		
		</div>
	  
      <hr>

      <footer>
        <p>&copy; Software Engineering Group 2 Spring Semester 2012-13</p>
      </footer>

    </div> <!-- /container -->
	
	<script>
	
	
	//HTML Strings for different forms
	
	var login_string = '<form action="" method="POST" class="form-signin">';
		login_string+= '<p><?php echo $message;?></p>';
		login_string+= '<input type="hidden" name="dowhat" value="0">';
        login_string+= '<input type="text" name="userid" class="input-block-level" placeholder="Campusmail ID">';
        login_string+= '<input type="password" name="password" class="input-block-level" placeholder="Password">';
        login_string+= '<button class="btn btn-medium btn-primary" type="submit" name="submit">Log in</button>';
		login_string+= '<hr>';
		login_string+= '<button class="btn btn-medium btn-block btn-primary" type="button" onclick="loadForm(1)">Don\'t have an account. Signup here</button>';
		login_string+= '</form>';
	
	var signup_string = '<form action="" method="POST" class="form-signin">';
		signup_string+= '<p><?php echo $message;?></p>';
		signup_string+= '<input type="hidden" name="dowhat" value="1">';
		signup_string+= '<input type="text" name="username" class="input-block-level" placeholder="Full Name">';
		signup_string+= '<input type="text" name="userid" class="input-block-level" placeholder="Campusmail ID">';
        signup_string+= '<input type="password" name="password" class="input-block-level" placeholder="Password">';
        signup_string+= '<button class="btn btn-medium btn-primary" type="submit" name="submit">Sign in</button>';
		signup_string+= '<hr>';
		signup_string+= '<button class="btn btn-medium btn-block btn-primary" type="button" onclick="loadForm(0)">Already a member. Login here</button>';
		signup_string+= '</form>';
	
	// function to load different forms	
		function loadForm(checker){
			
			if(checker == 0){
				document.getElementById("form-div").innerHTML = login_string;
			}else if(checker == 1){
				document.getElementById("form-div").innerHTML = signup_string;
			}else{
				document.getElementById("form-div").innerHTML = login_string;
			}
		}
		
		
		var loadFormVar = "<?php echo $flag;?>";
		
		
		// function to validate a from
		function validateForm11(e){
			if(e == 1){
				var email = $("input[name = email]").val();
				var password = $("input[name = password]").val();
				if( email != "" && isEmail(email)){
					if(password !=""){
						//$('.form-signin').submit();
						return true;
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				var name = $("input[name = name]").val();
					alert("name: "+ name);
				var email = $("input[name = email]").val();
				var password = $("input[name = password]").val();
				if(name != ""){
					if( email != "" && isEmail(email)){
						if(password !=""){
							//$('.form-signin').submit();
							return true;
						}else{
							return false;
						}
					}else{
						
						return false;
					}
				}else{
					return false;
				}
			}
			
		}
		
		function isEmail(e)
		{
		  var emailPattern = new RegExp(/^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/);
		  return(emailPattern.test(e));
		}
		
		
		
		// Loading login page initially
		loadForm(loadFormVar);
	</script>
  </body>
</html>		
