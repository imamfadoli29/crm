<?php
require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->SMTPOptions = array(
    "ssl" => array(
    "verify_peer" => false,
    "verify_peer_name" => false,
    "allow_self_signed" => true
    )
    );
// Konfigurasi SMTP
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'irvan.s.28.is@gmail.com';
$mail->Password = 'maimunah53';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('irvan.s.28.is@gmail.com', 'YukBelanja.com');
$mail->addReplyTo('irvan.s.28.is@gmail.com', 'Verifikasi User');

// Menambahkan penerima
$mail->addAddress('sulistioirvan@gmail.com');

// Menambahkan beberapa penerima
//$mail->addAddress('penerima2@contoh.com');
//$mail->addAddress('penerima3@contoh.com');


// Subjek email
$mail->Subject = 'Verifikasi User';

// Mengatur format email ke HTML
$mail->isHTML(true);

// Konten/isi email
$mailContent = "<h1>Cek EMAIL PAKE PHP WKWKWKWK</h1>
    <p>Ini adalah email percobaan yang dikirim menggunakan email server SMTP dengan PHPMailer.</p>";
$mail->Body = $mailContent;

// Menambahakn lampiran

// Kirim email
if(!$mail->send()){
    echo 'Pesan tidak dapat dikirim.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
    echo 'Pesan telah terkirim';
}