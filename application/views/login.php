<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Hospital Management System</title>
    
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
     <meta content="Live Demo Hospital Management System,HMS is designed for medical practitioners and health-related institutions to assistant them in storing and keeping track of all correlated information such as patient medical records, admission/discharge reports, pharmaceutical management, billing and report generation and more. " name="description">
	 <meta content="free live demo hms,free live demo hospital management system,live demo,demo,live,hospital management system live demo,hospital management system free source codes,source codes,php,mysql,codeigniter,mvc,php frameworks,hospital management system,hospital,management,system,solution,online demo,demo hospital management system,live demo,demo trial,trial,hospital solution,clinic management system,clinic solution,management system,system,online management system" name="keywords">
	  <meta content="Jayson Sarino" name="author">

	  <meta property="og:site_name" content="Hospital Management System Free Trial Demo">
	  <meta property="og:title" content="Hospital Management System">
	  <meta property="og:description" content="Live Demo Hospital Management System,HMS is designed for medical practitioners and health-related institutions to assistant them in storing and keeping track of all correlated information such as patient medical records, admission/discharge reports, pharmaceutical management, billing and report generation and more.">
	  <meta property="og:type" content="website">
	  <meta property="og:image" content="http://hms-demo.jaysonsarino.com/public/img/new/hms_logo.png"><!-- link to image for socio -->
	  <meta property="og:url" content="http://hms-demo.jaysonsarino.com/">
    
	<link href="<?php echo base_url()?>public/login/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url()?>public/login/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

	<link href="<?php echo base_url()?>public/login/css/font-awesome.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	    
	<link href="<?php echo base_url()?>public/login/css/style.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url()?>public/login/css/pages/signin.css" rel="stylesheet" type="text/css">
	
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		
		body {
			font-family: 'Poppins', sans-serif;
			background: linear-gradient(135deg, #BCB686 0%, #c5ba7eff 100%);
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		
		.login-container {
			background: rgba(255, 255, 255, 0.95);
			border-radius: 20px;
			box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
			backdrop-filter: blur(10px);
			overflow: hidden;
			width: 100%;
			max-width: 900px;
			margin: 20px;
		}
		
		.login-wrapper {
			display: flex;
			min-height: 500px;
		}
		
		.login-image {
			flex: 1;
			background: linear-gradient(45deg, #e7f4ffff, #fefffeff);
			display: flex;
			align-items: center;
			justify-content: center;
			position: relative;
			overflow: hidden;
		}
		
		.login-image::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
			opacity: 0.3;
		}
		
		.login-image-content {
			text-align: center;
			color: white;
			z-index: 1;
			padding: 40px;
		}
		
		.login-image h2 {
			font-size: 2.5rem;
			font-weight: 600;
			margin-bottom: 20px;
			text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
		}
		
		.login-image p {
			font-size: 1.1rem;
			opacity: 0.9;
			line-height: 1.6;
		}
		
		.medical-icon {
			font-size: 4rem;
			margin-bottom: 20px;
			opacity: 0.8;
		}
		
		.login-form-section {
			flex: 1;
			padding: 60px 50px;
			display: flex;
			flex-direction: column;
			justify-content: center;
		}
		
		.logo-section {
			text-align: center;
			margin-bottom: 40px;
		}
		
		.logo-section img {
			max-width: 180px;
			height: auto;
			margin-bottom: 15px;
		}
		
		.welcome-text {
			color: #333;
			font-size: 1.8rem;
			font-weight: 600;
			margin-bottom: 10px;
			text-align: center;
		}
		
		.subtitle {
			color: #666;
			font-size: 0.95rem;
			text-align: center;
			margin-bottom: 30px;
		}
		
		.form-group {
			margin-bottom: 25px;
			position: relative;
		}
		
		.form-group label {
			display: block;
			font-weight: 500;
			color: #555;
			margin-bottom: 8px;
			font-size: 0.9rem;
		}
		
		.form-control {
			width: 100%;
			padding: 15px 20px;
			border: 2px solid #e1e5e9;
			border-radius: 10px;
			font-size: 1rem;
			transition: all 0.3s ease;
			background: #f8f9fa;
		}
		
		.form-control:focus {
			outline: none;
			border-color: #BCB686;
			background: white;
			box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
		}
		
		.form-control::placeholder {
			color: #aaa;
		}
		
		.btn-login {
			width: 100%;
			padding: 15px;
			background: linear-gradient(135deg, #706d58ff 0%, #BCB686 100%);
			border: none;
			border-radius: 10px;
			color: white;
			font-size: 1.1rem;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.3s ease;
			margin-top: 10px;
		}
		
		.btn-login:hover {
			transform: translateY(-2px);
			box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
		}
		
		.btn-login:active {
			transform: translateY(0);
		}
		
		.validation-errors {
			background: #fee;
			border: 1px solid #fcc;
			color: #c33;
			padding: 10px 15px;
			border-radius: 8px;
			margin-bottom: 20px;
			font-size: 0.9rem;
		}
		
		@media (max-width: 768px) {
			.login-wrapper {
				flex-direction: column;
				min-height: auto;
			}
			
			.login-image {
				min-height: 200px;
			}
			
			.login-image h2 {
				font-size: 1.8rem;
			}
			
			.login-form-section {
				padding: 40px 30px;
			}
			
			.welcome-text {
				font-size: 1.5rem;
			}
		}
		
		@media (max-width: 480px) {
			.login-container {
				margin: 10px;
			}
			
			.login-form-section {
				padding: 30px 20px;
			}
		}
	</style>


</head>

<body>
	<script src="<?php echo base_url()?>public/login/js/jquery-1.7.2.min.js"></script>
	<script language="javascript">
    $(document).ready(function(){
		
	});
    </script>

	<div class="login-container">
		<div class="login-wrapper">
			<!-- Left Side - Branding/Image -->
			<div class="login-image">
				<div class="login-image-content">
					<div class="medical-icon">
						<i class="fa fa-heartbeat"></i>
					</div>
					<!-- <h2>Unique Physiotherapy </h2> -->
				<!-- Logo Section -->
				<div class="logo-section">
					<img src="<?php echo base_url()?>public/img/logo_hero.png" alt="Hospital Management System Logo">
				</div>
				</div>
			</div>
			
			<!-- Right Side - Login Form -->
			<div class="login-form-section">

				
				<h1 class="welcome-text">Welcome Back</h1>
				<p class="subtitle">Please sign in to your account</p>

				<!-- Validation Errors -->
				<?php if(validation_errors()): ?>
					<div class="validation-errors">
						<?php echo validation_errors(); ?>
					</div>
				<?php endif; ?>

				<form action="<?php echo base_url()?>login/validate_login" method="post" id="frmLogin" name="frmLogin">
					<?php 
					$usernamelogin = isset($usernamelogin) ? $usernamelogin : "";
					$passwordlogin = isset($passwordlogin) ? $passwordlogin : "";
					?>

					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required value="<?php echo $usernamelogin; ?>">
					</div>

					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required value="<?php echo $passwordlogin; ?>">
					</div>

					<button type="submit" class="btn-login">
						<i class="fa fa-sign-in" style="margin-right: 8px;"></i>
						Sign In
					</button>
				</form>
			</div>
		</div>
	</div>

</body>

</html>

