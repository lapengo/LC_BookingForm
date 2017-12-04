<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title"><?= $judul; ?></h3>
</div>
<!-- /.box-header -->
<!-- form start -->
 <?= form_open($form_action) ?>
  <div class="box-body">


    <div class="form-group">
      <label for="exampleInputPassword1">Nomor Identitas (KTP/SIM/KK)</label>
      <input type="text" class="form-control"  id="no_identitas" name="no_identitas" placeholder="Nomor Identitas (KTP/SIM/KK)">
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Nama Lengkap</label>
      <input type="text" class="form-control"  id="nm_customer" name="nm_customer" placeholder="Nama Lengkap">
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Telp/HP</label>
      <input type="text" class="form-control"  id="telp" name="telp" placeholder="No Telp">
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Alamat Lengkap</label>
      <textarea class="form-control" rows="3" placeholder="Enter ..." name="alamat"></textarea>
    </div>

    <div class="form-group">
      <label for="exampleInputEmail1">Pilih Kamar (/malam)</label>
      <select class="form-control" name="kamar_id" id="kamar_id">
      	<?php $i = 0; foreach ($datakamar as $row):?>
			<option value="<?= $row->id_kamar ?>"><b><?= $row->nama_kamar ?></b>, (<?= $row->harga_kamar ?>)</option>
		<?php endforeach; ?>
	    </select>
    </div>

    <div class="form-group">
      <label for="exampleInputEmail1">Check in</label>
      <input type="date" name="check_in" class="form-control"  >
    </div>

    <div class="form-group">
      <label for="exampleInputEmail1">Check Out</label>
      <input type="date" name="check_out" class="form-control"  >
    </div>

	

  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
    <?= form_button(['type' => 'submit', 'content' => 'Simpan', 'class' => 'btn btn-primary pull-right']) ?>
  </div>
    <?= form_close() ?>
</div>