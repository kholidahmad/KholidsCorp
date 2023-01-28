<?php
// Form buka utk delete multiple
echo form_open(base_url('admin/division/proses'));
?>
<input type="hidden" name="pengalihan" value="<?php echo str_replace('index.php/', '', current_url()) ?>">
<?php if ($this->session->userdata('akses_level') == "Admin") { ?>
  <p>
    <div class="btn-group">
      <a href="<?php echo base_url('admin/division/tambah') ?>" class="btn btn-success btn-lg">
        <i class="fa fa-plus"></i> Tambah Baru</a>

      <button class="btn btn-info btn-lg" name="aktifkan" type="submit">
        <i class="fa fa-check"></i> Aktifkan
      </button>

      <button class="btn btn-warning btn-lg" name="non_aktifkan" type="submit">
        <i class="fa fa-times"></i> Non Aktifkan
      </button>

      <button class="btn btn-danger btn-lg" name="hapus" type="submit">
        <i class="fa fa-trash"></i> Hapus
      </button>
    </div>
  </p>
<?php } ?>

<div class="table-responsive mailbox-messages">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th class="text-center" width="5%">
          <!-- Check all button -->
          <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
          </button>
        </th>
        <th>KODE</th>
        <th>NAMA</th>
        <th>STATUS</th>
        <?php if ($this->session->userdata('akses_level') == "Admin") { ?>
          <th>ACTION</th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>

      <?php
      // Looping data division dg foreach
      $i = 1;
      foreach ($division as $division) {
        ?>

        <tr>
          <td class="text-center">
            <input type="checkbox" name="id_division[]" value="<?php echo $division->id_division ?>">
          </td>
          <td><?php echo $division->kode_division ?></td>
          <td><?php echo $division->nama_division ?></td>
          <td><?php echo $division->status_division ?></td>
          <?php if ($this->session->userdata('akses_level') == "Admin") { ?>
            <td>
              <div class="btn-group">
                <a href="<?php echo base_url('admin/division/edit/' . $division->id_division) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                <a href="<?php echo base_url('admin/division/delete/' . $division->id_division) ?>" class="btn btn-danger btn-sm" onclick="confirmation(event)"><i class="fa fa-trash-o"></i> Hapus</a>
              </div>
            </td>
          <?php } ?>
        </tr>

      <?php $i++;
      } //End looping 
      ?>
    </tbody>
  </table>

</div>
<!-- /.mail-box-messages -->
<?php
// Form tutup
echo form_close();
?>