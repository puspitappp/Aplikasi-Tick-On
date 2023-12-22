<!-- edit.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Tiket Konser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 1000px
        }

        .card {
            margin-top: 10px
        }
    </style>
</head>

<body>
    <br><br><br><br>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Edit Data Tiket Konser
            </div>
            <div class="card-body">
                <?php
                include 'db_connection.php';

                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                    $id = $_GET['id'];

                    // Retrieve data from the database based on the ID
                    $sql_select = "SELECT * FROM tiket_konser WHERE id = $id";
                    $result = mysqli_query($koneksi, $sql_select);

                    if ($result) {
                        $data = mysqli_fetch_assoc($result);

                        // Assign data to variables
                        $nama = $data['nama'];
                        $tanggal_lahir = $data['tanggal_lahir'];
                        $jenis_tiket = $data['jenis_tiket'];
                        $harga_tiket = $data['harga_tiket'];
                        $jumlah_tiket = $data['jumlah_tiket'];
                        $total_harga = $data['total_harga'];
                    } else {
                        echo "Error: " . $sql_select . "<br>" . mysqli_error($koneksi);
                        exit;
                    }
                }
                ?>
                <form action="update.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jenis_tiket" class="col-sm-2 col-form-label">Jenis Tiket</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis_tiket" id="jenis_tiket">
                                <option value="Premium_Tribune" <?php echo ($jenis_tiket == "Premium_Tribune") ? "selected" : ""; ?>>Premium Tribune</option>
                                <option value="Festival" <?php echo ($jenis_tiket == "Festival") ? "selected" : ""; ?>>Festival</option>
                                <option value="Tribune_1" <?php echo ($jenis_tiket == "Tribune_1") ? "selected" : ""; ?>>Tribune 1</option>
                                <option value="Tribune_2" <?php echo ($jenis_tiket == "Tribune_2") ? "selected" : ""; ?>>Tribune 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="harga_tiket" class="col-sm-2 col-form-label">Harga Tiket</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="harga_tiket" name="harga_tiket" value="<?php echo $harga_tiket; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jumlah_tiket" class="col-sm-2 col-form-label">Jumlah Tiket</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jumlah_tiket" name="jumlah_tiket" value="<?php echo $jumlah_tiket; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="total_harga" class="col-sm-2 col-form-label">Total Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="total_harga" name="total_harga" value="<?php echo $total_harga; ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Perubahan" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
