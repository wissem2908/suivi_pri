$(document).ready(function () {
  //alert('ready')

  /*********************************************** */
  // Toggle Show/Hide Password
  $("#togglePassword").on("click", function () {
    var passwordField = $("#password");
    var passwordType =
      passwordField.attr("type") === "password" ? "text" : "password";
    passwordField.attr("type", passwordType);

    // Toggle eye icon (show/hide)
    var icon = $(this).children("i");
    if (passwordType === "password") {
      icon
        .removeClass("glyphicon glyphicon-eye-close")
        .addClass("glyphicon glyphicon-eye-open");
    } else {
      icon
        .removeClass("glyphicon glyphicon-eye-open")
        .addClass("glyphicon glyphicon-eye-close");
    }
  });

  // Generate Random Password
  $("#generatePassword").on("click", function () {
    var generatedPassword = generateRandomPassword();
    $("#password").val(generatedPassword);
  });

  // Function to generate a random password
  function generateRandomPassword() {
    var charset =
      "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()";
    var passwordLength = 12; // You can adjust the length of the generated password
    var password = "";
    for (var i = 0; i < passwordLength; i++) {
      var randomChar = charset.charAt(
        Math.floor(Math.random() * charset.length)
      );
      password += randomChar;
    }
    return password;
  }

  /*************************************************** list employee ***************************************************** */

  function list_employee() {
    $.ajax({
      url: "assets/php/list_employee.php",
      method: "post",
      success: function (response) {
        //console.log(response)

        var data = JSON.parse(response);

        var list_employee = "<option disabled selected> --Choisir--</option>";
        for (i = 0; i < data.length; i++) {
          list_employee +=
            "<option value='" +
            data[i].employee_id +
            "'> " +
            data[i].nom +
            " " +
            data[i].prenom +
            " </option>";
        }
        $("#nom_prenom").empty();
        $("#nom_prenom").append(list_employee);
      },
    });
  }
  list_employee();

  /******************************************* add user ************************************************** */

  $("#add_user").click(function (e) {
    e.preventDefault();

    var nom_prenom = $("#nom_prenom").val();
    var username = $("#username").val();
    var password = $("#password").val();
    var role = $("#role").val();

    $.ajax({
      url: "assets/php/add_user.php",
      method: "post",
      data: {
        nom_prenom: nom_prenom,
        username: username,
        password: password,
        role: role,
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
          } else if (data.message == "user_exist") {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Cet utilisateur déja exist",
            });
          }
        } else if (data.response == "true") {
          Swal.fire({
            icon: "success",
            title: "utilisateur ajouté avec success",
            showConfirmButton: false,
            timer: 1500,
          });

          $("#nom_prenom").val("");
          $("#username").val("");
          $("#password").val("");
          $("#role").val("");

          listUsers();
        }
      },
    });
  });

  /**************************************************** list users ***************************************************** */

  function listUsers() {
    $.ajax({
      url: "assets/php/list_users.php",
      method: "post",
      success: function (response) {
        console.log(response);

        var data = JSON.parse(response);

        var lisUsers = "";

        for (i = 0; i < data.length; i++) {
          let status;
          console.log(data[i].status);
          if (data[i].status == 1) {
            // Active status - green
            status =
              "<span id='deactive' data = '" +
              data[i].user_id +
              "' class='badge text-bg-success' style='background:#198754 !important; color:#fff; cursor:pointer'>Active</span>";
          } else {
            // Deactive status - red
            status =
              "<span id='active' data = '" +
              data[i].user_id +
              "' class='badge text-bg-danger' style='background:#dc3545 !important; color:#fff;cursor:pointer'>Désactivé </span>";
          }
          lisUsers +=
            "<tr class='text-center'><td>"+(i+1)+"</td><td>" +
            data[i].nom +
            "</td><td>" +
            data[i].prenom +
            "</td><td>" +
            data[i].username +
            "</td><td>" +
            data[i].role +
            "</td><td>" +
            status +
            "</td><td><button id='delete_user' data = '" +
            data[i].user_id +
            "' class='btn btn-sm btn-info btn-icon-anim btn-circle'>" +
            "<i class='icon-trash'></i>" +
            "</button></td></tr>";
        }

        $("#users_list").empty();

        if ($.fn.DataTable.isDataTable("#datable_1")) {
          $("#datable_1").DataTable().destroy();
        }
        $("#users_list").html(lisUsers);

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

  listUsers();

  /******************************* desactiver l'utilisateur ********************************************** */
  $(document).on("click", "#deactive", function () {
    var id_user = $(this).attr("data");

    $.ajax({
      url: "assets/php/change_status_user.php",
      method: "post",
      data: { id_user: id_user, action: "deactive" },
      success: function (response) {
        console.log(response);
        listUsers();
      },
    });
  });

  /*********************************** activer l'utilisateur *********************************************** */

  $(document).on("click", "#active", function () {
    var id_user = $(this).attr("data");

    $.ajax({
      url: "assets/php/change_status_user.php",
      method: "post",
      data: { id_user: id_user, action: "active" },
      success: function (response) {
        console.log(response);
        listUsers();
      },
    });
  });

  /************************************ delete user ***************************************** */
  $(document).on("click", "#delete_user", function (e) {
    e.preventDefault();

    var id_user = $(this).attr("data");

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
          url: "assets/php/delete_user.php",
          method: "post",
          data: { id_user: id_user },
          success: function (response) {
            if (response.trim() === "true") {
              Swal.fire({
                title: "Supprimé !",
                text: "Cet utilisateur a été supprimé.",
                icon: "success",
              });

              listUsers();
            } else {
              Swal.fire("Erreur", "Échec de la suppression.", "error");
            }
          },
        });
      }
    });
  });
});
