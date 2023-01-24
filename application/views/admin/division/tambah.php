<?php
// Notifikasi error
echo validation_errors('<p class="alert alert-warning">', '</p>');

// Form open
echo form_open(base_url('admin/division/tambah'));
?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Nama division <span class="text-danger">*</span></label>
			<input type="text" name="nama_division" class="form-control form-control-lg" value="<?php echo set_value('nama_division') ?>" placeholder="Nama division" required>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label>Kode division <span class="text-danger">*</span></label>
			<input type="text" name="kode_division" class="form-control form-control-lg" value="<?php echo set_value('kode_division') ?>" placeholder="Kode division" required>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label>Status division <span class="text-danger">*</span></label>
			<select name="status_division" class="form-control form-control-lg">
				<option value="Aktif">Aktif</option>
				<option value="Non Aktif">Non Aktif</option>
			</select>
		</div>
	</div>

	<div class="col-md-12">
		<div class="form-group">
			<label>Deskripsi division</label>
			<textarea name="keterangan" class="form-control textarea" placeholder="Keterangan"><?php echo set_value('keterangan') ?></textarea>
		</div>

		<div class="form-group">
			<div class="btn-group">
				<button class="btn btn-success btn-lg" name="submit" type="submit">
					<i class="fa fa-save"></i> Simpan
				</button>
				<button class="btn btn-info btn-lg" name="reset" type="reset">
					<i class="fa fa-times"></i> Reset
				</button>
				<a href="<?php echo base_url('admin/division') ?>" class="btn btn-warning btn-lg">
					<i class="fa fa-backward"></i> Kembali
				</a>
			</div>
		</div>
	</div>
</div>
<?php
// Form close
echo form_close();
?>