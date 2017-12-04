<!-- Flash message -->
<?php $this->load->view('_partial/flash_message') ?>


<!-- Form Element sizes -->
<div class="box box-success">
<div class="box-header with-border">
    <h3 class="box-title"><?= $judul; ?></h3>
    <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
  </div>
</div>
    <div class="box-body">
    <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-default">
        Tambah Data
    </button>

    <div style="overflow:auto;">
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
            <tr>
                <th width="3%">No</th>
                <th width="25%">Nama Kamar</th>
                <th width="15%">Harga Kamar</th>
                <th width="25%">Status Kamar</th>
                <th width="10%">Aksi</th>
            </tr>
            </thead>
            <tbody>
                <?php $i = 0; foreach ($datakamar as $row):?>

                <?php
                    $id    = base64_encode($row->id_kamar);

                    if($row->status == 1){
                        $statusku = "Available";
                        $color = "green";
                    }elseif($row->status == 0){
                        $statusku = "No Available";
                        $color = "red";
                    }

                ?>                
                <tr>
                    <td><?= ++$i ?></td>
                    <td><?= strtoupper($row->nama_kamar) ?></td>
                    <td><?= $row->harga_kamar ?></td>                  
                    <td>
                        <div style="font-size: 14px; text-align: center;  font-weight:bold; " class="bg-<?= $color ?> color-palette" ><?= $statusku ?></div>
                    </td>
                    <td>
                    	<?= anchor('kamar/edit/'.$id, 'Edit', 'class="link-class"') ?>&nbsp;&nbsp;
                    	<?= anchor('kamar/delete/'.$id, 'Delete', 'class="link-class"') ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div>
<!-- /.box-body -->
</div>
<!-- /.box -->



<div class="modal fade" id="modal-default">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"><?= $judul2 ?></h4>
    </div>
    <div class="modal-body">
        <?= form_open($form_action) ?>

        <div class="box-body">

            <div class="form-group">
                <label for="nama" class="col-sm-4 control-label">Nama Kamar</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama_kamar" id="nama_kamar" placeholder="Nama Kamar">
                </div>
            </div>
<br><br>
            <div class="form-group">
                <label for="harga" class="col-sm-4 control-label">Harga Kamar</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="harga_kamar" id="namaharga_kamar_kamar" placeholder="Harga Kamar">
                </div>
            </div>
<br><br>
            <div class="form-group">
                <label for="status" class="col-sm-4 control-label">Status Kamar</label>
                <div class="col-sm-6">
                	<select name="status" id="status">
                		<option value="1">Available</option>
                		<option value="0">Non Available</option>
                	</select>
                </div>
            </div>

            
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <?= form_button(['type' => 'submit', 'content' => 'Simpan', 'class' => 'btn btn-primary pull-right']) ?>
        </div>
    <?= form_close() ?>
    </div>
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->