<div class="box box-primary">
<div class="box-header with-border">
  <h3 class="box-title"><?= $judul; ?></h3>
</div>
<!-- /.box-header -->
<!-- form start -->
 <?= form_open($form_action) ?>
  <div class="box-body">
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Kamar</label>
      <input type="text" class="form-control" id="nama_kamar" value="<?= $row->nama_kamar ; ?>" name="nama_kamar" placeholder="Nama Kamar">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Harga Kamar</label>
      <input type="text" class="form-control"  id="harga_kamar" value="<?= $row->harga_kamar ; ?>" name="harga_kamar" placeholder="Harga Kamar">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Status</label> 
		<select class="form-control" name="status" id="status">
			<option value="1">Available</option>
			<option value="0">Non Available</option>
	    </select>
    </div>
  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
    <?= form_button(['type' => 'submit', 'content' => 'Simpan', 'class' => 'btn btn-primary pull-right']) ?>
  </div>
    <?= form_close() ?>
</div>