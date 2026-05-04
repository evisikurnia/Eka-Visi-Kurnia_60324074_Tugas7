<?php
include __DIR__ . '/../../config/database.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM anggota WHERE id_anggota=$id"));

if(isset($_POST['update'])){
    $nama = $_POST['nama'];
    $email = $_POST['email'];

    mysqli_query($conn, "UPDATE anggota SET 
    nama='$nama',
    email='$email'
    WHERE id_anggota=$id");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Anggota</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">

<h2>Edit Anggota</h2>

<form method="POST" class="card p-4 shadow">

<input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control mb-2">
<input type="email" name="email" value="<?= $data['email'] ?>" class="form-control mb-2">

<button name="update" class="btn btn-warning">Update</button>
</form>

</div>
</body>
</html>