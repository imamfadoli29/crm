<?php 
/*
    Author : Irvan Sulisito
    Requirements : PHP v7
    Notes : Tidak diperkenankan untuk diperjualbelikan, hanya untuk menjadi bahan belajar.
 */
require_once 'Database.php';
require_once 'phpmailer/PHPMailerAutoload.php';

class Escalation{

    public function __construct(){
        $this->db = new Database;
        $this->mail = new PHPMailer;
    }

    public function information()
    {
        $this->mail->SMTPOptions = array(
            "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => true
            )
            );
        // Konfigurasi SMTP
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = ''; //isi alamat gmail
        $this->mail->Password = ''; //isi password gmail
        $this->mail->SMTPSecure = 'tls';
        $this->mail->Port = 587;
        $this->mail->isHTML(true);
    }

    public function testEmail()
    {
        $this->information();
        $this->mail->setFrom('irvan.s.28.is@gmail.com', 'CRM.com');
        $this->mail->addAddress('sulistioirvan@gmail.com');
        $this->mail->Subject ="Test email from CRM";
        $this->mailContent = "This is testing email from CRM, please ignore this";
        $this->mail->Body = $this->mailContent;
        $this->mail->Send();
    }

    public function sendEscalationService($id, $idCust)
    {   
        //get data
        $sql = "SELECT * FROM tr_service t1, tr_jenis_service t2 WHERE t1.id_jenis=t2.id_jenis AND t1.id_service='$id' ";
        $data = $this->db->query($sql);
        $row = $data->fetch_assoc();
        $var = $this->db->object($row);
        $sql2 = "SELECT * FROM tr_user t1, tr_customer t2 WHERE t1.id_customer=t2.id_customer AND t2.is_active='Y' AND t1.id_customer='$idCust' ";
        $data2 = $this->db->query($sql2);
        $row2 = $data2->fetch_assoc();
        $var2 = $this->db->object($row2);

        if($id !==  ""){
            $this->information();
            $this->mail->setFrom('irvan.s.28.is@gmail.com', 'CRM.com');
            $this->mail->addAddress($var2->email);
            $this->mail->Subject = 'CRM - '.$var->nama_service.' ';
            $this->mailContent = "<div style='padding:2px 2px 2px;border:1px solid #f5f5f5;line-height:1.9;font-family:viga'>
            <h4>Dear customer, mungkin anda tertarik dengan service dari dealer kami : </h4>
            <table style='border-collapse:collapse;padding:2px 2px 2px;border:1px solid #999;width:100%;' border='1'>
                <th style='text-align:left;'>Service</th>
                <td>$var->nama_service</td>
                <tr>
                <th style='text-align:left;'>Jenis</th>
                <td>$var->jenis_service</td>
                <tr>
                <th style='text-align:left;'>Deskripsi</th>
                <td>$var->deskripsi_service</td>
                <tr>
                <th style='text-align:left;'>Harga</th>
                <td>Rp. ".number_format($var->harga_service,0,'.','.')."</td>
            </table>
            <p>Harga yang kami tawarkan sudah sangat murah, segera kunjungi web kami atau datang ke dealer motor kami!</p>
            <p><b>Alamat</b> : Jl PUP Sektor V Blok A 99 No 30 Bekasi Utara<br>
            <b>No Telp</b> : 0219999999<br>
            <b>Kota</b> : Bekasi</p>
            <center><a href='sulivan.site/demo/project_crm' style='background:#3c8dbc;color:#fff;border-radius:8px;width:100%;padding:10px 8px 8px;margin-bottom:10px;'>CEK SEKARANG!</a></center><br>
            </div><br>
            <div style='color:#999;text-align:center'> Email ini merupakan eskalasi yang dikirim dari CRM Dealer Motor </div>";
            $this->mail->Body = $this->mailContent;
            if($this->mail->Send()){
                return true;
            }else{
                return false;
            }
        }
    }

    public function sendEscalationPromo($id, $idCust)
    {
        //get data
        $sql = "SELECT * FROM tr_promo WHERE id_promo='$id' ";
        $data = $this->db->query($sql);
        $row = $data->fetch_assoc();
        $var = $this->db->object($row);
        $sql2 = "SELECT * FROM tr_user t1, tr_customer t2 WHERE t1.id_customer=t2.id_customer AND t2.is_active='Y' AND t1.id_customer='$idCust' ";
        $data2 = $this->db->query($sql2);
        $row2 = $data2->fetch_assoc();
        $var2 = $this->db->object($row2);

        if($id !==  ""){
            $this->information();
            $this->mail->setFrom('irvan.s.28.is@gmail.com', 'CRM.com');
            $this->mail->addAddress($var2->email);
            $this->mail->Subject = 'CRM - '.$var->nama_promo.' ';
            $this->mailContent = "<div style='padding:2px 2px 2px;border:1px solid #f5f5f5;line-height:1.9;font-family:viga'>
            <h4>Dear customer, mungkin anda tertarik dengan promo dari dealer kami : </h4>
            <table style='border-collapse:collapse;padding:10px 10px 10px;border:1px solid #999;width:100%' border='1'>
                <th style='text-align:left;'>Promo</th>
                <td>$var->nama_promo</td>
                <tr>
                <th style='text-align:left;'>Deskripsi</th>
                <td>$var->deskripsi_promo</td>
                <tr>
                <th style='text-align:left;'>Dari</th>
                <td>".date('d F Y', strtotime($var->dari_tgl))."</td>
                <tr>
                <th style='text-align:left;'>Sampai</th>
                <td>".date('d F Y', strtotime($var->sampai_tgl))."</td>
                <tr>
                <th style='text-align:left;'>Jml Hari</th>
                <td>$var->jumlah_hari Hari</td>
            </table>
            <p>Promo kami yang tawarkan sangat terbatas! langsung aja kunjungin web atau dealer motor kami!</p>
            <p><b>Alamat</b> : Jl PUP Sektor V Blok A 99 No 30 Bekasi Utara<br>
            <b>No Telp</b> : 0219999999<br>
            <b>Kota</b> : Bekasi</p>
            <center><a href='sulivan.site/demo/project_crm' style='background:#3c8dbc;color:#fff;border-radius:8px;width:100%;padding:10px 8px 8px;margin-bottom:10px;'>CEK SEKARANG!</a></center><br>
            </div><br>
            <div style='color:#999;text-align:center'> Email ini merupakan eskalasi yang dikirim dari CRM Dealer Motor </div>";
            $this->mail->Body = $this->mailContent;
            if($this->mail->Send()){
                return true;
            }else{
                return false;
            }
        }
    }

    public function sendEscalationProduct($id, $idCust)
    {
        //get data
        $sql = "SELECT * FROM tr_produk WHERE id_produk='$id' ";
        $data = $this->db->query($sql);
        $row = $data->fetch_assoc();
        $var = $this->db->object($row);
        $sql2 = "SELECT * FROM tr_user t1, tr_customer t2 WHERE t1.id_customer=t2.id_customer AND t2.is_active='Y' AND t1.id_customer='$idCust' ";
        $data2 = $this->db->query($sql2);
        $row2 = $data2->fetch_assoc();
        $var2 = $this->db->object($row2);

        if($id !==  ""){
            $this->information();
            $this->mail->setFrom('irvan.s.28.is@gmail.com', 'CRM.com');
            $this->mail->addAddress($var2->email);
            $this->mail->Subject = 'CRM - '.$var->nama_produk.' ';
            $this->mailContent = "<div style='padding:2px 2px 2px;border:1px solid #f5f5f5;line-height:1.9;font-family:viga'>
            <h4>Dear customer, mungkin anda tertarik dengan produk dari dealer kami : </h4>
            <table style='border-collapse:collapse;padding:10px 10px 10px;border:1px solid #999;width:100%' border='1'>
                <th style='text-align:left;'>Produk</th>
                <td>$var->nama_produk</td>
                <tr>
                <th style='text-align:left;'>Deskripsi</th>
                <td>$var->deskripsi_produk</td>
                <tr>
                <th style='text-align:left;'>Harga</th>
                <td>Rp ".number_format($var->harga_produk,0,'.','.')."</td>
            </table>
            <p>Produk yang kami yang tawarkan sangat terbatas! langsung aja kunjungin web atau dealer motor kami!</p>
            <p><b>Alamat</b> : Jl PUP Sektor V Blok A 99 No 30 Bekasi Utara<br>
            <b>No Telp</b> : 0219999999<br>
            <b>Kota</b> : Bekasi</p>
            <center><a href='sulivan.site/demo/project_crm' style='background:#3c8dbc;color:#fff;border-radius:8px;width:100%;padding:10px 8px 8px;margin-bottom:10px;'>CEK SEKARANG!</a></center><br>
            </div><br>
            <div style='color:#999;text-align:center'> Email ini merupakan eskalasi yang dikirim dari CRM Dealer Motor </div>";
            $this->mail->Body = $this->mailContent;
            if($this->mail->Send()){
                return true;
            }else{
                return false;
            }
        }
    }

    public function sendAllEscalationService($id)
    {
         //get data
         $sql = "SELECT * FROM tr_service t1, tr_jenis_service t2 WHERE t1.id_jenis=t2.id_jenis AND t1.id_service='$id' ";
         $data = $this->db->query($sql);
         $row = $data->fetch_assoc();
         $var = $this->db->object($row);
         $sql2 = "SELECT * FROM tr_user t1, tr_customer t2 WHERE t1.id_customer=t2.id_customer AND t2.is_active='Y'";
         $data2 = $this->db->query($sql2);
         if($id !==  ""){
            $this->information();
            $this->mail->setFrom('irvan.s.28.is@gmail.com', 'CRM.com');
            foreach($data2 as $row2){
                $var2 = $this->db->object($row2);
                $this->mail->addAddress($var2->email);
                $this->mail->Subject = 'CRM - '.$var->nama_service.' ';
                $this->mailContent = "<div style='padding:2px 2px 2px;border:1px solid #f5f5f5;line-height:1.9;font-family:viga'>
                <h4>Dear customer, mungkin anda tertarik dengan service dari dealer kami : </h4>
                <table style='border-collapse:collapse;padding:2px 2px 2px;border:1px solid #999;width:100%;' border='1'>
                    <th style='text-align:left;'>Service</th>
                    <td>$var->nama_service</td>
                    <tr>
                    <th style='text-align:left;'>Jenis</th>
                    <td>$var->jenis_service</td>
                    <tr>
                    <th style='text-align:left;'>Deskripsi</th>
                    <td>$var->deskripsi_service</td>
                    <tr>
                    <th style='text-align:left;'>Harga</th>
                    <td>Rp. ".number_format($var->harga_service,0,'.','.')."</td>
                </table>
                <p>Harga yang kami tawarkan sudah sangat murah, segera kunjungi web kami atau datang ke dealer motor kami!</p>
                <p><b>Alamat</b> : Jl PUP Sektor V Blok A 99 No 30 Bekasi Utara<br>
                <b>No Telp</b> : 0219999999<br>
                <b>Kota</b> : Bekasi</p>
                <center><a href='sulivan.site/demo/project_crm' style='background:#3c8dbc;color:#fff;border-radius:8px;width:100%;padding:10px 8px 8px;margin-bottom:10px;'>CEK SEKARANG!</a></center><br>
                </div><br>
                <div style='color:#999;text-align:center'> Email ini merupakan eskalasi yang dikirim dari CRM Dealer Motor </div>";
                $this->mail->Body = $this->mailContent;
            }
        }
        if($this->mail->Send()){
            return true;
        }else{
            return false;
        }
    }
    
    public function sendAllEscalationPromo($id)
    {
      //get data
      $sql = "SELECT * FROM tr_promo WHERE id_promo='$id' ";
      $data = $this->db->query($sql);
      $row = $data->fetch_assoc();
      $var = $this->db->object($row);
      $sql2 = "SELECT * FROM tr_user t1, tr_customer t2 WHERE t1.id_customer=t2.id_customer AND t2.is_active='Y'";
      $data2 = $this->db->query($sql2);
      foreach($data2 as $row2){
            $var2 = $this->db->object($row2);
            if($id !==  ""){
                $this->information();
                $this->mail->setFrom('irvan.s.28.is@gmail.com', 'CRM.com');
                $this->mail->addAddress($var2->email);
                $this->mail->Subject = 'CRM - '.$var->nama_promo.' ';
                $this->mailContent = "<div style='padding:2px 2px 2px;border:1px solid #f5f5f5;line-height:1.9;font-family:viga'>
                <h4>Dear customer, mungkin anda tertarik dengan promo dari dealer kami : </h4>
                <table style='border-collapse:collapse;padding:15px 15px 15px;border:1px solid #999;width:100%' border='1'>
                    <th style='text-align:left;'>Promo</th>
                    <td>$var->nama_promo</td>
                    <tr>
                    <th style='text-align:left;'>Deskripsi</th>
                    <td>$var->deskripsi_promo</td>
                    <tr>
                    <th style='text-align:left;'>Dari</th>
                    <td>".date('d F Y', strtotime($var->dari_tgl))."</td>
                    <tr>
                    <th style='text-align:left;'>Sampai</th>
                    <td>".date('d F Y', strtotime($var->sampai_tgl))."</td>
                    <tr>
                    <th style='text-align:left;'>Jml Hari</th>
                    <td>$var->jumlah_hari Hari</td>
                </table>
                <p>Promo kami yang tawarkan sangat terbatas! langsung aja kunjungin web atau dealer motor kami!</p>
                <p><b>Alamat</b> : Jl PUP Sektor V Blok A 99 No 30 Bekasi Utara<br>
                <b>No Telp</b> : 0219999999<br>
                <b>Kota</b> : Bekasi</p>
                <center><a href='sulivan.site/demo/project_crm' style='background:#3c8dbc;color:#fff;border-radius:8px;width:100%;padding:10px 8px 8px;margin-bottom:10px;'>CEK SEKARANG!</a></center><br>
                </div><br>
                <div style='color:#999;text-align:center'> Email ini merupakan eskalasi yang dikirim dari CRM Dealer Motor </div>";
                $this->mail->Body = $this->mailContent;
            }   
        }
        if($this->mail->Send()){
            return true;
        }else{
            return false;
        }
    }

    public function sendAllEscalationProduct($id)
    {
        //get data
        $sql = "SELECT * FROM tr_produk WHERE id_produk='$id' ";
        $data = $this->db->query($sql);
        $row = $data->fetch_assoc();
        $var = $this->db->object($row);
        $sql2 = "SELECT * FROM tr_user t1, tr_customer t2 WHERE t1.id_customer=t2.id_customer AND t2.is_active='Y' ";
        $data2 = $this->db->query($sql2);
        foreach($data2 as $row2){
            $var2 = $this->db->object($row2);
            if($id !==  ""){
                $this->information();
                $this->mail->setFrom('irvan.s.28.is@gmail.com', 'CRM.com');
                $this->mail->addAddress($var2->email);
                $this->mail->Subject = 'CRM - '.$var->nama_produk.' ';
                $this->mailContent = "<div style='padding:2px 2px 2px;border:1px solid #f5f5f5;line-height:1.9;font-family:viga'>
                <h4>Dear customer, mungkin anda tertarik dengan produk dari dealer kami : </h4>
                <table style='border-collapse:collapse;padding:15px 15px 15px;border:1px solid #999;width:100%' border='1'>
                    <th style='text-align:left;'>Produk</th>
                    <td>$var->nama_produk</td>
                    <tr>
                    <th style='text-align:left;'>Deskripsi</th>
                    <td>$var->deskripsi_produk</td>
                    <tr>
                    <th style='text-align:left;'>Harga</th>
                    <td>$var->harga_produk Hari</td>
                </table>
                <p>Produk yang kami yang tawarkan sangat terbatas! langsung aja kunjungin web atau dealer motor kami!</p>
                <p><b>Alamat</b> : Jl PUP Sektor V Blok A 99 No 30 Bekasi Utara<br>
                <b>No Telp</b> : 0219999999<br>
                <b>Kota</b> : Bekasi</p>
                <center><a href='sulivan.site/demo/project_crm' style='background:#3c8dbc;color:#fff;border-radius:8px;width:100%;padding:10px 8px 8px;margin-bottom:10px;'>CEK SEKARANG!</a></center><br>
                </div><br>
                <div style='color:#999;text-align:center'> Email ini merupakan eskalasi yang dikirim dari CRM Dealer Motor </div>";
                $this->mail->Body = $this->mailContent;
            }
        }
        if($this->mail->Send()){
            return true;
        }else{
            return false;
        }
    }
}