<?php

session_start();
if(!isset($_SESSION['is_login']) || $_SESSION['is_login']!="true"){
	header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>Suivi PRI</title>
	<meta name="description" content="Doodle is a Dashboard & Admin Site Responsive Template by hencework." />
	<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Doodle Admin, Doodleadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
	<meta name="author" content="hencework" />

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/logo.png">
	<link rel="icon" href="assets/images/logo.png" type="image/x-icon">

	<!-- Data table CSS -->
	<link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />



	<!-- SweetAlert2 CSS -->
	<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.0/dist/sweetalert2.min.css" rel="stylesheet">

	<!-- multi-select CSS -->
	<link href="vendors/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />

	<!-- bootstrap-select CSS -->
	<link href="vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

	<!-- select2 CSS -->
	<link href="vendors/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />

	<!-- Colorpicker CSS -->
	<link href="vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css" />

	<!-- switchery CSS -->
	<link href="vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css" />

	<!-- bootstrap-tagsinput CSS -->
	<link href="vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css" />

	<!-- bootstrap-touchspin CSS -->
	<link href="vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />

	<!-- Bootstrap Switches CSS -->
	<link href="vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />

	<!-- Bootstrap Datetimepicker CSS -->
	<link href="vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
	<!-- Custom CSS -->
	<link href="dist/css/style.css" rel="stylesheet" type="text/css">
		<link href="assets/css/main.css" rel="stylesheet" type="text/css">
</head>

<body>
	<!--Preloader-->
	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div>
	<!--/Preloader-->
	<div class="wrapper theme-1-active pimary-color-red">

		<!-- Top Menu Items -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
						<a href="accueil.php">
							<img class="brand-img" src="assets/images/logo.png" alt="brand" width='68px' />
							<!-- <span class="brand-text">Suivi PRI</span> -->
						</a>
					</div>
				</div>
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>

			</div>

		</nav>
		<!-- /Top Menu Items -->

		<!-- Left Sidebar Menu -->
		<div class="fixed-sidebar-left">
			<ul class="nav navbar-nav side-nav nicescroll-bar">
				<!-- <li class="navigation-header">
					<span>Main</span> 
					<i class="zmdi zmdi-more"></i>
				</li>  -->
				<li><br /></li>

				<?php

if($_SESSION['role']=="admin"){
	?>
	<li>
					<a href="pri.php">
						<div class="pull-left">
							<button id="add_pri"
								class="btn"
								style="
									background: linear-gradient(200deg, rgb(243, 206, 175), rgb(202, 93, 0));
									color: #fff;
									font-weight: 500;
									border: none;
									border-radius: 5px;
									padding: 8px 20px;
									font-size: 0.7rem;
									box-shadow: 0 2px 10px rgba(255,115,0,0.10);
									display: flex;
									align-items: center;
									gap: 8px;
									transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
								"
								onmouseover="this.style.background='#e15526';this.style.transform='scale(1.03)';"
								onmouseout="this.style.background='linear-gradient(90deg, #ff7300, #e15526)';this.style.transform='scale(1)';"
							>
								<i class="fa fa-plus-circle"></i>
								Ajouter la PRI de ce mois
							</button>
						</div>
						<div class="clearfix"></div>
					</a>
				</li>
	<?php

}
?>
			
				<li>
					<a href="pri.php">
						<div class="pull-left"><i class="zmdi zmdi-book mr-20"></i><span class="right-nav-text">PRI</span></div>
						<div class="clearfix"></div>
					</a>
				</li>
				<li>
					<a href="historique_pri.php">
						<div class="pull-left"><i class=" fa fa-history mr-20"></i><span class="right-nav-text">Historique</span></div>
						<div class="clearfix"></div>
					</a>
				</li>



				<li>
					<hr class="light-grey-hr mb-10" />
				</li>

								<?php

if($_SESSION['role']=="admin"){
	?>
				<li>
					<a href="employee_managment.php">
						<div class="pull-left"><i class="fa fa-user mr-20"></i><span class="right-nav-text">Gestion des employées</span></div>
						<div class="clearfix"></div>
					</a>
				</li>

		<li>
					<a href="user_management.php">
						<div class="pull-left"><i class="fa fa-users mr-20"></i><span class="right-nav-text">Gestion des utilisateurs</span></div>
						<div class="clearfix"></div>
					</a>
				</li>



				<?php

}

?>




				<!-- <li>
					<a href="javascript:void(0);" data-toggle="collapse" data-target="#user_managememnt">
						<div class="pull-left"><i class="zmdi zmdi-landscape mr-20"></i><span class="right-nav-text">Gestion des utilisateurs</span></div>
						<div class="pull-right"><i class="zmdi zmdi-caret-down"></i></div>
						<div class="clearfix"></div>
					</a>
					<ul id="user_managememnt" class="collapse collapse-level-1">
						<li>
							<a href="index.html">Liste des utilisateurs</a>
						</li>
						<li>
							<a href="index2.html">Ajouter un utilisateur</a>
						</li>

					</ul>
				</li> -->

	<li style="position: absolute; bottom:0; text-align:center">

<a href="assets/php/logout.php"  class="btn btn-danger" style="background-color: #880d1e !important ; color:#fff; border-radius:0px 0px !important">
						<div class="pull-center"><i class="fa fa-power-off"></i>&nbsp;<span class="right-nav-text">Déconnexion</span></div>
						<div class="clearfix"></div>
					</a>
				
	</li>
					


			</ul>
		</div>
		<!-- /Left Sidebar Menu -->