<?php
include 'koneksi.php'; // Pastikan file koneksi.php sudah benar

if (isset($_GET['id'])) {
    $id_mahasiswa_to_delete = $_GET['id'];

    // Query untuk delete data
    $query = "DELETE FROM tb_mahasiswa WHERE id_mahasiswa = ?";
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id_mahasiswa_to_delete);
        if (mysqli_stmt_execute($stmt)) {
            $message = "Data mahasiswa berhasil dihapus.";
        } else {
            $message = "Error: " . mysqli_error($connection);
        }
        mysqli_stmt_close($stmt);
    } else {
        $message = "Error preparing statement: " . mysqli_error($connection);
    }
} else {
    $message = "ID mahasiswa tidak diberikan.";
}

// Redirect kembali ke index.php setelah operasi delete
header("Location: index.php?message=" . urlencode($message));
exit();
?>