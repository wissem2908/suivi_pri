<?php

session_start();
if(isset($_SESSION['is_login']) and $_SESSION['is_login']=="true"){
	header('location:accueil.php');
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Connexion PRI</title>
	<link rel="shortcut icon" href="assets/images/logo.png">
	<link rel="icon" href="assets/images/logo.png" type="image/x-icon">
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.0/dist/sweetalert2.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
	<link href="assets/css/login.css" rel="stylesheet" type="text/css">
</head>

<body>
	<div class="login-wrapper">
		<div class="glass-card">
			<h2>Connexion PRI</h2>
			<p>Suivi de la Prime de Rendement Individuel</p>

			<form>
				<div class="form-group">
					<label for="username">Nom d'utilisateur</label>
					<input type="text" id="username" placeholder="Nom d'utilisateur" required>
				</div>

				<div class="form-group">
					<label for="password">Mot de passe</label>
					<input type="password" id="password" placeholder="********" required>
					<span class="toggle-password" id="togglePassword">👁</span>
				</div>

				<div class="actions"></div>
				<button id="login" type="submit">Se connecter</button>
			</form>
		</div>
	</div>
	<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.0/dist/sweetalert2.all.min.js"></script>
	<script>
		document.getElementById("togglePassword").addEventListener("click", function () {
			const passwordInput = document.getElementById("password");
			const isPassword = passwordInput.type === "password";
			passwordInput.type = isPassword ? "text" : "password";
			this.textContent = isPassword ? "🙈" : "👁";
		});

		$(document).ready(function () {
			$('#login').click(function (e) {
				e.preventDefault()
				var username = $('#username').val();
				var password = $('#password').val();

				$.ajax({
					url: 'assets/php/login.php',
					method: 'post',
					data: { username: username, password: password },
					success: function (response) {
						console.log(response)
						var data = JSON.parse(response);
						if (data.response == "false") {
							if (data.message == 'empty_field') {
								Swal.fire({ icon: "error", title: "Oops...", text: "Veuillez remplir tous les champs!" });
							} else if (data.message == 'user_not_found') {
								Swal.fire({ icon: "error", title: "Oops...", text: "Verifier votre nom d'uilisateur ou mot de passe!" });
							}
						} else if (data.response == "true") {
							window.location = 'accueil.php'
						}
					}
				})
			})
		})
	</script>
</body>

</html>
