<?php
include __DIR__ . '/../../config/database.php';

if(isset($_POST['simpan'])){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $pekerjaan = $_POST['pekerjaan'];

    $foto = "";
    if($_FILES['foto']['name']){
        $foto = time().$_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/".$foto);
    }

    mysqli_query($conn, "INSERT INTO anggota 
    (kode_anggota,nama,email,telepon,alamat,tanggal_lahir,jenis_kelamin,pekerjaan,tanggal_daftar,status,foto)
    VALUES ('$kode','$nama','$email','$telepon','$alamat','$tanggal_lahir','$jenis_kelamin','$pekerjaan',CURDATE(),'Aktif','$foto')");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Anggota</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">

<h2>Tambah Anggota</h2>

<form method="POST" enctype="multipart/form-data" class="card p-4 shadow">

<input type="text" name="kode" placeholder="Kode" class="form-control mb-2">
<input type="text" name="nama" placeholder="Nama" class="form-control mb-2">
<input type="email" name="email" placeholder="Email" class="form-control mb-2">
<input type="text" name="telepon" placeholder="Telepon" class="form-control mb-2">
<textarea name="alamat" placeholder="Alamat" class="form-control mb-2"></textarea>
<input type="date" name="tanggal_lahir" class="form-control mb-2">

<select name="jenis_kelamin" class="form-control mb-2">
<option>Laki-laki</option>
<option>Perempuan</option>
</select>

<input type="text" name="pekerjaan" placeholder="Pekerjaan" class="form-control mb-2">
<input type="file" name="foto" class="form-control mb-2">

<button name="simpan" class="btn btn-success">Simpan</button>
</form>

</div>
</body>
</html>