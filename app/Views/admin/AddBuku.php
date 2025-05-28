<style>
    @media screen and (max-width:400px) {
        body {
            min-width: max-content;
        }
        .container {
            width: max-content;
        };
    }
</style>

<main>

    <div class="container container-buku">
        <h2>Menambahkan Buku</h2>
        <form action="" id="form-submit">
            <div class="wrapper">
                <aside class="left">
                    <div class="field-input">
                        <label for="isbn_10">ISBN 10</label>
                        <input type="number" name="isbn_10" id="isbn_10" placeholder="Masukkan isbn 10.." minlength="10" maxlength="10" value="<?= $isbn_10 ?>">
                    </div>
                    <div class="field-input">
                        <label for="isbn_13">ISBN 13</label>
                        <input type="number" name="isbn_13" id="isbn_13" placeholder="Masukkan isbn 13.." minlength="13" maxlength="13" value="<?= $isbn_13 ?>">
                    </div>
                    <div class="field-input">
                        <label for="title">Judul<span>*</span></label>
                        <input type="text" name="title" id="title" placeholder="Masukkan judul.." minlength="10" maxlength="180" required value="<?= $judul ?>">
                    </div>
                    <div class="field-input">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" id="description" placeholder="Masukkan deskripsi..."><?= $description ?></textarea>
                    </div>
                    <div class="field-input">
                        <label for="author">Penulis<span>*</span></label>
                        <input type="text" name="author" id="author" placeholder="Masukkan penulis.." minlength="3" maxlength="180" required value="<?= $author ?>">
                    </div>
                    <div class="field-input">
                        <label for="publisher">Penerbit<span>*</span></label>
                        <input type="text" name="publisher" id="publisher" placeholder="Masukkan penulis.." minlength="3" maxlength="180" required value="<?= $publisher ?>">
                    </div>
                    <div class="field-input">
                        <label for="publication_year">Tahun Diterbitkan<span>*</span></label>
                        <input type="number" name="publication_year" id="publication_year" placeholder="Masukkan penulis.." value="<?= $publication_year ? $publication_year : date("Y") ?>" minlength="4" maxlength="4" required>
                    </div>
                    <div class="field-input">
                        <label for="edition_number">Buku Edisi<span>*</span></label>
                        <input type="number" name="edition_number" id="edition_number" placeholder="Masukkan penulis.." value="0" minlength="3" maxlength="180" required value="<?= $edition_number ?>">
                    </div>
                    <div class="field-input">
                        <label for="total_pages">Total Halaman<span>*</span></label>
                        <input type="number" name="total_pages" id="total_pages" placeholder="Masukkan Total Halaman.." minlength="3" maxlength="180" value="<?= $total_pages ? $total_pages : 0 ?>" required>
                    </div>
                    <div class="field-input">
                        <label for="category">Kategori<span>*</span></label>
                        <input type="text" name="category" id="category" placeholder="Masukkan category.." minlength="3" maxlength="180" required value="<?= $category ?>">
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
                                <option value="<?= $clsn["id"] ?>" <?= $classification_number == $clsn["id"] ? "selected" : "" ?>><?= $clsn["classification"] ?> </option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="field-input">
                        <label for="status">Status Buku<span>*</span></label>
                        <select name="status" id="status">
                            <option value="private" <?= $status == "private" ? "selected" : "" ?>>Sembunyikan</option>
                            <option value="public" <?= $status == "public" ? "selected" : "" ?>>Terlihat</option>
                        </select>
                    </div>
                </aside>
                <aside class="right">
                    <img src="<?= images ?>/default-book.png" alt="image-buku" id="gambar-buku">
                    <span class="" id="error-message-gambar">Format Gambar Tidak Didukung</span>
                    <label for="input-image">Uploud Images</label>
                    <input type="file" accept="image/jpeg, image/png" name="input-image" id="input-image">
                </aside>
            </div>
            <button type="submit" class="btn btn-buat">Buat Buku</button>
            <div style="height: 10px;"></div>
            <button type="button" class="btn btn-buat" onclick="history.back()">Kembali</button>
        </form>
    </div>
</main>

<script>
    const image_input = document.getElementById("input-image");
    const formBook = document.getElementById("form-submit");
    const error_message = document.getElementById("error-message-gambar");
    let isValidImage = false;
    let fileImage = null;
    let isSend = false;
    image_input.addEventListener("change", (e) => {
        const file = e.target.files[0];
        if (file && checkImageIsSupportedFormat(file) && file.size <= 2500000) {
            isValidImage = true;
            fileImage = file;
            setImage(file);
             error_message.style.display = "none";
            return;
        }
        error_message.style.display = "block";
        error_message.textContent = "Gambar yang diberikan tidak didukung dan Ukuran gambar maksimal 2,5MB";
        isValidImage = false;
        alert("Gambar yang diberikan tidak didukung dan Ukuran gambar maksimal 2,5MB");
    });

    formBook.addEventListener("submit", async (e) => {
        e.preventDefault();
        if (isValidImage && !isSend) {
            let formData = new FormData();
            for (let i = 0; i < 13; i++) {
                formData.append(e.target[i].getAttribute("name"), e.target[i].value);
            }
            formData.append("image", fileImage);
            isSend = true;
            const result = await (await fetch("", {
                method: "POST",
                body: formData
            })).json();
            alert(result.message);
            if (result.isSuccess) {
                location.href = "<?= base_url("admin/management-buku") ?>";
            }
            return;
        }
        alert("required image...");
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
</script>