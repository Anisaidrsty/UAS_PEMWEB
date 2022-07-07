<main class="container">
	<div class="row" style="margin-top:2rem;">
		<div class="col m12">
			<a class="waves-effect waves-light btn modal-trigger" href="#modalTambah" style="float:right;"><i class="material-icons left">add</i>Tambah Admin</a>
		</div>
		<div class="col m12" style="margin-top:2rem;">
			<div style="overflow-x:auto;">
				<table class="striped" id="tableAdmin">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Nama</th>
							<th scope="col">Username</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no=1; foreach($admin as $row){?>
							<tr>
								<th scope="row"><?= $no++;?></th>
								<td><?= $row['nama'];?></td>
								<td><?= $row['username'];?></td>
								<td>
									<button type="button" class="waves-effect waves-light btn-small" style="background-color:#e74c3c" onclick="hapusAdmin(<?= $row['id'];?>)">Hapus</button>
									<button type="button" class="waves-effect waves-light btn-small" style="background-color:#f39c12" onclick="editAdmin(<?= $row['id'];?>, '<?= $row['nama'];?>', '<?= $row['password'];?>')">Edit</button>
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
	<?= form_open('/admin/tambah', 'autocomplate="off"'); ?>
		<div class="modal-content">
			<h5>Tambah Admin</h5>
			<div class="row">
				<div class="input-field col s12">
          <input id="nama" name="nama" type="text" class="validate" value="<?= old('nama');?>" required>
          <label for="nama">Nama</label>
					<span class="form-text" style="color:#e74c3c;"><?= $validation->getError('nama');?></span>
        </div>
			</div>
			<div class="row">
				<div class="input-field col s12 m6">
					<input type="text" class="validate" id="username" name="username" value="<?= old('username');?>" required>
					<label for="username">Username</label>
					<span class="form-text" style="color:#e74c3c;"><?= $validation->getError('username');?></span>
				</div>
				<div class="input-field col s12 m6">
					<input type="password" class="validate" id="password" name="password" value="<?= old('password');?>" required>
					<label for="password">Password</label>
					<span class="form-text" style="color:#e74c3c;"><?= $validation->getError('password');?></span>
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
	<?= form_open('/admin/update', 'autocomplate="off"'); ?>
		<div class="modal-content">
			<h5>Edit Admin <label id="titleEdit"></label></h5>
			<input type="hidden" id="idEdit" name="idEdit" required>
			<div class="row">
				<div class="input-field col s12">
          <input id="namaEdit" name="namaEdit" type="text" class="validate" value="<?= old('namaEdit');?>" required>
          <label for="namaEdit">Nama</label>
					<span class="form-text" style="color:#e74c3c;"><?= $validation->getError('namaEdit');?></span>
        </div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="password" class="validate" id="passwordEdit" name="passwordEdit" value="<?= old('passwordEdit');?>" required>
					<label for="passwordEdit">Password</label>
					<span class="form-text" style="color:#e74c3c;"><?= $validation->getError('passwordEdit');?></span>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="reset" class="waves-effect waves-light btn-small" style="background-color:#e74c3c">Reset</button>
			<button type="submit" class="waves-effect waves-light btn-small" style="background-color:#1abc9c">Update</button>
		</div>
	<?= form_close();?>
</div>


<!-- Script -->
<script>
	var base_url  = "<?= base_url();?>";
	var formError = "<?= session()->getFlashdata('errorForm');?>";
	var formErrorEdit = "<?= session()->getFlashdata('errorFormEdit');?>";


	$(document).ready(function(){
		$('#admin').attr("class", "active");
		
		// Membuat Table Menjadi Datatable
		$('#tableAdmin').DataTable();

		// Membuat Function modal
		$('.modal').modal();

		// Jika Form Tambah Terdapat Error
		if(formError){
			$('#modalTambah').modal('open');
			Swal.fire(
				'Gagal',
				'Admin Gagal Ditambahkan',
				'warning'
			)
		}

		// Jika Form Edit Terdapat Error
		if(formErrorEdit){
			$('#modalEdit').modal('open');

			Swal.fire(
				'Gagal',
				'Admin Gagal Diupdate',
				'warning'
			)
		}

	});

	// Function Menghapus Admin
	function hapusAdmin(id){
		Swal.fire({
			title: `Hapus Admin?`,
			text: `Admin akan terhapus permanent`,
			showDenyButton: true,
			confirmButtonText: `Hapus`,
			denyButtonText: `Batal`,
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: base_url+`/admin/hapus/`,
					type: "POST",
					data: {
						id:id
					},
					success:function(kembali){
						if(kembali==1){
							Swal.fire({
								icon: 'success',
								title: 'User Berhasil Dihapus'
							});
							setTimeout( function(){ window.location.reload(); }, 600);
						}else{
							Swal.fire({
								icon: 'warning',
								title: 'User Gagal Dihapus'
							});
							setTimeout( function(){ window.location.reload(); }, 600);
						}
					}
				});
			}
		})
	}

	function editAdmin(id, nama, password){
		$('#idEdit').val(id);
		$('#namaEdit').val(nama);
		$('#passwordEdit').val(password);
		$('#titleEdit').html(nama);
		$('#modalEdit').modal('open');
	}
</script>