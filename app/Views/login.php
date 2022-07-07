<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title;?></title>
	<script src="/assets/jquery.js"></script>
	<link href="/assets/css/materialize.min.css" rel="stylesheet">
	<script src="/assets/js/materialize.min.js"></script>
	<style>
		html,
		body {
			height: 100%;
		}

		body {
			display: flex;
			align-items: center;
			padding-top: 40px;
			padding-bottom: 40px;
			background-color: #f5f5f5;
		}

		.form-signin {
			width: 100%;
			max-width: 330px;
			padding: 15px;
			margin: auto;
		}

		.form-signin .checkbox {
			font-weight: 400;
		}

		.form-signin .form-floating:focus-within {
			z-index: 2;
		}

		.form-signin input[type="email"] {
			margin-bottom: -1px;
			border-bottom-right-radius: 0;
			border-bottom-left-radius: 0;
		}

		.form-signin input[type="password"] {
			margin-bottom: 10px;
			border-top-left-radius: 0;
			border-top-right-radius: 0;
		}
	</style>
</head>
<body class="text-center">
	<main class="form-signin">
		<?= form_open('/login/proses', 'autocomplate="off"'); ?>
			<h4 style="text-align:center">Silahkan Login</h4>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" class="validate" id="username" name="username" value="<?= old('username');?>" required>
					<label for="user">User</label>
					<span class="form-text" style="color:#e74c3c;"><?= $validation->getError('username');?></span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="input-field col s12">
					<input type="password" class="validate" id="password" name="password" value="<?= old('password');?>" required>
					<label for="password">Password</label>
					<span class="form-text" style="color:#e74c3c;"><?= session()->getFlashdata('passwordSalah');?></span>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="input-field col s12">
					<button class="waves-effect waves-light btn" type="submit">Sign in</button>
				</div>
			</div>
		<?= form_close();?>
	</main>

	<script>
		$(document).ready(function(){
			$('#login').attr("class", "active");
		});
	</script>
</body>
</html>