<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

include("../koneksi.php");
include("sendEmail-v156.php");

if (isset($_POST['konfirmasi']) && isset($_POST['id_book'])) {
    $id_book = mysqli_real_escape_string($koneksi, $_POST['id_book']);
    
    // Ambil data transaksi
    $sql_sel = "SELECT * FROM transaksi WHERE id_book = '$id_book'";
    $query_sel = mysqli_query($koneksi, $sql_sel);
    $transaksi = mysqli_fetch_assoc($query_sel);
    
    if ($transaksi) {
        // Ambil data member
        $sql_selmem = "SELECT * FROM member WHERE username_member = '$transaksi[username_member]'";
        $selmem = mysqli_query($koneksi, $sql_selmem);
        $member = mysqli_fetch_assoc($selmem);
        
        $message = "Pembayaran dengan kode booking $id_book telah dikonfirmasi. Terima kasih telah melakukan pembayaran. Silahkan bermain dengan menunjukkan email ini pada operator tempat futsal terlebih dahulu.";
        $to = $member['email'];
        $subject = "Konfirmasi Pembayaran - Kode Booking: $id_book";
        
        $sender = "fikribiantara77@gmail.com";
        $password = "ladecima10"; // Sebaiknya gunakan variabel lingkungan untuk menyimpan password

        if (email_localhost1($to, $subject, $message, $sender, $password)) {
            $sql_update = mysqli_query($koneksi, "UPDATE transaksi SET status = 'Telah Dikonfirmasi' WHERE id_book = '$id_book'");
            if ($sql_update) {
                echo "<script>alert('Pembayaran telah dikonfirmasi dan email telah dikirim.'); window.location = 'admin.php';</script>";
            } else {
                echo "<script>alert('Gagal mengupdate status transaksi.'); window.location = 'admin.php';</script>";
            }
        } else {
            echo "<script>alert('Gagal mengirim email konfirmasi.'); window.location = 'admin.php';</script>";
        }
    } else {
        echo "<script>alert('Data transaksi tidak ditemukan.'); window.location = 'admin.php';</script>";
    }
} else {
    header('Location: admin.php');
    exit;
}