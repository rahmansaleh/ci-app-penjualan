<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('penjualan') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<!-- <a href="<?= base_url('penjualan/export') ?>" class="btn btn-danger btn-sm"><i class="fa fa-file-pdf"></i>&nbsp;&nbsp;Export</a> -->
						<a href="<?= base_url('penjualan/tambah') ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah</a>
					</div>
				</div>
				<hr>
				<?php if ($this->session->flashdata('success')) : ?>
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('success') ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php elseif($this->session->flashdata('error')) : ?>
					<div class="alert alert-danger alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('error') ?>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php endif ?>
				<div class="card shadow">
					<div class="card-header"><strong>Daftar Penjualan</strong></div>
					<div class="card-body">
						<form action="<?= base_url('penjualan/lihat') ?>" method="GET">
							<div class="form-group">
								<label>Filter Tanggal :</label>
								<div class="row">
									<div class="col-md-10">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="far fa-calendar-alt"></i>
												</span>
											</div>
											<input type="text" class="form-control float-right" id="penjualan-list-daterange" name="penjualan-list-daterange" value="<?= $penjualan_list_daterange; ?>">
										</div>
									</div>
									<div class="col-md-2">
										<button type="submit" class="btn btn-success btn-block">
											<i class="fas fa-check-circle">
												&nbsp;&nbsp;Pilih
											</i>
										</button>
									</div>
								</div>
							</div>
						</form>
						<div class="table-responsive">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
								<thead>
									<tr>
										<td>No.</td>
										<td>Nama Pembeli</td>
										<td>Tanggal Penjualan</td>
										<td>Barang</td>
										<td>Total</td>
									</tr>
								</thead>
								<tbody>
									<?php 
										$i = 0;
										foreach ($all_penjualan as $penjualan):
										$i++;
									?>
										<tr>
											<td><?= $i; ?></td>
											<td><?= $penjualan->nama_pembeli ?></td>
											<td><?= $penjualan->tgl_penjualan." ".$penjualan->jam_penjualan ?></td>
											<td><?= $penjualan->jumlah_barang."x ".$penjualan->nama_barang; ?></td>
											<td><?= number_format($penjualan->sub_total, 0, ',', '.') ?></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>				
				</div>
				</div>
			</div>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('sb-admin/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('sb-admin') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
	<script src="<?= base_url() ?>assets/moment/moment.min.js"></script>
	<script src="<?= base_url() ?>assets/daterangepicker/daterangepicker.js"></script>
	<script>
		$('#penjualan-list-daterange').daterangepicker();
	</script>
	
</body>
</html>