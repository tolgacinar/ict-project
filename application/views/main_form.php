<div class="row">
	<div class="col-12">
		<div class="card shadow">
			<div class="card-header d-flex justify-content-between align-items-center">
				<h2>İşlemler</h2>
				<button data-toggle="modal" data-target="#formModal" class="btn btn-primary">Yeni Ekle</button>
			</div>
			<div class="card-body">
				<div class="table table-responsive">
					<table id="main-list" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th>Müşteri</th>
								<th>Araç Markası</th>
								<th>Araç Modeli</th>
								<th>Tamir Türü</th>
								<th>Tamir Yeri</th>
								<th>Tamir Tarihi</th>
								<th>İşlemler</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($transactions as $key => $value): ?>
								<tr>
									<td><?php echo $value->customer_name; ?></td>
									<td><?php echo $value->brand_name; ?></td>
									<td><?php echo $value->model_name; ?></td>
									<td><?php echo $value->type_name; ?></td>
									<td><?php echo $value->area_name; ?></td>
									<td><?php echo date("d/m/Y H:i", strtotime($value->transaction_date)); ?></td>
									<td>
										<button type="button" class="btn btn-sm btn-info">Görüntüle</button>
										<button type="button" class="btn btn-sm btn-primary">Düzenle</button>
										<button type="button" class="btn btn-sm btn-success">Tamamla</button>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
						<tfoot>
							<tr>
								<th>Müşteri</th>
								<th>Araç Markası</th>
								<th>Araç Modeli</th>
								<th>Tamir Türü</th>
								<th>Tamir Yeri</th>
								<th>Tamir Tarihi</th>
								<th>İşlemler</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>