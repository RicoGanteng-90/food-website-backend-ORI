-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 03 Jan 2023 pada 06.23
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_fani_wedding`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `number`, `message`) VALUES
(2, 'Nurul Azizah', 'nur@gmail.com', '08123456789', 'Apakah bisa memungkin saya memesan layanan ini, sedangkan saya lokasinya di Bali?'),
(3, 'Marsha', 'arlin@gmail.com', '098789765456', 'Apakah bisa request jenis makeup kak?');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_products` varchar(500) NOT NULL,
  `total_price` int(11) NOT NULL,
  `order_time` date NOT NULL DEFAULT current_timestamp(),
  `event_time` datetime NOT NULL,
  `order_status` varchar(100) NOT NULL,
  `proof_payment` varchar(255) NOT NULL,
  `payment_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `partners`
--

CREATE TABLE `partners` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `keterangan` varchar(500) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `keterangan`, `price`, `image`) VALUES
(1, 'Makeup Akad', 'Makeup', 'Buatlah hari bahagia dalam hidupmu menjadi hal yang paling diingat. Jangan lupa untuk    membuat Anda menjadi wanita paling cantik saat itu.', 500000, 'akad.jpg'),
(2, 'Paket Makeup (Tanpa Dekorasi)', 'Paket Wedding', '1. Sepasang baju akad.\r\n2. Dua pasang gaun resepsi.\r\n3. Henna art.\r\n4. Melati.\r\n5. Softlens.', 3000000, '277963033_683817695996239_6100610082405590601_n.jpg'),
(3, 'Paket Dekorasi Indoor', 'Paket Wedding', '1. Sepasang baju akad.\r\n2. Dua pasang gaun resepsi.\r\n3. Henna art.\r\n4. Melati.\r\n5. Softlens.\r\n6. Dekorasi.', 4000000, 'dekor-indor.jpg'),
(5, 'Makeup Prewedding', 'Makeup', 'Rasanya gak sempurna jika tidak memiliki foto prewedding. Tampil cantik saat momen tersebut itu harus lohhh.\r\n*tidak termasuk baju/gaun.', 400000, 'Prewed.jpg'),
(6, 'Makeup Wisuda', 'Makeup', 'Tidak mau repot merias wajah namun ingin tampil cantik di acara wisuda nanti? Tenang dari klasik makeup  hingga semi bold makeup, kami menerima semua request-an dari kalian.\r\n*tidak termasuk baju/gaun.', 300000, 'wisuda.jpg'),
(7, 'Paket Dekorasi 4m', 'Paket Wedding', '1. Makeup.\r\n2. Rias manten 3x (satu akad dan dua resepsi).\r\n3. Rias dua kembar mayang.\r\n4. Rias orang tua.\r\n5. Henna art.\r\n6. Melati dan bouquet.\r\n7. Softlens.', 5500000, '4m.jpg'),
(8, 'Paket Dekorasi 6m', 'Paket Wedding', '1. Makeup.\r\n2. Rias manten 3x (satu akad dan dua resepsi).\r\n3. Rias dua kembar mayang.\r\n4. Rias dua terima tamu.\r\n5. Rias orang tua dan besan.\r\n6. Henna art.\r\n7. Melati dan bouquet.\r\n8. Softlens.', 6500000, '6m.jpg'),
(9, 'Paket Dekorasi 8m', 'Paket Wedding', '1. Makeup.\r\n2. Rias manten 3x (1 akad dan 2 resepsi).\r\n3. Rias 2 kembar mayang.\r\n4. Rias 4 terima tamu.\r\n5. Rias orang tua dan besan.\r\n6. Henna art.\r\n7. Melati dan bouquet.\r\n8. Softlens.\r\n9. Bunga pintu masuk.', 7500000, '8m.jpg'),
(10, 'Solo Putri Non Hijab', 'Extra Wedding', 'Penggunaan kebaya berbahan beludru panjang  dengan hiasan lung-lungan bordiran emas.\r\n*termasuk dengan MC, janur, dan alat temu manten.', 1000000, 'solo.jpg'),
(11, 'Jogja Putri Non Hijab', 'Extra Wedding', 'Hampir mirip dengan Solo. Menggunakan riasan yang lebih ekonomis dengan sapuan warna hitam ukuran spesifik, tata rias dan sanggul khas Jawa. \r\n*termasuk dengan MC, janur, dan alat temu manten.', 600000, 'jogja.jpeg'),
(12, 'Sunda Putri Non Hijab', 'Extra Wedding', 'Lain halnya dengan pengantin Sunda putri yang lebih sederhana tanpa mengenakan mahkota. Namun, tiara berukuran kecil  disematkan di atas sanggul puspasari.\r\n*termasuk dengan MC, janur, dan alat temu manten.', 400000, 'sunda.jpg'),
(13, 'Paket Dekorasi 10m', 'Paket Wedding', '1. Makeup.\r\n2. Rias manten 3x (satu akad dan dua resepsi).\r\n3. Rias dua kembar mayang.\r\n4. Rias enam terima tamu.\r\n5. Rias orang tua dan besan.\r\n6. Henna art.\r\n7. Melati dan bouquet.\r\n8. Softlens.\r\n9. Bunga pintu masuk.', 8500000, '10m.jpg'),
(14, '36 foto', 'Paket Foto', 'Cocok untuk anda yang hanya foto bersama pasangan dan orang-orang penting saja. Kurang? yuks kepaket foto kedua.', 400000, 'foto 1.png'),
(15, '72 foto', 'Paket Foto', 'Jumlahnya 2x lebih banyak dengan paket pertama. Ingin lebih puas berfoto disaat acara pernikahan Anda? Pilih paket unlimited saja!', 800000, 'foto 2.png'),
(16, 'Unlimited foto', 'Paket Foto', 'Abadikan acara pernikahan Anda tanpa memikiran limit foto!', 1500000, 'foto 3.png'),
(17, 'Temu Manten', 'Extra Wedding', 'Adat pertemuan antara pengantin wanita dengan pengantin pria di rumah kediaman wanita untuk melaksanakan prosesi perkawinan secara adat.\r\n*termasuk dengan MC, janur, dan alat temu manten.', 1000000, 'temu-manten.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `review` varchar(500) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `number`, `password`, `address`) VALUES
(1, 'arlinda', 'arlin43@gmail.com', '0852493637', '618dcdfb0cd9ae4481164961c4796dd8e3930c8d', 'Jl Karimata V, Sumber Sari, Jember');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Id_customer` (`user_id`),
  ADD KEY `Id_produk` (`pid`);

--
-- Indeks untuk tabel `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`user_id`);

--
-- Indeks untuk tabel `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
