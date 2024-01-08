<?php

if(isset($_GET['id'])){
    // tangkap id dari method get
    $id = $_GET['id'];

    // Buat koneksi dengan MySQL
    $conn = mysqli_connect("localhost","root","","seal_todolist");

    // cek koneksi
    if (mysqli_connect_errno()){
        echo "Koneksi Gagal";
        exit();
    }else{
        echo 'Koneksi berhasil';
    }
}

// buat query select semua todo list
$query = "UPDATE task SET status=1 WHERE id='$id' ";

// jalankan query
$sql = mysqli_query($conn,$query);
mysqli_close($conn);

if ($sql){
    echo "data berhasil diupdate";
    header("Refresh:0; url=index.php");
} else {
    echo "gagal update " .mysqli_error($conn);
}
  


?>