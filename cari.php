<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian Mahasiswa</title>
    <link rel="stylesheet" href="style.css"> </head>
<body>
    <?php
    include 'koneksi.php';

    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $sql = "SELECT * FROM tb_mahasiswa WHERE nama_mahasiswa LIKE '%$nama_mahasiswa%'";
    $hasil = mysqli_query($connection, $sql);

    echo "<h1>Hasil Pencarian Mahasiswa</h1>";

    if (mysqli_num_rows($hasil) > 0){
        // Display results in a table for better formatting
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Nama Mahasiswa</th>";
        echo "<th>Jurusan</th>";
        echo "<th>Semester</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($data = mysqli_fetch_array($hasil)){
            echo "<tr>";
            echo "<td>" . $data['nama_mahasiswa'] . "</td>";
            echo "<td>" . $data['prodi_mahasiswa'] . "</td>";
            echo "<td>" . $data['semester_mahasiswa'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        // You can add a success message here if desired
        // echo "<div class='message success'>Pencarian berhasil ditemukan.</div>";
    } else {
        echo "<div class='message error'>Tidak ada data yang ditemukan untuk nama : <strong>" . htmlspecialchars($nama_mahasiswa) . "</strong></div>";
    }

    echo "<br><a href='index.php' class='btn btn-edit'>Kembali ke halaman utama</a>"; // Styled as a button

    ?>
</body>
</html>