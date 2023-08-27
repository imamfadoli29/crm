<?php 
/*
    Author : Irvan Sulisito
    Requirements : PHP v7
    Notes : Tidak diperkenankan untuk diperjualbelikan, hanya untuk menjadi bahan belajar.
 */
require_once 'Database.php';
require_once 'Escalation.php';
@(session_start());

class Crm {

    public function __construct(){
        $this->db = new Database;
        $this->esk = new Escalation;
    }

    public function getCustomer()
    {
        $sql = "SELECT * FROM tr_customer t1, tr_user t2 WHERE t1.id_customer=t2.id_customer AND t2.id_customer IS NOT NULL ORDER BY t1.status_date DESC";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getCustomerById($id)
    {
        $sql = "SELECT * FROM tr_customer t1, tr_user t2 WHERE t1.id_customer=t2.id_customer AND t2.id_customer IS NOT NULL AND t1.id_customer='$id' ORDER BY t1.status_date DESC";
        $query = $this->db->query($sql);
        return $query;
    }


    public function getPromo()
    {
        $sql = "SELECT * FROM tr_promo t1 INNER JOIN tr_minat_promo t2 ON t1.id_promo=t2.id_promo ORDER BY t1.status_date DESC";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getProduct()
    {
        $sql = "SELECT * FROM tr_produk t1 INNER JOIN tr_minat_produk t2 ON t1.id_produk=t2.id_produk ORDER BY t1.status_date DESC";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getPeminatProduk()
    {
        $sql = "SELECT * FROM tr_ip t1, tr_produk t2 WHERE t1.id_produk=t2.id_produk";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getPeminatPromo()
    {
        $sql = "SELECT * FROM tr_ip_2 t1, tr_promo t2 WHERE t1.id_promo=t2.id_promo";
        $query = $this->db->query($sql);
        return $query;
    }

    public function addPromo()
    {
        $nama_promo = htmlspecialchars($_POST['nama_promo']);
        $deskripsi = htmlspecialchars($_POST['deskripsi_promo']);
        $dari_tgl = htmlspecialchars($_POST['dari_tgl']);
        $sampai_tgl = htmlspecialchars($_POST['sampai_tgl']);

        if($sampai_tgl < $dari_tgl){
            $_SESSION['warningx'] = "Input <b>sampai tanggal</b> harus lebih besar dari <b>dari tanggal</b>";
            header("location:../admin/index.php?menu=info");
        }else{
            $x = strtotime($dari_tgl);
            $y = strtotime($sampai_tgl);
            $hitung1 = floor($x / (60 * 60 * 24));
            $hitung2 = floor($y / (60 * 60 * 24));
            $jmlhari = $hitung2 - $hitung1;
            $arr = $this->db->query("SELECT max(id_promo) AS maxid FROM tr_promo");
            $var = $arr->fetch_assoc();
            $id = $var['maxid']+1;
            $this->db->query("INSERT INTO tr_minat_promo VALUES('$id', 0) ");
            $insert = $this->db->query("INSERT INTO tr_promo VALUES('$id', '$nama_promo', '$deskripsi' ,'$dari_tgl', '$sampai_tgl', '$jmlhari', now())  ");
            $_SESSION['successx'] = "Promo berhasil ditambahkan!";
            header("location:../admin/index.php?menu=info");
        }
    }

    public function delPromo($id)
    {
        $cek = $this->db->query("SELECT * FROM tr_promo WHERE id_promo='$id' ");
        if($cek->num_rows > 0){
            $this->db->query("DELETE FROM tr_promo WHERE id_promo='$id' ");
            $this->db->query("DELETE FROM tr_minat_promo WHERE id_promo='$id' ");
            $_SESSION['successx'] = "Promo berhasil dihapus!";
            header("location:../admin/index.php?menu=info");
        }else{
            header("location:../admin/index.php?menu=info");
            $_SESSION['warningx'] = "Promo gagal dihapus!";
        }
    }

    public function editPromo($id)
    {
        $nama_promo = htmlspecialchars($_POST['nama_promo']);
        $deskripsi = htmlspecialchars($_POST['deskripsi_promo']);
        $dari_tgl = htmlspecialchars($_POST['dari_tgl']);
        $sampai_tgl = htmlspecialchars($_POST['sampai_tgl']);
        if($sampai_tgl < $dari_tgl){
            $_SESSION['warningx'] = "Value <b>sampai tanggal</b> harus lebih besar dari <b>dari tanggal</b> !";
            header("location:../admin/index.php?menu=info");
        }else{
            $x = strtotime($dari_tgl);
            $y = strtotime($sampai_tgl);
            $hitung1 = floor($x / (60 * 60 * 24));
            $hitung2 = floor($y / (60 * 60 * 24));
            $jmlhari = $hitung2 - $hitung1;
            $edit = $this->db->query("UPDATE tr_promo SET nama_promo='$nama_promo', deskripsi_promo='$deskripsi', dari_tgl='$dari_tgl', 
            sampai_tgl='$sampai_tgl', jumlah_hari='$jmlhari' WHERE id_promo='$id' ");
            if($edit){
                $_SESSION['successx'] = "Promo berhasil diubah!";
                header("location:../admin/index.php?menu=info");
            }else{
                $_SESSION['successx'] = "Promo gagal diubah!";
                header("location:../admin/index.php?menu=info");
            }
        }
    }

    public function addProduct()
    {
        if(isset($_POST['proses'])){
            $nama_produk = htmlspecialchars($_POST['nama_produk']);
            $deskripsi = htmlspecialchars($_POST['deskripsi_produk']);
            $harga = htmlspecialchars($_POST['harga']);
            $foto = $_FILES['foto_produk']['name'];
            $size = $_FILES['foto_produk']['size'];
            $tmp = $_FILES['foto_produk']['tmp_name'];
            $x = explode('.', $foto);
            $ekstension = strtolower(end($x));
            $available = array(
                'jpg',
                'jpeg',
                'png'
            );

            if($size < 2180723){ //max 2mb
                if(in_array($ekstension, $available) === true){
                    $move = move_uploaded_file($tmp, "../assets/foto/". $foto);
                    $arr = $this->db->query("SELECT max(id_produk) AS maxid FROM tr_produk");
                    $var = $arr->fetch_assoc();
                    $id = $var['maxid']+1;
                    $this->db->query("INSERT INTO tr_produk VALUES ('$id', '$nama_produk' ,'$deskripsi', '$harga', '$foto', now() ) ");
                    $this->db->query("INSERT INTO tr_minat_produk VALUES('$id', 0) ");
                    $_SESSION['successy'] = "Produk berhasil ditambah";
                    header("location:../admin/index.php?menu=info");
                }else{
                    $_SESSION['warningy'] = "Ekstension foto produk tidak tersedia";
                    header("location:../admin/index.php?menu=info");
                }
            }else{
                $_SESSION['warningy'] = "Ukuran foto maksimal adalah 2 Megabyte";
                header("location:../admin/index.php?menu=info");
            }
        }else{
            $_SESSION['warningy'] = "Produk gagal ditambah";
            header("location:../admin/index.php?menu=info");
        }
    }

    public function delProduct($id)
    {
        $cek = $this->db->query("SELECT * FROM  tr_produk WHERE id_produk='$id' ");
        if($cek->num_rows > 0){
            $arr = $cek->fetch_assoc();
            unlink("../assets/foto/". $arr['foto_produk']);
            $this->db->query("DELETE FROM tr_produk WHERE id_produk='$id' ");
            $this->db->query("DELETE FROM tr_minat_produk WHERE id_produk='$id' ");
            $_SESSION['successy'] = "Produk berhasil dihapus!";
            header("location:../admin/index.php?menu=info");
        }else{
            $_SESSION['successy'] = "Produk gagal dihapus!";
            header("location:../admin/index.php?menu=info");
        }
    }

    public function editCustomer($id)
    {
        $nama = htmlspecialchars($_POST['nama_customer']);
        $alamat = htmlspecialchars($_POST['alamat_customer']);
        $nomor = htmlspecialchars($_POST['nomor_customer']);
        $email = htmlspecialchars($_POST['email_customer']);
        $is_active = $_POST['is_active'];
        if(is_numeric($nomor) == true){
            $update = $this->db->query("UPDATE tr_customer SET nama_customer='$nama', alamat_customer='$alamat', nomor_customer='$nomor', email='$email', is_active='$is_active' WHERE id_customer='$id' ");
            if($update){
                $update2 = $this->db->query("UPDATE tr_user SET email='$email' WHERE id_customer='$id'");
                if($_SESSION['id_customer'] == ""){
                    $_SESSION['success'] = "Customer berhasil diubah!";
                    header("location:../admin/index.php?menu=customer");
                }else{
                    $_SESSION['success'] = "Customer berhasil diubah!";
                    header("location:../user/index.php?menu=myprofile");
                }
            }else{
                $_SESSION['warning'] = "Customer gagal diubah!";
                header("location:../admin/index.php?menu=customer");
            }
        }else{
            $_SESSION['success'] = "Nomor handphone harus mengandung numeric!";
            header("location:../admin/index.php?menu=customer");
        }
    }

    public function editProduct($id)
    {
        $nama_produk = htmlspecialchars($_POST['nama_produk']);
        $deskripsi = htmlspecialchars($_POST['deskripsi_produk']);
        $harga = htmlspecialchars($_POST['harga_produk']);
        $foto = $_FILES['foto_produk']['name'];
        $size = $_FILES['foto_produk']['size'];
        $tmp = $_FILES['foto_produk']['tmp_name'];
        $x = explode('.', $foto);
        $ekstension = strtolower(end($x));
        $available = array(
            'jpg',
            'jpeg',
            'png'
        );

        if($size < 2180723){ //max 2mb
            if($foto !== ""){
                if(in_array($ekstension, $available) === true){
                    $arr = $this->db->query("SELECT * FROM tr_produk WHERE id_produk='$id' ");
                    $var = $arr->fetch_assoc();
                    $delete = unlink("../assets/foto/".$var['foto_produk']);
                    $this->db->query("UPDATE tr_produk SET nama_produk='$nama_produk', deskripsi_produk='$deskripsi', harga_produk='$harga', foto_produk='$foto' WHERE id_produk='$id'");
                    $move = move_uploaded_file($tmp, "../assets/foto/". $foto);
                    $_SESSION['successy'] = "Produk berhasil diubah";
                    header("location:../admin/index.php?menu=info");
                }else{
                    $_SESSION['warningy'] = "Ekstension foto produk tidak tersedia";
                    header("location:../admin/index.php?menu=info");
                }
            }else{
                $this->db->query("UPDATE tr_produk SET nama_produk='$nama_produk', deskripsi_produk='$deskripsi', harga_produk='$harga' WHERE id_produk='$id'");
                $_SESSION['successy'] = "Produk berhasil diubah";
                header("location:../admin/index.php?menu=info");
            }
        }else{
            $_SESSION['warningy'] = "Ukuran foto maksimal adalah 2 Megabyte";
            header("location:../admin/index.php?menu=info");
        }
    }

    public function sendMinat($id)
    {   
        $nama = htmlspecialchars($_POST['nama']);
        $no_hp = htmlspecialchars($_POST['no_hp']);
        $ip = $_SERVER['REMOTE_ADDR'];
        $cek = $this->db->query("SELECT * FROM tr_ip WHERE nomor_ip='$ip' AND id_produk='$id' ");
        if($cek->num_rows > 0){
            $_SESSION['warningx'] = "Anda sudah mengirim minat untuk produk ini!";
            header("location:../index.php");
        }else{
            $this->db->query("INSERT INTO tr_ip VALUES ('$ip', '$id', '$nama' ,'$no_hp') ");
            $get = $this->db->query("SELECT jumlah_peminat as maxid FROM tr_minat_produk WHERE id_produk='$id' ");
            $var = $get->fetch_assoc();
            $getId = $var['maxid']+1;
            $this->db->query("UPDATE tr_minat_produk SET jumlah_peminat='$getId' WHERE id_produk='$id' ");
            $_SESSION['successx'] = "Terima kasih atas partisipasi anda!";
            header("location:../index.php");
        }
    }

    public function sendMinatPromo($id)
    {   
        $nama = htmlspecialchars($_POST['nama']);
        $no_hp = htmlspecialchars($_POST['no_hp']);
        $ip = $_SERVER['REMOTE_ADDR'];
        $cek = $this->db->query("SELECT * FROM tr_ip_2 WHERE nomor_ip='$ip' AND id_promo='$id' ");
        if($cek->num_rows > 0){
            $_SESSION['warningy'] = "Anda sudah mengirim minat untuk promo ini!";
            header("location:../index.php");
        }else{
            $this->db->query("INSERT INTO tr_ip_2 VALUES ('$ip', '$id', '$nama', '$no_hp') ");
            $get = $this->db->query("SELECT jumlah_peminat as maxid FROM tr_minat_promo WHERE id_promo='$id' ");
            $var = $get->fetch_assoc();
            $getId = $var['maxid']+1;
            $this->db->query("UPDATE tr_minat_promo SET jumlah_peminat='$getId' WHERE id_promo='$id' ");
            $_SESSION['successy'] = "Terima kasih atas partisipasi andax!";
            header("location:../index.php");
        }
    }

    public function getAllFeedback(){
        $sql = "SELECT * FROM tr_feedback t1, tr_customer t2 WHERE t1.id_customer=t2.id_customer ORDER BY t1.feedback_date DESC";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getFeedbackById($id)
    {
        $sql = "SELECT * FROM tr_feedback t1, tr_customer t2 WHERE t1.id_customer=t2.id_customer AND t1.id_customer='$id' ";
        $query = $this->db->query($sql);
        return $query;
    }

    public function addFeedback($id)
    {
        $feedback = htmlspecialchars($_POST['feedback']);
        $add = $this->db->query("INSERT INTO tr_feedback VALUES ('', '$id', '$feedback', now() ) ");
        if($add){
            $_SESSION['success'] = "Feedback berhasil ditambahkan!";
            header("location:../user/index.php?menu=feedback");
        }else{
            $_SESSION['success'] = "Feedback gagal ditambahkan!"; 
        }
    }

    public function replyFeedback($id)
    {
        $reply = htmlspecialchars($_POST['feedback']);
        if($_SESSION['id_customer'] == ""){
            $reply_by = "Admin CRM";
        }else{
            $query = $this->db->query("SELECT * FROM tr_customer WHERE id_customer='".$_SESSION['id_customer']."' ");
            $arr = $query->fetch_assoc();
            $reply_by = $arr['nama_customer'];

        }
        $add = $this->db->query("INSERT INTO tr_reply_feedback VALUES('', '$id', '$reply', '$reply_by', now() ) ");
        if($add){
            $_SESSION['success'] = "Feedback berhasil direply!";
            if($_SESSION['id_customer'] == ""){
                header("location:../admin/index.php?menu=feedback");
            }else{
                header("location:../user/index.php?menu=feedback");
            }
        }else{
            $_SESSION['success'] = "Feedback gagal direply!"; 
        }
    }

    public function getAllReplyFeedback($id)
    {   
        $sql = "SELECT * FROM tr_reply_feedback WHERE id_feedback='$id' ";
        $query = $this->db->query($sql);
        return $query;
    }

    public function delFeedback($id)
    {
        $this->db->query("DELETE FROM tr_feedback WHERE id_feedback='$id' ");
        $this->db->query("DELETE FROM tr_reply_feedback WHERE id_feedback='$id' ");
        $_SESSION['success'] = "Feedback berhasil dihapus!";
        if($_SESSION['id_customer'] !== ""){
            header("location:../user/index.php?menu=feedback");
        }else{
            header("location:../admin/index.php?menu=feedback");
        }
    }

    public function getJenisService()
    {
        $sql = "SELECT * FROM tr_jenis_service ORDER BY id_jenis ASC";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getAllService()
    {
        $sql = "SELECT * FROM tr_service t1 INNER JOIN tr_jenis_service t2 ON t1.id_jenis=t2.id_jenis ORDER BY status_date DESC";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getAllOrders()
    {
        $sql = "SELECT * FROM tr_order t1, tr_customer t2, tr_status_order t3, tr_jenis_service t4, tr_service t5 WHERE t1.id_customer=t2.id_customer AND t1.status_order=t3.id_status AND t1.id_service=t5.id_service AND t5.id_jenis=t4.id_jenis";
        $query = $this->db->query($sql);
        return $query;
    }

    public function getOrderById($id)
    {
        $sql = "SELECT * FROM tr_order t1, tr_customer t2, tr_status_order t3, tr_jenis_service t4, tr_service t5 WHERE t1.id_customer=t2.id_customer AND t1.status_order=t3.id_status AND t1.id_service=t5.id_service AND t5.id_jenis=t4.id_jenis
        AND t1.id_customer='$id' ";
        $query = $this->db->query($sql);
        return $query;
    }

    public function addService()
    {
        $nama_service = htmlspecialchars($_POST['nama_service']);
        $deskripsi = htmlspecialchars($_POST['deskripsi_service']);
        $jenis = htmlspecialchars($_POST['jenis_service']);
        $harga = htmlspecialchars($_POST['harga_service']);
        
        if(is_numeric($harga) == true){
            $insert = $this->db->query("INSERT INTO tr_service VALUES('', '$jenis', '$nama_service', '$deskripsi', '$harga', now() ) ");
            if($insert){
                $_SESSION['success'] = "Service berhasil ditambahkan";
                header("location:../admin/index.php?menu=service");
            }else{
                $_SESSION['warning'] = "Service gagal ditambahkan";
                header("location:../admin/index.php?menu=service");
            }
        } else{
            $_SESSION['warning'] = "Harga harus mengandung numeric!";
            header("location:../admin/index.php?menu=service");
        }
    }

    public function delService($id)
    {
        $sql = "DELETE FROM tr_service WHERE id_service='$id' ";
        $sql2 = "DELETE FROM tr_order WHERE id_service='$id' ";
        $delete = $this->db->query($sql);
        $delete2 = $this->db->query($sql2);
        if($delete){
            $_SESSION['success'] = "Service berhasil dihapus";
            header("location:../admin/index.php?menu=service");
        }
    }

    public function editService($id)
    {
        $nama_service = htmlspecialchars($_POST['nama_service']);
        $deskripsi = htmlspecialchars($_POST['deskripsi_service']);
        $jenis = htmlspecialchars($_POST['jenis_service']);
        $harga = htmlspecialchars($_POST['harga_service']);
        if(is_numeric($harga) == true){
            $update = $this->db->query("UPDATE tr_service SET nama_service='$nama_service', deskripsi_service='$deskripsi', id_jenis='$jenis', harga_service='$harga' WHERE id_service='$id' ");
            if($update){
                $_SESSION['success'] = "Service berhasil diubah";
                header("location:../admin/index.php?menu=service");
            }else{
                $_SESSION['warning'] = "Service gagal diubah";
                header("location:../admin/index.php?menu=service");
            }
        }else{
            $_SESSION['warning'] = "Harga harus mengandung numeric!";
            header("location:../admin/index.php?menu=service");
        }
    }

    public function addOrder($id)
    {
        $no_hp = htmlspecialchars($_POST['no_hp']);
        $catatan = htmlspecialchars($_POST['catatan']);
        if(is_numeric($no_hp) == true){
            $arr = $this->db->query("SELECT * FROM tr_service WHERE id_service='$id' ");
            $var = $arr->fetch_assoc();
            $insert = $this->db->query("INSERT INTO tr_order VALUES ('', '$id', '".$_SESSION['id_customer']."', '$catatan', '".$var['harga_service']."', 2, '$no_hp', now() ) ");
            if($insert){
                $_SESSION['success'] = "Order berhasil ditambahkan!";
                header("location:../user/index.php?menu=myorder");
            }else{
                $_SESSION['warning'] = "Order gagal ditambahkan!";
                header("location:../user/index.php?menu=order");
            }
        }else{
            $_SESSION['success'] = "No telepon harus numeric!";
            header("location:../user/index.php?menu=order");
        }
    }

    public function getStatusOrder()
    {
        $sql = "SELECT * FROM tr_status_order ORDER BY id_status ASC ";
        $query = $this->db->query($sql);
        return $query;
    }

    public function delOrder($id)
    {
        $sql = "DELETE FROM tr_order WHERE id_order='$id' ";
        $this->db->query($sql);
        $_SESSION['success'] = "Order berhasil di delete!";
        header("location:../admin/index.php?menu=allorders");
    }

    public function orderAction($id)
    {
        $no_hp = htmlspecialchars($_POST['no_hp']);
        $catatan = htmlspecialchars($_POST['catatan']);
        $status = $_POST['status_order'];
        if(is_numeric($no_hp) == true){
            $arr = $this->db->query("SELECT * FROM tr_service WHERE id_service='$id' ");
            $var = $arr->fetch_assoc();
            $insert = $this->db->query("UPDATE tr_order SET nomor_telp='$no_hp', catatan_order='$catatan', status_order='$status' WHERE id_order='$id' ");
            if($insert){
                $_SESSION['success'] = "Order berhasil diedit!";
                header("location:../admin/index.php?menu=allorders");
            }else{
                $_SESSION['warning'] = "Order gagal diedit!";
                header("location:../admin/index.php?menu=allorders");
            }
        }else{
            $_SESSION['success'] = "No telepon harus numeric!";
            header("location:../admin/index.php?menu=allorders");
        }
    }

    public function reminderEscalation($type, $id, $idCust)
    {   
        switch($type){
            case 'service':
            $send = $this->esk->sendEscalationService($id, $idCust);
            break;

            case 'promo':
            $send = $this->esk->sendEscalationPromo($id, $idCust);
            break;

            case 'produk':
            $send = $this->esk->sendEscalationProduct($id, $idCust);

            default:
            echo 'Not found';
        }

        if($send == true){
            $_SESSION['success'] = "Reminder berhasil terkirim kepada customer!";
            header("location:../admin/index.php?menu=eskalasi");
        }else{
            $_SESSION['warning'] = "Reminder gagal terkirim kepada customer! ";
            header("location:../admin/index.php?menu=eskalasi");
        }
    }

    public function reminderAllEscalation($type, $id)
    {
        switch($type){
            case 'service':
            $send = $this->esk->sendAllEscalationService($id);
            break;

            case 'promo':
            $send = $this->esk->sendAllEscalationPromo($id);
            break;

            case 'produk':
            $send = $this->esk->sendAllEscalationProduct($id);
            break;
        }

        if($send == true){
            $_SESSION['success'] = "Reminder berhasil terkirim kepada customer!";
            header("location:../admin/index.php?menu=eskalasi");
        }else{
            $_SESSION['warning'] = "Reminder gagal terkirim kepada customer!";
            header("location:../admin/index.php?menu=eskalasi");
        }
    }
} ?>