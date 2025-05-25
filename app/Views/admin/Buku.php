
<main>
    <h2>Management Buku</h2>
    <div class="container">
      <div class="container-child">
        <h2>Data Buku</h2>
        <form class="menu-filter">
            <div class="select-option">
                <select name="classification-number" id="0" >
                    <option value="0">Semua Nomor Klasifikasi</option>
                    <?php
                     foreach($classification_numbers as $cn){
                        echo "<option value='". $cn["id"] ."'>". $cn["classification"] ."</option>";
                    }
                    ?>
                </select>
                <select name="author" id="author-option" >
                    <option value="0">Semua Penulis</option>
                    <?php
                     foreach($authors as $author){
                        echo "<option value='". $author["author"] ."'>". $author["author"] ."</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="search">
                <input type="search" name="judul" id="search-judul" placeholder="Cari Judul Disini..." value="">
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
                    foreach($books as $book){?>
                <tr>
                    <td><?= $book['title']?> </td>
                    <td><?= strlen($book['description']) > 20? str_split($book['description'],20)[0]."..." : $book["description"]  ?></td>
                    <td><?= $book['author'] ?></td>
                    <td><?= $book['publisher'] ?></td>
                    <td><?= $book['publication_year'] ?></td>
                    <td class="<?= $book['status'] === "private"? "text-red" : "text-green" ?>"><?= $book['status'] === "private"? "Private" : "Public" ?></td>
                    <td><a href="#">Lihat Detail</a></td> 
                </tr>
                <?php } ?>
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
    // Array.from(document.querySelector('.select-option').children).forEach(element => {
    //     element.onchange = (e) => {
    //         console.log(e.target.value)
    //     }
    // });
</script>