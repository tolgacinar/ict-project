		</div>
	</main>
	<div class="modal fade" id="formModal" data-backdrop="static" tabindex="-1">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="formModalLabel">Yeni İşlem Formu</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="insertForm">
						<div class="form-row">
							<div class="col-4 mb-3">
								<label for="isim">Müşteri Adı</label>
								<input type="text" class="form-control" name="isim" id="isim">
							</div>
							<div class="col-4 mb-3">
								<label for="model">Tamir Tarihi</label>
								<input type="text" name="date" class="form-control" id="datepicker">
							</div>
							<div class="col-4 mb-3">
								<label for="model">Tamir Saati</label>
								<select name="time" class="form-control" id="time">
									<option value="07:00">07:00</option>
									<option value="07:30">07:30</option>
									<option value="08:00">08:00</option>
									<option value="08:30">08:30</option>
									<option value="09:00">09:00</option>
									<option value="09:30">09:30</option>
									<option value="10:00">10:00</option>
									<option value="10:30">10:30</option>
									<option value="11:00">11:00</option>
									<option value="11:30">11:30</option>
									<option value="12:00">12:00</option>
									<option value="12:30">12:30</option>
									<option value="13:00">13:00</option>
									<option value="13:30">13:30</option>
									<option value="14:00">14:00</option>
									<option value="14:30">14:30</option>
									<option value="15:00">15:00</option>
									<option value="15:30">15:30</option>
									<option value="16:00">16:00</option>
									<option value="16:30">16:30</option>
									<option value="17:00">17:00</option>
									<option value="17:30">17:30</option>
									<option value="18:00">18:00</option>
									<option value="18:30">18:30</option>
									<option value="19:00">19:00</option>
								</select>
							</div>
							<div class="col-6 mb-3">
								<label for="arac">Araç Markası</label>
								<select class="form-control" name="arac" id="arac">
									<option>Bir Araç Seçin...</option>
									<?php foreach ($brands as $key => $value): ?>
										<option value="<?php echo $value->brand_id; ?>"><?php echo $value->brand_name; ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-6 mb-3">
								<label for="model">Araç Modeli</label>
								<select class="form-control" name="model" id="model" disabled="disabled">
									<option value>Araç Modeli Seçin...</option>
								</select>
							</div>
							<div class="col-6 mb-3">
								<label for="repair_type">Tamir Türü</label>
								<select class="form-control" name="repair_type" id="repair_type">
									<option>Bir Tamir Türü Seçin...</option>
									<?php foreach ($types as $key => $value): ?>
										<option value="<?php echo $value->type_id; ?>"><?php echo $value->type_name; ?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="col-6 mb-3">
								<label for="repair_area">Tamir Noktası</label>
								<select class="form-control" name="repair_area" id="repair_area" disabled="disabled">
									<option value>Tamir Noktası Seçin...</option>
								</select>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Vazgeç</button>
					<button type="button" class="btn btn-primary" onclick="$('#insertForm').submit();">Kaydet</button>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
	$(document).ready(function() {
		const base_url = "<?php echo base_url(); ?>";
		$('#main-list').DataTable({
			pageLength : 5,
			lengthMenu: [5, 10, 50],
			ordering: false
		});

		$('#datepicker').datepicker({
			uiLibrary: 'bootstrap4',
			minDate: '<?php echo date("m/d/Y") ?>',
			value: '<?php echo date("m/d/Y") ?>'
		});

		$("select[name=arac]").on("change", function(e) {
			var t = $(this);
			var val = t.val();
			var modelbox = $("select[name=model]");
			if ($.isNumeric(val)) {
				$.get(base_url + "getCarsBrands/" + val, function( data ) {
					if (data.status == "error") {
						modelbox.empty();
						modelbox.prop("disabled", true);
						modelbox.append($("<option></option>").text("Araç Modeli Seçin..."));
					}else {
						modelbox.empty();
						modelbox.prop("disabled", false)
						$.each(data.list, function(index, value) {
							modelbox.append(
								$("<option></option>")
								.attr("value", value.model_id)
								.text(`${value.model_name} (${value.model_segment} Segment)`)
								);
						});
					}
				})
			}else {
				modelbox.empty();
				modelbox.prop("disabled", true);
				modelbox.append($("<option></option>").text("Araç Modeli Seçin..."));	
			}
		})

		$("select[name=repair_type]").on("change", function(e) {
			var t = $(this);
			var val = t.val();
			var modelbox = $("select[name=repair_area]");
			if ($.isNumeric(val)) {
				$.get(base_url + "getRepairAreas/" + val, function( data ) {
					if (data.status == "error") {
						modelbox.empty();
						modelbox.prop("disabled", true);
						modelbox.append($("<option></option>").text("Tamir Alanı Seçin..."));
					}else {
						modelbox.empty();
						modelbox.prop("disabled", false)
						$.each(data.list, function(index, value) {
							modelbox.append(
								$("<option></option>")
								.attr("value", value.area_id)
								.prop("disabled", value.fill >= value.area_capacity ? true : false)
								.text(`${value.area_name} (Kapasite: ${value.fill}/${value.area_capacity})`)
								);
						});
					}
				})
			}else {
				modelbox.empty();
				modelbox.prop("disabled", true);
				modelbox.append($("<option></option>").text("Araç Modeli Seçin..."));	
			}
		})

		$("form#insertForm").on("submit", function(e) {
			var form = $(this);
			var areabox = $("select[name=repair_area]");
			var modelbox = $("select[name=model]");
			e.preventDefault();
			$.ajax({
				url: base_url + 'sendForm',
				type: 'POST',
				data: form.serialize(),
				beforeSend: function(bs) {

				},
				success: function(data) {
					if (data.status == "error") {
						toastr.error(data.message, 'Hata')
					}else if(data.status == "success") {
						toastr.success(data.message, 'Başarılı')
						areabox.empty();
						areabox.prop("disabled", true);
						areabox.append($("<option></option>").text("Tamir Alanı Seçin..."));
						modelbox.empty();
						modelbox.prop("disabled", true);
						modelbox.append($("<option></option>").text("Araç Modeli Seçin..."));
						form[0].reset();
					}
				}
			});
		})
	});
</script>
</html>