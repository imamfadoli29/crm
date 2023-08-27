<?php 
if(isset($_GET['menu'])){ ?>
<div class="col-md-12 mt-5">
    <div class="card">
        <div class="header bg-primary text-center text-white"><h3>Data Promo</h3></div>
        <div class="card-body">
        <?php 
        if(isset($_SESSION['successx'])){
            echo '<div class="alert alert-success">'.$_SESSION['successx'].'</div>';
            unset($_SESSION['successx']);
        }else if(isset($_SESSION['warningx'])){
            echo '<div class="alert alert-warning">'.$_SESSION['warningx'].'</div>';
            unset($_SESSION['warningx']);
        } ?>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus-circle"></i> Tambah Promo</button><br/><br/>
            <div class="modal fade" id="exampleModalLong">
                <div class="modal-dialog    ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Promo</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="../controller/Data_crm.php?action=tambah_promo" method="POST" enctype="multipart/form-data">
                                <label>Nama Promo</label>
                                <input type="text" name="nama_promo" class="form-control" placeholder="Nama promo..." required><br>
                                <label>Deskripsi Promo</label>
                                <textarea name="deskripsi_promo" class="form-control" placeholder="Deskripsi promo..." required></textarea><br>
                                <label>Dari Tgl</label>
                                <input type="date" name="dari_tgl" class="form-control"  required><br>
                                <label>Sampai Tgl</label>
                                <input type="date" name="sampai_tgl" class="form-control" required><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button name="proses" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table id="dataTable2" class="table table-striped">
                <thead>
                    <th>Nama Promo</th>
                    <th>Dari</th>
                    <th>Sampai</th>
                    <th>Jumlah</th>
                    <th>Date</th>
                    <th>Jumlah Tetarik</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($getPromo as $data1){ $var = $db->object($data1); ?>
                    <tr>
                    <td><?= $var->nama_promo ?></td>
                    <td><?= date('d F Y', strtotime($var->dari_tgl)) ?></td>
                    <td><?= date('d F Y', strtotime($var->sampai_tgl)) ?></td>
                    <td><?= $var->jumlah_hari. " Hari" ?></td>
                    <td><?= date('d F Y H:i:s', strtotime($var->status_date)) ?></td>
                    <td><?= $var->jumlah_peminat ." Orang" ?></td>
                    <td>
                        <a onclick="return confirm('Anda yakin?')" href="../controller/Data_crm.php?action=hapus_promo&id=<?= $var->id_promo ?>" class="h5"><i class="fa fa-trash text-danger"></i></a>
                        <a data-toggle="modal" data-target="#exampleModalLong<?= $var->id_promo ?>" href="#"><i class="fa fa-edit"></i></a>
                    </td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-md-12 mt-5">
    <div class="card">
        <div class="header bg-primary text-center text-white"><h3>Data Product</h3></div>
        <div class="card-body">
        <?php 
        if(isset($_SESSION['successy'])){
            echo '<div class="alert alert-success">'.$_SESSION['successy'].'</div>';
            unset($_SESSION['successy']);
        }else if(isset($_SESSION['warningy'])){
            echo '<div class="alert alert-warning">'.$_SESSION['warningy'].'</div>';
            unset($_SESSION['warningy']);
        } ?>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLongs"><i class="fa fa-plus-circle"></i> Tambah Product</button><br/><br/>
            <div class="modal fade" id="exampleModalLongs">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Product</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="../controller/Data_crm.php?action=tambah_product" method="POST" enctype="multipart/form-data">
                                <label>Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" placeholder="Nama produk..." required><br>
                                <label>Deskripsi Produk</label>
                                <input type="text" name="deskripsi_produk" class="form-control" placeholder="Deskripsi produk..." required><br>
                                <label>Harga</label>
                                <input type="text" name="harga" class="form-control" placeholder="Harga produk..." required><br>
                                <label>Foto Produk</label>
                                <input type="file" name="foto_produk" class="form-control" placeholder="Masukan jenis buku..." required><br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button name="proses" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table id="dataTable3" class="table table-striped">
                <thead>
                    <th>Nama Produk</th>
                    <th>Harga Produk</th>
                    <th>Foto</th>
                    <th>Date</th>
                    <th>Jumlah Tetarik</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($getProduct as $data2){ $row = $db->object($data2); ?>
                    <tr>
                    <td><?= $row->nama_produk ?></td>
                    <td><?= "Rp. ". number_format($row->harga_produk,0,'.','.') ?></td>
                    <td><img src="../assets/foto/<?= $row->foto_produk ?>" style="width:100px;height:100px;"></td>
                    <td><?= $row->status_date ?></td>
                    <td><?= $row->jumlah_peminat ." Orang" ?></td>
                    <td>
                        <a onclick="return confirm('Anda yakin?')" href="../controller/Data_crm.php?action=hapus_produk&id=<?= $row->id_produk; ?>" class="h5"><i class="fa fa-trash text-danger"></i></a>
                        <a data-toggle="modal" data-target="#exampleModalLongx<?= $row->id_produk ?>" href="#"><i class="fa fa-edit"></i></a>
                    </td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php foreach($getPromo as $data){ $row = $db->object($data); ?>
<div class="modal fade" id="exampleModalLong<?= $row->id_promo ?>">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Promo</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
            <form action="../controller/Data_crm.php?action=edit_promo&id=<?= $row->id_promo ?>" method="POST" enctype="multipart/form-data">
                <label class="my-4">Nama Promo</label>
                <input type="text" name="nama_promo" value="<?= $row->nama_promo ?>" class="form-control">
                <label class="my-4">Deskripsi Promo</label>
                <textarea name="deskripsi_promo" class="form-control"><?= $row->deskripsi_promo ?></textarea>
                <label class="my-4">Dari Tanggal</label>
                <input type="date" name="dari_tgl" value="<?= $row->dari_tgl ?>" class="form-control">
                <label class="my-4">Sampai Tanggal</label>
                <input type="date" name="sampai_tgl" value="<?= $row->sampai_tgl ?>" class="form-control">
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
<?php foreach($getProduct as $data){ $row = $db->object($data); ?>
<div class="modal fade" id="exampleModalLongx<?= $row->id_produk ?>">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Produk</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
            <form action="../controller/Data_crm.php?action=edit_produk&id=<?= $row->id_produk ?>" method="POST" enctype="multipart/form-data">
                <label class="my-4">Nama Produk</label>
                <input type="text" name="nama_produk" value="<?= $row->nama_produk ?>" class="form-control">
                <label class="my-4">Deskripsi Produk</label>
                <textarea name="deskripsi_produk" class="form-control"><?= $row->deskripsi_produk ?></textarea>
                <label class="my-4">Harga Produk</label>
                <input type="text" name="harga_produk" value="<?= $row->harga_produk ?>" class="form-control">
                <label class="my-4">Foto Produk</label>
                <img src="../assets/foto/<?= $row->foto_produk ?>" class="img-fluid">
                <input type="file" name="foto_produk" class="form-control my-2">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button name="proses" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
</div>
<?php } } if(!isset($_GET['menu'])){
    echo 'Not found';
} ?>