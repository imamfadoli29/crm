<?php 
/*
    Author : Irvan Sulisito
    Requirements : PHP v7
    Notes : Tidak diperkenankan untuk diperjualbelikan, hanya untuk menjadi bahan belajar.
 */
@(session_start());
require_once 'Database.php';

class Access {

    public function __construct() {
        $this->db = new Database;
    }

    public function login($username, $password){
       $this->username = $this->db->escape($username);
       $this->password = $this->db->escape(md5($password));
       
       $auth = $this->db->query("SELECT * FROM tr_user WHERE username='".$this->username."' AND password='".$this->password."' ");
       if($auth->num_rows > 0){
          $data = $auth->fetch_assoc();
          $row = $this->db->object($data);  
          
          $_SESSION['username'] = $row->username;
          $_SESSION['id_user']= $row->id_user;
          $_SESSION['date_registered'] = $row->date_registered;
          $_SESSION['role'] = $row->role;
          $_SESSION['id_customer'] = $row->id_customer;
          $_SESSION['email'] = $row->email;

          if($row->role == "admin"){
            header("location:../admin/index.php");
          }

          else if($row->role == "customer"){
            header("location:../user/index.php");
          }

       }else{
        header("location:../login.php"); 
        $_SESSION['warning'] = "Username atau password anda salah!";
       }
    }

    public function register(){
      $idCustomer =  "5". strtoupper(base_convert(rand(time(),2),10,17));
      $email = $_POST['email'];
      $username = $this->db->escape($_POST['username']);
      $password = $this->db->escape(md5($_POST['password']));
      $confirm = $this->db->escape(md5($_POST['confirm_password']));
      $nama = $_POST['nama_perusahaan'];
      $alamat = $_POST['alamat'];
      $no_hp = $_POST['no_hp'];
      $cek = $this->db->query("SELECT * FROM tr_user WHERE username='$username' OR email='$email'  ");
      if($cek->num_rows > 0){
        $_SESSION['warning'] = "Maaf, username atau email telah terdaftar";
        header("location:../register.php");
      }else{
        if($password !== $confirm){
          $_SESSION['warning'] = "Maaf, password tidak sama";
          header("location:../register.php");
        }else{
          $insert = $this->db->query("INSERT INTO tr_user VALUES ('', '$username', '$email', '$password', now(), 'customer', '$idCustomer') ");
          $insert2 = $this->db->query("INSERT INTO tr_customer VALUES('$idCustomer', '$nama', '$alamat', '$no_hp', '$email', '',  now(), 'Y' ) ");
          if($insert){
            $_SESSION['success'] = "Pendaftaran berhasil! silahkan login";
            header("location:../register.php");
          }else{
            $_SESSION['warning'] = "Pendaftaran gagal!";
            header("location:../register.php");
          }
        }
      }

    }

    public function logout(){
      session_destroy();
      header("location:../index.php");
    }
    

}