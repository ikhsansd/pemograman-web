<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_layanan");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>
<div class="col-lg-9 mt-2">
    <div class="card">
        <div class="card-header">
            Halaman User
        </div>
        <div class="card-body">
            <?php
            foreach ($result as $row) {
            ?>
            <!-- Modal view -->
            <div class="modal fade" id="ModalView<?php echo $row['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input disabled type="text" class="form-control" id="floatingInput" placeholder="Nama Pengemudi" value="<?php echo $row['nama_pengemudi']?>">
                                            <label for="floatingInput">Nama Pengemudi</label>
                                            <div class="invalid-feedback">Masukkan Nama Pengemudi.</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input disabled type="text" class="form-control" id="floatingLayanan" placeholder="Layanan" value="<?php echo $row['layanan']?>">
                                            <label for="floatingLayanan">Layanan</label>
                                            <div class="invalid-feedback">Masukkan Layanan.</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input disabled type="text" class="form-control" id="floatingHarga" placeholder="Harga" value="<?php echo $row['harga']?>">
                                            <label for="floatingHarga">Harga</label>
                                            <div class="invalid-feedback">Masukkan Harga.</div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <img src="assets/img/<?php echo $row['motor_ojek'] ?>" class="img-thumbnail" alt="Motor Ojek">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal view -->
            <?php
            }
            if(empty($result)){
                echo "Data user tidak ada";
            } else {
            ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-nowrap">
                            <th scope="col">No</th>
                            <th scope="col">Nama Pengemudi</th>
                            <th scope="col">Motor Ojek</th>
                            <th scope="col">Layanan</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total Biaya</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($result as $row) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $no++?></th>
                            <td><?php echo $row['nama_pengemudi'] ?></td>
                            <td>
                                <div style="width: 100px">
                                    <img src="assets/img/<?php echo $row['motor_ojek'] ?>" class="img-thumbnail" alt="Motor Ojek">
                                </div>
                            </td>
                            <td><?php echo $row['layanan'] ?></td>
                            <td><?php echo $row['harga'] ?></td>
                            <td><?php echo $row['total_biaya'] ?></td>
                            <td><?php echo $row['status'] ?></td>
                            <td>
                                <div class="d-flex">
                                    <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalView<?php echo $row['id']?>">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
