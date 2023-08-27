<?php 
if(isset($_GET['menu'])){ ?>
<div class="col-md-12 mt-5">
    <div class="card-header bg-primary text-center text-white"><h3>Data Order Saya</h3></div>
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
            <table id="dataTable" class="table table-striped">
                <thead>
                    <td>Nama Service</td>
                    <td>Jenis Service</td>
                    <td>Nama Customer</td>
                    <td>Catatan</td>
                    <td>Harga</td>
                    <td>Date</td>
                    <td>Status Order</td>
                    <td>Action</td>
                </thead>
                <tbody>
                    <?php foreach($getAllOrders as $data){ $row = $db->object($data); ?>
                    <tr>
                    <td><?= $row->nama_service ?></td>
                    <td><?= $row->jenis_service ?></td>
                    <td><?= $row->nama_customer ?></td>
                    <td><?= $row->catatan_order ?></td>
                    <td><?= "Rp. ". number_format($row->harga_order,0,'.','.') ?></td>
                    <td><?= $row->status_date ?></td>
                    <td><?= $row->status ?></td>
                    <td>
                        <?php if($row->id_status == 2){ ?>
                        <a onclick="return confirm('Anda yakin ingin membatalkan order ini ?')" href="../controller/Data_crm?action=hapus_order" class="h5"><i class="fa fa-trash text-danger"></i></a>
                        <?php } ?>
                        <a data-toggle="modal" data-target="#exampleModalLong<?= $row->id_order ?>" href="#"><i class="fa fa-edit"></i></a>
                    </td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php foreach($getAllOrders as $data){ $row = $db->object($data); ?>
<div class="modal fade" id="exampleModalLong<?= $row->id_order ?>">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title">Order Service</h6>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
            <form action="../controller/Data_crm.php?action=edit_order&id=<?= $row->id_order ?>" method="POST" enctype="multipart/form-data">
                <label class="my-4 h6">Nama Service</label>
                <p><?= $row->nama_service ?></p>
                <label class="my-4 h6">Deskripsi Service</label>
                <p><?= $row->deskripsi_service ?></p> 
                <label class="my-4 h6">Jenis Service</label>
                <p><?= $row->jenis_service ?></p> 
                <label class="my-4 h6">Harga Service</label>
                <p><?= "Rp. ". number_format($row->harga_service,0,'.','.') ?></p> 
                <label class="my-4 h6">Nomor Telepon</label>
                <input type="text" placeholder="Nomor hp..." name="no_hp" value="<?= $row->nomor_telp ?>" class="form-control" required>
                <label class="my-4 h6">Catatan Order (opsional)</label>
                <input type="text" placeholder="Catatan order..." name="catatan" value="<?= $row->catatan_order ?>"  class="form-control">
                <label class="my-4 h6">Status Order</label>
                <select class="form-control" name="status_order">
                    <option value="<?= $row->id_status ?>"><?= $row->status ?></option>
                    <?php foreach($crm->getStatusOrder() as $jenis){ $var = $db->object($jenis); ?>
                        <option value="<?= $var->id_status ?>"><?= $var->status ?></option>
                    <?php } ?>
                </select>
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
