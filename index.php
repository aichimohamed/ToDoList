<?php
  // Buat koneksi dengan MySQL
  $conn = mysqli_connect("localhost","root","","seal_todolist");

  // cek koneksi
  if (mysqli_connect_errno()) {
      echo "Koneksi Gagal";
      exit();
  }else{
    //echo 'Koneksi berhasil';
  }

  // buat query select semua to do list
  $query = "SELECT * FROM task";

  // baca data hasil query 
  $items = [];
  if ($result = mysqli_query($conn, $query)){
    // ambil data satu per satu
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }

    //var_dump($items);

    mysqli_free_result($result);
  }

  // section insert item 
  // tangkap data item dari form method post
  if(isset($_POST['item'])){
    $item = $_POST['item'];

    // buat query untuk memasukkan item
    $query = "INSERT INTO task (item) values ('$item')";

    // jalankan query
    if (mysqli_query($conn,$query)){
         echo "data baru berhasil disimpan";
         header("Refresh:0");
    }else{
    echo "Error " .mysqli_error($conn);
    }
}

     // tutup koneksi
     mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo List</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

<section class="vh-100" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-lg-9 col-xl-7">
        <div class="card rounded-3">
          <div class="card-body p-4">

            <h4 class="text-center my-3 pb-3">To Do App</h4>

            <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" method="post">
              <div class="col-12">
                <div class="form-outline">

                  <input type="text" id="form1" class="form-control" name="item" placeholder="Enter a task here">
               
                </div>
              </div>

              <div class="col-12">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>

            <table class="table mb-4">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">To do item</th>
                  <th scope="col">Status</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                   <?php foreach ($items as $key=>$value) : ?>
                    <tr>
                     <th scope="row"><?php echo $key+1; ?></th>
                     <td><?php echo $value['item'] ;?></td>
                     <td><?php echo ($value['status'] == 0) ? "in progress" : "finished"; ?> </td>
                     <td>
                         <a href="<?php echo 'delete.php?id='.$value['id']; ?>" type="submit" class="btn btn-danger">Delete</a>
                         <a href="<?php echo 'update.php?id='.$value['id']; ?>" type="submit" class="btn btn-success">Finished</a>
                     </td>
                   </tr>
                   <?php endforeach; ?>
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>