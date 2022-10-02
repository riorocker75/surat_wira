-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2022 at 10:33 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surat_wira`
--

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE `agama` (
  `id` int(90) NOT NULL,
  `agama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id`, `agama`) VALUES
(1, 'Islam'),
(2, 'Kristen'),
(3, 'Protestan'),
(4, 'Konghuchu'),
(5, 'Hindu'),
(6, 'Katholik'),
(7, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `dah_options`
--

CREATE TABLE `dah_options` (
  `option_id` int(11) NOT NULL,
  `option_name` varchar(60) NOT NULL,
  `option_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dah_options`
--

INSERT INTO `dah_options` (`option_id`, `option_name`, `option_value`) VALUES
(1, 'blog_name', 'Sistem Arsip Kantor Desa Kebun Balok'),
(2, 'blog_description', 'Sebuah Aplikasi Arsip  '),
(3, 'blog_logo', '884488349_logoutu1.png'),
(12, 'blog_welcome', ''),
(13, 'struktur', '<table border=\"0\" cellpadding=\"4\" cellspacing=\"2\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Kepala Desa&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>\r\n			<td>Nasrul Fadhil, ST</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sekretaris&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>\r\n			<td>Abdullah, SE</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tuha 8&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td>\r\n			<td>Tgk Halim, S.Pd</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bendahara&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>\r\n			<td>Abdullah, S.Sos</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tuha 4&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td>\r\n			<td>1. Tarmizi,&nbsp; S.Pd</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>2. Syarifuddin&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>3. Fakri</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>4. Khalil</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>5. Iskandar</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>6. Idris</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>7. Zainabon</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kaur Pemerintahan&nbsp; &nbsp; &nbsp;&nbsp;</td>\r\n			<td>Abdul Bahri</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kaur Pembangunan&nbsp; &nbsp; &nbsp;&nbsp;</td>\r\n			<td>Saifunnur</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kaur Kesra&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</td>\r\n			<td>Tgk Rasyidi.Y</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kadus Bak Buloh&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</td>\r\n			<td>Muhammad</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kadus Tgk Di kulam&nbsp; &nbsp; &nbsp;&nbsp;</td>\r\n			<td>Tarmizi.B</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kadus Lampoh Kubu&nbsp; &nbsp; &nbsp;&nbsp;</td>\r\n			<td>Muhammad Rizal, S.Pd</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),
(14, 'pengembang', '<table border=\"0\" cellpadding=\"4\" cellspacing=\"2\">\r\n	<tbody>\r\n		<tr>\r\n			<td><strong>Nama&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></td>\r\n			<td>: Muhammad Ichsan</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>NIM</strong></td>\r\n			<td>: 1657301062</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Tempat Lahir</strong></td>\r\n			<td>: Ulee Cibrek</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Tanggal Lahir</strong></td>\r\n			<td>: 11 Agustus 1998</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Alamat</strong></td>\r\n			<td>: Desa Ulee Ceubrek</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Nomor HP</strong></td>\r\n			<td>: 0822-7924-8267</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Email</strong></td>\r\n			<td>: ichsanaifaichravaro1998@gmail.com</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Prodi</strong></td>\r\n			<td>: Teknik Informatika</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Jurusan</strong></td>\r\n			<td>: Teknologi Informasi dan Komputer</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Kampus</strong></td>\r\n			<td>: Politeknik Negeri Lhokseumawe</td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong>Judul TGA</strong></td>\r\n			<td>: Sistem Informasi Pelayanan Administrasi Kependudukan Berbasis Web</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp; ( Studi Kasus : Desa Ulee Ceubrek Kecamatan Meurah Mulia Kabupaten</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp; Aceh Utara )</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),
(15, 'umum', '<table border=\"0\" cellpadding=\"6\" cellspacing=\"4\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Luas Wilayah&nbsp; &nbsp; &nbsp; &nbsp;</td>\r\n			<td>60 Ha</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jumlah Dusun</td>\r\n			<td>3</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>1. Dusun Bak Buloh</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>2. Dusun Tgk Di Kulam</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>3. Dusun Lampoh Kubu</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n'),
(16, 'nama_desa', 'Banyuasin'),
(17, 'pelayanan_surat', '<ol>\r\n	<li>Surat Keterangan Kartu Keluarga Baru</li>\r\n	<li>Surat Keterangan Penambahan Anggota KK</li>\r\n	<li>Surat Keterangan Pengurangan Anggota KK</li>\r\n	<li>Surat Keterangan KTP Baru</li>\r\n	<li>Surat Keterangan Kehilangan KTP</li>\r\n	<li>Surat Keterangan Kelahiran</li>\r\n	<li>Surat Keterangan Meninggal Dunia</li>\r\n	<li>Surat Keterangan Pindah Penduduk</li>\r\n	<li>Surat Keterangan Kurang Mampu(Miskin)</li>\r\n	<li>Surat Keterangan Sudah Menikah</li>\r\n	<li>Surat Keterangan Belum Menikah</li>\r\n	<li>Surat Keterangan Bercerai</li>\r\n</ol>\r\n'),
(18, 'foto_dev', ''),
(22, 'nama_desa', 'Banyuasin');

-- --------------------------------------------------------

--
-- Table structure for table `histori_surat`
--

CREATE TABLE `histori_surat` (
  `id` int(11) NOT NULL,
  `id_surat` varchar(100) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id` int(70) NOT NULL,
  `pekerjaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id`, `pekerjaan`) VALUES
(1, 'Petani/Pekebun'),
(2, 'PNS (Pegawai Negeri Sipil)'),
(3, 'Nelayan'),
(4, 'Dokter'),
(5, 'Wiraswasta'),
(6, 'Lainnya'),
(7, 'Mengurus Rumah Tangga'),
(8, 'Pelajar/Mahasiswa'),
(9, 'Belum/Tidak Bekerja'),
(10, 'Perawat'),
(11, 'Bidan'),
(12, 'Guru'),
(13, 'Pedagang'),
(14, 'Sopir');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id` bigint(20) NOT NULL,
  `pendidikan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`id`, `pendidikan`) VALUES
(2, 'SD/Sederajat'),
(3, 'SLTA/Sederajat'),
(4, 'SLTP/Sederajat'),
(5, 'Diploma I'),
(6, 'Diploma II'),
(7, 'Diploma III'),
(8, 'Diploma IV/Strata I'),
(10, 'Strata II'),
(11, 'Strata III'),
(12, 'Lainnya'),
(13, 'Tidak/Belum Sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id` bigint(60) NOT NULL,
  `nama` text NOT NULL,
  `nik` text NOT NULL,
  `nomor_kk` text NOT NULL,
  `jenis_kelamin` text NOT NULL,
  `tempat_lahir` text NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama` text NOT NULL,
  `pendidikan` text NOT NULL,
  `pekerjaan` text NOT NULL,
  `no_hp` text NOT NULL,
  `status_nikah` text NOT NULL,
  `status_hub_keluarga` text NOT NULL,
  `status_warga_negara` text NOT NULL,
  `nama_ayah` text NOT NULL,
  `nama_ibu` text NOT NULL,
  `gol_darah` varchar(56) NOT NULL,
  `dusun` text NOT NULL,
  `desa` text NOT NULL,
  `kecamatan` text NOT NULL,
  `kabupaten` text NOT NULL,
  `kode_pos` text NOT NULL,
  `provinsi` text NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id`, `nama`, `nik`, `nomor_kk`, `jenis_kelamin`, `tempat_lahir`, `tgl_lahir`, `agama`, `pendidikan`, `pekerjaan`, `no_hp`, `status_nikah`, `status_hub_keluarga`, `status_warga_negara`, `nama_ayah`, `nama_ibu`, `gol_darah`, `dusun`, `desa`, `kecamatan`, `kabupaten`, `kode_pos`, `provinsi`, `alamat`) VALUES
(10, 'Abdullah', '1108071404690001', '1108071711060771', 'pria', 'Ulee Ceubrek', '1969-04-14', 'Islam', 'Diploma IV/Strata I', 'PNS (Pegawai Negeri Sipil)', '085275079661', 'menikah', 'kepala', 'wni', 'M. Jalil', 'Tihabibah', 'o', 'lampoh', 'Ulee Ceubrek', 'Meurah Mulia', 'Aceh Utara', '24372', 'Aceh', ''),
(11, 'Nasrul Fadhil', '1108071012820003', '1108072108140002', 'pria', 'Kandang', '1982-12-10', 'Islam', 'Diploma IV/Strata I', 'Wiraswasta', '081360023061', 'menikah', 'kepala', 'wni', 'Umar Ahmad', 'Khadijah Umar', 'a', 'lampoh', 'Ulee Ceubrek', 'Meurah Mulia', 'Aceh Utara', '24372', 'Aceh', ''),
(12, 'Yunita Fitriani', '1108075506910001', '1108072108140002', 'wanita', 'Ulee Ceubrek', '1982-12-10', 'Islam', 'Diploma IV/Strata I', 'Mengurus Rumah Tangga', '082369906468', 'menikah', 'istri', 'wni', 'M. Jafar', 'Hendon', 'b', 'lampoh', 'Ulee Ceubrek', 'Meurah Mulia', 'Aceh Utara', '24372', 'Aceh', 'diatas tanah ajha'),
(13, 'Muhammad Rafa Azka Putra', '1108072406150001', '1108072108140002', 'pria', 'Lhokseumawe', '2015-06-24', 'Islam', 'Tidak/Belum Sekolah', 'Belum/Tidak Bekerja', '', 'belum_menikah', 'anak', 'wni', 'Nasrul Fadhil', 'Yunita Fitriani', '', 'lampoh', 'Ulee Ceubrek', 'Meurah Mulia', 'Aceh Utara', '24372', 'Aceh', ''),
(14, 'Nurjannah', '1108074909780001', '1108071711060771', 'wanita', 'Gampong Nibong', '1978-09-09', 'Islam', 'SLTP/Sederajat', 'Mengurus Rumah Tangga', '', 'menikah', 'istri', 'wni', 'Syamaun', 'Khadijah', 'o', 'lampoh', 'Ulee Ceubrek', 'Meurah Mulia', 'Aceh Utara', '24372', 'Aceh', ''),
(15, 'Muhammad Ichsan', '1108071108980001', '1108071711060771', 'pria', 'Ulee Cibrek', '1998-08-11', 'Islam', 'SLTA/Sederajat', 'Pelajar/Mahasiswa', '082279248267', 'belum_menikah', 'anak', 'wni', 'Abdullah', 'Nurjannah', 'o', 'lampoh', 'Ulee Ceubrek', 'Meurah Mulia', 'Aceh Utara', '24372', 'Aceh', ''),
(16, 'Liza Rahmati', '1108076302010001', '1108071711060771', 'wanita', 'Ulee Cibrek', '2001-02-23', 'Islam', 'SLTA/Sederajat', 'Pelajar/Mahasiswa', '', 'belum_menikah', 'anak', 'wni', 'Abdullah', 'Nurjannah', 'o', 'lampoh', 'Ulee Ceubrek', 'Meurah Mulia', 'Aceh Utara', '24372', 'Aceh', ''),
(17, 'Diniati', '1108074906040001', '1108071711060771', 'wanita', 'Ulee Cibrek', '2004-06-09', 'Islam', 'SLTP/Sederajat', 'Pelajar/Mahasiswa', '', 'belum_menikah', 'anak', 'wni', 'Abdullah', 'Nurjannah', 'o', 'lampoh', 'Ulee Ceubrek', 'Meurah Mulia', 'Aceh Utara', '24372', 'Aceh', ''),
(18, 'Abdul Muttaleb', '1108070107540117', '1108071711060571', 'pria', 'Paloh Lada', '1954-07-01', 'Islam', 'SD/Sederajat', 'Petani/Pekebun', '', 'menikah', 'kepala', 'wni', 'M. Yusuf', 'Tihadanah', '', 'buloh', 'Ulee Ceubrek', 'Meurah Mulia', 'Aceh Utara', '24372', 'Aceh', ''),
(20, 'Hasan Basri', '1108072606920001', '1108071711060571', 'pria', 'Ulee Ceubrek', '1992-06-26', 'Islam', 'SLTA/Sederajat', 'Pelajar/Mahasiswa', '', 'belum_menikah', 'anak', 'wni', 'Abdul Muttaleb', 'Salbiah', '', 'buloh', 'Ulee Ceubrek', 'Meurah Mulia', 'Aceh Utara', '24372', 'Aceh', ''),
(21, 'Halimaton Sakdiah', '1108074605940002', '1108071711060571', 'wanita', 'Ulee Ceubrek', '1994-05-06', 'Islam', 'SLTA/Sederajat', 'Pelajar/Mahasiswa', '', 'belum_menikah', 'anak', 'wni', 'Abdul Muttaleb', 'Salbiah', '', 'buloh', 'Ulee Ceubrek', 'Meurah Mulia', 'Aceh Utara', '24372', 'Aceh', '');

-- --------------------------------------------------------

--
-- Table structure for table `surat_datang`
--

CREATE TABLE `surat_datang` (
  `id` int(11) NOT NULL,
  `no_surat_pindah` text NOT NULL,
  `tanggal` date NOT NULL,
  `nama_datang` text NOT NULL,
  `nama_kepala` text NOT NULL,
  `jenis_kelamin` text NOT NULL,
  `tmp_tgl_lhr` text NOT NULL,
  `nik` text NOT NULL,
  `daerah_asal` text NOT NULL,
  `kecamatan` text NOT NULL,
  `kabupaten` text NOT NULL,
  `provinsi` text NOT NULL,
  `alamat` text NOT NULL,
  `lampiran` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_datang`
--

INSERT INTO `surat_datang` (`id`, `no_surat_pindah`, `tanggal`, `nama_datang`, `nama_kepala`, `jenis_kelamin`, `tmp_tgl_lhr`, `nik`, `daerah_asal`, `kecamatan`, `kabupaten`, `provinsi`, `alamat`, `lampiran`, `status`) VALUES
(2, 'adsdasd', '2022-04-24', 'asdasd', 'asdasd', 'pria', 'asdasd', '123123', 'asdasd', 'asd', 'asd', 'asd', 'asd', '8190_fdf.PNG', '1');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `id` int(10) NOT NULL,
  `pengirim` text NOT NULL,
  `no_surat` varchar(120) NOT NULL,
  `tanggal` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `lampiran` text NOT NULL,
  `deskripsi` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`id`, `pengirim`, `no_surat`, `tanggal`, `tgl_keluar`, `lampiran`, `deskripsi`, `status`) VALUES
(2, 'dnasjdnajs', 'asdasd', '2022-04-24', '2022-04-24', '3906_fdf.PNG', 'dasdasd', '');

-- --------------------------------------------------------

--
-- Table structure for table `surat_ket`
--

CREATE TABLE `surat_ket` (
  `id` int(11) NOT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `pemohon` text NOT NULL,
  `keperluan` text NOT NULL,
  `tanggal` date NOT NULL,
  `alamat` text NOT NULL,
  `lampiran` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_ket`
--

INSERT INTO `surat_ket` (`id`, `jenis_surat`, `no_surat`, `pemohon`, `keperluan`, `tanggal`, `alamat`, `lampiran`, `status`) VALUES
(2, 'sdasd', '12312', 'asdasd', 'adsdas', '2022-04-24', 'asdas', '2560_ax.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `id` int(11) NOT NULL,
  `pengirim` varchar(30) NOT NULL,
  `no_surat` text NOT NULL,
  `tanggal` date NOT NULL,
  `tgl_masuk` date NOT NULL,
  `lampiran` text NOT NULL,
  `deskripsi` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`id`, `pengirim`, `no_surat`, `tanggal`, `tgl_masuk`, `lampiran`, `deskripsi`, `status`) VALUES
(4, 'Kementrian Pendidikan', '8818772hh', '2022-04-24', '2022-04-24', '3491_MAINTENANCE-1170x1034.png', 'asdas', '');

-- --------------------------------------------------------

--
-- Table structure for table `surat_mati`
--

CREATE TABLE `surat_mati` (
  `id` int(11) NOT NULL,
  `no_surat` text NOT NULL,
  `nama_kepala` text NOT NULL,
  `nama_meninggal` text NOT NULL,
  `jenis_kelamin` text NOT NULL,
  `no_kk` text NOT NULL,
  `nik` text NOT NULL,
  `tanggal` date NOT NULL,
  `tgl_lhr` text NOT NULL,
  `tgl_meninggal` text NOT NULL,
  `alamat` text NOT NULL,
  `pelapor` text NOT NULL,
  `lampiran` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_mati`
--

INSERT INTO `surat_mati` (`id`, `no_surat`, `nama_kepala`, `nama_meninggal`, `jenis_kelamin`, `no_kk`, `nik`, `tanggal`, `tgl_lhr`, `tgl_meninggal`, `alamat`, `pelapor`, `lampiran`, `status`) VALUES
(2, 'dasd', 'asdasdasda', 'asdas', 'pria', '123123', 'sdfsdf', '2022-04-24', '2022-04-24', '2022-04-24', 'asdasd', 'asdas', '5825_ax.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `surat_mohon`
--

CREATE TABLE `surat_mohon` (
  `id` int(11) NOT NULL,
  `surat_id` varchar(20) NOT NULL,
  `surat_mohon_id` text NOT NULL,
  `penduduk_id` text NOT NULL,
  `jenis_surat` text NOT NULL,
  `nomor_surat` text NOT NULL,
  `tgl_ajukan` datetime NOT NULL,
  `tgl_surat` datetime NOT NULL,
  `info` text NOT NULL,
  `ket_surat` text NOT NULL,
  `format_surat` text NOT NULL,
  `upload` text NOT NULL,
  `notif` text NOT NULL COMMENT '1=review, 2=terima,tolak, 3=sudah lihat',
  `status_surat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surat_pindah`
--

CREATE TABLE `surat_pindah` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pindah` text NOT NULL,
  `nama_kepala` text NOT NULL,
  `no_kk` text NOT NULL,
  `nik` text NOT NULL,
  `daerah_tujuan` text NOT NULL,
  `kecamatan` text NOT NULL,
  `kabupaten` text NOT NULL,
  `provinsi` text NOT NULL,
  `lampiran` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_pindah`
--

INSERT INTO `surat_pindah` (`id`, `no_surat`, `tanggal`, `nama_pindah`, `nama_kepala`, `no_kk`, `nik`, `daerah_tujuan`, `kecamatan`, `kabupaten`, `provinsi`, `lampiran`, `status`) VALUES
(2, 'dasdasd123123', '2022-04-24', 'asdasd', 'Sumanto', '123123', '123123', 'asdasdasd', 'asd', 'asd', 'asd', '5072_bookcov.png', '');

-- --------------------------------------------------------

--
-- Table structure for table `surat_sengketa`
--

CREATE TABLE `surat_sengketa` (
  `id` int(11) NOT NULL,
  `jenis_surat` varchar(100) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `pemohon` varchar(100) NOT NULL,
  `keperluan` text NOT NULL,
  `tanggal` date NOT NULL,
  `alamat` text NOT NULL,
  `lampiran` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_sengketa`
--

INSERT INTO `surat_sengketa` (`id`, `jenis_surat`, `no_surat`, `pemohon`, `keperluan`, `tanggal`, `alamat`, `lampiran`, `status`) VALUES
(2, 'qwejqwej', '123', 'dasd', 'adsd', '2022-04-24', 'asdasd', '6162_fffg.PNG', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(50) NOT NULL,
  `user_lvl` text NOT NULL,
  `user_status` text NOT NULL,
  `user_login` text NOT NULL,
  `user_name` text NOT NULL,
  `user_pass` text NOT NULL,
  `user_email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_lvl`, `user_status`, `user_login`, `user_name`, `user_pass`, `user_email`) VALUES
(13, 'admin', '1', 'admin', 'wira', '21232f297a57a5a743894a0e4a801fc3', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dah_options`
--
ALTER TABLE `dah_options`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `histori_surat`
--
ALTER TABLE `histori_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_datang`
--
ALTER TABLE `surat_datang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_ket`
--
ALTER TABLE `surat_ket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_mati`
--
ALTER TABLE `surat_mati`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_mohon`
--
ALTER TABLE `surat_mohon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_pindah`
--
ALTER TABLE `surat_pindah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_sengketa`
--
ALTER TABLE `surat_sengketa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `id` int(90) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dah_options`
--
ALTER TABLE `dah_options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `histori_surat`
--
ALTER TABLE `histori_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id` int(70) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id` bigint(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `surat_datang`
--
ALTER TABLE `surat_datang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surat_ket`
--
ALTER TABLE `surat_ket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `surat_mati`
--
ALTER TABLE `surat_mati`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surat_mohon`
--
ALTER TABLE `surat_mohon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `surat_pindah`
--
ALTER TABLE `surat_pindah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surat_sengketa`
--
ALTER TABLE `surat_sengketa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=282;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
