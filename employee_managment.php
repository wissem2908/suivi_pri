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
                  Gestion des employés
                </h1>
                <p class="heading-desc">
                  Ajoutez, supprimez et consultez les employés de votre organisation.
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
                            Ajouter un employé
                        </h6>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body panel-body-form">
                            <form>
                                <div class="form-group form-group-mb">
                                    <label class="control-label mb-10" for="nom" style="color:#e15526;font-weight:600;">Nom</label>
                                    <div class="input-group input-group-style">
                                        <div class="input-group-addon input-group-addon-style"><i class="icon-user"></i></div>
                                        <input type="text" class="form-control form-control-radius" id="nom" placeholder="Nom">
                                    </div>
                                </div>
                                <div class="form-group form-group-mb">
                                    <label class="control-label mb-10" for="prenom" style="color:#e15526;font-weight:600;">Prénom</label>
                                    <div class="input-group input-group-style">
                                        <div class="input-group-addon input-group-addon-style"><i class="icon-user"></i></div>
                                        <input type="text" class="form-control form-control-radius" id="prenom" placeholder="Prénom">
                                    </div>
                                </div>
                                <div class="form-group form-group-mb">
                                    <label class="control-label mb-10" for="email" style="color:#e15526;font-weight:600;">Email</label>
                                    <div class="input-group input-group-style">
                                        <div class="input-group-addon input-group-addon-style"><i class="icon-envelope-open"></i></div>
                                        <input type="email" class="form-control form-control-radius" id="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group form-group-mb">
                                    <label class="control-label mb-10" for="dir" style="color:#e15526;font-weight:600;">Direction</label>
                                    <div class="input-group input-group-style">
                                        <div class="input-group-addon input-group-addon-style"><i class="icon-briefcase"></i></div>
                                        <select class="form-control dir form-control-radius" id="dir" placeholder="Direction">
                                        </select>
                                        <div data-toggle="modal" data-target="#responsive-modal-direction" style="cursor:pointer" id="add_direction" class="input-group-addon input-group-addon-style"><i class="icon-plus"></i></div>
                                    </div>
                                </div>
                                <div class="form-group form-group-mb">
                                    <label class="control-label mb-10" for="sous_dir" style="color:#e15526;font-weight:600;">Sous Direction</label>
                                    <div class="input-group input-group-style">
                                        <div class="input-group-addon input-group-addon-style"><i class="icon-people"></i></div>
                                        <select class="form-control form-control-radius" id="sous_dir">
                                            <option disabled selected>--Choisir--</option>
                                        </select>
                                        <div id="add_sous_direction" data-toggle="modal" data-target="#responsive-modal-sous-direction" style="cursor:pointer" class="input-group-addon input-group-addon-style"><i class="icon-plus"></i></div>
                                    </div>
                                </div>
                                <div class="form-group form-group-mb">
                                    <label class="control-label mb-10" for="fonction" style="color:#e15526;font-weight:600;">Fonction</label>
                                    <div class="input-group input-group-style">
                                        <div class="input-group-addon input-group-addon-style"><i class="fa fa-paper-plane"></i></div>
                                        <select class="form-control form-control-radius" id="fonction">
                                            <option disabled selected>--Choisir--</option>
                                        </select>
                                        <div data-toggle="modal" data-target="#responsive-modal-fonction" class="input-group-addon input-group-addon-style"><i class="icon-plus"></i></div>
                                    </div>
                                </div>
                                <div class="form-group form-group-mt">
                                    <button id="add_employee" class="btn btn-block btn-add-employee">Ajouter l'employé</button>
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
                            Liste des employés
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
                                                <th>Email</th>
                                                <th>Direction</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Nom</th>
                                                <th>Prénom</th>
                                                <th>Email</th>
                                                <th>Direction</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                        <tbody id="employee_list">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ******************************************** modal direction ****************************************************-->

        <div id="responsive-modal-direction" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title">Ajouter une direction</h5>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="nom_direction" class="control-label mb-10">Nom de la direction:</label>
                                <input type="text" class="form-control" id="nom_direction">
                            </div>
                            <div class="form-group">
                                <label for="desc_direction" class="control-label mb-10">Description:</label>
                                <textarea class="form-control" id="desc_direction"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button id="ajouter_direction" type="button" class="btn btn-danger">Sauvegarder</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- ******************************************** modal sous direction ************************************************* -->

        <div id="responsive-modal-sous-direction" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title">Ajouter une sous direction</h5>
                    </div>
                    <div class="modal-body">
                        <form>


                            <div class="form-group">
                                <br />
                                <label for="nom_sous_direction" class="control-label mb-10">Nom de la sous direction <span style='color:red'>*</span></label>
                                <input type="text" class="form-control" id="nom_sous_direction">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10" for="dir_form">Direction <span style='color:red'>*</span></label>
                                <div class="input-group">

                                    <select class="form-control dir" id="dir_form" placeholder="Direction">
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="desc_sous_direction" class="control-label mb-10">Description:</label>
                                <textarea class="form-control" id="desc_sous_direction"></textarea>
                            </div>
                            <span class="text-end" style='color:red'>(*) Champ obligatoire</span>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button id="ajouter_sous_direction" type="button" class="btn btn-danger">Sauvegarder</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- /********************************************* modal fonction  ********************************************************* */ -->
        <div id="responsive-modal-fonction" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h5 class="modal-title">Ajouter une fonction</h5>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="nom_direction" class="control-label mb-10">Nom de la fonction:</label>
                                <input type="text" class="form-control" id="nom_fonction">
                            </div>
                            <div class="form-group">
                                <label for="desc_direction" class="control-label mb-10">Description:</label>
                                <textarea class="form-control" id="desc_fonction"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button id="ajouter_fonction" type="button" class="btn btn-danger">Sauvegarder</button>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include('includes/footer.php');
        ?>

        <script src="assets/js/employee.js"></script>