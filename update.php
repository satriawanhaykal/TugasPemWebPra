<?php
include 'koneksi.php'; // Pastikan file koneksi.php sudah benar

$message = ""; // Variabel untuk menyimpan pesan sukses/error

// Bagian ini dijalankan ketika form di-submit untuk update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_mahasiswa = $_POST['id_mahasiswa'];
    $nama_mahasiswa = $_POST['nama_mahasiswa'];
    $prodi_mahasiswa = $_POST['prodi_mahasiswa'];
    $semester_mahasiswa = $_POST['semester_mahasiswa'];

    // Query untuk update data
    $query = "UPDATE tb_mahasiswa SET nama_mahasiswa=?, prodi_mahasiswa=?, semester_mahasiswa=? WHERE id_mahasiswa=?";
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssi", $nama_mahasiswa, $prodi_mahasiswa, $semester_mahasiswa, $id_mahasiswa);
        if (mysqli_stmt_execute($stmt)) {
            $message = "Data mahasiswa berhasil diperbarui!";
            // Redirect kembali ke index.php setelah update sukses
            header("Location: index.php?message=" . urlencode($message));
            exit();
        } else {
            $message = "Error: " . mysqli_error($connection);
        }
        mysqli_stmt_close($stmt);
    } else {
        $message = "Error preparing statement: " . mysqli_error($connection);
    }
}

// Bagian ini dijalankan ketika halaman diakses pertama kali (untuk menampilkan form dengan data)
if (isset($_GET['id'])) {
    $id_mahasiswa_to_update = $_GET['id'];

    // Ambil data mahasiswa berdasarkan ID
    $query_select = "SELECT * FROM tb_mahasiswa WHERE id_mahasiswa = ?";
    $stmt_select = mysqli_prepare($connection, $query_select);

    if ($stmt_select) {
        mysqli_stmt_bind_param($stmt_select, "i", $id_mahasiswa_to_update);
        mysqli_stmt_execute($stmt_select);
        $result_select = mysqli_stmt_get_result($stmt_select);

        if (mysqli_num_rows($result_select) == 1) {
            $data = mysqli_fetch_assoc($result_select);
        } else {
            $message = "Data mahasiswa tidak ditemukan.";
            // Redirect kembali ke index.php jika ID tidak valid
            header("Location: index.php?message=" . urlencode($message));
            exit();
        }
        mysqli_stmt_close($stmt_select);
    } else {
        $message = "Error preparing select statement: " . mysqli_error($connection);
    }
} else {
    // Jika tidak ada ID yang diberikan, redirect kembali ke index.php
    header("Location: index.php?message=" . urlencode("ID mahasiswa tidak diberikan."));
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Data Mahasiswa</h1>

    <?php if (!empty($message)): ?>
        <p style="color: red;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="update.php" method="post">
        <input type="hidden" name="id_mahasiswa" value="<?php echo htmlspecialchars($data['id_mahasiswa']); ?>">

        <label for="nama_mahasiswa">Nama Mahasiswa: </label><br>
        <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" value="<?php echo htmlspecialchars($data['nama_mahasiswa']); ?>" required><br><br>

        <label for="prodi_mahasiswa">Prodi: </label><br>
        <input type="text" id="prodi_mahasiswa" name="prodi_mahasiswa" value="<?php echo htmlspecialchars($data['prodi_mahasiswa']); ?>" required><br><br>

        <label for="semester_mahasiswa">Semester: </label><br>
        <input type="text" id="semester_mahasiswa" name="semester_mahasiswa" value="<?php echo htmlspecialchars($data['semester_mahasiswa']); ?>" required><br><br>

        <input type="submit" value="Update Data">
        <input type="button" value="Batal" onclick="window.location.href='index.php';">
    </form>
</body>
</html>