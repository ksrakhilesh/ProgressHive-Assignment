<?php session_start();?>
<?php
if(isset($_POST['email']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
	$data =$_POST['email'];
	if($data === ''){
		echo "empty";
		die();
	}
	if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
		echo "notValid";
		die();
	}
	$getData = file_get_contents("emails.json");
	$obj = json_decode($getData, true);
	foreach ($obj['emails'] as $value) {
		if($value['email'] === $data){
			echo "true";
			die();
		}
	}
	echo "false";
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="ProgressHive Assignment">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ProgressHive Assignment</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/paper/bootstrap.min.css">
	<link href="styles.css" rel="stylesheet" type="text/css" media="screen, projection"/>
</head>
<body>   

	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>                        
				</button>
				<a class="navbar-brand" href="#">ProgressHive Assignment</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="#">Page 1-1</a></li>
							<li><a href="#">Page 1-2</a></li>
							<li><a href="#">Page 1-3</a></li>
						</ul>
					</li>
					<li><a href="#">Page 2</a></li>
					<li><a href="#">Page 3</a></li>
				</ul>
				
			</div>
		</div>
	</nav>
	<div class="container">
		<form class="form-horizontal" method="post" id="myForm" action ="index.php">
			<fieldset>
				<legend>Verify Your Email Id (post)</legend>
				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label" for="email"><strong>Email:</strong></label>
					<div class="col-sm-6">
						<input class="form-control" type="email" id="email" placeholder="Email address" required>
						<p class="Validator text-success" id="successful">Valid Email Id.</p>
						<p class="Validator text-danger" id="failed">Email Id Does not Exist.</p>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2">
						<button class="btn btn-primary" id="submit" type="submit" style="margin-left: 2em;">Verify</button>
						<button class="btn btn-default" id="clear" type="reset">Clear</button>
					</div>
				</div>
			</fieldset>
		</form>

		<hr>
		<form class="form-horizontal" method="post" id="ajaxForm" action ="index.php">
			<fieldset>
				<legend>Verify Your Email Id (Ajax)</legend>
				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label" for="email"><strong>Email:</strong></label>
					<div class="col-sm-6">
						<input class="form-control" type="text" id="email1" placeholder="Email address" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<span class="label label-success" id="ajaxLabel"></span>
					</div>
				</div>
			</fieldset>
		</form>
		<hr>
		<form class="form-horizontal" method="post" action ="checkMail.php">
			<fieldset>
				<legend>Verify Your Email Id (Normal)</legend>

				<div class="form-group form-group-lg">
					<label class="col-sm-2 control-label" for="email"><strong>Email:</strong></label>
					<div class="col-sm-6">
						<input class="form-control" type="email" name ="email" placeholder="Email address" required>
						<?php if(isset($_SESSION["valid"]) && !empty($_SESSION['valid']) && $_SESSION['valid'] != '' ) {?>
						<p class=" <?php echo $_SESSION['state'] ?>"><strong><em> <?php echo $_SESSION['valid'] ?></em></strong></p>
						<?php session_destroy(); }?>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-offset-2">
						<button class="btn btn-primary" type="submit" style="margin-left: 2em;">Verify</button>
						<button class="btn btn-default"  type="reset">Clear</button>
					</div>
				</div>
				
			</fieldset>
		</form>
	</div>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts.js" type="text/javascript"></script>
</body>
</html>