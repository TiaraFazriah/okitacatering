<?php
$servername = "localhost"; 
$username = "root";       
$password = "";           
$dbname = "okita_catering"; 

$message = ''; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nama_lengkap = $conn->real_escape_string($_POST['nama_lengkap']);
    $email = $conn->real_escape_string($_POST['email']);
    $subjek = $conn->real_escape_string($_POST['subjek']);
    $pesan = $conn->real_escape_string($_POST['pesan']);

    $sql = "INSERT INTO pesan_kontak (nama_lengkap, email, subjek, pesan) 
            VALUES ('$nama_lengkap', '$email', '$subjek', '$pesan')";

    if ($conn->query($sql) === TRUE) {
        $message = "<div style='padding: 15px; margin-bottom: 20px; border: 1px solid #4CAF50; background-color: #e6ffe6; color: #4CAF50; border-radius: 5px; text-align: center;'>✅ Pesan Berhasil Terkirim! Terima kasih, $nama_lengkap.</div>";
    } else {
        $message = "<div style='padding: 15px; margin-bottom: 20px; border: 1px solid #f44336; background-color: #ffe6e6; color: #f44336; border-radius: 5px; text-align: center;'>Error: " . $conn->error . "</div>";
    }

}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Okita Catering</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Playfair Display', serif;
            line-height: 1.6;
            background-color: #f8f8f8; 
            color: #333;
            scroll-behavior: smooth;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        ul {
            list-style: none;
        }

        header {
            background-color: #a87f5dd2;
            color: white;
            padding: 15px 15%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo-section {
            display: flex;
            align-items: center;
        }

        .logo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-right: 10px;
        }

        header h1 {
            font-size: 1.8em;
            font-weight: 700;
        }

        nav ul {
            display: flex;
        }

        nav ul li {
            margin-left: 30px;
        }

        nav ul li a {
            padding: 10px 0;
            transition: color 0.3s;
            font-weight: 600;
        }

        nav ul li a:hover {
            color: #f1d7bc;
        }

        .hero {
            text-align: center;
            padding: 100px 5% 50px;
            background: url('3.jpg') no-repeat center center/cover ;
            background-color: #fcfcfc;
            min-height: 70vh;
        }

        .hero h2 {
            font-size: 3em;
            margin-bottom: 20px;
            color: #ffffffff;
        }

        .hero p {
            font-size: 1.2em;
            max-width: 800px;
            margin: 0 auto 40px;
            line-height: 1.8;
            color: white;
        }

        .food-images {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            margin-top: 30px;
            gap: 30px;
        }

        .food-images img {
            border: 5px solid white;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            object-fit: cover;
        }

        .img-left, .img-right {
            width: 250px;
            height: 200px;
            border-radius: 10px;
        }

        .img-center {
            width: 220px;
            height: 300px;
            border-radius: 50%;
        }

        .menu-section {
            padding: 60px 5%;
            background-color: white;
        }

        .menu-title {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 40px;
            color: #a87f5d;
        }

        .menu-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr); 
            gap: 30px;
        }

        .menu-card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s; 
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .menu-card h3 {
            font-size: 1.7em;
            color: #333;
            margin-bottom: 15px;
            border-bottom: 2px solid #a87f5d;
            padding-bottom: 5px;
        }

        .menu-card ul {
            flex-grow: 1; 
        }

        .menu-card ul li {
            font-size: 1.1em;
            margin-bottom: 8px;
            padding-left: 15px;
            position: relative;
        }

        .menu-card ul li::before {
            content: "🍽️";
            position: absolute;
            left: 0;
        }

        .price {
            font-size: 1.8em;
            font-weight: 700;
            color: #a87f5d;
            margin-top: 20px;
            text-align: right;
            padding-top: 10px;
            border-top: 1px dashed #ccc; 
        }

        .gallery-section {
            padding: 60px 5%;
            background-color: #f0f0f0;
        }

        .gallery-title {
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 40px;
            color: #333;
        }

        .gallery-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
        }

        .gallery-item {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .gallery-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-item p {
            padding: 10px;
            font-weight: 600;
            color: #555;
            background-color: #fff;
            font-size: 0.95em;
        }

        #contact-header {
            text-align: center;
            padding: 50px 5% 20px;
        }

        #contact-header h2 {
            font-size: 2.5em;
            color: #a87f5d;
            margin-bottom: 10px;
        }

        #contact-header p {
            font-size: 1.1em;
            margin-bottom: 30px;
        }

        #contact-container {
            display: flex;
            flex-wrap: wrap; 
            justify-content: center;
            padding: 0 5% 60px;
            gap: 40px;
        }

        .contact-box, .info-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .contact-box {
            flex: 1 1 450px;
            max-width: 500px;
        }

        .info-container {
            flex: 1 1 350px;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .contact-box form input,
        .contact-box form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            font-family: inherit;
        }

        .contact-box form textarea {
            resize: vertical;
            min-height: 150px;
        }

        .contact-box form button {
            background-color: #a87f5d;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .contact-box form button:hover {
            background-color: #8c6b4f;
        }

        .contact-info-box h3, .owner-box h3 {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .info-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .info-row img {
            width: 24px;
            height: 24px;
            margin-right: 15px;
        }

        .info-row p {
            font-size: 1em;
        }

        .owner-profile {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .owner-profile img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #a87f5d;
        }

        .owner-name {
            font-weight: 700;
            font-size: 1.2em;
            color: #a87f5d;
        }

        .owner-caption {
            font-style: italic;
            color: #666;
        }

        #footer {
            background-color: #a87f5d;
            color: white;
            display: flex;
            justify-content: center; 
            align-items: center;    
            height: 50px;           
        }

        .footer-bottom {
            font-size: 0.9em;
        }
        @media (max-width: 992px) {
            header {
                flex-direction: column;
                text-align: center;
            }

            nav ul {
                margin-top: 15px;
                justify-content: center;
                flex-wrap: wrap;
            }

            nav ul li {
                margin: 5px 15px;
            }
            
            .menu-container {
                grid-template-columns: repeat(2, 1fr);
            }

            .gallery-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero h2 {
                font-size: 2.5em;
            }
            
            .food-images {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }

            .img-left, .img-right, .img-center {
                margin: 0;
                width: 80%;
                max-width: 250px;
            }

            .img-center {
                height: 250px;
            }

            .menu-container {
                grid-template-columns: 1fr;
            }
            
            #contact-container {
                flex-direction: column;
                align-items: center;
            }
            
            .contact-box, .info-container {
                width: 100%;
                max-width: 90%;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo-section">
            <img src="logo oc.png" class="logo" alt="Okita Catering Logo">
            <h1>OKITA CATERING</h1>
        </div>
        <nav>
            <ul>
                <li><a href="#home">BERANDA</a></li>
                <li><a href="#menu">MENU</a></li>
                <li><a href="#galery">GALERI KAMI</a></li>
                <li><a href="#contact-header">KONTAK</a></li>
            </ul>
        </nav>
    </header>
    <section class="hero" id="home">
        <h2>Selamat Datang!</h2>
        <p>
            Di sini, makanan bukan sekadar hidangan–tapi bagian dari cerita indah Anda.<br>
            Yuk, temukan menu favorit dan biarkan<br>
            kami bantu merayakan hari-hari spesial Anda dengan rasa<br>
            yang tak terlupakan.
        </p>
        <div class="food-images">
            <img src="ayamgoreng.jpg" class="img-left" alt="Makanan Kiri">
            <img src="chef.png" class="img-center" alt="Chef">
            <img src="martabak.jpg" class="img-right" alt="Makanan Kanan">
        </div>
    </section>
    <section class="menu-section" id="menu">
    <h2 class="menu-title">Paket Menu</h2>
    <div class="menu-container">
        <div class="menu-card">
            <h3>Paket 1</h3>
            <ul>
                <li>Nasi Kuning</li>
                <li>Ayam Goreng</li>
                <li>Tahu tempe goreng</li>
                <li>Kerupuk</li>
                <li>Sambal pedas</li>
            </ul>
            <div class="price">Rp. 30. 000</div>
        </div>
        <div class="menu-card">
            <h3>Paket 2</h3>
            <ul>
                <li>Nasi Kuning</li>
                <li>Telur Balado</li>
                <li>Tahu tempe goreng</li>
                <li>Kerupuk</li>
                <li>Sambal bawang</li>
            </ul>
            <div class="price">Rp. 20. 000</div>
        </div>
        <div class="menu-card">
            <h3>Paket 3</h3>
            <ul>
                <li>Nasi Putih</li>
                <li>Ikan Bakar</li>
                <li>Tahu tempe goreng</li>
                <li>Kerupuk</li>
                <li>Sambal Kecap</li>
            </ul>
            <div class="price">Rp. 25. 000</div>
        </div>
        <div class="menu-card">
            <h3>Paket 4</h3>
            <ul>
                <li>Nasi Kuning</li>
                <li>Telur Dadar</li>
                <li>Tahu tempe goreng</li>
                <li>Kerupuk</li>
                <li>Sambal Terasi</li>
            </ul>
            <div class="price">Rp. 15. 000</div>
        </div>
        <div class="menu-card">
            <h3>Paket 5</h3>
            <ul>
                <li>Nasi Putih</li>
                <li>Ayam Bumbu</li>
                <li>Tahu tempe goreng</li>
                <li>Kerupuk</li>
                <li>Sambal bawang</li>
            </ul>
            <div class="price">Rp. 30. 000</div>
        </div>
        <div class="menu-card">
            <h3>Paket 6</h3>
            <ul>
                <li>Nasi Goreng</li>
                <li>Telur dadar</li>
                <li>Sosis Goreng</li>
                <li>Kerupuk</li>
                <li>Sambal pedas</li>
            </ul>
            <div class="price">Rp. 17. 000</div>
        </div>
        <div class="menu-card">
            <h3>Paket 7</h3>
            <ul>
                <li>Nasi Kuning</li>
                <li>Terung Balado</li>
                <li>Tahu tempe goreng</li>
                <li>Kerupuk</li>
                <li>Sambal pedas</li>
            </ul>
            <div class="price">Rp. 10. 000</div>
        </div>
        <div class="menu-card">
            <h3>Paket 8</h3>
            <ul>
                <li>Nasi Putih</li>
                <li>Ayam Bakar</li>
                <li>Tahu tempe goreng</li>
                <li>Kerupuk</li>
                <li>Sambal Kecap</li>
            </ul>
            <div class="price">Rp. 35. 000</div>
        </div>
    </div>
    </section>
        <section class="gallery-section" id="galery">
            <h2 class="gallery-title">Galeri Kami</h2>
            <div class="gallery-container">
                <div class="gallery-item"><img src="ikan.jpg"><p>Ikan Bakar</p></div>
                <div class="gallery-item"><img src="ikan b.jpg"><p>Ikan Balado</p></div>
                <div class="gallery-item"><img src="ikan kris.jpg"><p>Ikan Krispi</p></div>
                <div class="gallery-item"><img src="ayamgoreng.jpg"><p>Ayam Goreng</p></div>
                <div class="gallery-item"><img src="ak.jpg"><p>Ayam Kecap</p></div>

                <div class="gallery-item"><img src="nasi goreng.jpg"><p>Nasi Kuning</p></div>
                <div class="gallery-item"><img src="nasgor.jpg"><p>Nasi Goreng</p></div>
                <div class="gallery-item"><img src="telur.avif"><p>Telur Dadar</p></div>
                <div class="gallery-item"><img src="tlur.avif"><p>Telur Balado</p></div>
                <div class="gallery-item"><img src="terb.jpg"><p>Terung Balado</p></div>

                <div class="gallery-item"><img src="tahu krispi.jpg"><p>Tahu Krispi</p></div>
                <div class="gallery-item"><img src="pecel.avif"><p>Pecel</p></div>
                <div class="gallery-item"><img src="ayambak.jpeg"><p>Ayam Bakar</p></div>
                <div class="gallery-item"><img src="tempe oseng.jpg"><p>Tempe Oseng</p></div>
                <div class="gallery-item"><img src="mie.jpg"><p>Mie Matahari</p></div>

                <div class="gallery-item"><img src="tar.jpeg"><p>Kue Tar</p></div>
                <div class="gallery-item"><img src="kd.jpg"><p>Kue Dadar</p></div>
                <div class="gallery-item"><img src="rot.jpg"><p>Roti Goreng</p></div>
                <div class="gallery-item"><img src="dnt.avif"><p>Donat</p></div>
                <div class="gallery-item"><img src="ptu.jpg"><p>Putu Ayu</p></div>

                <div class="gallery-item"><img src="tb.avif"><p>Terang Bulan</p></div>
                <div class="gallery-item"><img src="lapis.jpg"><p>Kue Lapis</p></div>
                <div class="gallery-item"><img src="mangkok.jpg"><p>Kue Mangkok</p></div>
                <div class="gallery-item"><img src="waji.jpg"><p>Kue Waji</p></div>
                <div class="gallery-item"><img src="klepon.avif"><p>Klepon</p></div>
            </div>
        </section>
    <section id="contact-header">
        <h2>HUBUNGI KAMI</h2>
        <p>Hubungi Kami melalui form di bawah ini atau hubungi kami melalui informasi kontak</p>
    </section>
    <section id="contact-container">
        <div class="contact-box">
            <h3>Kirim Pesan</h3>
            <?php echo $message; ?> 
            
            <form action="#contact-header" method="POST"> 
                <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="subjek" placeholder="Subjek">
                <textarea name="pesan" placeholder="Pesan" required></textarea>
                <button type="submit">Kirim</button>
            </form>
        </div>
        <div class="info-container">
            <div class="contact-info-box">
                <h3>Informasi Kontak</h3>
                <div class="info-row">
                    <img src="al.png" alt="">
                    <p><b>Alamat Catering</b><br>Kab. Ende Kec. Ndori</p>
                </div>
                <div class="info-row">
                    <img src="emai.png" alt="">
                    <p><b>Email</b><br>tiarafazriah08@gmail.com</p>
                </div>
                <div class="info-row">
                    <img src="wa.png" alt="">
                    <p><b>Telephone</b><br>081353884657</p>
                </div>
            </div>
            <div class="owner-box">
                <h3>Pemilik Catering</h3>
                <div class="owner-profile">
                    <img src="own.jpg" alt="Pemilik Catering">
                    <div>
                        <p class="owner-name">Rosni Tanggela</p>
                        <p class="owner-caption">“Hubungi kami kapan saja”</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer id="footer">
        <div class="footer-bottom">
            <p>© 2025 | OKITA CATERING | Semua Hak Cipta Dilindungi.</p>
        </div>
    </footer>
</body>
</html>

<?php 
    $conn->close();
?>