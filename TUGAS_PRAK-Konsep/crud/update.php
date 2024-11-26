<?php
$conn = new mysqli("localhost", "root", "", "crud_db");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM pendaftar WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Ambil data yang ada di database
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $tanggal_pendaftaran = $row['tanggal_pendaftaran'];
        $umur = $row['umur'];
        $jenis_kelamin = $row['jenis_kelamin'];
        $cabang_olahraga = $row['cabang_olahraga'];
        $status = $row['status'];
        $pesan = $row['pesan'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $tanggal_pendaftaran = $_POST['tanggal_pendaftaran'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $cabang_olahraga = $_POST['cabang_olahraga'];
    $status = $_POST['status'];
    $pesan = $_POST['pesan'];

    // Query untuk update data
    $sql = "UPDATE pendaftar SET name='$name', email='$email', phone='$phone', tanggal_pendaftaran='$tanggal_pendaftaran', umur=$umur, jenis_kelamin='$jenis_kelamin', cabang_olahraga='$cabang_olahraga', status='$status', pesan='$pesan' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");  // Redirect ke halaman utama setelah update
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Pengguna</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Body Style */
        body {
            background-color: #f4f4f9;
        }

        /* Header Styling */
        header {
            background-color: #003366;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        header p {
            font-size: 16px;
            margin: 0;
        }

        /* Form Container */
        .form-container {
            width: 90%;
            max-width: 500px;
            margin: 30px auto;
            padding: 20px;
            background-color: #e6f2ff; /* Light blue background */
            border: 1px solid #003366; /* Dark blue border */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .form-container h2 {
            color: #003366;
            text-align: center;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            font-weight: bold;
            color: #003366;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="tel"],
        form input[type="date"],
        form input[type="number"], /* Ditambahkan untuk Umur */
        form select,
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #003366;
            border-radius: 4px;
            background-color: #ffffff;
            outline: none;
            transition: border-color 0.3s;
        }

        form input[type="text"]:focus,
        form input[type="email"]:focus,
        form input[type="tel"]:focus,
        form input[type="date"]:focus,
        form input[type="number"]:focus, /* Fokus pada Umur */
        form select:focus,
        form textarea:focus {
            border-color: #66b3ff;
        }

        .radio-group {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .radio-group input[type="radio"] {
            margin-right: 5px;
        }

        form button {
            width: 100%;
            padding: 10px;
            background-color: #003366;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #002244;
        }

        footer {
    background-color: #003366;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    width: 100%;
    bottom: 0;
}


        /* Responsive Styling */
        @media (max-width: 600px) {
            .form-container {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Formulir Pendaftaran</h1>
    <p>Update Data Pengguna</p>
</header>

<div class="form-container">
    <h2>Update Pengguna</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="name">Nama</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

        <label for="phone">Telepon</label>
        <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" required>

        <label for="tanggal_pendaftaran">Tanggal Pendaftaran</label>
        <input type="date" id="tanggal_pendaftaran" name="tanggal_pendaftaran" value="<?php echo $tanggal_pendaftaran; ?>" required>

        <label for="umur">Umur</label>
        <input type="number" id="umur" name="umur" value="<?php echo $umur; ?>" required>

        <label for="jenis_kelamin">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="jenis_kelamin" required>
            <option value="Laki-Laki" <?php if ($jenis_kelamin == 'Laki-Laki') echo 'selected'; ?>>Laki-Laki</option>
            <option value="Perempuan" <?php if ($jenis_kelamin == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
        </select>

        <label for="cabang_olahraga">Cabang Olahraga</label>
        <select name="cabang_olahraga" id="cabang_olahraga" required>
            <option value="sepak bola" <?php if ($cabang_olahraga == 'sepak bola') echo 'selected'; ?>>Sepak Bola</option>
            <option value="basket" <?php if ($cabang_olahraga == 'basket') echo 'selected'; ?>>Basket</option>
            <option value="futsal" <?php if ($cabang_olahraga == 'futsal') echo 'selected'; ?>>Futsal</option>
            <option value="voli" <?php if ($cabang_olahraga == 'voli') echo 'selected'; ?>>Voli</option>
            <option value="bulutangkis" <?php if ($cabang_olahraga == 'bulutangkis') echo 'selected'; ?>>Bulutangkis</option>
        </select>

        <label>Status</label>
        <div class="radio-group">
            <input type="radio" id="pelajar" name="status" value="pelajar" <?php if ($status == 'pelajar') echo 'checked'; ?>>
            <label for="pelajar">Pelajar</label>

            <input type="radio" id="mahasiswa" name="status" value="mahasiswa" <?php if ($status == 'mahasiswa') echo 'checked'; ?>>
            <label for="mahasiswa">Mahasiswa</label>

            <input type="radio" id="pekerja" name="status" value="pekerja" <?php if ($status == 'pekerja') echo 'checked'; ?>>
            <label for="pekerja">Pekerja</label>
        </div>

        <label for="pesan">Pesan</label>
        <textarea id="pesan" name="pesan" required><?php echo $pesan; ?></textarea>

        <button type="submit">Update Pengguna</button>
    </form>
</div>

<footer>
        <p>&copy; 2024 Created By | Anindia Atikah Putri.</p>
    </footer>

</body>
</html>
