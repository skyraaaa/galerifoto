<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .heading {
            font-size: 3em;
            margin-bottom: 20px;
            color: #007bff;
        }
        .subheading {
            font-size: 1.5em;
            margin-bottom: 40px;
        }
        .button-container {
            margin-bottom: 20px;
        }
        .button-container button {
            padding: 12px 24px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 0 10px;
        }
        .button-container button:hover {
            background-color: #0056b3;
        }
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .gallery img {
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="heading">Selamat datang di galeri digital</h1>
        <p class="subheading">SkyArt Gallery</p>
        <div class="button-container">
            <button onclick="location.href='<?= site_url('Login') ?>'">Login</button>
            <button onclick="location.href='<?= site_url('Register') ?>'">Register</button>
        </div>
        <br>
        <div class="gallery">
            <img src="<?= base_url('assets/images/jalan.jpg')?>" style="width: 250px; height: 210px" alt="Photo 1">
            <img src="<?= base_url('assets/images/pangalengan.jpg')?>" style="width: 250px; height: 210px" alt="Photo 2">
            <img src="<?= base_url('assets/images/jalan1.jpeg')?>" style="width: 250px; height: 210px" alt="Photo 3">
            <img src="<?= base_url('assets/images/jalan2.jpeg')?>" style="width: 250px; height: 210px" alt="Photo 4">
            <img src="<?= base_url('assets/images/jalan3.jpeg')?>" style="width: 250px; height: 210px" alt="Photo 5">
            <img src="<?= base_url('assets/images/jalan4.jpeg')?>" style="width: 250px; height: 210px" alt="Photo 6">
            <!-- Anda dapat menambahkan lebih banyak foto di sini -->
        </div>
    </div>
</body>
</html>
