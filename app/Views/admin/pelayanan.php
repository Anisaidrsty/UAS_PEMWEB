<main class="container">
	<div class="row" style="margin-top:2rem;">
		<div class="col m12">
			<a class="waves-effect waves-light btn modal-trigger" href="#modalTambah" style="float:right;"><i class="material-icons left">add</i>Tambah Pelayanan</a>
		</div>
		<div class="col m12" style="margin-top:1rem;">
			<div style="overflow-x:auto;">
				<table class="striped" id="tablePelayanan">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Nama</th>
							<th scope="col">Keterangan</th>
							<th scope="col">Kode</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach($pelayanan as $row){?>
							<tr>
								<th scope="row"><?= $no++;?></th>
								<td><?= $row['nama'];?></td>
								<td><?= $row['keterangan'];?></td>
								<td><?= $row['kode'];?></td>
								<td>
									<button type="button" class="waves-effect waves-light btn-small" style="background-color:#e74c3c" onclick="hapusPelayanan(<?= $row['id'];?>, '<?= $row['nama'];?>')">Hapus</button>
									<button type="button" class="waves-effect waves-light btn-small" style="background-color:#f39c12" onclick="editPelayanan(<?= $row['id'];?>, '<?= $row['nama'];?>', '<?= $row['keterangan'];?>', '<?= $row['kode'];?>')">Edit</button>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</main>

<!-- Modal Tambah -->
<div class="modal" id="modalTambah">
	<?= form_open('/admin/pelayanan/tambah', 'autocomplate="off"'); ?>
		<div class="modal-content">
			<h5>Tambah Pelayanan</h5>
			<div class="row">
				<div class="input-field col s6 m6">
          <input id="nama" name="nama" type="text" class="validate" value="<?= old('nama');?>" required>
          <label for="nama">Nama</label>
					<span class="form-text" style="color:#e74c3c;"><?= $validation->getError('nama');?></span>
        </div>
				<div class="input-field col s6 m6">
					<input type="text" class="validate" id="kode" name="kode" value="<?= old('kode');?>" required>
					<label for="kode">Kode</label>
					<span class="form-text" style="color:#e74c3c;"><?= $validation->getError('kode');?></span>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<label for="keterangan">Keterangan</label>
					<input type="text" class="validate" id="keterangan" name="keterangan" value="<?= old('keterangan');?>" required>
					<span class="form-text" style="color:#e74c3c;"><?= $validation->getError('keterangan');?></span>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="reset" class="waves-effect waves-light btn-small" style="background-color:#e74c3c">Reset</button>
			<button type="submit" class="waves-effect waves-light btn-small" style="background-color:#1abc9c">Submit</button>
		</div>
	<?= form_close();?>
</div>


<!-- Modal Edit -->
<div class="modal" id="modalEdit">
	<?= form_open('/admin/pelayanan/update', 'autocomplate="off"'); ?>
		<div class="modal-content">
			<h5 class="modal-title" id="exampleModalLabel">Edit Pelayanan <label id="titleEdit"></label></h5>
			<input type="hidden" id="idEdit" name="idEdit" required>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" class="validate" id="namaEdit" name="namaEdit" value="<?= old('namaEdit');?>" required>
					<label for="namaEdit">Nama</label>
					<span class="form-text" style="color:#e74c3c;"><?= $validation->getError('namaEdit');?></span>
				</div>
				<div class="input-field col s12">
					<input type="text" class="validate" id="keteranganEdit" name="keteranganEdit" value="<?= old('keteranganEdit');?>" required>
					<label for="keterangan">Keterangan</label>
					<span class="form-text" style="color:#e74c3c;"><?= $validation->getError('keteranganEdit');?></span>
				</div>
			</div>
			<div class="modal-footer">
				<button type="reset" class="waves-effect waves-light btn-small" style="background-color:#e74c3c">Reset</button>
				<button type="submit" class="waves-effect waves-light btn-small" style="background-color:#1abc9c">Submit</button>
			</div>
		</div>
	<?= form_close();?>
</div>


<!-- Script -->
<script>
	var base_url  = "<?= base_url();?>";
	var errorForm = "<?= session()->getFlashdata('errorForm');?>";
	var errorFormEdit = "<?= session()->getFlashdata('errorFormEdit');?>";


	$(document).ready(function(){

		$('#pelayanan').addClass('active');

		// Membuat Function modal
		$('.modal').modal();

		// Membuat DataTable
		$('#tablePelayanan').DataTable();

		// Jika Form Terdapat Error
		if(errorForm){
			$('#modalTambah').modal('open');
			Swal.fire(
				'Gagal',
				'Data Gagal Ditambahkan',
				'warning'
			)
		}

		// Jika Form Edit Terdapat Error
		if(errorFormEdit){
			$('#modalEdit').modal('open');

			Swal.fire(
				'Gagal',
				'Data Gagal Diupdate',
				'warning'
			)
		}
	});

	function hapusPelayanan(id, pelayanan){
		Swal.fire({
			title: 'Hapus Pelayanan?',
			text: 'Pelayanan '+pelayanan+' akan terhapus permanent',
			showDenyButton: true,
			confirmButtonText: 'Hapus',
			denyButtonText: 'Batal',
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: base_url+'/admin/pelayanan/hapus/',
					type: "POST",
					data: {
						id:id
					},
					success:function(kembali){
						if(kembali==1){
							Swal.fire({
								icon: 'success',
								title: 'Pelayanan Berhasil Dihapus'
							});
							setTimeout( function(){ window.location.reload(); }, 600);
						}else{
							Swal.fire({
								icon: 'warning',
								title: 'Pelayanan Gagal Dihapus'
							});
							setTimeout( function(){ window.location.reload(); }, 600);
						}
					}
				});
			}
		});
	}

	function editPelayanan(id, nama, keterangan, kode){
		$('#idEdit').val(id);
		$('#namaEdit').val(nama);
		$('#keteranganEdit').val(keterangan);
		$('#kodeEdit').val(kode);
		$('#titleEdit').html(nama);
		$('#modalEdit').modal('open');
	}
</script>