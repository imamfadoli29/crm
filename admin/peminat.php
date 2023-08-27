<?php 
if(isset($_GET['menu'])){ ?>
<div class="col-md-12 mt-5">
    <div class="card">
        <div class="card-header bg-primary text-center text-white"><h3>Data Peminat Produk</h3></div>
        <div class="card-body">
            <table id="dataTable" class="table table-striped">
                <thead>
                    <td>Nama Lengkap</td>
                    <td>Nomor Handphone</td>
                    <td>Produk</td>
                </thead>
                <tbody>
                    <?php foreach($getPeminatProduk as $data){ $row = $db->object($data); ?>
                    <tr>
                    <td><?= $row->nama ?></td>
                    <td><?= $row->no_hp ?></td>
                    <td><?= $row->nama_produk ?></td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-md-12 mt-5">
    <div class="card">
        <div class="card-header bg-primary text-center text-white"><h3>Data Peminat Promo</h3></div>
        <div class="card-body">
            <table id="dataTable2" class="table table-striped">
                <thead>
                    <td>Nama Lengkap</td>
                    <td>Nomor Handphone</td>
                    <td>Produk</td>
                </thead>
                <tbody>
                    <?php foreach($getPeminatPromo as $data){ $row = $db->object($data); ?>
                    <tr>
                    <td><?= $row->nama ?></td>
                    <td><?= $row->no_hp ?></td>
                    <td><?= $row->nama_promo ?></td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php } if(!isset($_GET['menu'])){
    echo 'Not found';
} ?>
