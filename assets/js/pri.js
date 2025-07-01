$(document).ready(function () {

  var direction_user = $("#direction_user").val();
  var role_user = $("#role_user").val();

 


      if (direction_user == "2") {
      $("#pri_card").show();
      $("#recap_card").slideUp();
      $("#note").slideUp();
      $("#id_dir").val(direction_user);
      list_s_dir(direction_user);
      list_pri(17);
    }else if(direction_user == "4"){
  
      $("#pri_card").show();
      $("#recap_card").slideUp();
      $("#note").slideUp();
      $("#id_dir").val(direction_user);
      list_s_dir(direction_user);
      list_pri(18);
  
    } 
    

  function list_dir() {
    $.ajax({
      url: "assets/php/dir_list.php",
      method: "post",
      success: function (response) {
        var data = JSON.parse(response);
        var dir_list = "";

        for (var i = 0; i < data.length; i++) {
          var isActive = data[i].id_dir == direction_user ? "active" : "";

          if (role_user === "utilisateur" && data[i].id_dir != direction_user) {
            // Show direction but make it non-clickable (disabled)
            dir_list +=
              '<li class="' +
              isActive +
              '" role="presentation">' +
              '<a href="#" onclick="return false;" style="pointer-events: none; opacity: 0.6; cursor: not-allowed !important;">' +
              data[i].name +
              "</a></li>";
          } else {
            // Admin or the user's own direction (clickable)
            dir_list +=
              '<li class="' +
              isActive +
              '" role="presentation">' +
              '<a class="direction" aria-expanded="true" data-toggle="tab" role="tab" id="' +
              data[i].id_dir +
              '" href="#home_10">' +
              data[i].name +
              "</a></li>";
          }
        }

        $("#dir_list").append(dir_list);
      },
    });
  }

  list_dir();

  /*************************************** list des sous directions *********************************************** */

  function list_s_dir(id_dir) {
 
    $.ajax({
      url: "assets/php/sous_dir_list.php",
      method: "post",
      data: { id_dir: id_dir },
      success: function (response) {
    
        var data = JSON.parse(response);

        var list_s_dir = "";
     const colors = ["#033f63","#295570e3",  "#8eaabb"];
list_s_dir = ""; // Assure-toi que cette variable est initialisée

for (let i = 0; i < data.length; i++) {
  const name = data[i].name.toLowerCase(); // normalisation pour éviter les erreurs de casse
  const bgColor = colors[i % colors.length];

  // Vérifie que le nom n'est pas "daf" ou "degp"
  if (name === "daf" || name === "degp") {
    continue; // saute cette itération
  }

  // Sinon, ajoute la carte avec la couleur
  list_s_dir += `
    <div style="padding: 2rem;" class="col-lg-4 text-center sous_direction" id="${data[i].id_sous_direction}">
      <div class="panel panel-primary card-view" style="background:${bgColor} !important;" data-bg="${bgColor}">
    
          <div class="pull-left">
            <h6 class="panel-title s_d_text">${data[i].name}</h6>
          </div>
          <div class="clearfix"></div>
        
      </div>
    </div>
  `;
}

        $("#list_s_dir").empty();
        $("#list_s_dir").append(list_s_dir);
      },
    });
  }


  list_s_dir(direction_user);


$(document).on('click', '.sous_direction', function () {
//       const colors = ["#033f63","#295570e3",  "#8eaabb"];
//  $('.sous_direction .card-view').each(function (index) {
//   const bg = colors[index];
//   $(this).css('background', bg+ ' !important');
//   });


$('[data-bg]').each(function () {
  const bg = $(this).attr('data-bg');
  this.style.setProperty('background', bg, 'important');
});
  $(this).find('.card-view').removeAttr('style');


 
  $('.sous_direction').removeClass('active'); // Remove active from others
  $(this).addClass('active'); // Add active to clicked one
});


/******************************************************************************************************* */
  $(document).on("click", ".direction", function () {
    var id_dir = $(this).attr("id");
    console.log("Direction ID:", id_dir);
/************************************** */
   $("#pri_card").removeClass("hidden")
    if (id_dir == "2") {
      
      $("#pri_card").show();
      $("#recap_card").slideUp();
      $("#note").slideUp();
      $("#id_dir").val(id_dir);
      list_s_dir(id_dir);
      list_pri(17);
    }else if(id_dir == "4"){
  
      $("#pri_card").show();
      $("#recap_card").slideUp();
      $("#note").slideUp();
      $("#id_dir").val(id_dir);
      list_s_dir(id_dir);
      list_pri(18);
  
    } 
    
    /********************/
    else{
      $("#pri_card").addClass("hidden");
      $("#recap_card").slideUp();
      $("#note").slideDown();
      $("#id_dir").val(id_dir);
      list_s_dir(id_dir);
    }
  });

  /******************************************* table recap ************************************************* */

  function pri_by_dir() {
    var id_dir = $("#id_dir").val();
 

    $("#recap_card").slideDown();

    $.ajax({
      url: "assets/php/recap_direction.php",
      method: "post",
      data: { id_dir: id_dir },
      success: function (response) {
      
        var data = JSON.parse(response);

        if (data.length === 0) {
          $("#table_recap").hide();
          $("#empty_data_recap").show();
        } else {
          $("#table_recap").show();
          $("#empty_data_recap").hide();
        }
        var list_recap = "";
        for (i = 0; i < data.length; i++) {
          list_recap +=
            '<tr data-id_pri="' +
            data[i].id_pri +
            '"><td>' +
            data[i].period +
            "</td><td>" +
            data[i].nom +
            "</td><td>" +
            data[i].prenom +
            "</td><td>" +
            data[i].name +
            "</td><td>" +
            data[i].total +
            "</td></tr>";
        }
    

        // Destroy DataTable BEFORE updating rows
        if ($.fn.DataTable.isDataTable("#edit_datable00")) {
          $("#edit_datable00").DataTable().destroy();
        }    $("#recap_dir").empty();
      
        $("#recap_dir").append(list_recap);

        // Reinitialize DataTable
        $("#edit_datable00").DataTable({
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

  $("#afficher_recap").click(function () {
    $("#pri_card").slideUp();
    $("#note").slideDown();
    pri_by_dir();
  });

  /*********************************************  list pri  ************************************************* */
  function list_pri(id_sous_dir) {
    console.log(id_sous_dir)
    if (!id_sous_dir) {
      console.warn("id_sous_dir is missing!");
      return;
    }
  

    $.post(
      "assets/php/list_pri.php",
      { id_sous_dir: id_sous_dir },
      function (response) {
        let rows = "";
        const data = JSON.parse(response);

        if (data.length === 0) {
          $("#pri_table").hide();
          $("#empty_data").show();
        } else {
          $("#pri_table").show();
          $("#empty_data").hide();
        }

        data.forEach((d) => {
          const total = parseFloat(d.total);
          const color = total >= 18 ? "green" : total >= 14 ? "orange" : "red";
          rows += `
        <tr data-id_pri="${d.id_pri}">
          <td >${d.period}</td>
          <td>${d.nom}</td>
          <td>${d.prenom}</td>
          <td>${d.name}</td>
          <td contenteditable="true" class="editable" data-field="respect_objectif"   title="Entrez une valeur de 0 à 6">${d.respect_objectif}</td>
          <td contenteditable="true" class="editable" data-field="qualite_travail" title="Entrez une valeur de 0 à 6">${d.qualite_travail}</td>
          <td contenteditable="true" class="editable" data-field="organisation" title="Entrez une valeur de 0 à 4">${d.organisation}</td>
          <td contenteditable="true" class="editable" data-field="disponibilite" title="Entrez une valeur de 0 à 4">${d.disponibilite}</td>
          <td class="total" style="color: ${color}">${d.total}</td>
          <td style='white-space: nowrap;'>
            <button class="btn btn-sm btn-info btn-icon-anim btn-circle delete-pri" data-id="${d.id_pri}">
              <i class="icon-trash"></i>
            </button>
             <button class="btn btn-sm btn-warning btn-icon-anim btn-circle print-pri" data="${d.id_pri}">
    <i class="icon-printer"></i>
  </button>
          </td>
        </tr>`;
        });

      
        // Destroy DataTable BEFORE updating rows
        if ($.fn.DataTable.isDataTable("#edit_datable_2")) {
          $("#edit_datable_2").DataTable().destroy();
        }
    $("#list_pri").empty();
        // Inject rows into tbody
        $("#list_pri").html(rows);

        
        // Reinitialize DataTable
        $("#edit_datable_2").DataTable({
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

        // Input validation handler (on typing)
        $("#edit_datable_2")
          .off("input")
          .on("input", ".editable", function () {
            const $cell = $(this);
            const field = $cell.data("field");
            let value = $cell.text().replace(/[^0-9.]/g, "");

            const parts = value.split(".");
            if (parts.length > 2) {
              value = parts[0] + "." + parts.slice(1).join("");
            }

            let floatValue = parseFloat(value);
            if (isNaN(floatValue)) floatValue = 0;

            if (["respect_objectif", "qualite_travail"].includes(field)) {
              if (floatValue > 6) floatValue = 6;
            } else if (["organisation", "disponibilite"].includes(field)) {
              if (floatValue > 4) floatValue = 4;
            }

            $cell.text(floatValue);
            $cell.addClass("edited");
          });

        // Save on blur
        $("#edit_datable_2")
          .off("blur")
          .on("blur", ".editable", function () {
            const $row = $(this).closest("tr");
            const id_pri = $row.data("id_pri");

            const respect_objectif =
              parseFloat($row.find('[data-field="respect_objectif"]').text()) ||
              0;
            const qualite_travail =
              parseFloat($row.find('[data-field="qualite_travail"]').text()) ||
              0;
            const organisation =
              parseFloat($row.find('[data-field="organisation"]').text()) || 0;
            const disponibilite =
              parseFloat($row.find('[data-field="disponibilite"]').text()) || 0;

            const total =
              respect_objectif + qualite_travail + organisation + disponibilite;
            $row.find(".total").text(total);

            const color =
              total >= 18 ? "green" : total >= 14 ? "orange" : "red";
            $row.find(".total").css("color", color);

            $.post(
              "assets/php/update_pri.php",
              {
                id_pri,
                respect_objectif,
                qualite_travail,
                organisation,
                disponibilite,
                total,
              },
              function (res) {
                try {
                  const result = JSON.parse(res);
                  if (result.response !== "true") {
                    console.error("Save failed:", result.message);
                    alert("Erreur lors de la sauvegarde.");
                  }
                } catch (e) {
                  console.error("Invalid JSON from server:", res);
                }
              }
            );
          });

        // Delete PRI
        $("#edit_datable_2")
          .off("click", ".delete-pri")
          .on("click", ".delete-pri", function (e) {
            e.preventDefault();

            const id_pri = $(this).data("id");

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
                  url: "assets/php/delete_pri.php",
                  method: "post",
                  data: { id_pri },
                  success: function (response) {
                    if (response.trim() === "true") {
                      Swal.fire({
                        title: "Supprimé !",
                        text: "Cette PRI a été supprimée.",
                        icon: "success",
                      });

                      const currentSousDir = $("#id_sous_dir").val();
                  
                      list_pri(currentSousDir);
                    } else {
                      Swal.fire("Erreur", "Échec de la suppression.", "error");
                    }
                  },
                });
              }
            });
          });

        $("#edit_datable_2")
          .off("click", ".print-pri")
          .on("click", ".print-pri", function (e) {
            e.preventDefault();

            const id_pri = $(this).attr("data");

            // Option 1: Open print in a new tab via PHP that creates PDF
            window.open(`assets/php/print_pri.php?id_pri=${id_pri}`, "_blank");

            // OR Option 2: Use JavaScript PDF generation (e.g., jsPDF)
            // generatePDF(id_pri); // You'll need to define this function if you want client-side PDF.
          });
      }
    );
  }

  $(document).on("click", ".sous_direction", function () {
    var id_sous_dir = $(this).attr("id");

    $("#id_sous_dir").val(id_sous_dir);
    //list_employee(id_sous_dir);

    $(".sous_direction > .panel-primary > .panel-heading").css(
      "background-color",
      "#033f63"
    );
    $(this).find(".panel-heading").css("background-color", "#669bbc");
    $("#pri_card").removeClass("hidden").slideDown();
    $("#note").slideUp();
    $("#recap_card").slideUp().hide();
    list_pri(id_sous_dir);
  });

  /*********************************************** list employee ********************************************* */

  // function list_employee(sous_dir) {
  //   $.ajax({
  //     url: "assets/php/employee_list.php",
  //     method: "post",
  //     data: { sous_dir: sous_dir },
  //     success: function (response) {
  //    
  //       var data = JSON.parse(response);
  //       var list_employee = "<option disabled selected>Choisir...</option>";
  //       for (i = 0; i < data.length; i++) {
  //         list_employee +=
  //           '<option value="' +
  //           data[i].employee_id +
  //           '">' +
  //           data[i].nom +
  //           " " +
  //           data[i].prenom +
  //           "</option>";
  //       }
  //       $("#employee").empty();
  //       $("#employee").append(list_employee);
  //     },
  //   });
  // }

  /****************************************** add pri *********************************************** */

  // $("#add_pri").click(function (e) {
  //   e.preventDefault();

  //   var employee = $("#employee").val();
  //   var respect_objectif = $("#respect_objectif").val();
  //   var qualite_travail = $("#qualite_travail").val();
  //   var organisation = $("#organisation").val();
  //   var disponibilite = $("#disponibilite").val();
  //   var id_sous_dir = $("#id_sous_dir").val();
  //   $.ajax({
  //     url: "assets/php/add_pri.php",
  //     method: "post",
  //     data: {
  //       employee: employee,
  //       respect_objectif: respect_objectif,
  //       qualite_travail: qualite_travail,
  //       organisation: organisation,
  //       disponibilite: disponibilite,
  //     },
  //     success: function (response) {
  //       var data = JSON.parse(response);

  //     
  //       if (data.response == "false") {
  //         if (data.message == "empty_data") {
  //           Swal.fire({
  //             icon: "error",
  //             title: "Oops...",
  //             text: "Veuillez remplir tous les champs",
  //           });
  //         }

  //         /********************** */

  //         if (data.message == "pri_exist") {
  //           Swal.fire({
  //             icon: "error",
  //             title: "Oops...",
  //             text: "La PRI de ce mois a déjà été effectuée pour cet employé",
  //           });
  //         }
  //       } else if (data.response == "true") {
  //         Swal.fire({
  //           title: "PRI ajoutée avec succès",
  //           icon: "success",
  //           draggable: true,
  //         });

  //         //close right sidebar

  //         $("body > .wrapper").removeClass(
  //           "open-right-sidebar open-setting-panel"
  //         );

  //         /*************** */
  //         list_pri(id_sous_dir);
  //       }
  //     },
  //   });
  // });

  /******************************************************************************************/
  // $("#close_right_sidebar").click(function (e) {
  //   e.preventDefault();

  //   $("body > .wrapper").removeClass("open-right-sidebar open-setting-panel");
  // });

  /******************************************** delete pri **********************************************/

  //   $(document).on("click", "#delete_pri", function (e) {
  //     e.preventDefault();

  //     var id_pri = $(this).attr("data");
 
  //     Swal.fire({
  //       title: "Êtes-vous sûr ?",

  //       icon: "warning",
  //       showCancelButton: true,
  //       confirmButtonColor: "#3085d6",
  //       cancelButtonColor: "#d33",
  //       cancelButtonText: "Annuler",
  //       confirmButtonText: "Oui, supprimer !",
  //     }).then((result) => {
  //       if (result.isConfirmed) {
  //         $.ajax({
  //           url: "assets/php/delete_pri.php",
  //           method: "post",
  //           data: { id_pri: id_pri },
  //           success: function (response) {
  //           

  //             if (response == "true") {
  //               Swal.fire({
  //                 title: "Supprimé !",
  //                 text: "Cette PRI a été supprimée.",
  //                 icon: "success",
  //               });

  //               var id_sous_dir = $("#id_sous_dir").val();
  //          
  //               list_pri(id_sous_dir);
  //             }
  //           },
  //         });
  //       }
  //     });
  //   });

  document.getElementById("printAllPri").addEventListener("click", function () {
   
    // Get all rows inside the tbody
    const rows = document.querySelectorAll("#list_pri tr");
    const ids = [];
 
    rows.forEach((row) => {
      const id = row.getAttribute("data-id_pri");
      if (id) {
        ids.push(id);
      }
    });

    // Now send via POST to the PHP generator
    if (ids.length > 0) {
      const form = document.createElement("form");
      form.method = "POST";
      form.action = "assets/php/generate_all_pri_pdf.php"; // Change to your actual file
      form.target = "_blank"; // Open in new tab

      const input = document.createElement("input");
      input.type = "hidden";
      input.name = "ids[]";
      input.value = JSON.stringify(ids);
      form.appendChild(input);

      document.body.appendChild(form);
      form.submit();
      document.body.removeChild(form);
    } else {
      alert("Aucune ligne trouvée.");
    }
  });

  document
    .getElementById("printAllPriDir")
    .addEventListener("click", function () {
    
      // Get all rows inside the tbody
      const rows = document.querySelectorAll("#recap_dir tr");
      const ids = [];

      rows.forEach((row) => {
        const id = row.getAttribute("data-id_pri");
        if (id) {
          ids.push(id);
        }
      });

      // Now send via POST to the PHP generator
      if (ids.length > 0) {
      
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "assets/php/generate_all_pri_recap_dir_pdf.php"; // Change to your actual file
        form.target = "_blank"; // Open in new tab

        const input = document.createElement("input");
        input.type = "hidden";
        input.name = "ids[]";
        input.value = JSON.stringify(ids);
        form.appendChild(input);

        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
      } else {
        alert("Aucune ligne trouvée.");
      }
    });

  document
    .getElementById("printAllPriRecap")
    .addEventListener("click", function () {
     
      // Get all rows inside the tbody
      const rows = document.querySelectorAll("#list_pri tr");
      const ids = [];
  
      rows.forEach((row) => {
        const id = row.getAttribute("data-id_pri");
        if (id) {
          ids.push(id);
        }
      });

      // Now send via POST to the PHP generator
      if (ids.length > 0) {
     
        const form = document.createElement("form");
        form.method = "POST";
        form.action = "assets/php/generate_all_pri_recap_s_d_pdf.php"; // Change to your actual file
        form.target = "_blank"; // Open in new tab

        const input = document.createElement("input");
        input.type = "hidden";
        input.name = "ids[]";
        input.value = JSON.stringify(ids);
        form.appendChild(input);

        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
      } else {
        alert("Aucune ligne trouvée.");
      }
    });
});
