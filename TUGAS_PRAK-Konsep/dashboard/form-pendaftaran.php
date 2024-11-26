<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengecek apakah data ada di dalam $_POST
    if (isset($_POST["name"], $_POST["email"], $_POST["phone"], $_POST["tanggal_pendaftaran"], $_POST["umur"], $_POST["jenis_kelamin"], $_POST["cabang_olahraga"], $_POST["status"], $_POST["pesan"])) {
        // Mengambil data dari form
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = substr(preg_replace("/[^0-9]/", "", $_POST["phone"]), 0, 13);
        $tgl_daftar = $_POST["tanggal_pendaftaran"];
        $umur = $_POST["umur"];
        $jenis_kelamin = $_POST["jenis_kelamin"];
        $cabang_olahraga = $_POST["cabang_olahraga"];     
        $status = $_POST["status"];
        $pesan = $_POST["pesan"];

        // Koneksi ke database
        $conn = new mysqli("localhost", "root", "", "crud_db"); // Ganti "your_password" jika perlu

        // Mengecek koneksi
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Menyiapkan statement
        $stmt = $conn->prepare("INSERT INTO pendaftar (name, email, phone, tanggal_pendaftaran, umur, jenis_kelamin, cabang_olahraga, status, pesan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $name, $email, $phone, $tgl_daftar, $umur, $jenis_kelamin, $cabang_olahraga, $status, $pesan);
        

        // Eksekusi query dan cek hasilnya
        if ($stmt->execute()) {
            // Menggunakan alert JavaScript sebelum redirect
            echo "<script>alert('Data berhasil ditambahkan'); window.location.href = 'index.html';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Menutup koneksi dan statement
        $stmt->close();
        $conn->close();
    } else {
        echo "Name, email, and phone are required.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran HIMA-CUP</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="nav-container">
            <nav>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="landingPage.html#about">About</a></li>
                    <li><a href="landingPage.html#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
        <div class="header-content">
            <h1>Pendaftaran Peserta HIMA-CUP</h1>
            <p>Bergabunglah di HIMA-CUP dan tunjukkan kemampuan terbaik Anda dalam kompetisi olahraga bergengsi!</p>
        </div>
    </header>

    <div class="form-container">
    <form action="form-pendaftaran.php" method="POST">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" required>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="phone">Phone</label>
    <input type="text" name="phone" id="phone" required>

    <label for="tanggal_pendaftaran">Tanggal Pendaftaran</label>
    <input type="date" name="tanggal_pendaftaran" id="tanggal_pendaftaran" required>

    <label for="umur">Umur</label>
    <input type="number" name="umur" id="umur" required>

    <label for="jenis_kelamin">Jenis Kelamin</label>
    <select name="jenis_kelamin" id="jenis_kelamin" required>
        <option value="Laki-Laki">Laki-Laki</option>
        <option value="Perempuan">Perempuan</option>
    </select>

    <label for="cabang_olahraga">Cabang Olahraga:</label>
    <select name="cabang_olahraga" id="cabang_olahraga" required>
        <option value="" disabled selected>Pilih Cabang Olahraga</option>
        <option value="sepak bola">Sepak Bola</option>
        <option value="basket">Basket</option>
        <option value="futsal">Futsal</option>
        <option value="voli">Voli</option>
        <option value="bulutangkis">Bulutangkis</option>
                
    </select>

            <label>Status:</label>
            <div class="radio-group">
                <input type="radio" id="pelajar" name="status" value="pelajar">
                <label for="pelajar">Pelajar</label>
                
                <input type="radio" id="mahasiswa" name="status" value="mahasiswa">
                <label for="mahasiswa">Mahasiswa</label>

                <input type="radio" id="pekerja" name="status" value="pekerja">
                <label for="pekerja">Pekerja</label>
            </div>

    <label for="pesan">Pesan</label>
    <textarea name="pesan" id="pesan" required></textarea>

    <button type="submit">Submit</button>
</form>

    </div>

    <footer>
        <p>&copy; 2024 Created By | Anindia Atikah Putri.</p>
    </footer>

</body>
</html>
