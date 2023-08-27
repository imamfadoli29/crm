<?php 
if(isset($_GET['menu'])){ ?>
<?php foreach($getAllService as $data){ $row = $db->object($data); ?>
<div class="col-md-12 mt-5">
    <div class="card-header bg-primary text-center text-white"><h3>Service</h3></div>
    <div class="card">
        <div class="card-body">
            <?php 
            if(isset($_SESSION['success'])){
                echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
                unset($_SESSION['success']);
            }else if(isset($_SESSION['warning'])){
                echo '<div class="alert alert-warning">'.$_SESSION['warning'].'</div>';
                unset($_SESSION['warning']);
            } ?>
            <h4><?= $row->nama_service ?></h4><br>
            <p><?= $row->deskripsi_service ?>
            <br>
            <a class="btn btn-primary my-4" data-toggle="modal" data-target="#exampleModalLong<?= $row->id_service ?>" href="#">Order Sekarang!</a>
        </div>
        <div class="card-footer bg-white">
            <i class="fa fa-bookmark"></i> <?= $row->jenis_service ?>
            | <i class="fa fa-dollar"></i> <?= "Rp. ". number_format($row->harga_service,0,'.','.') ?>
        </div>
    </div>
</div>
<?php } ?>
<?php foreach($getAllService as $data){ $row = $db->object($data); ?>
<div class="modal fade" id="exampleModalLong<?= $row->id_service ?>">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title">Order Service</h6>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
            <form action="../controller/Data_crm.php?action=tambah_order&id=<?= $row->id_service ?>" method="POST" enctype="multipart/form-data">
                <label class="my-4 h6">Nama Service</label>
                <p><?= $row->nama_service ?></p>
                <label class="my-4 h6">Deskripsi Service</label>
                <p><?= $row->deskripsi_service ?></p> 
                <label class="my-4 h6">Jenis Service</label>
                <p><?= $row->jenis_service ?></p> 
                <label class="my-4 h6">Harga Service</label>
                <p><?= "Rp. ". number_format($row->harga_service,0,'.','.') ?></p> 
                <label class="my-4 h6">Nomor Telepon</label>
                <input type="text" placeholder="Nomor hp..." name="no_hp" class="form-control" required>
                <label class="my-4 h6">Catatan Order (opsional)</label>
                <input type="text" placeholder="Catatan order..." name="catatan" class="form-control">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button name="proses" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
</div>
<?php } ?>
<?php } if(!isset($_GET['menu'])){
    echo 'Not found';
} ?>
