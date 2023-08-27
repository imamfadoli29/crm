<?php 
if(isset($_GET['menu'])){ ?>
<div class="col-md-12 mt-5">
    <div class="card">
        <div class="header bg-primary text-center text-white"><h3>Feedback</h3></div>
        <div class="card-body">
        <?php 
        if(isset($_SESSION['success'])){
            echo '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
            unset($_SESSION['success']);
        }else if(isset($_SESSION['warning'])){
            echo '<div class="alert alert-warning">'.$_SESSION['warning'].'</div>';
            unset($_SESSION['warning']);
        } ?>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-plus-circle"></i> Tambah Feedback</button><br/><br/>
            <div class="modal fade" id="exampleModalLong">
                <div class="modal-dialog    ">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Feedback</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="../controller/Data_crm.php?action=tambah_feedback" method="POST" enctype="multipart/form-data">
                                <label>Isi Feedback</label>
                                <textarea class="form-control" name="feedback" required></textarea>
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
                    <th>ID</th>
                    <th>Isi Feedback</th>
                    <th>Status Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php foreach($getFeedbackById as $data){ $row = $db->object($data); ?>
                    <tr>
                    <td><?= $row->id_customer ?></td>
                    <td><?= $row->isi_feedback ?></td>
                    <td><?= $row->feedback_date ?></td>
                    <td>
                        <a onclick="return confirm('Anda yakin?')" href="../controller/Data_crm.php?action=hapus_feedback&id=<?= $row->id_feedback; ?>" class="h5"><i class="fa fa-trash text-danger"></i></a>
                        <a data-toggle="modal" data-target="#exampleModalLong<?= $row->id_feedback ?>" href="#"><i class="fa fa-comment"></i></a><br/><br/>
                    </td>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php foreach($getFeedbackById as $data){ $row = $db->object($data); ?>
<div class="modal fade" id="exampleModalLong<?= $row->id_feedback ?>">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Reply Feedback</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
            <i class="fa fa-user"></i> <?= $row->nama_customer ?>
            <p class="mb-2"><?= $row->isi_feedback ?>
            <br><i class="text-secondary"><?= date('d F Y H:i:s',strtotime($row->feedback_date)) ?></i></p>
            <?php foreach($crm->getAllReplyFeedback($row->id_feedback) as $reply){ $var = $db->object($reply) ?>
                <?php 
                if($var->reply_by !== "Admin CRM"){
                    echo '<p class="text-left my-4"><i class="fa fa-user"></i> '.$var->reply_by.'<br>
                    '.$var->isi_reply.'<br><i class="text-secondary">'.date('d F Y H:i:s',strtotime($var->status_date)).'</i></p>';
                }else{
                    echo '<p class="text-right my-4"><i class="fa fa-user"></i> '.$var->reply_by.'<br>
                    '.$var->isi_reply.'<br><i class="text-secondary">'.date('d F Y H:i:s',strtotime($var->status_date)).'</i></p>';
                } ?>
            <?php } ?>
            <form action="../controller/Data_crm.php?action=reply_feedback&id=<?= $row->id_feedback ?>" method="POST" enctype="multipart/form-data">
                <label class="my-4">Balas Feedback</label>
                <textarea class="form-control" name="feedback" required></textarea>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button name="proses" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>
<?php } } if(!isset($_GET['menu'])){
    echo 'Not found';
} ?>
