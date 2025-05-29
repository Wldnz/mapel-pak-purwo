<style>
    body {
        min-width: 320px;
    }
</style>

<?php
if (!isset($peminjaman) || empty($peminjaman)) {
} else {
    $message = $peminjaman["borrow_status"] == "fail" ? "Gagal" : "Dikembalikan";
    $color = $peminjaman["borrow_status"] == "fail" ? "red" : "green";
     if($peminjaman["status"] == "borrowed"){
                                    $message = "Dipinjam";
                                }else if($peminjaman["status"] == 'wait'){
                                    $color = "darkgoldenrod";
                                } ?>
    <main>
        <div class="container">
            <div class="container-child">
                <h2>Detail Anggota <?= $peminjaman["name"] ?></h2>
            </div>
            <div class="peminjaman-container">
                <div class="field-input">
                    <label for="name">Nama</label>
                    <input type="text" name="name" value="<?= $peminjaman["name"] ?>" readonly>
                </div>
                <div class="field-input">
                    <label for="fullname">Nama Lengkap</label>
                    <input type="text" name="fullname" value="<?= $peminjaman["fullname"] ?>" readonly>
                </div>
                <div class="field-input">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="<?= $peminjaman["email"] ?>" readonly>
                </div>
                <div class="field-input">
                    <label for="phone">Nomor Telephone</label>
                    <input type="text" name="phone" value="<?= $peminjaman["phone"] ?>" readonly>
                </div>
                <div class="field-input">
                    <label for="role">Role</label>
                    <input type="text" name="role" value="<?= $peminjaman["role"] == "user" ? "Anggota" : $peminjaman["user"] ?>" readonly>
                </div>
                <div class="field-input">
                    <label for="status">Status Verifikasi</label>
                    <input type="text" name="status" value="<?= $peminjaman["user_status"] ?>" readonly>
                </div>
                <div class="field-input">
                    <label for="status">Status Peminjaman</label>
                    <input style="color:<?= $color ?>; font-weight:bold;" type="text" name="status" value="<?= $message ?>" readonly>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="container-child">
                <h2>Personal Data Anggota <?= $peminjaman["name"] ?></h2>
            </div>
            <?php
            if (!isset($personal_data) || empty($personal_data)) { ?>
                <p>Anggota belum melakukan verifikasi / data tidak ada...</p>
            <?php } else { ?>
                <div class="peminjaman-container">
                    <div class="field-input">
                        <label for="address">Alamat</label>
                        <input type="text" name="address" value="<?= $personal_data["address"] ?>" readonly>
                    </div>
                    <div class="field-input">
                        <label for="status_user">Status Anggota</label>
                        <input type="text" name="status_user" value="<?= $personal_data["status_user"] ?>" readonly>
                    </div>
                    <div class="field-input">
                        <label for="identify_type">Identifikasi Anggota</label>
                        <input type="text" name="identify_type" value="<?= $personal_data["identify_type"] ?>" readonly>
                    </div>
                    <div class="field-input">
                        <img src="<?= $personal_data["identify_image"] ? $personal_data["identify_image"] : images . "/default-book.png" ?>" alt="image-buku" id="gambar-buku">
                        <div class="modal-image" id="modal-image">
                            <div class="content">
                                <img
                                    src="<?= $personal_data["identify_image"] ?>" alt="identifikasi-gambar"
                                    class="identify-image">
                            </div>
                        </div>
                    </div>
                </div>
                <script defer>
                    const modal_image = document.getElementById("modal-image");
                    const showModal = document.querySelector("#gambar-buku");
                    modal_image.addEventListener("click", (e) => {
                        modal_image.style.display = "none";
                    });
                    showModal.addEventListener("click", (e) => {
                        modal_image.style.display = "block";
                    });
                </script>
            <?php }
            ?>
        </div>
        <div class="container">
            <div class="container-child child-2">
                <h2>Data Request Peminjaman Buku - (<?= $peminjaman["title"] ?>)</h2>
                <div class="child-3">
                    <?php

                    if ($peminjaman["borrow_status"] == "wait") { ?>
                        <form action="<?= base_url("admin/management-riwayat-peminjaman/accept") ?>" method="post"> <button type="submit" name="id_borrowed" value="<?= $peminjaman["id"] ?>" id="terima-request">Terima Request</button></form>
                        <form action="<?= base_url("admin/management-riwayat-peminjaman/cancel") ?>" method="post"> <button type="submit" name="id_borrowed" value="<?= $peminjaman["id"] ?>" id="tolak-request">Tolak Request</button></form>
                    <?php } else if ($peminjaman["borrow_status"] == "fail") { ?>
                        <form action="<?= base_url("admin/management-riwayat-peminjaman/accept") ?>" method="post"> <button type="submit" name="id_borrowed" value="<?= $peminjaman["id"] ?>" id="terima-request">Terima Request</button></form>
                        <div></div>
                    <?php } else if ($peminjaman["borrow_status"] == "borrow") { ?>
                        <form action="<?= base_url("admin/management-riwayat-peminjaman/return") ?>" method="post"> <button type="submit" name="id_borrowed" value="<?= $peminjaman["id"] ?>" id="tolak-request">Buku Dikembalikan</button></form>
                        <form action="<?= base_url("admin/management-riwayat-peminjaman/cancel") ?>" method="post"> <button type="submit" name="id_borrowed" value="<?= $peminjaman["id"] ?>" id="tolak-request">Tolak Request</button></form>
                    <?php }

                    ?>
                </div>
            </div>
            <div class="peminjaman-container">
                <div class="field-input">
                    <label for="isbn_10">ISBN 10</label>
                    <input type="text" name="isbn_10" value="<?= $peminjaman["isbn_10"] ?>" readonly>
                </div>
                <div class="field-input">
                    <label for="isbn_13">ISBN 13</label>
                    <input type="text" name="isbn_13" value="<?= $peminjaman["isbn_13"] ?>" readonly>
                </div>
                <div class="field-input">
                    <label for="title">Judul Buku</label>
                    <input type="text" name="title" value="<?= $peminjaman["title"] ?>" readonly>
                </div>
                <div class="field-input">
                    <img src="<?= $peminjaman["image_url"] ? $peminjaman["image_url"] : images . "/default-book.png" ?>" alt="image-buku" id="gambar-buku">
                </div>
                <div class="field-input">
                    <label for="description">Deskripsi</label>
                    <textarea style="height: 240px;" name="" id="" disabled><?= $peminjaman["description"] ?></textarea>
                </div>
                <div class="field-input">
                    <label for="author">Penulis</label>
                    <input type="text" name="author" value="<?= $peminjaman["author"] ?>" readonly>
                </div>
                <div class="field-input">
                    <label for="publisher">Penerbit</label>
                    <input type="text" name="publisher" value="<?= $peminjaman["publisher"] ?>" readonly>
                </div>
                <div class="field-input">
                    <label for="publication_year">Tahun Terbit</label>
                    <input type="text" name="publication_year" value="<?= $peminjaman["publication_year"] ?>" readonly>
                </div>
            </div>
        </div>
        <!-- <script defer>
            const terima_btn = document.getElementById("terima-request");
            const tolak_btn = document.getElementById("tolak-request");
            let isSendRequest = false;
            terima_btn.addEventListener("click",() => {
                const
            });
        </script> -->
    </main>
<?php }
?>