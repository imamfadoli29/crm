<?php 
if(isset($_GET['menu'])){ ?>
<div class="col-md-12 mt-5">
    <div class="card">
        <div class="header bg-primary text-center text-white"><h3>Data Customer</h3></div>
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
                    <td>ID</td>
                    <td>Nama Customer</td>
                    <td>Alamat</td>
                    <td>Nomor</td>
                    <td>Email</td>
                    <td>Registered</td>
                    <td>Active</td>
                    <td>Action</td>
                </thead>
                <tbody>
                    <?php foreach($getCustomerById as $data){ $row = $db->object($data); ?>
                    <tr>
                    <td><?= $row->id_customer ?></td>
                    <td><?= $row->nama_customer ?></td>
                    <td><?= $row->alamat_customer ?></td>
                    <td><?= $row->nomor_customer ?></td>
                    <td><?= $row->email ?></td>
                    <td><?= $row->status_date ?></td>
                    <td><?= $row->is_active?></td>
                    <td>
                        <a href="../controller/Data_crm?action=hapus_customer" class="h5"><i class="fa fa-trash text-danger"></i></a>
                        <a data-toggle="modal" data-target="#exampleModalLong<?= $row->id_customer ?>" href="#"><i class="fa fa-edit"></i></a><br/><br/>
                    </td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php foreach($getCustomerById as $data){ $row = $db->object($data); ?>
<div class="modal fade" id="exampleModalLong<?= $row->id_customer ?>">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title">Edit Profile</h6>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
            <form action="../controller/Data_crm.php?action=edit_customer&id=<?= $row->id_customer ?>" method="POST" enctype="multipart/form-data">
                <label class="my-4 h6">ID Customer</label>
                <input type="text" value="<?= $row->id_customer ?>" name="id_customer" class="form-control" readonly>
                <label class="my-4 h6">Nama Customer</label>
                <input type="text" value="<?= $row->nama_customer ?>" name="nama_customer" class="form-control" >
                <label class="my-4 h6">Alamat Customer</label>
                <input type="text" value="<?= $row->alamat_customer ?>" name="alamat_customer" class="form-control" >
                <label class="my-4 h6">Nomor Customer</label>
                <input type="text" value="<?= $row->nomor_customer ?>" name="nomor_customer" class="form-control" >
                <label class="my-4 h6">Email Customer</label>
                <input type="text" value="<?= $row->email ?>" name="email_customer" class="form-control" >
               <!--  <label class="my-4 h6">No Plat Motor</label>
                <input type="text" value="<?= $row->no_plat ?>" name="no_plat" class="form-control" placeholder='Nomor plat...' > -->
                <label class="my-4 h6">Date Registered</label>
                <input type="text" value="<?= $row->status_date ?>" class="form-control" readonly>
                <input type="hidden" value="<?= $row->is_active ?>" name="is_active">
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
