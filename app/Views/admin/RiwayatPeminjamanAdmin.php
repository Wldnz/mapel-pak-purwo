<main>
    <div class="container">
        <div class="container-child">
            <div class="header-container">
                <h2>Data Buku</h2>
                <button type="button" id="add-peminjaman"><img src="<?= icons ?>/add.svg" alt=""></button>
            </div>
            <form class="menu-filter">
                <div class="select-option">
                    <select name="status" id="0">
                        <option value="">Semua Status Peminjaman</option>
                        <option value="wait" <?= $status == "wait" ? "selected" : ""  ?>>Menunggu</option>
                        <option value="borrowed" <?= $status == "borrowed" ? "selected" : ""  ?>>Dipinjam</option>
                        <option value="returned" <?= $status == "returned" ? "selected" : ""  ?>>Dikembalikan</option>
                        <option value="fail" <?= $status == "fail" ? "selected" : ""  ?>>Gagal</option>
                    </select>
                    <select name="member-name" id="member-option">
                        <option value="">Semua Anggota</option>
                            <?php
                    if(count($userv) > 0){
                        foreach($userv as $user){ ?>
                            <option value="<?= $user["fullname"] ?>" <?= $user["fullname"] == $fullname ? "selected" : ""  ?> ><?= $user["fullname"] ?></option>
                        <?php }
                    }
                ?>
                    </select>
                </div>
                <div class="search">
                    <input type="search" name="title" id="search-title" placeholder="Cari Judul Buku Disini..." value="<?=  $judul ?>">
                    <button type="submit"><img src="<?= icons ?>/search.svg" alt=""></button>
                </div>
            </form>
            <div class="wrapper-table">
                <table>
                    <tr class="table-header">
                        <th>Nama</th>
                        <th>Judul Buku</th>
                        <th>Buku Panggil</th>
                        <th>Kondisi Buku</th>
                        <th>Tanggal Dipinjam</th>
                        <th>Tanggal Dibalikin</th>
                        <th>Status Peminjaman</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        if(count($bws) == 0){
                            echo "<td colspan='7'>Tidak dapat menemukan data peminjaman....</td>";
                        }else{
                            foreach($bws as $bw){ 
                                $message = $bw["status"] == "fail"? "Gagal" : "Dikembalikan";
                                $color = $bw["status"] == "fail"? "red" : "green";
                                if($bw["status"] == "borrowed"){
                                    $message = "Dipinjam";
                                }else if($bw["status"] == 'wait'){
                                    $message = "Menunggu";
                                    $color = "darkgoldenrod";
                                }
                            ?>
                            <tr>
                                <td><?= $bw["fullname"] ?></td>
                                <td><?= $bw["title"] ?></td>
                                <td><?= $bw["call_number"] ?></td>
                                <td><?= $bw["book_condition"] ?></td>
                                <td><?= !$bw["borrowed_at"]? "-" : date("d-m-Y",$bw["borrowed_at"] / 1000) ?></td>
                                <td><?= !$bw["return_at"]? "-" : date("d-m-Y",timestamp: $bw["return_at"] / 1000) ?></td>
                                <td>
                                    <span style="padding:5px; border-radius:8px;    text-transform: capitalize;  color:white; font-weight: bold; background-color:  <?= $color ?> ;"><?= $message ?></span>
                                </td>
                                <td><a href="<?= base_url("admin/management-riwayat-peminjaman?id=".$bw["id_borrowed"]) ?>">Lihat Detail...</a></td>
                            </tr>
                        <?php }
                        }
                    ?>
                </table>
            </div>
        </div>
            <div class="modal" id="modal">
        <form action="<?= base_url("admin/management-riwayat-peminjaman/create") ?>" id="form-add-book-copy" method="post">
            <div class="header-form">
                <h2>Buat Peminjaman</h2>
                <button type="button" class="btn-close" id="btn-close">Close</button>
            </div>
             <p class="error-message" id="error-message" style="display: none;">Pastikan Password Dan Konfirmasi Sama</p>

            <div class="fieldInput2">
                <label for="id_user">Anggota Perpustakaan</label>
                <select name="id_user" id="id_user">
                         <?php
                    if(count($userv) > 0){
                        foreach($userv as $user){ ?>
                            <option value="<?= $user["id"] ?>"><?= $user["fullname"] ?></option>
                        <?php }
                    }
                ?>
                </select>
            </div>
             <div class="fieldInput2">
                 <label for="id_book_copy">Buku</label>
                <select name="id_book_copy" id="id_book_copy">
                        <?php
                    if(count($books) > 0){
                        foreach($books as $book){ ?>
                            <option value="<?= $book["id"] ?>"><?= "(". $book["id"] . ") - " . $book["title"] ?></option>
                        <?php }
                    }
                ?>
                </select>
            </div>
             <div class="fieldInput2">
                <label for="tanggal_dikembalikan">Tanggal Dikembalikan</label>
                <input type="date" value="<?= date("Y-m-d") ?>" name="return_at" id="tanggal_dikembalikan">
            </div>
            <input type="hidden" name="book_condition" id="book_condition" value="<?= $books[0]["physical_condition"] ?>">
            <button type="submit" class="btn">Buat Peminjaman</button>
        </form>
    </div>

</main>

<script defer>
    const books = <?= json_encode($books) ?>;
    const btn_close = document.getElementById("btn-close");
    const modal = document.getElementById("modal");
    const add_peminjaman = document.getElementById("add-peminjaman");
    let isChange = false;
    btn_close.addEventListener("click", () => {
        if (!isChange) {
            modal.style.display = "none";   
        }else if(confirm("anda yakin ingin menutup form?")){
            modal.style.display = "none";   
            isChange = false;
        }
    });

    document.getElementById("id_book_copy").addEventListener("change", (e) => {
        books.forEach(book => {
           if(book["id"] == e.target.value){
             document.getElementById("book_condition").value = book["physical_condition"];
           }
        });
    });

    add_peminjaman.addEventListener("click",() => modal.style.display ="flex");
</script>