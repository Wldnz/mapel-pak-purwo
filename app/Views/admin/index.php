
<?php

//  $arrSectionField = [
//     "Buku" => "buku",
//     "Pegawai & Anggota" => "pegawai_anggota",
//     "Aktifitas" => "aktifitas"
//  ];

 $arrSection = [
    "buku" => 
        [
            [
                "section-name" => "Buku",
                "icon-name" => "book-open.svg",
                "alt" => "icon-buku",
                "desc" => "Data yang diberikan adalah data yang diambil dari total buku.",
                "footer-text" => "Total Buku"
            ],
            [
                "section-name" => "Buku",
                "icon-name" => "book-open.svg",
                "alt" => "icon-buku",
                "desc" => "Data yang diberikan adalah buku yang diterima selama 14 hari.",
                "footer-text" => "Buku Baru"
            ],
            [
                "section-name" => "Buku",
                "icon-name" => "book-open.svg",
                "alt" => "icon-buku",
                "desc" => "Data yang diberikan adalah total data buku yang dipinjam",
                "footer-text" => "Buku Dipinjam"
            ],
            [
                "section-name" => "Buku",
                "icon-name" => "book-open.svg",
                "alt" => "icon-buku",
                "desc" => "Data yang diberikan adalah buku sudah jatuh tempo pada har ini.",
                "footer-text" => "Buku Jatuh Tempo"
            ]
            ],
    "anggota-pegawai" => 
        [
            [
                "section-name" => "Pegawai & Anggota",
                "icon-name" => "members.svg",
                "alt" => "icon-anggota",
                "desc" => "Data yang diberikan adalah total pegawai perpustakaan",
                "footer-text" => "Total Pegawai"
            ],
            [
                "section-name" => "Anggota",
                "icon-name" => "members.svg",
                "alt" => "icon-anggota",
                "desc" => "Data yang diberikan adalah total anggota perpustakaan",
                "footer-text" => "Total Anggota"
            ],
            [
                "section-name" => "Anggota",
                "icon-name" => "members.svg",
                "alt" => "icon-anggota",
                "desc" => "Data yang diberikan adalah anggota yang sudah melakukan verifikasi",
                "footer-text" => "Anggota Terverifikasi"
            ],
            [
                "section-name" => "Anggota",
                "icon-name" => "members.svg",
                "alt" => "icon-anggota",
                "desc" => "Data yang diberikan adalah anggota yang belum melakukan verifikasi",
                "footer-text" => "Anggota Belum Terverifikasi"
            ],
        ],
          "aktifitas" => 
        [
            [
                "section-name" => "Aktifitas",
                "icon-name" => "historys.svg",
                "alt" => "icon-aktifitas",
                "desc" => "Data yang diberikan adalah aktifitas dari semua pengguna",
                "footer-text" => "Total Aktifitas"
            ],
            [
                "section-name" => "Aktifitas",
                "icon-name" => "historys.svg",
                "alt" => "icon-aktifitas",
                "desc" => "Data yang diberikan adalah aktifitas dari  anggota",
                "footer-text" => "Aktifitas Anggota"
            ],
            [
                "section-name" => "Aktifitas",
                "icon-name" => "historys.svg",
                "alt" => "icon-aktifitas",
                "desc" => "Data yang diberikan adalah aktifitas dari pegawai",
                "footer-text" => "Aktifitas Pegawai"
            ],
            [
                "section-name" => "Aktifitas",
                "icon-name" => "historys.svg",
                "alt" => "icon-aktifitas",
                "desc" => "Data yang diberikan adalah aktifitas dari admin",
                "footer-text" => "Aktifitas Admin"
            ],
         ]
 ];

//  echo strval(time());

?>

<main>
    <h2>Dashboard Admin</h2>
    <div class="container">
        <?php 
            foreach($arrSection as $sections){ ?>
            <div class="container-child">
                <h2><?= $sections[0]['section-name'] ?></h2>
                <div class="wrapper-card">
                    <?php foreach($sections as $section){ ?>
                        <div class="card">
                            <div class="header">
                                <h4><?= explode(" ",$section['section-name'])[0] ?></h4>
                                <div class="icon">
                                    <img src="<?= icons ?>/<?= $section['icon-name'] ?>" alt="<?= $section['alt'] ?>">
                                </div>
                                <div class="short-desc">
                                    <p class="desc-text"><?= $section['desc'] ?></p>
                                </div>
                            </div>
                            <div class="text">
                                <h2><?= $data[$section["section-name"]][$section["footer-text"]] ?></h2>
                                <span><?= $section['footer-text'] ?></span>
                            </div>
                        </div>
        <?php   } ?>
                    </div>
                </div>    
        <?php  } ?>
    </div>
    <br>
    <h2>Permintaan Verifikasi Anggota & Peminjaman Buku</h2>
    <div class="container container-padding-none">
        <h2 id="header-text-selection">Permintaan Verifikasi Anggota</h2>
        <div class="select-container">
            <select id="selection-permintaan">
                <option value="Permintaan Verifikasi Anggota">Verifikasi</option>
                <option value="Peminjaman Buku">Permintaan Peminjaman Buku</option>
            </select>
        </div>
        <div class="field-data">
            <img src="https://res.cloudinary.com/ddiulakke/image/upload/v1747055039/vecteezy_profile-icon-design-vector_5544718_cje74w.jpg" alt="profil">
            <h4>Wldnz</h4>
            <h4>Wil***</h4>
            <h4>w***@gmail.com</h4>
            <h4>Anggota</h4>
            <a href="#">Lihat Detail...</a>
        </div>
        <div class="field-data">
            <img src="https://res.cloudinary.com/ddiulakke/image/upload/v1747055039/vecteezy_profile-icon-design-vector_5544718_cje74w.jpg" alt="profil">
            <h4>Wldnz</h4>
            <h4>Wil***</h4>
            <h4>w***@gmail.com</h4>
            <h4>Anggota</h4>
            <a href="#">Lihat Detail...</a>
        </div>
        <div class="field-data">
            <img src="https://res.cloudinary.com/ddiulakke/image/upload/v1747055039/vecteezy_profile-icon-design-vector_5544718_cje74w.jpg" alt="profil">
            <h4>Wldnz</h4>
            <h4>Wil***</h4>
            <h4>w***@gmail.com</h4>
            <h4>Anggota</h4>
            <a href="#">Lihat Detail...</a>
        </div>
    </div>
</main>

<script>
    document.getElementById('selection-permintaan').onchange = ((e) => {
       document.getElementById('header-text-selection').textContent = e.target.value;
    })
</script>