<?php 
if(isset($_GET['menu'])){ ?>
<div class="col-md-12 mt-5">
    <div class="card">
        <div class="card-header bg-primary text-center text-white"><h3>Eskalasi Reminder</h3></div>
        <div class="card-body">
            <?php 
            if(isset($_SESSION['success'])){
                echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
                unset($_SESSION['success']);
            }else if(isset($_SESSION['warning'])){
                echo '<div class="alert alert-warning">'.$_SESSION['warning'].'</div>';
                unset($_SESSION['warning']);
            } ?>
            <a data-toggle="modal" data-target="#exampleModalLongx" href="#" class="btn btn-primary text-center"><i class="fa fa-send"></i> Send All</a><br/><br/>
            <div class="modal fade" id="exampleModalLongx">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title text-center">Eskalasi Reminder</h6>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                        <h4 class="header-title">Pilih Type</h4>
                            <div id="accordion1" class="according">
                                <div class="card">
                                    <div class="card-header">
                                        <a class="card-link" data-toggle="collapse" href="#accordion11x">SERVICE</a>
                                    </div>
                                    <div id="accordion11x" class="collapse" data-parent="#accordion1">
                                        <div class="card-body">
                                            <form action="../controller/Data_crm.php?action=send_eskalasi_all&type=service" method="POST">
                                                <select name="esk" class="custom-select">
                                                    <?php foreach($getAllService as $var1){ $arr1 = $db->object($var1);
                                                            echo '<option value='.$arr1->id_service.'>'.$arr1->nama_service.'</option>';
                                                    } ?>
                                                </select>
                                                <button class="btn btn-primary w-100 my-4">Send Now</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <a class="collapsed card-link" data-toggle="collapse" href="#accordion12x">PROMO</a>
                                    </div>
                                    <div id="accordion12x" class="collapse" data-parent="#accordion1">
                                        <div class="card-body">
                                        <form action="../controller/Data_crm.php?action=send_eskalasi_all&type=promo" method="POST">
                                                <select name="esk" class="custom-select">
                                                    <?php foreach($getPromo as $var1){ $arr1 = $db->object($var1);
                                                            echo '<option value='.$arr1->id_promo.'>'.$arr1->nama_promo.'</option>';
                                                    } ?>
                                                </select>
                                                <button class="btn btn-primary w-100 my-4">Send Now</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                <div class="card">
                                    <div class="card-header">
                                        <a class="collapsed card-link" data-toggle="collapse" href="#accordion13x">PRODUK</a>
                                    </div>
                                    <div id="accordion13x" class="collapse" data-parent="#accordion1">
                                        <div class="card-body">
                                            <form action="../controller/Data_crm.php?action=send_eskalasi_all&type=produk" method="POST">
                                                <select name="esk" class="custom-select">
                                                    <?php foreach($getProduct as $var1){ $arr1 = $db->object($var1);
                                                            echo '<option value='.$arr1->id_produk.'>'.$arr1->nama_produk.'</option>';
                                                    } ?>
                                                </select>
                                                <button class="btn btn-primary w-100 my-4">Send Now</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table table-responsive">
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
                        <?php foreach($getCustomer as $data){ $row = $db->object($data); ?>
                        <tr>
                        <td><?= $row->id_customer ?></td>
                        <td><?= $row->nama_customer ?></td>
                        <td><?= $row->alamat_customer ?></td>
                        <td><?= $row->nomor_customer ?></td>
                        <td><?= $row->email ?></td>
                        <td><?= $row->status_date ?></td>
                        <td><?= $row->is_active?></td>
                        <td>
                            <a data-toggle="modal" data-target="#exampleModalLong<?= $row->id_customer ?>" href="#" class="btn btn-primary text-center"><i class="fa fa-send"></i></a><br/><br/>
                        </td>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php foreach($getCustomer as $data){ $row = $db->object($data); ?>
<div class="modal fade" id="exampleModalLong<?= $row->id_customer ?>">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title text-center">Eskalasi Reminder</h6>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
        <h4 class="header-title">Pilih Type</h4>
            <div id="accordion1" class="according">
                <div class="card">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#accordion11<?= $row->id_customer; ?>">SERVICE</a>
                    </div>
                    <div id="accordion11<?= $row->id_customer; ?>" class="collapse" data-parent="#accordion1">
                        <div class="card-body">
                            <form action="../controller/Data_crm.php?action=send_eskalasi&type=service&id_cust=<?= $row->id_customer ?>" method="POST">
                                <select name="esk" class="custom-select">
                                    <?php foreach($getAllService as $var1){ $arr1 = $db->object($var1);
                                            echo '<option value='.$arr1->id_service.'>'.$arr1->nama_service.'</option>';
                                    } ?>
                                </select>
                                <button class="btn btn-primary w-100 my-4">Send Now</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#accordion12<?= $row->id_customer; ?>">PROMO</a>
                    </div>
                    <div id="accordion12<?= $row->id_customer; ?>" class="collapse" data-parent="#accordion1">
                        <div class="card-body">
                        <form action="../controller/Data_crm.php?action=send_eskalasi&type=promo&id_cust=<?= $row->id_customer ?>" method="POST">
                                <select name="esk" class="custom-select">
                                    <?php foreach($getPromo as $var1){ $arr1 = $db->object($var1);
                                            echo '<option value='.$arr1->id_promo.'>'.$arr1->nama_promo.'</option>';
                                    } ?>
                                </select>
                                <button class="btn btn-primary w-100 my-4">Send Now</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#accordion13<?= $row->id_customer; ?>">PRODUK</a>
                    </div>
                    <div id="accordion13<?= $row->id_customer; ?>" class="collapse" data-parent="#accordion1">
                        <div class="card-body">
                            <form action="../controller/Data_crm.php?action=send_eskalasi&type=produk&id_cust=<?= $row->id_customer ?>" method="POST">
                                <select name="esk" class="custom-select">
                                    <?php foreach($getProduct as $var1){ $arr1 = $db->object($var1);
                                            echo '<option value='.$arr1->id_produk.'>'.$arr1->nama_produk.'</option>';
                                    } ?>
                                </select>
                                <button class="btn btn-primary w-100 my-4">Send Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php } ?>
<?php } if(!isset($_GET['menu'])){
    echo 'Not found';
} ?>
