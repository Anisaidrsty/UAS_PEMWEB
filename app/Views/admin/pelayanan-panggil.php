<main class="container">
	
	<div class="row" style="margin-top:2rem;">
		<div class="col m12" style="text-align:center;">
			<h5>Pelayanan <?= $detailLoket['nama'];?> (<?= $detailLoket['nama_pelayanan'];?>)</h5>
		</div>
	</div>

	<div class="row">

		<!-- Tampilan Sedang Dilayani -->
		<div class="col m5 s12" style="text-align:center;">
			<div class="card" style="background-color:#ecf0f1">
				<div class="card-content">
					<span class="card-title">Sedang Dilayani</span>
					<h4><?= loketLayani(service('uri')->getSegment(4), $detailLoket['kode']);?></h4>
				</div>
			</div>
			<br>
			<?php if(loketLayani(service('uri')->getSegment(4), $detailLoket['kode'])!="Tidak Ada"){?>
				<button type="button" class="waves-effect waves-light btn" onclick="selesaiLayan(<?= service('uri')->getSegment(4);?>)">Selesai</button>
			<?php }?>
		</div>

		<!-- Daftar Antrian Selanjutnya -->
		<div class="col m7 s12">
			<div class="d-grid gap-2">
				<h6 style="font-weight:500">Daftar Antrian Selanjutnya</h6>
			</div>
			<br>
			<table class="striped">
				<thead>
					<tr>
						<th scope="col">Antrian</th>
						<th scope="col">Panggil</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($antrian->getResultArray() as $row){?> 
						<tr>
							<th scope="row"><?= $row['kode'];?>-<?= $row['no_antrian'];?></th>
							<td>
								<?php if($row['status']==0){?>
									<button type="button" class="waves-effect waves-light btn" onclick="panggilAntrian(<?= $row['id'];?>, <?= service('uri')->getSegment(4);?>, '<?= $row['kode'];?>-<?= $row['no_antrian'];?>')">Panggil</button>
								<?php }else{?>
									<button type="button" class="waves-effect waves-light btn" style="background-color:#e67e22" onclick="panggilLagi(<?= $row['id'];?>, '<?= $row['kode'];?>-<?= $row['no_antrian'];?>')">Panggil Lagi</button>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>

</main>

<script>
	var base_url = "<?= base_url();?>";

	$('#loket').addClass('active');

	// Memanggil nomor antrian baru
	function panggilAntrian(id, loketId, noAntrian) {
		$.ajax({
			url: base_url+"/admin/antrian/panggil-antrian",
			type: "POST",
			data: {
				id: id,
				loketId: loketId,
			},
			success:function(kembali){
				if(kembali==1){
					Swal.fire({
						icon: 'success',
						title: 'Berhasil',
						text: 'Panggilan Nomor Antrian '+ noAntrian
					});
					setTimeout( function(){ window.location.reload(); }, 500);
				}else{
					Swal.fire({
						icon: 'warning',
						title: 'Gagal Memanggil'
					});
				}
			}
		});
	}

	// Memanggil Lagi Nomor Antrian yang sedang dilayani
	function panggilLagi(id, noAntrian) {
		Swal.fire({
			icon: 'success',
			title: 'Panggilan Nomor Antrian '+ noAntrian
		});
	}

	function selesaiLayan(loketId) {
		Swal.fire({
			title: 'Selesai?',
			showDenyButton: true,
			confirmButtonText: 'Iya',
			denyButtonText: 'Batal',
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: base_url+'/admin/antrian/panggil/selesai',
					type: "POST",
					data: {
						loketId: loketId
					},
					success:function(kembali){
						if(kembali==1){
							Swal.fire({
								icon: 'success',
								title: 'Berhasil'
							});
							setTimeout( function(){ window.location.reload(); }, 600);
						}else{
							Swal.fire({
								icon: 'warning',
								title: 'Gagal'
							});
						}
					}
				});
			}
		})
	}
</script>