<?php
// Notifikasi error
echo validation_errors('<p class="alert alert-warning">', '</p>');

// Form open
echo form_open(base_url('admin/director/edit/' . $director->id_director));
?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Nama director <span class="text-danger">*</span></label>
			<input type="text" name="nama_director" class="form-control form-control-lg" value="<?php echo $director->nama_director ?>" placeholder="Nama director" required>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label>Kode director <span class="text-danger">*</span></label>
			<input type="text" name="kode_director" class="form-control form-control-lg" value="<?php echo $director->kode_director ?>" placeholder="Kode director" required>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label>Status director <span class="text-danger">*</span></label>
			<select name="status_director" class="form-control form-control-lg">
				<option value="Aktif">Aktif</option>
				<option value="Non Aktif" <?php if ($director->status_director == "Non Aktif") {
												echo "selected";
											} ?>>Non Aktif</option>
			</select>
		</div>
	</div>

	<div class="col-md-12">
		<div class="form-group">
			<label>Deskripsi director</label>
			<textarea name="keterangan" class="form-control textarea" placeholder="Keterangan"><?php echo $director->keterangan ?></textarea>
		</div>

		<div class="form-group">
			<label>Wilayah yang dibawahi</label>
			<textarea name="wilayah" class="form-control" placeholder="Wilayah"><?php echo $director->wilayah ?></textarea>
		</div>

		<div class="form-group">
			<div class="btn-group">
				<button class="btn btn-success btn-lg" name="submit" type="submit">
					<i class="fa fa-save"></i> Simpan
				</button>
				<button class="btn btn-info btn-lg" name="reset" type="reset">
					<i class="fa fa-times"></i> Reset
				</button>
				<a href="<?php echo base_url('admin/director') ?>" class="btn btn-warning btn-lg">
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