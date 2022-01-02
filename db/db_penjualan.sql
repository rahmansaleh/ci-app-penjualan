-- -------------------------------------------------------------
-- TablePlus 3.6.2(322)
--
-- https://tableplus.com/
--
-- Database: db_penjualan
-- Generation Time: 2022-01-03 01:19:46.0460
-- -------------------------------------------------------------


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


CREATE TABLE `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga_beli` varchar(100) DEFAULT NULL,
  `harga_jual` varchar(100) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `data_toko` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(80) DEFAULT NULL,
  `nama_pemilik` varchar(80) DEFAULT NULL,
  `no_telepon` varchar(15) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `detail_penjualan` (
  `no_penjualan` varchar(20) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga_barang` varchar(20) DEFAULT NULL,
  `jumlah_barang` int(11) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `sub_total` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `kasir` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kasir` varchar(10) DEFAULT NULL,
  `nama_kasir` varchar(100) DEFAULT NULL,
  `username_kasir` varchar(20) DEFAULT NULL,
  `password_kasir` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pengguna` varchar(10) DEFAULT NULL,
  `nama_pengguna` varchar(100) DEFAULT NULL,
  `username_pengguna` varchar(20) DEFAULT NULL,
  `password_pengguna` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_penjualan` varchar(20) DEFAULT NULL,
  `nama_kasir` varchar(100) DEFAULT NULL,
  `tgl_penjualan` varchar(20) DEFAULT NULL,
  `jam_penjualan` varchar(20) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `nama_pembeli` varchar(255) DEFAULT NULL,
  `piutang` int(11) DEFAULT NULL,
  `hutang` int(11) DEFAULT NULL,
  `bayar` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `stok`, `satuan`) VALUES
('5', '35653739', 'Indomie Goreng', '5500', '11000', '9997', 'pcs'),
('6', '80670849', 'Telur', '500', '1000', '997', 'pcs'),
('7', '36769144', 'Aqua', '4000', '5000', '9995', 'pcs'),
('8', '11970023', 'Roti Donat', '7000', '8000', '997', 'pcs'),
('9', '29005085', 'Roti Coklat Keju', '7000', '8000', '997', 'pcs'),
('10', '10062476', 'Roti Kopi Coklat', '6000', '7000', '998', 'pcs'),
('11', '94178112', 'Roti Kopi Vanilla', '6000', '7000', '998', 'pcs'),
('12', '65949653', 'Gorengan Bakwan', '2500', '3000', '999', 'pcs'),
('13', '66714436', 'Gorengan Tahu', '3000', '3500', '997', 'pcs');

INSERT INTO `data_toko` (`id`, `nama_toko`, `nama_pemilik`, `no_telepon`, `alamat`) VALUES
('1', 'KOPKARTA', 'Rakyat RSUD Tanah Abang', '0', 'Tanah Abang');

INSERT INTO `detail_penjualan` (`no_penjualan`, `nama_barang`, `harga_barang`, `jumlah_barang`, `satuan`, `sub_total`) VALUES
('PJ1641143323', 'Gorengan Tahu', '3500', '2', 'pcs', '7000'),
('PJ1641143323', 'Roti Kopi Vanilla', '7000', '1', 'pcs', '7000'),
('PJ1641145580', 'Indomie Goreng', '11000', '1', 'pcs', '11000'),
('PJ1641145580', 'Telur', '1000', '1', 'pcs', '1000'),
('PJ1641145685', 'Indomie Goreng', '11000', '1', 'pcs', '11000'),
('PJ1641145685', 'Aqua', '5000', '1', 'pcs', '5000'),
('PJ1641146283', 'Telur', '1000', '1', 'pcs', '1000'),
('PJ1641146283', 'Roti Kopi Coklat', '7000', '1', 'pcs', '7000'),
('PJ1641147058', 'Roti Coklat Keju', '8000', '2', 'pcs', '16000'),
('PJ1641147058', 'Roti Donat', '8000', '1', 'pcs', '8000'),
('PJ1641147058', 'Aqua', '5000', '1', 'pcs', '5000');

INSERT INTO `kasir` (`id`, `kode_kasir`, `nama_kasir`, `username_kasir`, `password_kasir`) VALUES
('2', 'KASIR - 01', 'Ari', 'ari', '123456');

INSERT INTO `pengguna` (`id`, `kode_pengguna`, `nama_pengguna`, `username_pengguna`, `password_pengguna`) VALUES
('1', 'PGN01', 'Indah', 'indah', '123456'),
('2', 'PGN02', 'Isti', 'isti', '123456');

INSERT INTO `penjualan` (`id`, `no_penjualan`, `nama_kasir`, `tgl_penjualan`, `jam_penjualan`, `total`, `nama_pembeli`, `piutang`, `hutang`, `bayar`) VALUES
('6', 'PJ1641143323', 'Ari', '03/01/2022', '00:08:43', '14000', 'pak rahmadi', NULL, NULL, '14000'),
('7', 'PJ1641145580', 'Ari', '03/01/2022', '00:46:20', '12000', 'pak latan', NULL, NULL, '12000'),
('8', 'PJ1641145685', 'Ari', '03/01/2022', '00:48:05', '16000', 'pak latan', '0', '16000', '0'),
('9', 'PJ1641146283', 'Ari', '03/01/2022', '00:58:03', '8000', 'pak rahman', '2000', '0', '10000'),
('10', 'PJ1641147058', 'Ari', '03/01/2022', '01:10:58', '29000', 'Yy', '0', '0', '29000');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;