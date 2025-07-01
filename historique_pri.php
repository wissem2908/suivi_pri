<?php
include('includes/header.php');

$role = $_SESSION['role'];
$direction = $_SESSION['direction'];
//echo $role;
?>
<style>

</style>

<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <input type="hidden" id="id_sous_dir" />
        <!-- Title -->
        <div class="row heading-bg heading-bg-margin">
            <div class="col-12 heading-bg-center">
                <img src="assets/images/logo.png" alt="Logo PRI" class="logo-img">
                <h1 class="heading-title">
                  Historique PRI
                </h1>
                <p class="heading-desc">
                  Filtrez, consultez et imprimez l'historique des PRI.
                </p>
            </div>
            <input type="hidden" value="<?php echo $direction; ?>" id="direction_user" />
            <input type="hidden" value="<?php echo $role; ?>" id="role_user" />
        </div>

        <br><br><br><br><br>
        <!-- /Title -->
        <div class="panel-wrapper collapse in">
            <div class="panel-body">
                <div class="pills-struct vertical-pills ">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12  col-xs-12">
                                    <div class="panel panel-success card-view">
                                        <div class="panel-heading" style="background: linear-gradient(to right, #fff, #e69a2a) !important;">
                                            <span style="display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;background: linear-gradient(to right, #e15526, #e69a2a) !important;border-radius:50%;margin-right:14px;box-shadow:0 1px 4px rgba(255,115,0,0.13);">
                                                <i class="fa fa-history" style="font-size:1.3rem;color:#fff;"></i>
                                            </span>
                                            <h6 class="panel-title txt-light panel-title-style">
                                                Historique PRI
                                            </h6>
                                        </div>
                                        <div class="panel-wrapper collapse in">
                                            <div class="panel-body">
                                                <form>
                                                    <div class="row">
                                                        <div class="form-group mb-0 col-lg-6">
                                                            <label class="control-label mb-10">Direction</label>
                                                            <select class="select2 select2-multiple" multiple="multiple" data-placeholder="Chosir" id="dir_list"></select>
                                                        </div>
                                                        <div class="form-group mb-0 col-lg-6">
                                                            <label class="control-label mb-10">Sous direction</label>
                                                            <select class="select2 select2-multiple" multiple="multiple" data-placeholder="Chosir" id="s_dir_list"></select>
                                                        </div>
                                                        <div class="form-group mb-0 col-lg-4">
                                                            <label class="control-label mb-10">Période</label>
                                                            <input type="month" class="form-control" id="period_input">
                                                        </div>
                                                        <div class="form-group mt-4 col-lg-2" style="margin-top:30px !important;">
                                                            <button class="btn btn-block btn-filtrer"
                                                                id="filter"
                                                            >Filtrer</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12  col-xs-12">
                                    <div class="panel panel-default card-view " id="pri_card">
                                        <div class="panel-wrapper collapse in">
                                            <div class="text-center">
                                                <span id='empty_data' class="mb-4">Pas de données</span>
                                                <br />
                                            </div>
                                            <div class="panel-body table-responsive " id="pri_table">
                                                <div class="mb-3 " dir="rtl">
                                                    <button id="printAllPri" class="btn btn-success"> <i class="icon-printer"></i> &nbsp;Imprimer Tout</button>
                                                </div>
                                                <table id="data-table" class="table table-hover display mb-30 text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Nom</th>
                                                            <th>Prénom</th>
                                                            <th>Poste</th>
                                                            <th>RESPECT DES OBJECTIFS </th>
                                                            <th>QUALITE DE TRAVAIL</th>
                                                            <th> ORGANISATION ET ESPRIT D'INITIATIVE </th>
                                                            <th>DISPONIBILITE</th>
                                                            <th>TOTAL</th>
                                                            <th></th>
                                                        </tr>
                                                        <tr class="placeholder-row">
                                                            <th colspan="4"></th>
                                                            <th><small>(0–6)</small></th>
                                                            <th><small>(0–6)</small></th>
                                                            <th><small>(0–4)</small></th>
                                                            <th><small>(0–4)</small></th>
                                                            <th colspan="2"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="list_pri">
                                                        <!-- ...existing code... -->
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
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
        <script src="assets/js/historique_pri.js"></script>