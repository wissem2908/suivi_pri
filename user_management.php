<?php
ob_start(); 
include('includes/header.php');

if(isset($_SESSION['role']) && $_SESSION['role']=="utilisateur"){
	header('location:pri.php');
}
?>

<style>
  
</style>
<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg heading-bg-margin">
            <div class="col-12 heading-bg-center">
                <img src="assets/images/logo.png" alt="Logo PRI" class="logo-img">
                <h1 class="heading-title">
                  Gestion des utilisateurs
                </h1>
                <p class="heading-desc">
                  Ajoutez, supprimez et consultez les utilisateurs de l'application.
                </p>
            </div>
        </div>
        <!-- /Title -->
<br/><br/><br/><br/><br/>
        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-success card-view panel-form-bg">
                    <div class="panel-heading panel-heading-gradient">
                        <span class="panel-heading-icon">
                            <i class="fa fa-user-plus"></i>
                        </span>
                        <h6 class="panel-title txt-light panel-title-style">
                            Ajouter un utilisateur
                        </h6>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body panel-body-form">
                            <form>
                                <div class="form-group form-group-mb">
                                    <label class="control-label mb-10" for="nom_prenom">Nom et prénom</label>
                                    <div class="input-group input-group-style">
                                        <div class="input-group-addon input-group-addon-style"><i class="icon-briefcase"></i></div>
                                        <select class="form-control form-control-radius" id="nom_prenom">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-group-mb">
                                    <label class="control-label mb-10" for="username">Nom d'utilisateur</label>
                                    <div class="input-group input-group-style">
                                        <div class="input-group-addon input-group-addon-style"><i class="icon-user"></i></div>
                                        <input type="text" class="form-control form-control-radius" id="username" placeholder="Nom d'utilisateur">
                                    </div>
                                </div>
                                <div class="form-group form-group-mb">
                                    <label class="control-label mb-10" for="password">Password</label>
                                    <div class="input-group input-group-style">
                                        <div class="input-group-addon input-group-addon-style"><i class="icon-user"></i></div>
                                        <input type="password" class="form-control form-control-radius" id="password" placeholder="*********">
                                        <div style="cursor:pointer" class="input-group-addon input-group-addon-style" id="togglePassword"><i class="icon-eye"></i></div>
                                        <div style="cursor:pointer" class="input-group-addon input-group-addon-style" id="generatePassword"><i class="icon-refresh"></i></div>
                                    </div>
                                </div>
                                <div class="form-group form-group-mb">
                                    <label class="control-label mb-10" for="role">Role</label>
                                    <div class="input-group input-group-style">
                                        <div class="input-group-addon input-group-addon-style"><i class="icon-people"></i></div>
                                        <select class="form-control form-control-radius" id="role">
                                            <option disabled selected>--Choisir--</option>
                                            <option value="admin">Admin</option>
                                            <option value="utilisateur">Utilisateur</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group form-group-mt">
                                    <button id="add_user" class="btn btn-block btn-add-user">Ajouter l'utilisateur</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="panel panel-success card-view panel-list-bg">
                    <div class="panel-heading panel-heading-gradient">
                        <span class="panel-heading-icon">
                            <i class="fa fa-users"></i>
                        </span>
                        <h6 class="panel-title txt-light panel-title-style">
                            Liste des utilisateurs
                        </h6>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table id="datable_1" class="table table-hover display pb-30 table-style">
                                        <thead>
                                            <tr>
                                                 <th>#</th>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>username</th>
                                                <th>role</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                 <th>#</th>
                                                   <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>username</th>
                                                <th>role</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                        <tbody id="users_list">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include('includes/footer.php');
        ?>

        <script src="assets/js/users.js"></script>