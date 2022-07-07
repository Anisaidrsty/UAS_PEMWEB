<main class="container">
	<!-- Nomor Antrian Sekarang & Video -->
	<div class="row" style="margin-top:3rem;">
		<div class="col s12 m5" style="text-align:center">
			<div class="card" style="background-color:#ecf0f1">
				<div class="card-content">
					<span class="card-title">Panggilan Antrian</span>
					<h5><?= ($panggilTerakhir->getNumRows()<1)?"Tidak Ada":$panggilTerakhir->getRowArray()['kode']."-".$panggilTerakhir->getRowArray()['no_antrian'];?></h5>
				</div>
				<?php if($panggilTerakhir->getNumRows()>0){?>
					<div class="card-action">
						<?= $panggilTerakhir->getRowArray()['nama_loket'];?>
					</div>
				<?php } ?>				
			</div>
		</div>

		<div class="col s12 m7">
			<div class="card text-center">
				<div class="card-content">
					<iframe width="550" height="275" src="https://www.youtube.com/embed/ZpTKvEIhZNQ?autoplay=1"  allow="autoplay" frameborder="0" allowfullscreen style="max-width:100%"></iframe>
				</div>
			</div>
		</div>
	</div>
	<!-- END Nomor Antrian Sekarang & Video -->

	<!-- Daftar Loket & Nomor Antrian Aktif -->
	<div class="row">
		<?php foreach ($detailLoket as $row) {?>
			<div class="col m3 s6" style="text-align:center;">
				<div class="card">
					<div class="card-content">
						<h1 class="card-title"><?= loketLayani($row['id'], $row['kode']);?></h1>
					</div>
					<div class="card-action">
						<?= $row['nama'];?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
	<!-- END Daftar Loket & Nomor Antrian Aktif -->

</main>

<script>
	$(document).ready(function(){
		$('#detailAntrian').attr("class", "active");
	})
</script>