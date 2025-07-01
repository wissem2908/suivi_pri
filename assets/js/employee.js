$(document).ready(function () {
  /******************************************** employee list ****************************************************** */

  function listEmployee() {
    $.ajax({
      url: "assets/php/list_employee.php",
      method: "post",
      success: function (response) {
        var data = JSON.parse(response);
        console.log(data);
        var list_employee = "";
        for (i = 0; i < data.length; i++) {
          let status;
          console.log(data[i].status);
          if (data[i].status == 1) {
            // Active status - green
            status =
              "<span id='deactive' data = '" +
              data[i].employee_id +
              "' class='badge text-bg-success' style='background:#198754 !important; color:#fff; cursor:pointer'>Active</span>";
          } else {
            // Deactive status - red
            status =
              "<span id='active' data = '" +
              data[i].employee_id +
              "' class='badge text-bg-danger' style='background:#dc3545 !important; color:#fff;cursor:pointer'>Désactivé </span>";
          }

          list_employee +=
            "<tr >" +
            "<td>"+(i+1)+"</td><td>" +
            data[i].nom +
            "</td>" +
            "<td>" +
            data[i].prenom +
            "</td>" +
            "<td>" +
            data[i].email +
            "</td>" +
            "<td>" +
            data[i].direction +
            "</td>" +
            "<td class='text-center'>" +
            status +
            "</td>" +
            "<td><button id='delete_employee' data = '" +
            data[i].employee_id +
            "' class='btn btn-sm btn-info btn-icon-anim btn-circle'>" +
            "<i class='icon-trash'></i>" +
            "</button></td>" +
            "</tr>";
        }

        $("#employee_list").empty();

        if ($.fn.DataTable.isDataTable("#datable_1")) {
          $("#datable_1").DataTable().destroy();
        }

        $("#employee_list").html(list_employee);

      $("#datable_1").DataTable({
            language: {
              sProcessing: "Traitement en cours...",
              sSearch: "Rechercher&nbsp;:",
              sLengthMenu: "Afficher _MENU_ éléments",
              sInfo:
                "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
              sInfoEmpty: "Affichage de l'élément 0 à 0 sur 0 élément",
              sInfoFiltered: "(filtré de _MAX_ éléments au total)",
              sInfoPostFix: "",
              sLoadingRecords: "Chargement en cours...",
              sZeroRecords: "Aucun élément à afficher",
              sEmptyTable: "Aucune donnée disponible dans le tableau",
              oPaginate: {
                sFirst: "Premier",
                sPrevious: "Précédent",
                sNext: "Suivant",
                sLast: "Dernier",
              },
              oAria: {
                sSortAscending:
                  ": activer pour trier la colonne par ordre croissant",
                sSortDescending:
                  ": activer pour trier la colonne par ordre décroissant",
              },
            },
          });
      },
    });
  }

  listEmployee();

  /******************************* desactiver l'employee ********************************************** */
  $(document).on("click", "#deactive", function () {
    var id_employee = $(this).attr("data");

    $.ajax({
      url: "assets/php/change_status.php",
      method: "post",
      data: { id_employee: id_employee, action: "deactive" },
      success: function (response) {
        console.log(response);
        listEmployee();
      },
    });
  });

  /*********************************** activer l'employee *********************************************** */

  $(document).on("click", "#active", function () {
    var id_employee = $(this).attr("data");

    $.ajax({
      url: "assets/php/change_status.php",
      method: "post",
      data: { id_employee: id_employee, action: "active" },
      success: function (response) {
        console.log(response);
        listEmployee();
      },
    });
  });

  /************************************ delete employee ***************************************** */
  $(document).on("click", "#delete_employee", function (e) {
    e.preventDefault();

    var id_employee = $(this).attr("data");

    Swal.fire({
      title: "Êtes-vous sûr ?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Annuler",
      confirmButtonText: "Oui, supprimer !",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "assets/php/delete_employee.php",
          method: "post",
          data: { id_employee: id_employee },
          success: function (response) {
            if (response.trim() === "true") {
              Swal.fire({
                title: "Supprimé !",
                text: "Cet employé a été supprimé.",
                icon: "success",
              });

              listEmployee();
            } else {
              Swal.fire("Erreur", "Échec de la suppression.", "error");
            }
          },
        });
      }
    });
  });

  /***************************************** list direction  ********************************************** */

  function list_dir() {
    $.ajax({
      url: "assets/php/dir_list.php",
      method: "post",
      success: function (response) {
        // console.log(response);
        var data = JSON.parse(response);

        var dir_list = "<option disabled selected>--Choisir--</option>";

        for (i = 0; i < data.length; i++) {
          dir_list +=
            '<option value="' +
            data[i].id_dir +
            '">' +
            data[i].name +
            "</option>";
        }
        $(".dir").empty();
        $(".dir").append(dir_list);
      },
    });
  }

  list_dir();

  /************************************** list sous direction   ******************************************* */

  function list_s_dir(id_dir) {
    $.ajax({
      url: "assets/php/sous_dir_list.php",
      method: "post",
      data: { id_dir: id_dir },
      success: function (response) {
        //    console.log(response);
        var data = JSON.parse(response);

        var list_s_dir = "<option disabled selected>--Choisir--</option>";
        for (i = 0; i < data.length; i++) {
          list_s_dir +=
            '<option value="' +
            data[i].id_sous_direction +
            '">' +
            data[i].name +
            "</option>";
        }
        $("#sous_dir").empty();
        $("#sous_dir").append(list_s_dir);
      },
    });
  }

  $(document).on("change", "#dir", function () {
    var id_dir = $(this).val(); // Add the missing semicolon
    list_s_dir(id_dir); // Call the function with the selected value
  });

  /*********************************************** list fonction************************************************/

  function function_list() {
    $.ajax({
      url: "assets/php/list_function.php",
      method: "post",
      success: function (response) {
        console.log(response);

        var data = JSON.parse(response);
        var list_fonction = "<option disabled selected>--Choisir--</option>";
        for (i = 0; i < data.length; i++) {
          list_fonction +=
            '<option value="' +
            data[i].id_poste +
            '">' +
            data[i].name +
            "</option>";
        }
        $("#fonction").empty();
        $("#fonction").append(list_fonction);
      },
    });
  }
  function_list();

  /************************************************************************************************* */

  $("#add_employee").click(function (e) {
    e.preventDefault();

    var nom = $("#nom").val();
    var prenom = $("#prenom").val();
    var email = $("#email").val();
    var dir = $("#dir").val();
    var sous_dir = $("#sous_dir").val();
    var fonction = $("#fonction").val();

    $.ajax({
      url: "assets/php/add_employee.php",
      method: "post",
      data: {
        nom: nom,
        prenom: prenom,
        email: email,
        dir: dir,
        sous_dir: sous_dir,
        fonction: fonction,
      },
      success: function (response) {
        console.log(response);
        var data = JSON.parse(response);
        if (data.response == "false") {
          if (data.message == "empty_field") {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Veuillez remplir tous les champs",
            });
          } else if (data.message == "employee_exist") {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Cet employé déja exist",
            });
          }
        } else if (data.response == "true") {
          Swal.fire({
            icon: "success",
            title: "Employé ajouté avec success",
            showConfirmButton: false,
            timer: 1500,
          });

          $("#nom").val("");
          $("#prenom").val("");
          $("#email").val("");
          $("#dir").val("");
          $("#sous_dir").val("");
          $("#fonction").val("");
          listEmployee();
        }
      },
    });
  });

  /***************************** add direction ************************** */

  $("#ajouter_direction").click(function (e) {
    // alert('clicked')
    e.preventDefault();

    var nom_direction = $("#nom_direction").val();
    var desc_direction = $("#desc_direction").val();

    $.ajax({
      url: "assets/php/add_direction.php",
      method: "post",
      data: { nom_direction: nom_direction, desc_direction: desc_direction },
      success: function (response) {
        console.log(response);
        var data = JSON.parse(response);

        if (data.response == "false") {
          if (data.message == "empty_field") {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Veuillez remplir le nom de la direction",
            });
          } else if (data.message == "dirction_exist") {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Cette direction déja exist",
            });
          }
        } else if (data.response == "true") {
          Swal.fire({
            icon: "success",
            title: "Direction ajouté avec success",
            showConfirmButton: false,
            timer: 1500,
          });

          $("#nom_direction").val("");
          $("#desc_direction").val("");

          list_dir();
          $("#responsive-modal-direction").modal("hide");
        }
      },
    });
  });

  /******************************** ajouter sous direction ************************************************** */

  $("#ajouter_sous_direction").click(function (e) {
    // alert('clicked')
    e.preventDefault();

    var nom_sous_direction = $("#nom_sous_direction").val();
    var dir_form = $("#dir_form").val();
    var desc_sous_direction = $("#desc_sous_direction").val();

    $.ajax({
      url: "assets/php/add_sous_direction.php",
      method: "post",
      data: {
        nom_sous_direction: nom_sous_direction,
        dir_form: dir_form,
        desc_sous_direction: desc_sous_direction,
      },
      success: function (response) {
        console.log(response);
        var data = JSON.parse(response);

        if (data.response == "false") {
          if (data.message == "empty_field") {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Veuillez remplir les champs obligatoire",
            });
          } else if (data.message == "sous_dirction_exist") {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Cette sous direction déja exist",
            });
          }
        } else if (data.response == "true") {
          Swal.fire({
            icon: "success",
            title: "Sous Direction ajouté avec success",
            showConfirmButton: false,
            timer: 1500,
          });

          $("#nom_sous_direction").val("");
          $("#dir_form").val("");
          $("#desc_sous_direction").val("");
          list_dir();
          $("#responsive-modal-sous-direction").modal("hide");
        }
      },
    });
  });

  /*******************************************  ajout de la fonction ********************************************* */

  $("#ajouter_fonction").click(function (e) {
    // alert('clicked')
    e.preventDefault();

    var nom_fonction = $("#nom_fonction").val();
    var desc_fonction = $("#desc_fonction").val();

    $.ajax({
      url: "assets/php/add_fonction.php",
      method: "post",
      data: { nom_fonction: nom_fonction, desc_fonction: desc_fonction },
      success: function (response) {
        console.log(response);
        var data = JSON.parse(response);

        if (data.response == "false") {
          if (data.message == "empty_field") {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Veuillez remplir les champs obligatoire",
            });
          } else if (data.message == "fonction_exist") {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Cette fonction déja exist",
            });
          }
        } else if (data.response == "true") {
          Swal.fire({
            icon: "success",
            title: "Fonction ajouté avec success",
            showConfirmButton: false,
            timer: 1500,
          });

          $("#nom_fonction").val("");
          $("#desc_fonction").val("");

          function_list();
          $("#responsive-modal-fonction").modal("hide");
        }
      },
    });
  });
});
