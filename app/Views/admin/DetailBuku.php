<style>
    @media screen and (max-width:400px) {
        body {
            min-width: max-content;
        }

        .container {
            width: max-content;
        }

        ;
    }
</style>

<main>

    <div class="container container-buku">
        <h2>Menambahkan Buku</h2>
        <form action="" id="form-submit" method="POST">
            <div class="wrapper">
                <aside class="left">
                    <div class="field-input">
                        <label for="isbn_10">ISBN 10</label>
                        <input type="number" name="isbn_10" id="isbn_10" placeholder="Masukkan isbn 10.." minlength="10" maxlength="10" value="<?= $data["isbn_10"] ?>">
                    </div>
                    <div class="field-input">
                        <label for="isbn_13">ISBN 13</label>
                        <input type="number" name="isbn_13" id="isbn_13" placeholder="Masukkan isbn 13.." minlength="13" maxlength="13" value="<?= $data["isbn_13"] ?>">
                    </div>
                    <div class="field-input">
                        <label for="title">Judul<span>*</span></label>
                        <input type="text" name="title" id="title" placeholder="Masukkan judul.." minlength="10" maxlength="180" required value="<?= $data["title"] ?>">
                    </div>
                    <div class="field-input">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" id="description" placeholder="Masukkan deskripsi..."><?= $data["description"] ?></textarea>
                    </div>
                    <div class="field-input">
                        <label for="author">Penulis<span>*</span></label>
                        <input type="text" name="author" id="author" placeholder="Masukkan penulis.." minlength="3" maxlength="180" required value="<?= $data["author"] ?>">
                    </div>
                    <div class="field-input">
                        <label for="publisher">Penerbit<span>*</span></label>
                        <input type="text" name="publisher" id="publisher" placeholder="Masukkan penulis.." minlength="3" maxlength="180" required value="<?= $data["publisher"] ?>">
                    </div>
                    <div class="field-input">
                        <label for="publication_year">Tahun Diterbitkan<span>*</span></label>
                        <input type="number" name="publication_year" id="publication_year" placeholder="Masukkan penulis.." value="<?= $data["publication_year"] ? $data["publication_year"] : date("Y") ?>" minlength="4" maxlength="4" required>
                    </div>
                    <div class="field-input">
                        <label for="edition_number">Buku Edisi<span>*</span></label>
                        <input type="number" name="edition_number" id="edition_number" placeholder="Masukkan penulis.." minlength="3" maxlength="180" required value="<?= $data["edition_number"] ?>">
                    </div>
                    <div class="field-input">
                        <label for="total_pages">Total Halaman<span>*</span></label>
                        <input type="number" name="total_pages" id="total_pages" placeholder="Masukkan Total Halaman.." minlength="3" maxlength="180" value="<?= $data["total_pages"] ? $data["total_pages"] : 0 ?>" required>
                    </div>
                    <div class="field-input">
                        <label for="category">Kategori<span>*</span></label>
                        <input type="text" name="category" id="category" placeholder="Masukkan category.." minlength="3" maxlength="180" required value="<?= $data["category"] ?>">
                    </div>
                    <div class="field-input">
                        <label for="language">Bahasa<span>*</span></label>
                        <select name="language" id="language">
                            <option value="Indonesian">Indonesian</option>
                            <option value="English">Inggris</option>
                        </select>
                    </div>
                    <div class="field-input">
                        <label for="classification_number">Nomor Klasifikasi<span>*</span></label>
                        <select name="classification_number" id="classification_number">
                            <?php
                            foreach ($clsns as $clsn) { ?>
                                <option value="<?= $clsn["id"] ?>" <?= $data["clsn_id"] == $clsn["id"] ? "selected" : "" ?>><?= $clsn["classification"] ?> </option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="field-input">
                        <label for="status">Status Buku<span>*</span></label>
                        <select name="status" id="status">
                            <option value="private" <?= $data["status"] == "private" ? "selected" : "" ?>>Sembunyikan</option>
                            <option value="public" <?= $data["status"] == "public" ? "selected" : "" ?>>Terlihat</option>
                        </select>
                    </div>
                </aside>
                <aside class="right">
                    <img src="<?= $data["image_url"] ? $data["image_url"] : images . "/default-book.png" ?>" alt="image-buku" id="gambar-buku">
                    <input type="hidden" name="image_url" id="image_url-hidden" value="<?= $data["image_url"] ?>">
                    <input type="hidden" name="id" value="<?= $data["id"] ?>">
                    <span class="" id="error-message-gambar">Format Gambar Tidak Didukung</span>
                    <label for="input-image">Uploud Images</label>
                    <input type="file" accept="image/jpeg, image/png" name="input-image" id="input-image">
                </aside>
            </div>
            <button type="submit" class="btn btn-buat">Update Buku</button>
            <p style="color:white;">as</p>
        </form>
    </div>
    <div class="container">
        <div class="header-container">
            <h2>Data Buku Salinan (<?= count($cr_bc) ?>)</h2>
            <button type="button" id="buat-buku-salinan"><img src="<?= icons ?>/add.svg" alt=""></button>
        </div>
        <table>
            <tr class="table-header">
                <th>ID Salinan</th>
                <th>Buku Panggil</th>
                <th>Tanggal Dipinjam</th>
                <th>Tanggal Dibalikin</th>
                <th>Buku Kondisi</th>
                <th>Status Salinan</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($bcopys as $book) { ?>
                <tr>
                    <td><?= $book["id"] ?></td>
                    <td><?= $book["call_number"] ?></td>
                    <td><?= $book["loan_date"] ? date("d-m-Y") : "-" ?></td>
                    <td><?= $book["due_date"] ? date("d-m-Y") : "-" ?> </td>
                    <td><?= $book["physical_condition"] ?></td>
                    <td><?= $book["status"] ?></td>
                    <td><a href="<?= base_url("admin/management-buku?id=" . $data["id"] . "&id_book_copy=" . $book["id"] . "") ?>">Update Buku Salinan</a></td>
                </tr>
            <?php }
            ?>
        </table>
        <button type="button" class="btn btn-buat" onclick="history.back()">Kembali</button>
    </div>

    <div class="modal" id="modal">
        <form action="<?= base_url("admin/management-buku/create-book-copy") ?>" id="form-add-book-copy" method="post">
            <div class="header-form">
                <h2>Tambah Buku Salinan</h2>
                <button type="button" class="btn-close" id="btn-close">Close</button>
            </div>
            <p class="error-message" id="error-message" style="display: none;">Pastikan Password Dan Konfirmasi Sama</p>
            <div class="fieldInput2">
                <label for="id_book_copy">ID - BUKU SALINAN</label>
                <input type="text" name="id_book_copy" id="id_book_copy" minlength="3" required>
            </div>
            <div class="fieldInput2">
                <label for="call_number">Buku Panggil</label>
                <input type="text" name="call_number" id="call_number" minlength="3" required>
            </div>
            <div class="fieldInput2">
                <label for="status_salinan">Buku Panggil</label>
                <select name="status_salinan" id="status_salinan">
                    <option value="available">Tersedia</option>
                    <option value="borrowed">Dipinjam</option>
                    <option value="damaged">Rusak</option>
                    <option value="lost">Hilang</option>
                    <option value="under repair">Dalam Perbaikan</option>
                </select>
            </div>
            <div class="fieldInput2">
                <label for="physical_condition">Kondisi Buku</label>
                <select name="physical_condition" id="physical_condition">
                    <option value="good">Sangat Baik</option>
                    <option value="normal">Baik</option>
                    <option value="damaged">Rusak</option>
                    <option value="lost">Hilang</option>
                </select>
            </div>
            <input type="hidden" name="id_book" value="<?= $data["id"] ?>">
            <button type="submit" class="btn">Buat Buku Salinan</button>
        </form>
    </div>

    <?php

    if (isset($cr_bc) && !empty($cr_bc)) { ?>
        <div class="modal" id="modal-update-book">
            <form action="<?= base_url("admin/management-buku/update-book-copy") ?>" id="form-add-book-copy" method="post">
                <div class="header-form">
                    <h2>Edit Buku Salinan</h2>
                    <button type="button" class="btn-close" id="btn-close2">Close</button>
                </div>
                <div class="fieldInput2">
                    <label for="id_book_copy">ID - BUKU SALINAN</label>
                    <input type="text" name="id_book_copy" id="id_book_copy" value="<?= $cr_bc["id"] ?>" minlength="3" required readonly>
                </div>
                <div class="fieldInput2">
                    <label for="call_number">Buku Panggil</label>
                    <input type="text" name="call_number" id="call_number" value="<?= $cr_bc["call_number"] ?>" minlength="3" required>
                </div>
                <div class="fieldInput2">
                    <label for="loan_date">Tanggal DIpinjam</label>
                    <input type="date" name="loan_date" id="loan_date" value="<?= $cr_bc["loan_date"] ? date("Y-m-d", $cr_bc["loan_date"] / 1000) : date("Y-m-d") ?>" minlength="3" required>
                </div>
                <div class="fieldInput2">
                    <label for="due_date">Tanggal Dibalikin</label>
                    <input type="date" name="due_date" id="due_date" value="<?= $cr_bc["due_date"] ? date("Y-m-d", $cr_bc["due_date"] / 1000) : date("Y-m-d") ?>" minlength="3" required>
                </div>
                <div class="fieldInput2">
                    <label for="id_book">Salinan Dari Buku</label>
                    <select name="id_book" id="id_book">
                        <?php
                        foreach ($books as $book) { ?>
                            <option <?= $book["id"] == $data["id"] ? "value='" . $book["id"] . "' selected" : "value='" . $book["id"] . "'" ?>><?= $book["title"] ?></option>
                        <?php }
                        ?>
                    </select>
                </div>
                <div class="fieldInput2">
                    <label for="status_salinan">Status Buku</label>
                    <select name="status_salinan" id="status_salinan">
                        <option value="available" <?= $cr_bc["status"] == "availabe" ? "selected" : "" ?>>Tersedia</option>
                        <option value="borrowed" <?= $cr_bc["status"] == "borrowed" ? "selected" : "" ?>>Dipinjam</option>
                        <option value="damaged" <?= $cr_bc["status"] == "damaged" ? "selected" : "" ?>>Rusak</option>
                        <option value="lost" <?= $cr_bc["status"] == "lost" ? "selected" : "" ?>>Hilang</option>
                        <option value="under repair" <?= $cr_bc["status"] == "under repair" ? "selected" : "" ?>>Dalam Perbaikan</option>
                    </select>
                </div>
                <div class="fieldInput2">
                    <label for="physical_condition">Kondisi Buku</label>
                    <select name="physical_condition" id="physical_condition">
                        <option value="good" <?= $cr_bc["physical_condition"] == "good" ? "selected" : "" ?>>Sangat Baik</option>
                        <option value="normal" <?= $cr_bc["physical_condition"] == "normal" ? "selected" : "" ?>>Baik</option>
                        <option value="damaged" <?= $cr_bc["physical_condition"] == "damaged" ? "selected" : "" ?>>Rusak</option>
                        <option value="lost" <?= $cr_bc["physical_condition"] == "lost" ? "selected" : "" ?>>Hilang</option>
                    </select>
                </div>
                <button type="submit" class="btn">Update Buku Salinan</button>
            </form>
        </div>
    <?php }

    ?>

</main>

<script defer>
    const image_input = document.getElementById("input-image");
    const formBook = document.getElementById("form-submit");
    const error_message = document.getElementById("error-message-gambar");
    let isValidImage = false;
    let isChangeImage = false;
    let fileImage = null;


    const btn_close = document.getElementById("btn-close");
    const modal = document.getElementById("modal");
    const error_msg = document.getElementById("error-message");
    const btn_buat_buku = document.getElementById("buat-buku-salinan");
    let isChange = false;

    const btn_close2 = document.getElementById("btn-close2");
    const modal2 = document.getElementById("modal-update-book");
    const update_buat_buku = document.getElementById("update-buku-salinan");
    let isChangeUpdate = false;

    if (new URLSearchParams(location.href).get("id_book_copy")) {
        modal2.style.display = "flex";
        btn_close2.addEventListener("click", () => modal2.style.display = "none")
    }


    image_input.addEventListener("change", (e) => {
        const file = e.target.files[0];
        if (file && checkImageIsSupportedFormat(file) && file.size <= 2500000) {
            if (!isChangeImage) {
                document.getElementById("image_url-hidden").remove();
            }
            isValidImage = true;
            isChangeImage = true;
            fileImage = file;
            setImage(file);
            error_message.style.display = "none";
            return;
        }
        isValidImage = false;
        error_message.style.display = "block";
        error_message.textContent = "Gambar yang diberikan tidak didukung dan Ukuran gambar maksimal 2,5MB";
        alert("Gambar yang diberikan tidak didukung dan Ukuran gambar maksimal 2,5MB");
    });

    formBook.addEventListener("submit", async (e) => {
        e.preventDefault();
        let formData = new FormData();
        for (let i = 0; i < 14; i++) {
            formData.append(e.target[i].getAttribute("name"), e.target[i].value);
        }
        if (isChangeImage) {
            if (isValidImage) {
                formData.append("image", fileImage);
            } else {
                alert("required image...");
            }
        }

        const result = await (await fetch("", {
            method: "POST",
            body: formData
        })).json();

        if (result.isSuccess) {
            // location.href = "<?= base_url("admin/management-buku") ?>";
            alert("berhasil update buku");
        }
    });




    function setImage(file) {
        const image_url = URL.createObjectURL(file);
        document.getElementById("gambar-buku").src = image_url;
    }

    function checkImageIsSupportedFormat(file) {
        let expectedFormats = ["png", "jpeg", "jpg"];
        for (format in expectedFormats) {
            if (file.type.includes(expectedFormats[format])) {
                return true;
            }
        }
        return false;
    }
    btn_close.addEventListener("click", () => {
        if (!isChange) {
            modal.style.display = "none";
        } else if (confirm("anda yakin ingin menutup form?")) {
            modal.style.display = "none";
            isChange = false;
        }
    });

    btn_buat_buku.addEventListener("click", () => {
        modal.style.display = "flex";
    });
</script>