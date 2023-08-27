<?php 
if(isset($_GET['menu'])){ ?>
<div class="col-md-12 mt-5">
    <div class="card-header bg-primary text-center text-white"><h3>Data Order Saya</h3></div>
    <div class="card">
        <div class="card-body">
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
                    <?php foreach($getOrderById as $data){ $row = $db->object($data); ?>
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
                        <a class="btn btn-warning text-white" onclick="return confirm('Anda yakin ingin membatalkan order ini ?')" href="../controller/Data_crm?action=hapus_customer" class="h5">Batalkan</a>
                        <?php } ?>
                    </td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php } if(!isset($_GET['menu'])){
    echo 'Not found';
} ?>
