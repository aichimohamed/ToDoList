<?php

if(isset($_GET['id'])){
    // tangkap id dari method get
    $id = $_GET['id'];

    // Buat koneksi dengan MySQL
    $conn = mysqli_connect("localhost","root","","seal_todolist");

    // Cek koneksi
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }else{
        echo 'Koneksi berhasil';
    }

    // buat query select semua todo list
    $query = "DELETE FROM task WHERE id='$id' ";

    // jalankan query
    $sql = mysqli_query($conn,$query);
    mysqli_close($conn);

    if ($sql){
        echo "data berhasil dihapus";
        header("Refresh:0; url=index.php");
    } else {
        echo "gagal hapus " .mysqli_error($conn);
    }
      
}


?>