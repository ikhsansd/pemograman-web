<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_user");
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>
<div class="col-lg-9  mt-2">
    <div class="card">
        <div class="card-header">
            Halaman User
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">Tambah
                        User</button>
                </div>
            </div>
            <!-- Modal tambah user baru -->
            <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_user.php"
                                method="POST">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="Your Name" name="name" required>
                                            <label for="floatingInput">Nama</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nama.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control" id="floatingInput"
                                                placeholder="name@example.com" name="username" required>
                                            <label for="floatingInput">Username</label>
                                            <div class="invalid-feedback">
                                                Masukkan Username.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" name="level"
                                                required>
                                                <option selected hidden valaue="">Pilih level user</option>
                                                <option value="1">Pemilik/admin</option>
                                                <option value="2">Kasir</option>
                                                <option value="3">Siswa</option>
                                                <option value="4">Pengemudi</option>
                                            </select>
                                            <label for="floatingInput">Level user</label>
                                            <div class="invalid-feedback">
                                                Pilih level user.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="08xxxxx" name="nohp">
                                            <label for="floatingInput">No Hp</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" id="floatingInput"
                                                    placeholder="Password" disabled value="12345" name="password">
                                                <label for="floatingpassword">Password</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" id="" style="height:100px" name="alamat"></textarea>
                                    <label for="floatinginput">Alamat</label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_user_validate"
                                        value="12345">Save changes</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!--Akhir Modal tambah user baru -->
            <?php
            foreach ($result as $row) {
                ?>
            <!-- Modal edit -->
            <div class="modal fade" id="ModalEdit<?php echo $row['id']?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_edit_user.php"
                                method="POST">
                                <input type="hidden" value="<?php echo $row['id']?>" name="id">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="Your Name" name="name" required
                                                value="<?php echo $row['nama']?>">
                                            <label for="floatingInput">Nama</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nama.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input <?php echo  ($row['username'] == $_SESSION['username_ojesis']) ? 'disabled' : '' ; ?> type="email" class="form-control" id="floatingInput"
                                                placeholder="name@example.com" name="username" required
                                                value="<?php echo $row['username']?>">
                                            <label for="floatingInput">Username</label>
                                            <div class="invalid-feedback">
                                                Masukkan Username.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" aria-label="Default select example" required
                                                name="level" id="">
                                                <?php
                                                $data = array("Pemilik/Admin", "Kasir", "Siswa", "Pengemudi");
                                                foreach($data as $key => $value){
                                                    if($row['level'] == $key+1){
                                                        echo "<option selected value=".($key+1).">$value</option>";
                                                    }else{
                                                        echo "<option value=".($key+1).">$value</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingInput">Level user</label>
                                            <div class="invalid-feedback">
                                                Pilih level user.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="08xxxxx" name="nohp" value="<?php echo $row['nohp']?>">
                                            <label for="floatingInput">No Hp</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" id="" style="height:100px"
                                        name="alamat"><?php echo $row['alamat']?></textarea>
                                    <label for="floatinginput">Alamat</label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="input_user_validate"
                                        value="12345">Save changes</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Akhir Modal edit -->

            <!-- Modal delete -->
            <div class="modal fade" id="ModalDelete<?php echo $row['id']?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_delete_user.php"
                                method="POST">
                                <input type="hidden" value="<?php echo $row['id']?>" name="id">
                                <div class="col-lg-12">
                                    <?php 
                        if($row['username'] == $_SESSION['username_ojesis']){
                            echo "<div class='alert alert-danger'>Anda tidak dapat menghapus akun sendiri</div>";
                        } else {
                            echo "Apakah anda yakin ingin menghapus user <b>{$row['username']}</b>?";
                        }
                        ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger" name="input_user_validate"
                                        value="12345" <?php echo  ($row['username'] == $_SESSION['username_ojesis']) ? 'disabled' : '' ; ?>>Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal delete -->





            <!-- Modal view -->
            <div class="modal fade" id="ModalView<?php echo $row['id']?>" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="needs-validation" novalidate action="proses/proses_input_user.php"
                                method="POST">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input disabled type="text" class="form-control" id="floatingInput"
                                                placeholder="Your Name" name="name" value="<?php echo $row['nama']?>">
                                            <label for="floatingInput">Nama</label>
                                            <div class="invalid-feedback">
                                                Masukkan Nama.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-floating mb-3">
                                            <input disabled type="email" class="form-control" id="floatingInput"
                                                placeholder="name@example.com" name="username"
                                                value="<?php echo $row['username']?>">
                                            <label for="floatingInput">Username</label>
                                            <div class="invalid-feedback">
                                                Masukkan Username.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <select disabled class="form-select" aria-label="Default select example"
                                                required name="level" id="">
                                                <?php
                                                $data = array("Pemilik/Admin", "Kasir", "Siswa", "Pengemudi");
                                                foreach($data as $key => $value){
                                                    if($row['level'] == $key+1){
                                                        echo "<option selected value='$key'>$value</option>";
                                                    }else{
                                                        echo "<option value='$key'>$value</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <label for="floatingInput">Level user</label>
                                            <div class="invalid-feedback">
                                                Pilih level user.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="form-floating mb-3">
                                            <input disabled type="number" class="form-control" id="floatingInput"
                                                placeholder="08xxxxx" name="nohp" value="<?php echo $row['nohp']?>">
                                            <label for="floatingInput">No Hp</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-floating">
                                    <textarea disabled class="form-control" id="" style="height:100px"
                                        name="alamat"><?php echo $row['alamat']?></textarea>
                                    <label for="floatinginput">Alamat</label>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>

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
            }else{

            
            ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Username</th>
                            <th scope="col">Level</th>
                            <th scope="col">No Hp</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no =1;
                        foreach ($result as $row) {
                            ?>
                        <tr>
                            <th scope="row"><?php echo $no++?></th>
                            <td><?php echo $row['nama'] ?></td>
                            <td><?php echo $row['username'] ?></td>
                            <td><?php 
                                                if($row['level'] ==1){
                                                    echo "Admin";
                                                }elseif($row['level'] ==2){
                                                    echo "Kasir";
                                                }elseif($row['level'] ==3){
                                                    echo "Siswa";
                                                }elseif($row['level'] ==4){
                                                    echo "Pengemudi";
                                                }
                                                
                                                ?></td>
                            <td><?php echo $row['nohp'] ?></td>
                            <td class="d-flex">
                                <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                    data-bs-target="#ModalView<?php echo $row['id']?>"><i
                                        class="bi bi-eye"></i></button>
                                <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal"
                                    data-bs-target="#ModalEdit<?php echo $row['id']?>"><i
                                        class="bi bi-pencil-square"></i></i></button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#ModalDelete<?php echo $row['id']?>"><i
                                        class="bi bi-trash3"></i></i></button>
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

