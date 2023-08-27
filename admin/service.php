<?php 
if(isset($_GET['menu'])){ ?>
<div class="col-md-12 mt-5">
    <div class="card">
        <div class="header bg-primary text-center text-white"><h3>Data Service  </h3></div>
        <div class="card-body">
        <?php 
        if(isset($_SESSION['success'])){
            echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
            unset($_SESSION['success']);
        }else if(isset($_SESSION['warning'])){
            echo '<div class="alert alert-warning">'.$_SESSION['warning'].'</div>';
            unset($_SESSION['warning']);
        } ?>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus-circle"></i> Tambah Service</button><br/><br/>
            <div class="modal fade" id="exampleModalLong">
                <div class="modal-dialog    ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Service</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="../controller/Data_crm.php?action=tambah_service" method="POST" enctype="multipart/form-data">
                                <label>Nama Service</label>
                                <input type="text" name="nama_service" class="form-control" placeholder="Nama service..." required><br>
                                <label>Deskripsi Service</label>
                                <textarea name="deskripsi_service" class="form-control" placeholder="Deskripsi service..." required></textarea><br>
                                <label>Jenis Service</label>
                                <select class="custom-select" name="jenis_service">
                                    <?php foreach($crm->getJenisService() as $jenis){ $row = $db->object($jenis); ?>
                                    <option value="<?= $row->id_jenis ?>"><?= $row->jenis_service ?></option>
                                    <?php } ?>
                                </select>
                                <label class="my-4">Harga Service</label>
                                <input type="text" name="harga_service" placeholder="Harga service..." class="form-control" required><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button name="proses" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table id="dataTable" class="table table-striped">
                <thead>
                    <td>Nama Service</td>
                    <td>Jenis Service</td>
                    <td>Harga Service</td>
                    <td>Date</td>
                    <td>Action</td>
                </thead>
                <tbody>
                    <?php foreach($getAllService as $data){ $row = $db->object($data); ?>
                    <tr>
                    <td><?= $row->nama_service ?></td>
                    <td><?= $row->jenis_service ?></td>
                    <td><?= "Rp. ". number_format($row->harga_service,0,'.','.') ?></td>
                    <td><?= $row->status_date ?></td>
                    <td>
                        <a onclick="return confirm('Anda yakin?')" href="../controller/Data_crm.php?action=hapus_service&id=<?= $row->id_service ?>" class="h5"><i class="fa fa-trash text-danger"></i></a>
                        <a data-toggle="modal" data-target="#exampleModalLong<?= $row->id_service ?>" href="#"><i class="fa fa-edit"></i></a>
                    </td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php foreach($getAllService as $data){ $row = $db->object($data); ?>
<div class="modal fade" id="exampleModalLong<?= $row->id_service ?>">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Service</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
            <form action="../controller/Data_crm.php?action=edit_service&id=<?= $row->id_service ?>" method="POST" enctype="multipart/form-data">
                <label class="my-4">Nama Service</label>
                <input type="text" name="nama_service" value="<?= $row->nama_service ?>" class="form-control">
                <label class="my-4">Deskripsi Sercice</label>
                <textarea name="deskripsi_service" class="form-control"><?= $row->deskripsi_service ?></textarea>
                <label class="my-4">Jenis Service</label>
                <select class="custom-select" name="jenis_service">
                    <?php foreach($crm->getJenisService() as $jenis){ $var = $db->object($jenis); ?>
                    <option value="<?= $var->id_jenis ?>"><?= $var->jenis_service ?></option>
                    <?php } ?>
                </select>
                <label class="my-4">Harga Service</label>
                <input type="text" name="harga_service" value="<?= $row->harga_service ?>" class="form-control">
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
