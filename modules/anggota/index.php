<?php
include __DIR__ . '/../../config/database.php';

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$search = $_GET['search'] ?? "";

$query = "SELECT * FROM anggota 
          WHERE nama LIKE '%$search%' 
          OR email LIKE '%$search%' 
          OR telepon LIKE '%$search%'
          LIMIT $start, $limit";

$result = mysqli_query($conn, $query);

// count
$count = mysqli_query($conn, "SELECT COUNT(*) as total FROM anggota");
$total = mysqli_fetch_assoc($count)['total'];
$pages = ceil($total / $limit);
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Anggota</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">

<h2 class="mb-3">Data Anggota</h2>

<form method="GET" class="mb-3 d-flex gap-2">
    <input type="text" name="search" class="form-control" placeholder="Cari..." value="<?= $search ?>">
    <button class="btn btn-primary">Cari</button>
</form>

<a href="create.php" class="btn btn-success mb-3">+ Tambah Anggota</a>

<table class="table table-bordered table-striped">
<tr>
    <th>Foto</th>
    <th>Kode</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Telepon</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td>
    <?php if(!empty($row['foto'])) { ?>
     <img src="uploads/<?= $row['foto'] ?>" width="60">
    <?php } else { ?>
    <span>Tidak ada</span>
<?php } ?>
    </td>
    <td><?= $row['kode_anggota'] ?></td>
    <td><?= $row['nama'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['telepon'] ?></td>
    <td>
        <?php if($row['status']=="Aktif"){ ?>
            <span class="badge bg-success">Aktif</span>
        <?php } else { ?>
            <span class="badge bg-danger">Nonaktif</span>
        <?php } ?>
    </td>
    <td>
        <a href="edit.php?id=<?= $row['id_anggota'] ?>" class="btn btn-warning btn-sm">Edit</a>
        <a href="delete.php?id=<?= $row['id_anggota'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
    </td>
</tr>
<?php } ?>
</table>

<!-- pagination -->
<?php for($i=1; $i<=$pages; $i++) { ?>
    <a href="?page=<?= $i ?>&search=<?= $search ?>" class="btn btn-outline-primary btn-sm"><?= $i ?></a>
<?php } ?>

</div>
</body>
</html>