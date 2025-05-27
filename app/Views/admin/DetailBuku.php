<style>
    body{
        min-width: 300px;
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
                        <input type="text" name="author" id="author" placeholder="Masukkan penulis.." minlength="3" maxlength="180" required value="<?= $data["author"]?>">
                    </div>
                    <div class="field-input">
                        <label for="publisher">Penerbit<span>*</span></label>
                        <input type="text" name="publisher" id="publisher" placeholder="Masukkan penulis.." minlength="3" maxlength="180" required value="<?= $data["publisher"] ?>">
                    </div>
                    <div class="field-input">
                        <label for="publication_year">Tahun Diterbitkan<span>*</span></label>
                        <input type="number" name="publication_year" id="publication_year" placeholder="Masukkan penulis.." value="<?= $data["publication_year"]? $data["publication_year"] : date("Y") ?>" minlength="4" maxlength="4" required>
                    </div>
                    <div class="field-input">
                        <label for="edition_number">Buku Edisi<span>*</span></label>
                        <input type="number" name="edition_number" id="edition_number" placeholder="Masukkan penulis.." value="0" minlength="3" maxlength="180" required value="<?= $data["edition_number"] ?>">
                    </div>
                    <div class="field-input">
                        <label for="total_pages">Total Halaman<span>*</span></label>
                        <input type="number" name="total_pages" id="total_pages" placeholder="Masukkan Total Halaman.." minlength="3" maxlength="180" value="<?= $data["total_pages"]? $data["total_pages"] : 0 ?>" required>
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
                                foreach($clsns as $clsn){?>
                                    <option value="<?= $clsn["id"] ?>" <?= $data["clsn_id"] == $clsn["id"]? "selected" : "" ?>><?= $clsn["classification"] ?> </option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="field-input">
                        <label for="status">Status Buku<span>*</span></label>
                        <select name="status" id="status">
                            <option value="private" <?=  $data["status"] == "private"? "selected" : "" ?>>Sembunyikan</option>
                            <option value="public" <?=  $data["status"] == "public"? "selected" : "" ?>>Terlihat</option>
                        </select>
                    </div>
                </aside>
                <aside class="right">
                    <img src="<?= $data["image_url"]? $data["image_url"] : images . "/default-book.png" ?>" alt="image-buku" id="gambar-buku">
                    <input type="hidden" name="image_url" id="image_url-hidden" value="<?= $data["image_url"] ?>">
                    <input type="hidden" name="id" value="<?= $data["id"] ?>">
                    <!-- <span class="">Format Gambar Tidak Didukung</span> -->
                    <label for="input-image">Uploud Images</label>
                    <input type="file" accept="image/jpeg, image/png" name="input-image" id="input-image">
                </aside>
            </div>
            <button type="submit" class="btn btn-buat">Update Buku</button>
            <p style="color:white;">as</p>
            <button type="button" class="btn btn-buat" onclick="history.back()">Kembali</button>
        </form>
    </div>
</main>

<script>
    const image_input = document.getElementById("input-image");
    const formBook = document.getElementById("form-submit");
    let isValidImage = false;
    let isChangeImage = false;
    let fileImage = null;
    image_input.addEventListener("change",(e) => {
        const file = e.target.files[0];
        if(file && checkImageIsSupportedFormat(file) && file.size <= 2500000){
            if(!isChangeImage){
                document.getElementById("image_url-hidden").remove();
            }
            isValidImage = true;
            isChangeImage = true;
            fileImage = file;
            setImage(file);
            return;
        }
        isValidImage = false;
        alert("Gambar yang diberikan tidak didukung dan Ukuran gambar maksimal 2,5MB");
    });

    formBook.addEventListener("submit", async(e) => {
        if(isChangeImage){
            e.preventDefault();
            if(isValidImage){
                let formData = new FormData();
                for(let i =0; i< 13; i++){
                    formData.append(e.target[i].getAttribute("name"),e.target[i].value);
                }
                formData.append("image",fileImage);
                const result = await (await fetch("",{
                        method : "POST",
                        body : formData
                    })).json();
                alert(result.message);
                if(result.isSuccess){
                    location.href = "<?= base_url("admin/management-buku") ?>";
                }
                return;
                alert("required image...");
            }
        }
        
    });

    
    

    function setImage(file){
        const image_url = URL.createObjectURL(file);
        document.getElementById("gambar-buku").src = image_url;
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