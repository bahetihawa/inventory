<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>ITCombine: Log in Form </title>
    
    
    
    <link rel='stylesheet prefetch' href='http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css'>

        <link rel="stylesheet" href="<?= ASSETS;?>/css/login.css">
		<script src="<?= ASSETS;?>/js/jquery-3.1.1.js"></script>
    
  </head>

  <body>
	  
	<div id="loginform">
		<div id="facebook"><i class="fa fa-facebook"></i><div id="connect">Supported By: ITCombine</div></div>
		<div id="mainlogin">
			<div id="or" class="fa fa-check"></div>
			<h1 id="message">Log in with awesome new thing</h1>
			<form action="#">
				<input type="text" placeholder="username or email" value="" name="userId" required>
				<input type="password" placeholder="password" name="password" value="" required>
				<button type="submit"><i class="fa fa-arrow-right"></i></button>
			</form>
			<div id="note"><a href="#">Forgot your password?</a></div>
		</div>
	</div>  
	<script src="<?= ASSETS;?>/js/bootstrap.min.js"></script>
	<script>
		$("button").click(function(e){
			e.preventDefault();
			$.post("Controls/loginControl.php",{
				id : "ndjfkvjgn"
			},
			function(data){
				alert(data)
				if(data == "success")
					window.location.href = "";
				else
					$("#message").text("error");
			});
		});
	</script>
 </body>
</html>
