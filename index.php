<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    session_start(); // Keep this line here, at the very beginning of your PHP block

    include 'koneksi.php'; //

    $displayMessage = ''; //
    $messageType = ''; //

    if (isset($_SESSION['message'])) { //
        $displayMessage = htmlspecialchars($_SESSION['message']); //
        $messageType = htmlspecialchars($_SESSION['message_type'] ?? 'info'); //
        unset($_SESSION['message']); //
        unset($_SESSION['message_type']); //
    }
    else if (isset($_GET['message'])) { //
        $displayMessage = htmlspecialchars($_GET['message']); //
        $messageType = strpos($displayMessage, 'Error') !== false ? 'error' : 'success'; //
    }

    if (!empty($displayMessage)) { //
        echo "<div id='statusMessage' class='message {$messageType}'>"; //
        echo "<span class='closebtn' onclick='this.parentElement.style.display=\"none\";'>&times;</span>"; //
        echo $displayMessage; //
        echo "</div>"; //
    }

    $hasil = mysqli_query($connection, "SELECT * FROM tb_mahasiswa"); //
    echo "<h1>DATA MAHASISWA</h1>"; //

    if (mysqli_num_rows($hasil) > 0) { //
        echo "<table>"; //
        echo "<thead>"; //
        echo "<tr>"; //
        echo "<th>Nama Mahasiswa</th>"; //
        echo "<th>Prodi Mahasiswa</th>"; //
        echo "<th>Semester Mahasiswa</th>"; //
        echo "<th>Aksi</th>"; //
        echo "</tr>"; //
        echo "</thead>"; //
        echo "<tbody>"; //

        while ($data = mysqli_fetch_array($hasil)){ //
            echo "<tr>"; //
            echo "<td data-label='Nama Mahasiswa'>" . $data['nama_mahasiswa'] . "</td>";
            echo "<td data-label='Prodi Mahasiswa'>" . $data['prodi_mahasiswa'] . "</td>";
            echo "<td data-label='Semester Mahasiswa'>" . $data['semester_mahasiswa'] . "</td>";
            echo "<td data-label='Aksi'>";
            echo "<a href='update.php?id=" . $data['id_mahasiswa'] . "' class='btn btn-edit'>Edit</a> "; //
            echo "<a href='delete.php?id=" . $data['id_mahasiswa'] . "' class='btn btn-delete' onclick=\"return confirm('Anda yakin ingin menghapus data ini?');\">Hapus</a>"; //
            echo "</td>"; //
            echo "</tr>"; //
        }
        echo "</tbody>"; //
        echo "</table>"; //
    } else {
        echo "<p>Tidak ada data mahasiswa.</p>"; //
    }
    ?>

    <hr>

    <div class="forms-container">
        <div class="form-section">
            <h2>Tambah Data Mahasiswa</h2>
            <form action="tambah.php" method="post">
                <label for="nama_mahasiswa">Nama Mahasiswa: </label><br>
                <input type="text" id="nama_mahasiswa" name="nama_mahasiswa" required><br><br>

                <label for="prodi_mahasiswa">Prodi: </label><br>
                <input type="text" id="prodi_mahasiswa" name="prodi_mahasiswa" required><br><br>

                <label for="semester_mahasiswa">Semester: </label><br>
                <input type="text" id="semester_mahasiswa" name="semester_mahasiswa" required><br><br>

                <input type="submit" value="Tambah Data">
                <input type="reset" value="Reset">
            </form>
        </div>

        <div class="form-section">
            <h2>Cari Data Mahasiswa</h2>
            <form action="cari.php" method="POST">
                <label for="nama_mahasiswa_cari">Nama Mahasiswa :</label><br>
                <input type="text" id="nama_mahasiswa_cari" name="nama_mahasiswa" required><br><br>
                <input type="submit" value="Cari Data">
                <input type="reset" value="Reset">
            </form>
        </div>
    </div>

</body>
</html>