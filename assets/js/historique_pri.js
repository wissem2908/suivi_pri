$(document).ready(function () {
  //console.log('ready')
  var direction_user = $("#direction_user").val();
  var role_user = $("#role_user").val();

  //************************************ list des directions  ************************************* */

  function list_dir() {
    $.ajax({
      url: "assets/php/dir_list.php",
      method: "post",
      success: function (response) {
        // console.log(response);
        var data = JSON.parse(response);

        var dir_list = "";

        for (i = 0; i < data.length; i++) {
          if (role_user == "utilisateur") {
            if(data[i].id_dir==direction_user){
    dir_list +=
              '<option value="' +
              data[i].id_dir +
              '">' +
              data[i].name +
              "</option>";
            }
        
          } else {
            dir_list +=
              '<option value="' +
              data[i].id_dir +
              '">' +
              data[i].name +
              "</option>";
          }
        }

        $("#dir_list").append(dir_list);
      },
    });
  }

  list_dir();

  /*************************************** liste de sous direction **************************************************** */
  $(document).on("change", "#dir_list", function () {
    var id_dir = $(this).val();

    $.ajax({
      url: "assets/php/list_s_dir_history.php",
      method: "post",
      data: { id_dir: id_dir },
      success: function (response) {
        console.log(response);

        var data = JSON.parse(response);
        var s_dir_list = "";
        for (i = 0; i < data.length; i++) {
          s_dir_list +=
            "<option value='" +
            data[i].id_sous_direction +
            "'>" +
            data[i].name +
            "</option>";
        }
        $("#s_dir_list").empty();
        $("#s_dir_list").append(s_dir_list);
      },
    });
  });

  /*************************************************  list pri  ******************************************************* */

  function list_pri(dir_list, s_dir_list, period_input) {
    $.post(
      "assets/php/list_pri_history.php",
      {
        dir_list: dir_list,
        s_dir_list: s_dir_list,
        period_input: period_input,
      },
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
          <td>${d.respect_objectif}</td>
          <td>${d.qualite_travail}</td>
          <td>${d.organisation}</td>
          <td>${d.disponibilite}</td>
          <td class="total" style="color: ${color}">${d.total}</td>
          <td style='white-space: nowrap;'>
           
             <button class="btn btn-sm btn-warning btn-icon-anim btn-circle print-pri" data="${d.id_pri}">
    <i class="icon-printer"></i>
  </button>
          </td>
        </tr>`;
        });

        // Destroy DataTable BEFORE updating rows
        if ($.fn.DataTable.isDataTable("#data-table")) {
          $("#data-table").DataTable().destroy();
        }

        // Inject rows into tbody
        $("#list_pri").html(rows);

        // Reinitialize DataTable
        $("#data-table").DataTable({
  language: {
    "sProcessing":     "Traitement en cours...",
    "sSearch":         "Rechercher&nbsp;:",
    "sLengthMenu":     "Afficher _MENU_ éléments",
    "sInfo":           "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
    "sInfoEmpty":      "Affichage de l'élément 0 à 0 sur 0 élément",
    "sInfoFiltered":   "(filtré de _MAX_ éléments au total)",
    "sInfoPostFix":    "",
    "sLoadingRecords": "Chargement en cours...",
    "sZeroRecords":    "Aucun élément à afficher",
    "sEmptyTable":     "Aucune donnée disponible dans le tableau",
    "oPaginate": {
        "sFirst":      "Premier",
        "sPrevious":   "Précédent",
        "sNext":       "Suivant",
        "sLast":       "Dernier"
    },
    "oAria": {
        "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
        "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
    }
  }
});

        $("#data-table")
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

  list_pri(null, null, null);

  document.getElementById("printAllPri").addEventListener("click", function () {
    console.log("ddddddddddddddddddddd");
    // Get all rows inside the tbody
    const rows = document.querySelectorAll("#list_pri tr");
    const ids = [];
    console.log(rows);
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

  /************************************ filter ***************************************** */

  $("#filter").click(function (e) {
    e.preventDefault();

    var dir_list = $("#dir_list").val();
    var s_dir_list = $("#s_dir_list").val();
    var period_input = $("#period_input").val();
    console.log(dir_list, s_dir_list, period_input);

    list_pri(dir_list, s_dir_list, period_input);
  });
});
