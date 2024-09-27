<?php
// Include necessary files and initialize database connection
include "koneksi.php";
require('fpdf/fpdf.php');

// Fetch member data from the database
$query = "SELECT * FROM member ORDER BY id_member";
$result = mysqli_query($koneksi, $query);

// Create new PDF document
$pdf = new FPDF();
$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', 'B', 16);

// Title
$pdf->Cell(0, 10, 'Laporan Data Member Benteng-Sport Center', 0, 1, 'C');
$pdf->Ln(10);

// Table header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(10, 10, 'No', 1, 0, 'C');
$pdf->Cell(40, 10, 'Nama', 1, 0, 'C');
$pdf->Cell(40, 10, 'Username', 1, 0, 'C');
$pdf->Cell(60, 10, 'Email', 1, 0, 'C');
$pdf->Cell(40, 10, 'No. Telepon', 1, 1, 'C');

// Table content
$pdf->SetFont('Arial', '', 12);
$no = 1;
while($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(10, 10, $no, 1, 0, 'C');
    $pdf->Cell(40, 10, $row['nama'], 1, 0, 'L');
    $pdf->Cell(40, 10, $row['username_member'], 1, 0, 'L');
    $pdf->Cell(60, 10, $row['email'], 1, 0, 'L');
    $pdf->Cell(40, 10, $row['no_hp'], 1, 1, 'L');
    $no++;
}

// Output PDF
$pdf->Output('laporan_data_member.pdf', 'F');

echo "<h2>Laporan Data Member Benteng-Sport Center</h2>";
echo "<p>Laporan PDF telah dibuat. <a href='laporan_data_member.pdf' target='_blank'>Klik disini untuk mengunduh</a></p>";
?>
