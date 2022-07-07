<main class="container">
	<div class="row">
		<div class="col s12">
			<h3 style="text-align:center">Menu Antrian</h3>
		</div>
	</div>

	<div class="row">
		<?php foreach ($pelayanan as $row) {?>
			<div class="col s12 m6" style="text-align:center">
				<div class="card" style="background-color:#ecf0f1">
					<div class="card-content">
						<span class="card-title"><?= $row['nama'];?></span>
						<p><?= $row['keterangan'];?></p>
					</div>
					<div class="card-action">
						<a class="waves-effect waves-light btn" onclick="ambilAntrian(<?= $row['id'];?>)">Ambil Antrian</a>
					</div>
					<div class="card-action">
						<?= getTotalAntrian($row['id']);?> Antrian
					</div>
				</div>
			</div>

		<?php } ?>
	</div>
</main>

<script>
	var base_url = "<?= base_url();?>";

	$(document).ready(function(){
		$('#home').attr("class", "active");
	});

	function ambilAntrian(id){
		$.ajax({
			url: base_url+'/ambil-antrian',
			type: "POST",
			data: {
				id:id
			},
			success:function(kembali){
				var responseData = JSON.parse(kembali);
				if(responseData.status=='1'){
					Swal.fire({
						icon: 'success',
						title: 'Antrian ke '+responseData.noAntrian
					});
				}else{
					Swal.fire({
						icon: 'warning',
						title: 'Antrian gagal, silahkan ambil lagi'
					});
				}
				setTimeout( function(){ window.location.reload(); }, 1000);

			}
		});
	}
</script>
