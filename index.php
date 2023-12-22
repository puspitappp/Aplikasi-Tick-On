<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tick On - Pesan Tiket Konser Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 1000px
        }

        .card {
            margin-top: 10px
        }

        /* CSS untuk bagian Venue */
        #venue {
            text-align: center;
            margin-top: 50px;
        }

        #venue .wrapper {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        #venue img {
            width: 70%;
        }

        #venue .kolom {
            margin-left: 20px;
            max-width: 400px;
        }
    </style>
</head>

<body>
    <br><br><br><br>
    <div class="mx-auto">
        <h1 class="text-center">Tick On - Pesan Tiket Konser Online</h1>
        <p class="text-center">Tick On adalah platform inovatif yang memudahkan pengguna untuk meraih pengalaman konser yang tak terlupakan dengan mudah dan cepat. Dengan antarmuka yang ramah pengguna dan fitur canggih, Tick On menjadi teman setia pecinta musik dalam menjelajahi dunia konser secara online.</p>

        <!-- Bagian Venue -->
        <section id="venue">
            <div class="wrapper">
                <img src="https://www.warnaplus.com/wp-content/uploads/2020/01/OOR-Layout-New.jpg" alt="Venue Layout" />
                <div class="kolom">
                    <h2>VENUE</h2>
                    <p class="deskripsi">Booking Seat mu Sekarang!!!</p>
                    <p>Syarat dan Ketentuan:</p>
                    <p>- Tiket harus ditukarkan H-1 konser akan dilaksanakan.</p>
                    <p>- Nanti akan mendapatkan gelang konser untuk masuk ke dalam venue.</p>
                    <p>- Apabila H-1 tidak datang untuk menukarkan tiket, maka akan hangus dan tidak bisa untuk masuk ke dalam venue pada hari konser dimulai.</p>
                </div>
            </div>
        </section>
        <div class="card">
            <div class="card-header">
                Lakukan Pemesanan Tiket Konser Disini
            </div>
            <div class="card-body">
            <?php
            include 'db_connection.php';
                if (isset($error) && $error) {
                    echoAlert('danger', $error);
                    redirectToIndex();
                }

                if (isset($sukses) && $sukses) {
                    echoAlert('success', $sukses);
                    redirectToIndex();
                }

                function echoAlert($type, $message)
                {
                    echo "<div class='alert alert-$type' role='alert'>$message</div>";
                }

                function redirectToIndex()
                {
                    header("refresh:5;url=index.php");
                    exit;
                }
                
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Ambil dan validasi data dari formulir
                    $nama = $_POST['nama'];
                    $tanggal_lahir = $_POST['tanggal_lahir'];
                    $jenis_tiket = $_POST['jenis_tiket'];
                    $harga_tiket = $_POST['harga_tiket'];
                    $jumlah_tiket = $_POST['jumlah_tiket'];
                
                    // Lakukan validasi data jika diperlukan
                    if (empty($nama) || empty($tanggal_lahir) || empty($jenis_tiket) || empty($harga_tiket) || empty($jumlah_tiket)) {
                        $error = "Mohon lengkapi semua kolom.";
                    } else {
                        // Hitung total harga
                        $total_harga = $harga_tiket * $jumlah_tiket;
                
                        // Simpan data ke database
                        $sql_insert = "INSERT INTO tiket_konser (nama, tanggal_lahir, jenis_tiket, harga_tiket, jumlah_tiket, total_harga) VALUES ('$nama', '$tanggal_lahir', '$jenis_tiket', $harga_tiket, $jumlah_tiket, $total_harga)";
                
                        if (mysqli_query($koneksi, $sql_insert)) {
                            $sukses = "Data berhasil disimpan!";
                        } else {
                            $error = "Error: " . $sql_insert . "<br>" . mysqli_error($koneksi);
                        }
                    }
                }                
            ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo isset($nama) ? $nama : ''; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo isset($tanggal_lahir) ? $tanggal_lahir : ''; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jenis_tiket" class="col-sm-2 col-form-label">Jenis Tiket</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis_tiket" id="jenis_tiket">
                                <option value="">- Pilih Jenis Tiket -</option>
                                <option value="Premium_Tribune" <?php echo (isset($jenis_tiket) && $jenis_tiket == "Premium_Tribune") ? "selected" : ""; ?>>Premium Tribune</option>
                                <option value="Festival" <?php echo (isset($jenis_tiket) && $jenis_tiket == "Festival") ? "selected" : ""; ?>>Festival</option>
                                <option value="Tribune_1" <?php echo (isset($jenis_tiket) && $jenis_tiket == "Tribune_1") ? "selected" : ""; ?>>Tribune 1</option>
                                <option value="Tribune_2" <?php echo (isset($jenis_tiket) && $jenis_tiket == "Tribune_2") ? "selected" : ""; ?>>Tribune 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="harga_tiket" class="col-sm-2 col-form-label">Harga Tiket</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="harga_tiket" name="harga_tiket" value="<?php echo isset($harga_tiket) ? $harga_tiket : ''; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="jumlah_tiket" class="col-sm-2 col-form-label">Jumlah Tiket</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="jumlah_tiket" name="jumlah_tiket" value="<?php echo isset($jumlah_tiket) ? $jumlah_tiket : ''; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="total_harga" class="col-sm-2 col-form-label">Total Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="total_harga" name="total_harga" value="<?php echo isset($total_harga) ? $total_harga : ''; ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-white bg-black">
                Lihat Data Anda Disini
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">jenis Tiket</th>
                            <th scope="col">Harga Tiket</th>
                            <th scope="col">Jumlah Tiket</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM tiket_konser ORDER BY id DESC";
                        $q2 = mysqli_query($koneksi, $sql2);
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id = $r2['id'];
                            $nama = $r2['nama'];
                            $tanggal_lahir = $r2['tanggal_lahir'];
                            $jenis_tiket = $r2['jenis_tiket'];
                            $harga_tiket = $r2['harga_tiket'];
                            $jumlah_tiket = $r2['jumlah_tiket'];
                            $total_harga = $r2['total_harga'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nama ?></td>
                                <td scope="row"><?php echo $tanggal_lahir ?></td>
                                <td scope="row"><?php echo $jenis_tiket ?></td>
                                <td scope="row"><?php echo $harga_tiket ?></td>
                                <td scope="row"><?php echo $jumlah_tiket ?></td>
                                <td scope="row"><?php echo $total_harga ?></td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-secondary">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Yakin mau hapus data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>