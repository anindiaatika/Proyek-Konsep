<?php
// Mengecek apakah form telah dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $conn = new mysqli("localhost", "root", "", "crud_db");

    // Mengecek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Menyiapkan statement
    $stmt = $conn->prepare("INSERT INTO pendaftar (name, email, phone) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $phone);

    // Eksekusi query dan cek hasilnya
    if ($stmt->execute()) {
        echo "Data berhasil ditambahkan";
        header("Refresh: 2; URL=index.php"); // Redirect to index.php after 2 seconds
    } else {
        echo "Error: " . $stmt->error;
    }
    // Menutup koneksi dan statement
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna Baru</title>
    <style>
        /* Mengatur gaya umum untuk body */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* Alice Blue */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Mengatur gaya container form */
        .form-container {
            background-color: #FAFAD2; /* Light Goldenrod Yellow */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        /* Mengatur label input dan spasi antar elemen */
        .form-container label {
            display: block;
            width: 100%;
            margin-bottom: 5px;
            font-weight: bold;
            color: #6b8e23; /* Olive Drab */
        }

        .form-container input[type="text"], .form-container input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Mengatur gaya tombol submit dan tombol kembali */
        .form-container button{
            display: inline-block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .form-container button {
            background-color: #90EE90; /* Light Green */
        }

        .form-container button:hover {
            background-color: #77dd77; /* Slightly darker green */
        }

        .form-container #back {
            background-color: #ADD8E6; /* Light Blue */
            text-align: center;
        }

        .form-container #back:hover {
            background-color: #87CEEB; /* Sky Blue */
        }
    </style>
</head>
<body>

<div class="form-container">
    <h3>Tambah Pengguna Baru</h3>
    <form method="POST" action="create.php">
        <label for="name">Nama</label>
        <input type="text" id="name" name="name" required>
        
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        
        <label for="phone">Telepon</label>
        <input type="text" id="phone" name="phone" required>
        
        <button type="submit">Simpan</button>
        <button id="back" type="back"><a href="index.php">Kembali</a></button>
    </form>
</div>

</body>
</html>