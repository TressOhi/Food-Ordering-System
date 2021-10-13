<!doctype html>
<html lang="en">
	<head>
		<title> Fortress's Login Form </title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css">
      * {
        font-family: "Urbanist", sans-serif;
				box-sizing: border-box;
			}
		
			body {
				margin: 0px;
			}
			
			#container {

				height: 100vh;
				background-image:url("../assets/ChickenRepublic_HomePageBanner.jpg");
				background-position: center;
				background-size: cover;
				background-repeat: no-repeat;
				background-attachment: fixed;
				padding: 25px;
				display: flex;
				align-content: center;
				justify-content: center;			
			}
			
			#card {
			
				padding: 40px;
				padding-top:40px;
				padding-bottom:60px;
				box-shadow: 10px 10px 30px rgba(0,0,0,0.3);
				margin:auto;
				width:35%;
				background-color: rgba(0,0,0,0.7);
				color:white;
			
			}
			
			#card:hover {
			
				background-color: white;
				
				color: black;
				
			
			}
			
			#card:hover .input-field{
        color: black;
				border:none;
				border-bottom: 0.5px solid black;
				border-radius: 0;
				transition:1s;
			
			}
			
			#title{
			
				margin-bottom:40px
			
			}
			
			.input-field{
        color: white;
				width: 100%;
        outline: none;
        padding: 15px;
        margin-top:5px;
				background: transparent;
				border: none;
				border-bottom: 0.5px solid white;
			
			}
			
			#button{
			
				height: 40px;
				width: 150px;
				border-radius: 5px;
				background: #ff0000;
				border: 0;
        color: white;
        transition: .3s;
				cursor:pointer;
			
			}
			
			#button:hover{
        background: #ffe61c;
        color: #111111;
			
			}

			@media only screen and (max-width:1150px){
				#card{
					width: 45%;
				}
			}
		
			@media only screen and (max-width:870px){
				#card{
					width: 55%;
				}
			}

			@media only screen and (max-width:700px){
				#card{
					width: 75%;
				}
			}

			@media only screen and (max-width:470px){
				#card{
					width: 100%;
					padding: 40px 25px;
				}
			}
		</style>
	
	</head>
	
	
	<body>
	
		<div id="container">
		
			<div id="card">
			
				<h2 id="title">Login</h2>
			
				<form action="#" method="POST">
				
					<label for="username">Email:<label>
					<br>
					<input type="text" id="username" name="username" class="input-field">
					<br/><br>
					<label for="password">Password:</label>
					<br>
					<input type="password" id="password" name="password" class="input-field">
					<br/>
					<br>
					<input type="submit" value="Login" id="button">

				</form>
			
			</div>
		
		</div>
		
	</body>

		
</html>