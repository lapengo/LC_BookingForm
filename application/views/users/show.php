
<!-- Flash message -->
<?php $this->load->view('_partial/flash_message') ?>


<!-- Form Element sizes -->
<div class="box box-success">
<div class="box-header with-border">
    <h3 class="box-title"><?= $tittle; ?></h3>
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
                <th width="9%">Level</th>
                <th width="15%">Username</th>
                <th width="25%">Full Name</th>
                <th width="20%">Email</th>
                <th width="9%">Login Date</th>
                <th  width="7%">Diblokir?</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php $i = 0; foreach ($dataku as $row):?>

                <?php
                    $id    = base64_encode($row->idUsers);
                    $status= base64_encode($row->statususers);

                    if($row->statususers == 0){
                        $statusku = "No";
                        $color = "green";
                    }elseif($row->statususers == 1){
                        $statusku = "Yes";
                        $color = "red";
                    }elseif($row->statususers == 2){
                        $statusku = "Confirm Mail";
                        $color = "yellow";
                    }

                ?>                
                <tr>
                    <td><?= ++$i ?></td>
                    <td><?= strtoupper($row->nameLevels) ?></td>
                    <td><?= $row->username ?></td>
                    <td><?= $row->fullname ?></td>
                    <td><?= $row->email ?></td>
                    <td><?= $row->logindate ?></td>
                    <td>
                        <div style="font-size: 14px; text-align: center;  font-weight:bold; " class="bg-<?= $color ?> color-palette" ><?= $statusku ?></div>
                    </td>
                    <td style="text-align:center" width="140px">
                        <a href="users/update/<?= $id ?>/<?= $status ?>" class="btn btn-app"><i class="fa fa-repeat"></i> Update Status </a>
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
    <h4 class="modal-title"><?= $title2 ?></h4>
    </div>
    <div class="modal-body">
        <?= form_open($form_action) ?>

        <div class="box-body">
            
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-sm-2 control-label">Level</label>
                <div class="col-sm-10">
                <select class="form-control" name="levelID"> 
                    <?php foreach ($level as $r):?>
                        <option value="<?= $r->idLevels ?>"><?= strtoupper($r->nameLevels) ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

            </div>

            <br><br>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email">
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





<!-- Form Element sizes -->
<!-- <div class="box box-primary">
<div class="box-header with-border">
    <h3 class="box-title">Different Height</h3>
    <div class="box-tools pull-right">
    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
</div>
<div class="box-body">
    <input class="form-control input-lg" type="text" placeholder=".input-lg">
    <br>
    <input class="form-control" type="text" placeholder="Default input">
    <br>
    <input class="form-control input-sm" type="text" placeholder=".input-sm">
</div>
<!-- /.box-body -->
<!-- </div> -->
<!-- /.box -->