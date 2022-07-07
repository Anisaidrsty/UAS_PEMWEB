<main class="container">
	<div class="row" style="margin-top:2rem;">
		<div class="col s12">
			<a class="waves-effect waves-light btn modal-trigger" href="#modalTambah" style="float:right;"><i class="material-icons left">add</i>Tambah Loket</a>
		</div>
		<div class="col s12" style="margin-top:1rem;">
			<div style="overflow-x:auto;">
				<table class="striped" id="tableLoket">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Nama</th>
							<th scope="col">Keterangan</th>
							<th scope="col">Pelayanan</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach($loket as $row){?>
							<tr>
								<th scope="row"><?= $no++;?></th>
								<td><a href="/admin/antrian/panggil/<?= $row['id'];?>"><?= $row['nama'];?></a></td>
								<td><?= $row['keterangan'];?></td>
								<td><?= $row['nama_pelayanan'];?></td>
								<td>
									<button type="button" class="waves-effect waves-light btn-small" style="background-color:#e74c3c" onclick="hapusLoket(<?= $row['id'];?>, '<?= $row['nama'];?>')">Hapus</button>
									<button type="button" class="waves-effect waves-light btn-small" style="background-color:#f39c12" onclick="editLoket(<?= $row['id'];?>, '<?= $row['nama'];?>', '<?= $row['keterangan'];?>', <?= $row['pelayanan_id'];?>)">Edit</button>
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
	<?= form_open('/admin/loket/tambah', 'autocomplate="off"'); ?>
		<div class="modal-content">
			<h5>Tambah Loket</h5>
			<div class="row">
				<div class="input-field col s12">
					<input type="text" class="validate" id="nama" name="nama" value="<?= old('nama');?>" required>
					<label for="nama">Nama</label>
					<span class="form-text" style="color:#e74c3c;"><?= $validation->getError('nama');?></span>
				</div>
				<div class="input-field col s12">
					<input type="text" class="validate" id="keterangan" name="keterangan" value="<?= old('keterangan');?>" required>
					<label for="keterangan">Keterangan</label>
					<span class="form-text" style="color:#e74c3c;"><?= $validation->getError('keterangan');?></span>
				</div>
				<div class="input-field col s12">
					<select name="pelayanan" id="pelayanan" required>
						<option value="">~~~Pilih Pelayanan~~~</option>
						<?php foreach($pelayanan as $row){?>
							<option value="<?= $row['id'];?>"><?= $row['nama'];?></option>
						<?php } ?>
					</select>
					<label for="pelayanan">Pelayanan</label>
				</div>
			</div>
			<div class="modal-footer">
				<button type="reset" class="waves-effect waves-light btn-small" style="background-color:#e74c3c">Reset</button>
				<button type="submit" class="waves-effect waves-light btn-small" style="background-color:#1abc9c">Submit</button>
			</div>
		</div>
	<?= form_close();?>
</div>


<!-- Modal Edit -->
<div class="modal" id="modalEdit">
	<?= form_open('/admin/loket/update', 'autocomplate="off"'); ?>
		<div class="modal-content">
			<h5 class="modal-title" id="exampleModalLabel">Edit Loket <label id="titleEdit"></label></h5>
			<div class="row">
				<input type="hidden" name="idEdit" id="idEdit" required>
				<div class="input-field col s12">
					<input type="text" class="validate" id="namaEdit" name="namaEdit" value="<?= old('namaEdit');?>" required>
					<label for="nama">Nama</label>
					<span class="form-text" style="color:#e74c3c;"><?= $validation->getError('namaEdit');?></span>
				</div>
				<div class="input-field col s12">
					<input type="text" class="form-control" id="keteranganEdit" name="keteranganEdit" value="<?= old('keteranganEdit');?>" required>
					<label for="keterangan">Keterangan</label>
					<span class="form-text" style="color:#e74c3c;"><?= $validation->getError('keteranganEdit');?></span>
				</div>
				<div class="input-field col s12">
					<select name="pelayananEdit" id="pelayananEdit" required>
						<option value="">~~~Pilih Pelayanan~~~</option>
						<?php foreach($pelayanan as $row){?>
							<option value="<?= $row['id'];?>" ><?= $row['nama'];?></option>
						<?php } ?>
					</select>
					<span class="form-text" style="color:#e74c3c;"><?= $validation->getError('pelayananEdit');?></span>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="reset" class="waves-effect waves-light btn-small" style="background-color:#e74c3c">Reset</button>
			<button type="submit" class="waves-effect waves-light btn-small" style="background-color:#1abc9c">Submit</button>
		</div>
	<?= form_close();?>
</div>


<!-- Script -->
<script>
	var base_url  = "<?= base_url();?>";
	var errorForm = "<?= session()->getFlashdata('errorForm');?>";
	var errorFormEdit = "<?= session()->getFlashdata('errorFormEdit');?>";

	$(document).ready(function(){

		$('#loket').addClass('active');

		$('#tableLoket').DataTable();

		// Membuat Function Modal
		$('.modal').modal();

		// Membuat Select Modal
		$('select').formSelect();

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

	function hapusLoket(id, loket){
		Swal.fire({
			title: 'Hapus Loket?',
			text: 'Loket '+loket+' akan terhapus permanent',
			openDenyButton: true,
			confirmButtonText: 'Hapus',
			denyButtonText: 'Batal',
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: base_url+'/admin/loket/hapus/',
					type: "POST",
					data: {
						id:id
					},
					success:function(kembali){
						if(kembali==1){
							Swal.fire({
								icon: 'success',
								title: 'Loket Berhasil Dihapus'
							});
						}else{
							Swal.fire({
								icon: 'warning',
								title: 'Loket Gagal Dihapus'
							});
						}
						setTimeout( function(){ window.location.reload(); }, 600);
					}
				});
			} else if (result.isDenied) {
				Swal.fire('Batal', 'Data Tidak Terhapus', 'info');
			}
		});
	}

	function editLoket(id, nama, keterangan, pelayanan){
		$('#idEdit').val(id);
		$('#namaEdit').val(nama);
		$('#keteranganEdit').val(keterangan);
		$('#pelayananEdit').val(pelayanan)
		$('#titleEdit').html(nama);
		$('#modalEdit').modal('open');
	}
</script>