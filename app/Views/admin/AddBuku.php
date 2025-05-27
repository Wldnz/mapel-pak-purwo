<main>

    <div class="container">
        <h2>Menambahkan Buku</h2>
        <form action="">
            <div class="wrapper">
                <aside class="left">
                    <div class="field-input">
                        <label for="isbn_10">ISBN 10</label>
                        <input type="number" name="isbn_10" id="isbn_10" placeholder="Masukkan isbn 10.." minlength="10" maxlength="10">
                    </div>
                    <div class="field-input">
                        <label for="isbn_13">ISBN 13</label>
                        <input type="number" name="isbn_13" id="isbn_13" placeholder="Masukkan isbn 13.." minlength="13" maxlength="13">
                    </div>
                    <div class="field-input">
                        <label for="title">Judul<span>*</span></label>
                        <input type="text" name="title" id="title" placeholder="Masukkan judul.." minlength="10" maxlength="180" required>
                    </div>
                    <div class="field-input">
                        <label for="description">Deskripsi</label>
                        <textarea name="description" id="description" placeholder="Masukkan deskripsi..." value="-"></textarea>
                    </div>
                    <div class="field-input">
                        <label for="author">Penulis<span>*</span></label>
                        <input type="text" name="author" id="author" placeholder="Masukkan penulis.." minlength="3" maxlength="180" required>
                    </div>
                    <div class="field-input">
                        <label for="publisher">Penerbit<span>*</span></label>
                        <input type="text" name="publisher" id="publisher" placeholder="Masukkan penulis.." minlength="3" maxlength="180" required>
                    </div>
                    <div class="field-input">
                        <label for="publication_year">Tahun Diterbitkan<span>*</span></label>
                        <input type="number" name="publication_year" id="publication_year" placeholder="Masukkan penulis.." value="2025" minlength="4" maxlength="4" required>
                    </div>
                    <div class="field-input">
                        <label for="edition_number">Buku Edisi<span>*</span></label>
                        <input type="number" name="edition_number" id="edition_number" placeholder="Masukkan penulis.." value="0" minlength="3" maxlength="180" required>
                    </div>
                    <div class="field-input">
                        <label for="total_pages">Total Halaman<span>*</span></label>
                        <input type="number" name="total_pages" id="total_pages" placeholder="Masukkan Total Halaman.." value="0" minlength="3" maxlength="180" required>
                    </div>
                    <div class="field-input">
                        <label for="category">Kategori<span>*</span></label>
                        <input type="text" name="category" id="category" placeholder="Masukkan category.." minlength="3" maxlength="180" required>
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
                            <option value="1">Tantnagan Hidup</option>
                            <option value="2">Karya hidup</option>
                        </select>
                    </div>
                    <div class="field-input">
                        <label for="status">Status Buku<span>*</span></label>
                        <select name="status" id="status">
                            <option value="private" selected>Sembunyikan</option>
                            <option value="public">Terlihat</option>
                        </select>
                    </div>
                </aside>
                <aside class="right">
                    <img src="<?= images ?>/default-book.png" alt="image-buku" id="gambar-buku">
                    <span>Format Gambar Tidak Didukung</span>
                    <input type="file" accept="image/jpeg, image/png" id="input-image">
                </aside>
            </div>
            <button type="submit" class="btn btn-buat">Buat Buku</button>
        </form>
    </div>
</main>

<script>
    const image_input = document.getElementById("input-image");
    let isValidImage = false;
    image_input.addEventListener("change",(e) => {
        const file = e.target.files[0];
        if(file && checkImageIsSupportedFormat(file) && file.size <= 2500000){
            isValidImage = true;
            setImage(file);
            return;
        }
        isValidImage = false;
        alert("Gambar yang diberikan tidak didukung dan Ukuran gambar maksimal 2,5MB");
    });

    function setImage(file){
        const image_url = URL.createObjectURL(file);
        document.getElementById("gambar-buku").src = image_url;
        console.log(image_url);
    }

    function checkImageIsSupportedFormat(file){
        let expectedFormats = ["png","jpeg","jpg"];
        for(format in expectedFormats){
            if(file.type.includes(expectedFormats[format])){
                return true;
            }
        }
        return false;
    }
</script>