<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../crud/style.css">
    <title>CRUD System</title>
</head>
<body>
    <div class="container">

        <a href="../dashboard/main_menu.php" class="btn-back">Kembali</a>

        <!-- Judul halaman -->
        <h3 style="text-align: center; color: #003366;">Daftar Peserta</h3>
        
        <!-- Form Pencarian -->
        <div class="search-container" style="display: flex; justify-content: center; margin-bottom: 20px;">
            <form method="GET" action="index.php">
                <input type="text" name="search" placeholder="Cari nama pengguna..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" style="padding: 5px; border: 2px solid #003366;">
                <button type="submit" class="btn btn-primary" style="background-color: #003366; color: white;">Cari</button>
                <a href="index.php" class="btn btn-success" style="background-color: #4CAF50; color: white;">Reset</a>
            </form>
        </div>
        
        <!-- Tombol Tambah Pengguna Baru -->
        <div style="text-align: center; margin-bottom: 15px;">
            <a href="../dashboard/form-pendaftaran.php" class="btn btn-success" style="background-color: #4CAF50; color: white; padding: 8px 12px; text-decoration: none; border-radius: 5px;">Tambah Pengguna Baru</a>
        </div>
        
        <!-- Tabel Daftar Pengguna -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Tanggal Pendaftaran</th>
                        <th>Umur</th>
                        <th>Jenis Kelamin</th>
                        <th>Cabang Olahraga</th>
                        <th>Status</th>
                        <th>Pesan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Koneksi ke database
                    $conn = new mysqli("localhost", "root", "", "crud_db");
                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    // Tentukan jumlah data per halaman
                    $limit = 10;

                    // Menentukan halaman saat ini
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($page - 1) * $limit;

                    // Mengambil data dari tabel dengan pencarian jika ada
                    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                    $sql = $search ? "SELECT * FROM pendaftar WHERE name LIKE '%$search%' LIMIT $limit OFFSET $offset" : "SELECT * FROM pendaftar LIMIT $limit OFFSET $offset";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . htmlspecialchars($row["id"]) . "</td>
                                <td>" . htmlspecialchars($row["name"]) . "</td>
                                <td>" . htmlspecialchars($row["email"]) . "</td>
                                <td>" . htmlspecialchars($row["phone"]) . "</td>
                                <td>" . htmlspecialchars($row["tanggal_pendaftaran"]) . "</td>
                                <td>" . htmlspecialchars($row["umur"]) . "</td>
                                <td>" . htmlspecialchars($row["jenis_kelamin"]) . "</td>
                                <td>" . htmlspecialchars($row["cabang_olahraga"]) . "</td>
                                <td>" . htmlspecialchars($row["status"]) . "</td>
                                <td>" . htmlspecialchars($row["pesan"]) . "</td>
                                <td>
                                    <a href='update.php?id=" . urlencode($row["id"]) . "' class='btn btn-edit' style='background-color: #6495ED; color: white; text-decoration: none; padding: 5px 8px;'>Edit</a>
                                    <a href='delete.php?id=" . urlencode($row["id"]) . "' class='btn btn-delete' style='background-color: #FF6B6B; color: white; text-decoration: none; padding: 5px 8px;' onclick=\"return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')\">Hapus</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align: center;'>Tidak ada data</td></tr>";
                    }

                    // Menghitung total data untuk pagination
                    $sqlCount = $search ? "SELECT COUNT(*) AS total FROM pendaftar WHERE name LIKE '%$search%'" : "SELECT COUNT(*) AS total FROM pendaftar";
                    $resultCount = $conn->query($sqlCount);
                    $totalData = $resultCount->fetch_assoc()['total'];
                    $totalPages = ceil($totalData / $limit);

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-container" style="text-align: center;">
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="index.php?page=<?php echo $page - 1; ?>&search=<?php echo htmlspecialchars($search); ?>" class="pagination-btn previous">Sebelumnya</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="index.php?page=<?php echo $i; ?>&search=<?php echo htmlspecialchars($search); ?>" class="pagination-btn <?php echo $i == $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="index.php?page=<?php echo $page + 1; ?>&search=<?php echo htmlspecialchars($search); ?>" class="pagination-btn next">Berikutnya</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
