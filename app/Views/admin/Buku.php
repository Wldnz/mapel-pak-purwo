
<main>
    <h2>Management Buku</h2>
    <div class="container">
      <div class="container-child">
       <div class="header-container">
         <h2>Data Buku</h2>
         <button type="button" id="add-book"><img src="<?= icons ?>/add.svg" alt=""></button>
       </div>
        <form class="menu-filter">
            <div class="select-option">
                <select name="status" id="0" >
                    <option value="">Semua Status</option>
                    <option <?php echo $status == "public"? "value='public' selected" : "value='public'" ?>>Terbuka Umum</option>
                    <option  <?php echo $status == "private"? "value='private' selected" : "value='private'" ?>>Disembunyikan</option>
                </select>
                <select name="author" id="author-option" >
                    <option value="">Semua Penulis</option>
                    <?php
                     foreach($authors as $author){?>
                        <option <?= $author["author"] == $currentAuthor? "value='" . $author['author'] ."' selected" : "value='" . $author['author'] ."'" ?>><?= $author["author"] ?></option>
                    <?php }
                    ?>
                </select>
            </div>
            <div class="search">
                <input type="search" name="judul" id="search-judul" placeholder="Cari Judul Disini..." value="<?= $judul ?>">
                <button type="submit"><img src="<?= icons ?>/search.svg" alt=""></button>
            </div>
        </form>
        <div class="wrapper-table">
            <table>
                <tr class="table-header">
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Author</th>
                    <th>Penerbit</th>
                    <th>Tahun Publish</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                    if(count($books) == 0){ ?> 
                        <td colspan="7">Tidak Dapat Menemukan Data...</td>
                    <?php }else {
                    foreach($books as $book){?>
                <tr>
                    <td><?= $book['title']?> </td>
                    <td><?= strlen($book['description']) > 20? str_split($book['description'],20)[0]."..." : $book["description"]  ?></td>
                    <td><?= $book['author'] ?></td>
                    <td><?= $book['publisher'] ?></td>
                    <td><?= $book['publication_year'] ?></td>
                    <td class="<?= $book['status'] === "private"? "text-red" : "text-green" ?>"><?= $book['status'] === "private"? "Private" : "Public" ?></td>
                    <td><a href="<?= base_url("admin/management-buku?id=".$book["id"]) ?>">Lihat Detail</a></td> 
                </tr>
                <?php }} ?>
            </table>
        </div>
      </div>
      <div class="footer-pagination">
        <p>Sebelumnya</p>
        <p>1</p>
        <p>Lanjut</p>
      </div>
    </div>
</main>

<script>
    document.querySelector("#add-book").addEventListener("click",() => location.href = "<?= base_url('admin/management-buku/add-book') ?>")
</script>