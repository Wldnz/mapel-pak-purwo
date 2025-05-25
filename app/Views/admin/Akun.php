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

    </div>
</main>

<script defer>
    const btn_add = document.getElementById("add-akun");
    btn_add.addEventListener("click",() => {
        console.log("as");
    });
</script>