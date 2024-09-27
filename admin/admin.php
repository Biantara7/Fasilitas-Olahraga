<?php
// Pastikan hanya admin yang bisa mengakses halaman ini
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

include("../koneksi.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>

<body>
 <div class="container">            
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>Kode Booking</th>
        <th>Username</th>
      	<th>ID</th>
        <th>Tanggal Booking</th>
        <th>Tanggal Main</th>
        <th>Mulai</th>
		<th>Selesai</th>
		<th>Pembayaran</th>
		<th>Status</th>
		<th>Bukti Pembayaran</th>
      </tr>
    </thead>
    <tbody>
    <?php 
		$sql_sel = "SELECT * FROM transaksi ORDER BY tgl_book DESC";
		$query_sel = mysqli_query($koneksi, $sql_sel);
		while($sql_res = mysqli_fetch_assoc($query_sel)){
											
	?>
          <tr>
             <td><?php echo htmlspecialchars($sql_res['id_book']); ?></td>
             <td><?php echo htmlspecialchars($sql_res['username_member']); ?></td>
             <td><?php echo htmlspecialchars($sql_res['id_lap']); ?></td>
             <td><?php echo htmlspecialchars($sql_res['tgl_book']); ?></td>
             <td><?php echo htmlspecialchars($sql_res['tgl_main']); ?></td>
             <td><?php echo htmlspecialchars($sql_res['jam_mulai']); ?></td>
             <td><?php echo htmlspecialchars($sql_res['jam_berakhir']); ?></td>
             <td><?php echo htmlspecialchars($sql_res['jenis_bayar']); ?></td>
             <td><?php echo htmlspecialchars($sql_res['status']); ?></td>
             <td>
                <?php if (!empty($sql_res['bukti_bayar'])): ?>
                    <img src="assets/foto_bukti/<?php echo htmlspecialchars($sql_res['bukti_bayar']); ?>" width="90" height="30" alt="Bukti Pembayaran">
                <?php else: ?>
                    Belum ada bukti
                <?php endif; ?>
             </td>
             <td>
                <?php if ($sql_res['status'] == 'Menunggu Konfirmasi admin'): ?>
                    <form method="post" action="konfirmasi_pembayaran.php">
                        <input type="hidden" name="id_book" value="<?php echo htmlspecialchars($sql_res['id_book']); ?>">
                        <button type="submit" name="konfirmasi" class="btn btn-primary btn-sm">Konfirmasi</button>
                    </form>
                <?php endif; ?>
             </td>
          </tr>
    <?php } ?>
    </tbody>
  </table>
</div>
   
</body>
</html>