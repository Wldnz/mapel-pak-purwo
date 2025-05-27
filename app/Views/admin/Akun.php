<main>
    <div class="container">
        <h2>Mangement Akun Pengguna</h2>
        <form class="find">
            <select name="status" id="">
                <option value="">Semua Status</option>
                <option <?php echo $status == "verified" ? "selected value='verified'" : "value='verified'" ?>>Terverifikasi</option>
                <option <?php echo $status == "unverified" ? "selected value='unverified'" : "value='unverified'" ?>>Belum Terverifikasi</option>
                <option <?php echo $status == "inactive" ? "selected value='inactive'" : "value='inactive'" ?>>Tidak Aktif</option>
            </select>
            <div>
                <input type="text" name="name" id="" placeholder="Cari nama pengguna" value="<?= $name ?>">
                <button type="submit">
                    <img src="<?= icons ?>/search.svg" alt="search">
                </button>
            </div>
        </form>
        <table>
            <tr>
                <th>Nama</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Status</th>
                <th>Action</th>
                <th class="center">
                    <button type="button" class="add-book" id="add-akun">
                        <img src="<?= icons ?>/add.svg" alt="search">
                    </button>
                </th>
            </tr>
            <?php
            if (isset($accounts) && !empty($accounts)) {
                foreach ($accounts as $account) { ?>
                    <tr>
                        <td><?= $account["name"] ?></td>
                        <td><?= $account["fullname"] ?></td>
                        <td><?= $account["email"] ?></td>
                        <td><?= $account["phone"] ?></td>
                        <td><?= $account["role"] ?></td>
                        <td><span class='<?= $account["status"] == "verified" ? "verified" : "not-verified" ?>'><?= $account["status"] == "verified" ? "Terverifikasi" : "Belum Terverifikasi" ?></span></td>
                        <td colspan="2"><a href='<?= base_url("admin/management-akun?id=" . $account["id"]) ?>'>Lihat Detail</a></td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="8">Tidak ada data...</td>
                </tr>
            <?php }
            ?>
        </table>
    </div>
    </div>
    <div class="modal" id="modal-add-book">
        <form action="create-akun" id="create-akun" method="post">
            <div class="header-form">
                <h2>Buat Akun </h2>
                <button type="button" class="btn-close" id="btn-close">Close</button>
            </div>
            <p class="error-message" id="error-message" style="display: none;">Pastikan Password Dan Konfirmasi Sama</p>
            <div class="fieldInput2">
                <label for="name">Nama</label>
                <input type="text" name="name" id="name" minlength="3" required >
            </div>
            <div class="fieldInput2">
                <label for="fullname">Nama Lengakap</label>
                <input type="text" name="fullname" id="fullname" minlength="3" required >
            </div>
            <div class="fieldInput2">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" minlength="3" required >
            </div>
            <div class="fieldInput2">
                <label for="phone">Phone</label>
                <input type="text" inputmode="numeric" name="phone" id="phone" minlength="3" required >
            </div>
            <div class="fieldInput2">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" minlength="8" required >
            </div>
            <div class="fieldInput2">
                <label for="confirm-password">Konfirmasi Password</label>
                <input type="password" name="confirm-password" id="confirm-password" minlength="8" required >
            </div>
            <button type="submit" class="btn">Buat Akun</button>
        </form>
    </div>
</main>

<script defer>
    const btn_close = document.getElementById("btn-close");
    const modal = document.getElementById("modal-add-book");
    const error_msg = document.getElementById("error-message");
    const formContainer = document.getElementById("create-akun");
    let isChange = false;
    btn_close.addEventListener("click", () => {
        if (!isChange) {
            modal.style.display = "none";   
        }else if(confirm("anda yakin ingin menutup form?")){
            modal.style.display = "none";   
        }
    });
    document.getElementById("add-akun").addEventListener("click", () => {
        modal.style.display = "flex";
    });
    formContainer.addEventListener("change",(e) => isChange=true);
    formContainer.addEventListener("submit",(e) => submitForm(e));
    function submitForm(e){
        if(document.getElementById("confirm-password").value != document.getElementById("password").value){
            e.preventDefault();
            error_msg.style.display = "block";
            error_msg.textContent = "Konfirmasi Password & Password Tidak Sama, Silahkan Coba lagi";
        }
    }
</script>