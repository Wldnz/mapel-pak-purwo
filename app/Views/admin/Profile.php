    <style>
        body{
            min-width: none;
        }
    </style>
    
    <main class="main-update">
        <?php

        if (count($account) == 0) { ?>
            <div class="container container-v2">
                <h2>Tidak Dapat Menemunkan Data Pengguna...</h2>
            </div>
        <?php } else { ?>

            <div class="container">
                <h2>Data Umum - <?= $account["name"] ?>
                </h2>
                <form action="update-akun" class="general-data">
                    <div class="fieldInput">
                        <label for="name">Nama: </label>
                        <input type="text" name="name" id="name" placeholder="Masukkan nama.."
                            value="<?= $account["name"] ?>"
                            readonly>
                    </div>
                    <div class="fieldInput">
                        <label for="fullname">Nama Lengkap: </label>
                        <input type="text" name="fullname" id="fullname" placeholder="Masukkan nama Lengkap.."
                            value="<?= $account["fullname"] ?>"
                            readonly>
                    </div>
                    <div class="fieldInput">
                        <label for="email">Email: </label>
                        <input type="email" name="email" id="email" placeholder="Masukkan email.."
                            value="<?= $account["email"] ?>" readonly>
                    </div>
                    <div class="fieldInput">
                        <label for="phone">Nomor Telephone: </label>
                        <input type="text" name="phone" placeholder="Masukkan nomor telepon.."
                            value="<?= $account["phone"] ?>"
                            readonly min="11" max="12">
                    </div>
                    <div class="fieldInput">
                        <label for="role">Role: </label>
                        <select name="role" id="role" disabled>
                            <?php  
                                $account = session()->get("account");
                                if($account["role"] == "admin"){ ?>
                                    <option <?= $account["role"] == "staff" ? "value='staff' selected" : "value='staff'" ?>>Pegawai</option>
                                    <option <?= $account["role"] == "admin" ? "value='admin' selected" : "value='admin'" ?>>Admin</option>
                                    <?php } ?> 
                                <option <?= $account["role"] == "user" ? "value='user' selected" : "value='user'" ?> value="user">Anggota</option>
                        </select>
                    </div>
                    <div class="fieldInput">
                        <label for="status">Status: </label>
                        <select name="status" id="status" disabled>
                            <?php
                            if ($account["status"] == "verified") { ?>
                                <option <?= $account["status"] == "verified" ? "value='verified' selected" : "value='verified'" ?>>Terverifikasi</option>
                                <option <?= $account["status"] == "unverified" ? "value='unverified' selected" : "value='unverified'" ?>>Belum Terverikasi</option>
                                <option <?= $account["status"] == "inactive" ? "value='inactive' selected" : "value='inactive'" ?>>Tidak Aktif</option>
                                <option <?= $account["status"] == "deleted" ? "value='deleted' selected" : "value='deleted'" ?>>Dihapus</option>
                            <?php } else { ?>
                                <option <?= $account["status"] == "unverified" ? "value='unverified' selected" : "value='unverified'" ?>>Belum Terverikasi</option>
                                <option <?= $account["status"] == "inactive" ? "value='inactive' selected" : "value='inactive'" ?>>Tidak Aktif</option>
                                <option <?= $account["status"] == "deleted" ? "value='deleted' selected" : "value='deleted'" ?>>Dihapus</option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </form>
            </div>

            <div class="container">
                <?php
                if (count($personalAccount) == 0) {
                    echo "<h2>Pengguna Belum Melakukan Verifikasi Akun</h2>";
                } else { ?>
                    <h2>Data Pribadi - <?= $account["name"] ?></h2>
                    <div class="general-data">
                        <div class="fieldInput">
                            <label for="address">Alamat: </label>
                            <input type="text" name="address" id="address" placeholder="Masukkan alamat.."
                                value="<?= $personalAccount["address"] ?>"
                                required readonly>
                        </div>
                        <div class="fieldInput">
                            <label for="role">Tipe Identifikasi: </label>
                            <select name="role" id="role" disabled>
                                <option value="Kartu Pelajar">Kartu Pelajar</option>
                                <option value="KTP">KTP</option>
                                <option value="KIP">KIP</option>
                            </select>
                        </div>
                        <div class="fieldInput">
                            <label for="status">Status Verifikasi: </label>
                            <select name="status" id="status" disabled>
                                <option <?= $personalAccount["status"] == "wait" ? "value='wait' selected" : "value='wait'" ?>>Proses</option>
                                <option <?= $personalAccount["status"] == "success" ? "value='success' selected" : "value='success'" ?>>Berhasil</option>
                                <option <?= $personalAccount["status"] == "fail" ? "value='fail' selected" : "value='fail'" ?>>Gagal</option>
                            </select>
                        </div>
                        <img
                            src="<?= $personalAccount["identify_image"] ?>" alt="identifikasi-gambar"
                            class="identify-image">
                        <button class="btn" onclick="history.back()">Kembali</button>
                        <div class="modal-image" id="modal-image">
                            <div class="content">
                                <img
                                    src="<?= $personalAccount["identify_image"] ?>" alt="identifikasi-gambar"
                                    class="identify-image">
                            </div>
                        </div>
                    </div>
            </div>
            </div>
        <?php }
        ?>

    </main>
    <?php  } ?>

    <?php

    if (count($personalAccount) != 0) { ?>
        <script>
            const modal_image = document.getElementById("modal-image");
            const showModal = document.querySelector(".identify-image");
            modal_image.addEventListener("click", (e) => {
                modal_image.style.display = "none";
            });
            showModal.addEventListener("click", (e) => {
                modal_image.style.display = "block";
            });
        </script>
    <?php } ?>