<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title;?></title>
	<script src="/assets/jquery.js"></script>
	<link href="/assets/css/materialize.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
	<script src="/assets/js/materialize.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
</head>
<body>
	<nav>
		<div class="nav-wrapper">
			<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li id="home">
					<a href="/">Home</a>
				</li>
				<li id="detailAntrian">
					<a href="/antrian">Detail Antrian</a>
				</li>
				<?php if(session()->status){?>
					<li id="admin">
						<a href="/admin">Admin</a>
					</li>
					<li id="pelayanan">
						<a href="/admin/pelayanan">Pelayanan</a>
					</li>
					<li id="loket">
						<a href="/admin/loket">Loket</a>
					</li>
					<li id="logout">
						<a href="/logout">Logout</a>
					</li>
				<?php }else{ ?>
					<li id="login">
						<a href="/login">Login</a>
					</li>
				<?php } ?>
			</ul>
		</div>
	</nav>

	<ul class="sidenav" id="mobile-demo">
		<li id="detailAntrian">
			<a href="/antrian">Detail Antrian</a>
		</li>
		<?php if(session()->login){?>
			<li id="admin">
				<a href="/admin">Admin</a>
			</li>
			<li id="pelayanan">
				<a href="/admin/pelayanan">Pelayanan</a>
			</li>
			<li id="loket">
				<a href="/admin/loket">Loket</a>
			</li>
			<hr>
			<li id="logout">
				<a href="/logout">Logout</a>
			</li>
		<?php } ?>
  </ul>