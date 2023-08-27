<?php 

require_once '../library/Crm.php';

$crm = new Crm;


switch(isset($_GET['action']) ? $_GET['action'] : NULL){
    
    case 'tambah_promo':
    $crm->addPromo();
    break;

    case 'tambah_product':
    $crm->addProduct();
    break;

    case 'hapus_promo':
    $crm->delPromo($_GET['id']);
    break;

    case 'hapus_produk':
    $crm->delProduct($_GET['id']);
    break;

    case 'kirim_minat':
    $crm->sendMinat($_GET['id']);
    break;

    case 'kirim_minat_promo':
    $crm->sendMinatPromo($_GET['id']);
    break;

    case 'tambah_feedback':
    $crm->addFeedback($_SESSION['id_customer']);
    break;

    case 'delete_feedback':
    $crm->delFeedback($_GET['id']);
    break;

    case 'reply_feedback':
    $crm->replyFeedback($_GET['id']);
    break;

    case 'hapus_feedback':
    $crm->delFeedback($_GET['id']);
    break;

    case 'edit_promo':
    $crm->editPromo($_GET['id']);
    break;

    case 'edit_produk':
    $crm->editProduct($_GET['id']);
    break;

    case 'tambah_service':
    $crm->addService();
    break;

    case 'hapus_service':
    $crm->delService($_GET['id']);
    break;

    case 'edit_service':
    $crm->editService($_GET['id']);
    break;

    case 'tambah_order':
    $crm->addOrder($_GET['id']);
    break;

    case 'edit_order':
    $crm->orderAction($_GET['id']);
    break;

    case 'hapus_order':
    $crm->delOrder($_GET['id']);
    break;

    case 'edit_customer':
    $crm->editCustomer($_GET['id']);
    break;

    case 'send_eskalasi':
    $crm->reminderEscalation($_GET['type'], $_POST['esk'], $_GET['id_cust']);
    break;

    case 'send_eskalasi_all':
    $crm->reminderAllEscalation($_GET['type'], $_POST['esk']);
    break;
}

?>