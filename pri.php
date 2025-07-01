<?php
include('includes/header.php');
//print_r($_SESSION);
$role = $_SESSION['role'];
$direction = $_SESSION['direction'];
//echo $role;
?>




<input type="hidden" id="id_dir" value="<?php echo $direction;  ?>" />
<!-- Main Content -->
<div class="page-wrapper">
  <div class="container-fluid">
    <!-- Title -->
    <div class="row heading-bg">
      <div class="col-xs-12 col-sm-6">
        <h5 class="txt-dark">Suivi de PRI</h5>
      </div>
      <div class="col-xs-12 col-sm-6 text-right">
        <ol class="breadcrumb">
          <li><a href="index.html">Pri</a></li>
          <li class="active"><a href="#"><span>Liste des pri</span></a></li>
        </ol>
      </div>
    </div>
    <!-- /Title -->

    <div class="panel-wrapper collapse in">
      <div class="panel-body">
        <div class="pills-struct vertical-pills mt-40">
          <div class="row">
            <div class="col-xs-12 col-md-3 pb-20">
              <ul role="tablist" class="nav nav-pills ver-nav-pills" id="dir_list"></ul>
            </div>

            <div class="col-xs-12 col-md-9">
              <?php  
if(isset($_GET['dir'])){
  ?>
 <input type="hidden" value="<?php echo $_GET['dir']; ?>" id="direction_user" />
  <?php
}else{
  ?>
 <input type="hidden" value="<?php echo $direction; ?>" id="direction_user" />
  <?php
}
              ?>
             
              <input type="hidden" value="<?php echo $role; ?>" id="role_user" />

              <div class="tab-content" id="myTabContent_10" style="padding:0">
                <div id="home_10" class="tab-pane fade active in" role="tabpanel">
                  <div class="row" id="list_s_dir"></div>

                  <div class="panel panel-default card-view-bg">
                    <div class="panel-wrapper collapse in">
                      <div class="panel-body text-center panel-body-recap">
                        <button id="afficher_recap"
                          class="btn w-100 btn-recap-direction">
                          <i class="fas fa-chart-bar" style="margin-right:10px;"></i>
                          Récapitulatif de la Direction
                        </button>
                      </div>
                    </div>
                  </div>

                  <div class="panel panel-default card-view-white" id="note">
                    <div class="panel-wrapper collapse in">
                      <div class="panel-body text-center panel-body-note">
                        <div class="panel-note-body">
                          <div class="panel-note-icon">
                            <span style="color:#fff; font-size:2rem; line-height:1;">
                              &#9432;
                            </span>
                          </div>
                          <div class="panel-note-title">
                            Sélectionnez une sous-direction pour afficher la liste des pri
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="panel panel-default card-view-none" id="pri_card">
                    <div class="panel-wrapper collapse in pb-15">
                      <div class="text-center">
                        <span id='empty_data' class="mb-4">Pas de données</span><br />
                      </div>

                      <div class="panel-body table-responsive" id="pri_table">
                        <div class="row pri-table-row-gap">
                          <div class="col-md-6 mb-2">
                            <button id="printAllPri"
                              class="btn pri-btn-print-all">
                              <i class="icon-printer" style="margin-right:10px;"></i>
                              Imprimer Tout
                            </button>
                          </div>
                          <div class="col-md-6 mb-2 pri-table-btn-right">
                            <button id="printAllPriRecap"
                              class="btn pri-btn-print-recap">
                              <i class="icon-printer" style="margin-right:10px;"></i>
                              Imprimer Recap
                            </button>
                          </div>
                        </div>

                        <div class="table-responsive">
                          <table id="edit_datable_2" class="table table-hover display mb-30 text-center">
                            <thead>
                              <tr>
                                <th>Date</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Poste</th>
                                <th>RESPECT DES OBJECTIFS</th>
                                <th>QUALITE DE TRAVAIL</th>
                                <th>ORGANISATION ET ESPRIT D'INITIATIVE</th>
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
                            <tbody id="list_pri"></tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="panel panel-default card-view-none" id="recap_card">
                    <div class="panel-wrapper collapse in pb-15">
                      <div class="text-center">
                        <span id='empty_data_recap' class="mb-4">Pas de données</span><br />
                      </div>

                      <div class="panel-body table-responsive" id="table_recap">
                        <div class="mb-3 text-right">
                          <button id="printAllPriDir" class="btn btn-success">
                            <i class="icon-printer"></i>
                          </button>
                        </div>

                        <div class="table-responsive">
                          <table id="edit_datable00" class="table table-hover display mb-30">
                            <thead>
                              <tr>
                                <th>Date</th>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Fonction</th>
                                <th>Note</th>
                              </tr>
                            </thead>
                            <tbody id="recap_dir"></tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div> <!-- recap_card -->
                </div>
              </div> <!-- tab-content -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /Main Content -->

<!-- /Title -->

<?php
include('includes/footer.php');
?>

<script src="assets/js/pri.js"></script>