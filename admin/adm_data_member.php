<?php
// Include necessary files and initialize database connection
include "../koneksi.php";
require('../fpdf/fpdf.php');

// Fetch member data from the database
$query = "SELECT * FROM member ORDER BY id_member";
$result = mysqli_query($koneksi, $query);

// Create new PDF document
$pdf = new FPDF();
$pdf->AddPage();

// Set font
$pdf->SetFont('Arial', 'B', 16);

// Title
$pdf->Cell(0, 10, 'Data Member Benteng-Sport Center', 0, 1, 'C');
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
// Display PDF
if (file_exists('data_member.pdf')) {
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="data_member.pdf"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    @readfile('data_member.pdf');
} else {
    echo "PDF file not found.";
}
exit;

// Output PDF
$pdf->Output('data_member.pdf', 'F');

// Display member data in HTML table
echo "<h2>Data Member Benteng-Sport Center</h2>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>No</th><th>Nama</th><th>Username</th><th>Email</th><th>No. Telepon</th></tr>";

mysqli_data_seek($result, 0); // Reset result pointer
$no = 1;
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$no."</td>";
    echo "<td>".$row['nama']."</td>";
    echo "<td>".$row['username_member']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['no_hp']."</td>";
    echo "</tr>";
    $no++;
}
echo "</table>";

echo "<br><a href='data_member.pdf' target='_blank'>Download PDF</a>";
?>
