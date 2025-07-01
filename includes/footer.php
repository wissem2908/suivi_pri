	<!-- Footer
	<footer class="footer container-fluid pl-30 pr-30">
		<div class="row">
			<div class="col-sm-12">


				<p> &copy; ANURB 2025. Tous Droits Réservés.</p>
			</div>
		</div>
	</footer> -->
	<!-- /Footer -->
	</div>
	</div>
	<!-- /Main Content -->

	</div>
	<!-- /#wrapper -->

	<!-- JavaScript -->

	<!-- jQuery -->
	<script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Data table JavaScript -->
	<script src="vendors/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="dist/js/dataTables-data.js"></script>

	<!-- Slimscroll JavaScript -->
	<script src="dist/js/jquery.slimscroll.js"></script>

	<!-- Owl JavaScript -->
	<script src="vendors/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>

	<!-- Switchery JavaScript -->
	<script src="vendors/bower_components/switchery/dist/switchery.min.js"></script>

	<!-- Fancy Dropdown JS -->
	<script src="dist/js/dropdown-bootstrap-extended.js"></script>

	<!-- SweetAlert2 JS -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.22.0/dist/sweetalert2.all.min.js"></script>

	<!-- Init JavaScript -->
	<script src="dist/js/init.js"></script>

	<!-- TableEdit JS -->
	<script src="https://markcell.github.io/jquery-tabledit/assets/js/jquery.tabledit.min.js"></script>

	<!-- Select2 JavaScript -->
	<script src="vendors/bower_components/select2/dist/js/select2.full.min.js"></script>

	<!-- Bootstrap Select JavaScript -->
	<script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

	<!-- Moment.js -->
	<script src="vendors/bower_components/moment/min/moment-with-locales.min.js"></script>

	<!-- Bootstrap Colorpicker JavaScript -->
	<script src="vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

	<!-- Bootstrap Tagsinput JavaScript -->
	<script src="vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

	<!-- Bootstrap Touchspin JavaScript -->
	<script src="vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>

	<!-- Multiselect JavaScript -->
	<script src="vendors/bower_components/multiselect/js/jquery.multi-select.js"></script>

	<!-- Bootstrap Switch JavaScript -->
	<script src="vendors/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>

	<!-- Bootstrap Datetimepicker JavaScript -->
	<script src="vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

	<!-- Form Advance Init JavaScript -->
	<script src="dist/js/form-advance-data.js"></script>



	<script>
		$('.select2').select2({
			width: '100%', // important to ensure proper sizing
			dropdownParent: $('body'), // ensures it renders at root level
			containerCssClass: 'custom-select2-container'
		});
	</script>



	<script>
		$(document).ready(function() {


			$('#add_pri').click(function(e) {
				e.preventDefault();
				Swal.fire({
					title: "Voulez-vous vraiment ajouter la prime de rendement individuel (PRI)",

					showCancelButton: true,
					confirmButtonText: "Oui",
					cancelButtonText: "Annuler",
				}).then((result) => {
					/* Read more about isConfirmed, isDenied below */
					if (result.isConfirmed) {

						$.ajax({
							url: 'assets/php/add_pri.php',
							methos: 'post',
							success: function(response) {
								console.log(response)

								var data = JSON.parse(response);
								if (data.response == "false") {
									Swal.fire({
										icon: "error",
										title: "Oops...",
										text: "La PRI de ce mois existe déjà !",
										
									});
								}else if(data.response == "true"){
									Swal.fire({

  icon: "success",
  title: "PRI ajoutée avec succès",
  showConfirmButton: false,
  timer: 1500
});
								}

							}
						})
					


					}
				});

			})

		})
	</script>

	</body>

	</html>