<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ICS Project</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar-brand" href="#">Site Başlığı</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="#">Anasayfa <span class="sr-only">(current)</span></a>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<main>
		<div class="container p-3">
			<div class="row">
				<div class="col-12">
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
								<tr>
									<td>Tolga ÇINAR</td>
									<td>Renault</td>
									<td>Clio</td>
									<td>Tamir Türü</td>
									<td>Tamir Yeri</td>
									<td>Tamir Tarihi</td>
									<td>
										<div class="btn-group d-flex" role="group" aria-label="Second group">
											<button type="button" class="btn btn-secondary">Görüntüle</button>
											<button type="button" class="btn btn-secondary">Düzenle</button>
											<button type="button" class="btn btn-secondary">Kaldır</button>
										</div>
									</td>
								</tr>
							</tbody>
							<tfoot>
								<tr te>
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
	</main>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script>
	$(document).ready(function() {
		$('#main-list').DataTable();
	});
</script>
</html>