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
   <a href="reservasi"><button type="button" class="btn btn-primary btn-flat">
        Pesan Kamar
    </button></a>

    <div style="overflow:auto;">
        <table class="table table-bordered table-striped" id="mytable">
            <thead>
            <tr>
                <th>No. Identitas</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. Telp</th>
                <th>Kamar</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>Harga</th>
                <th>Status</th>
                <th width="10%">Aksi</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($pesanan as $row):?>    
                <?php 
                	$id = base64_encode($row->id_transaksi);
                	$status = base64_encode($row->status_transaksi);  

                	if($row->status_transaksi == 1){
                        $statusku = "Done";
                        $color = "green";
                    }elseif($row->status_transaksi == 0){
                        $statusku = "Pendding";
                        $color = "yellow";
                    }
                ?>       
                <tr>
                    <td><?= $row->no_identitas ?></td>
                    <td><?= $row->nm_customer ?></td> 
                    <td><?= $row->alamat ?></td>
                    <td><?= $row->telp ?></td>
                    <td><?= $row->nama_kamar ?></td>
                    <td><?= $row->check_in ?></td>
                    <td><?= $row->check_out ?></td>
                    <td><?= $row->harga ?></td>
                    <td>
                        <div style="font-size: 14px; text-align: center;  font-weight:bold; " class="bg-<?= $color ?> color-palette" ><?= $statusku ?></div>
                    </td>
                    <td style="text-align:center" width="140px">
                        <a href="reservasi/update/<?= $id ?>/<?= $status ?>" class="btn btn-app"><i class="fa fa-repeat"></i> Update Status </a>
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