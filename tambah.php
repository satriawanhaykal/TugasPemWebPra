<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Tambah Data</title>
    <link rel="stylesheet" href="style.css"> </head>
<body>
    <?php
    include 'koneksi.php';

    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $prodi_mahasiswa = $_POST['prodi_mahasiswa'];
    $semester_mahasiswa = $_POST['semester_mahasiswa'];

    $query = "INSERT INTO tb_mahasiswa (nama_mahasiswa,prodi_mahasiswa,semester_mahasiswa) VALUES ('$nama_mahasiswa','$prodi_mahasiswa','$semester_mahasiswa')";

    if(mysqli_query($connection, $query)){
        // Display success message with CSS classes
        echo "<div class='message success'>";
        echo "Data Berhasil Ditambahkan!";
        echo "</div>";
    }else{
        // Display error message with CSS classes
        echo "<div class='message error'>";
        echo "Error : " . mysqli_error($connection); // Only show mysqli_error for security reasons in dev
        echo "</div>";
    }
    ?>

    <br>
    <a href='index.php' class='btn btn-edit'>Kembali ke halaman utama</a> </body>
</html>