<div class="row">
  <div class="col-md-6">


    <p>

      <?php include('tambah.php') ?>
    </p>
  </div>
</div>
<?php
echo form_open(base_url('admin/staff/proses'));
?>
<?php if ($this->session->userdata('akses_level') == "Admin") { ?>
  <p class="text-right">
    <div class="btn-group">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"></i> Tambah Staff
      </button>


      <button class="btn btn-danger" type="submit" name="hapus" onClick="check();">
        <i class="fa fa-trash-o"></i> Hapus
      </button>
      <button class="btn btn-primary" type="submit" name="export" onClick="Export();">
        <i class="fa fa-file-excel-o"></i> Export Excel (Terpilih)
      </button>

      <button class="btn btn-info" type="submit" name="exportAll" onClick="Export();">
        <i class="fa fa-file-excel-o"></i> Export Excel (Semua)
      </button>

    </div>
  </p>
<?php } ?>
<div class="table-responsive mailbox-messages">
  <table id="example" class="display table table-bordered table-hover" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th width="5%">
          <div class="mailbox-controls">
            <!-- Check all button -->
            <button type="button" class="btn btn-default btn-xs checkbox-toggle"><i class="fa fa-square-o"></i>
            </button>
          </div>
        </th>
        <th style="vertical-align: middle;" class="text-center" width="25%">NAMA</th>
        <th style="vertical-align: middle;" class="text-center" width="20%">EMAIL</th>
        <th style="vertical-align: middle;" class="text-center">JABATAN</th>
        <?php if ($this->session->userdata('akses_level') == "Admin") { ?>
          <th width="15%"></th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>

      <?php
      // Looping data user dg foreach
      $i = 1;
      foreach ($staff as $staff) {
        ?>

        <tr>
          <td class="text-center">
            <input type="checkbox" name="id_staff[]" value="<?php echo $staff->id_staff ?>">
          </td>
          <td><?php echo $staff->nama ?></td>
          <td><?php echo $staff->email ?></td>
          <td><?php echo $staff->jabatan ?></td>
          <?php if ($this->session->userdata('akses_level') == "Admin") { ?>
            <td>
              <div class="btn-group">
                <a href="<?php echo base_url('admin/staff/edit/' . $staff->id_staff) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                <a href="<?php echo base_url('admin/staff/delete/' . $staff->id_staff) ?>" class="btn btn-danger btn-sm" onclick="confirmation(event)"><i class="fa fa-trash-o"></i> Hapus</a>
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

<?php echo form_close(); ?>