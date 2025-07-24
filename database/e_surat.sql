-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2020 at 09:41 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
--
-- Database: `e_surat`
--
-- --------------------------------------------------------
--
-- Table structure for table `m_dispos`
--
CREATE TABLE `m_dispos` (
  `id_dispos` int(11) NOT NULL,
  `nama_bagian` varchar(255) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `m_dispos`
--
INSERT INTO `m_dispos` (`id_dispos`, `nama_bagian`) VALUES
(1, 'Bagian Keuangan'),
(2, 'Bagian Perencanaan');
-- --------------------------------------------------------
--
-- Table structure for table `ref_klasifikasi`
--
CREATE TABLE `ref_klasifikasi` (
  `id` int(4) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `uraian` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `ref_klasifikasi`
--
INSERT INTO `ref_klasifikasi` (`id`, `kode`, `nama`, `uraian`) VALUES
(1, 'HK', 'HUKUM', 'HUKUM'),
(2, 'HK.00', 'PERATURAN PERUNDANG-UNDANGAN', 'Surat-surat yang berkenaan dengan proses penyusunan peraturan perundang-undangan produk Mahkamah Agung, dari konsep / draf smpai selesai, maupun produk peraturan perundang-undangan yang diterima baik intern Mahkamah Agung maupun dari instansi lainnya.'),
(3, 'HK.00.1', 'PERATURAN PERUNDANG-UNDANGAN', 'Undang-undang, termasuk PERPU'),
(4, 'HK.00.2', 'PERATURAN PERUNDANG-UNDANGAN', 'Peraturan Pemerintah.'),
(5, 'HK.00.3', 'PERATURAN PERUNDANG-UNDANGAN', 'Keputusan Presiden, Instruksi Presiden, Penetapan Presiden.'),
(6, 'HK.00.4', 'PERATURAN PERUNDANG-UNDANGAN', 'Peraturan Ketua Mahkamah Agung RI.'),
(7, 'HK.00.5', 'PERATURAN PERUNDANG-UNDANGAN', 'Keputusan Ketua Mahkamah Agung, Instruksi Mahkamah Agung.'),
(8, 'HK.00.6', 'PERATURAN PERUNDANG-UNDANGAN', 'Keputusan Pejabat Eselon I.'),
(9, 'HK.00.7', 'PERATURAN PERUNDANG-UNDANGAN', 'Surat Edaran Pejabat Eselon I.'),
(10, 'HK.00.8', 'PERATURAN PERUNDANG-UNDANGAN', 'Peraturan Pengadilan Tingkat Banding dan Tingkat Pertama.'),
(11, 'HK.00.9', 'PERATURAN PERUNDANG-UNDANGAN', 'Peraturan PEMDA Tk. I, dan PEMDA Tk. II.'),
(12, 'HK.01', 'PIDANA', 'Surat-surat yang berkenaan dengan penyelesaian perkara pidana, baik pidana kejahatan maupun pidana pelanggaran.'),
(176, 'HK.02', 'PERDATA', 'Surat-surat yang berkenaan dengan penyelesaian perkara perdata, baik gugatan maupun permohonan.'),
(177, 'HK.03', 'PERDATA NIAGA', 'Surat-surat yang berkenaan dengan penyelesaian perkara perdata niaga.'),
(178, 'HK.04', 'PIDANA MILITER', 'Surat-surat yang berkenaan dengan penyelesaian perkara pidana militer.'),
(179, 'HK.05', 'PERDATA AGAMA', 'Surat-surat yang berkenaan dengan penyelesaian perkara perdata agama.'),
(180, 'HK.06', 'TATA USAHA NEGARA', 'Surat-surat yang berkenaan dengan penyelesaian perkara Tata Usaha Negara.'),
(181, 'HK.07', 'PIDANA KHUSUS', 'Surat-surat yang berkenaan dengan penyelesaian perkara pidana khusus.'),
(182, 'HM', 'KEHUMASAN', 'KEHUMASAN'),
(183, 'HM.00', 'PENERANGAN', '	\r\nSurat-surat yang berkenaan dengan segala kegiatan penerangan terhadap masyarakat tentang kegiatan Mahkamah Agung RI, termasuk di dalamnya :\r\n- konferensi pers,\r\n- pameran,\r\n- wawancara,\r\n- dan penerangan dalam media massa lainnya.'),
(184, 'HM.01', 'HUBUNGAN DAN KEPROTOKOLAN', '-'),
(185, 'HM.01.1', 'HUBUNGAN', 'Surat-surat yang berhubungan dengan segala kegiatan intern Mahkamah Agung RI, dan antara Mahkamah Agung RI dengan pihak lain, baik dalam maupun luar negeri dalam bidang kehumasan, koordinasi, antara lain :\r\n- bakohumas,\r\n- hearing DPR,\r\n- kelompok kerja (POKJA),\r\n- dan organisasi-organisasi mass media.'),
(186, 'HM.01.2', 'KEPROTOKOLAN', 'Surat-surat yang berkaan dengan masalah keprotokolan, seperti :\r\n- tamu-tamu pimpinan Mahkamah Agung RI baik dalam maupun luar negeri,\r\n- kunjungan kerja pimpinan dan pejabat Mahkamah Agung RI,\r\n- upacara hari nasional, dan\r\n- HUT Mahkamah Agung RI.'),
(187, 'HM.02', 'DOKUMENTASI, KEPUSTAKAAN DAN TEKNOLOGI INFORMASI', '-'),
(188, 'HM.02.1', 'DOKUMENTASI', 'Surat-surat yang berkenaan dengan kegiatan yang berhubungan dengan penyediaan / pengumpulan bahan / dokumentasi, termasuk penyebarannya.'),
(189, 'HM.02.2', 'KEPUSTAKAAN', 'Surat-surat yang berkenaan dengan kegiatan yang berhubungan dengan penyediaan, pengumpulan, dan penataan bahan-bahan kepustakaan.'),
(190, 'HM.02.3', 'TEKNOLOGI INFORMASI', 'Surat-surat yang berkenaan dengan kegiatan yang berhubungan dengan perencanaan, penyediaan, pemeliharaan, pengelolaan dan hal-hal lain yang berkaitan dengan teknologi informasi.'),
(191, 'KP', 'KEPEGAWAIAN', '-'),
(192, 'KP.00', 'PENGADAAN', '-'),
(193, 'KP.00.1', 'FORMASI', 'Surat-surat yang berkenaan dengan perencanaan pengadaan pegawai, nota usul formasi, sampai dengan persetujuan termasuk di dalamnya besetting.'),
(194, 'KP.00.2', 'PENERIMAAN', 'Surat-surat yang berkenaan dengan penerimaan pegawai baru, mulai dari pengumuman penerimaan, panggilan testing / psikotes / clearance test, sampai dengan pengumuman yang diterima, termasuk di dalamnya pegawai honorer, seperti :\r\n- satpam,\r\n- pramusaji,\r\n- supir.'),
(195, 'KP.00.3', 'PENGANGKATAN', 'Surat-surat yang berkenaan dengan seluruh proses pengangkatan, dan penempatan calon pegawai (CPNS) sampai dengan menjadi pegawai (PNS), mulai dari persyaratan, pemeriksaan kesehatan dan keterangan-keterangan lainnya yang berhubungan dengan pengangkatan.'),
(196, 'KP.01', 'TATA USAHA KEPEGAWAIAN', '-'),
(197, 'KP.01.1', 'IZIN / DISPENSASI', 'Surat-surat yang berkenaan dengan izin tidak masuk kerja atas permintaan yang diajukan oleh pegawai yang bersangkutan, maupun dispensasi yang diajukan oleh instansi lain termasuk tugas pada instansi lain baik tugas belajar maupun tugas di luar negeri bagi pegawai Mahkamah Agung RI.'),
(198, 'KP.01.2', 'KETERANGAN', 'Surat-surat yang berkenaan dengan keterangan pegawai dan keluarganya, termasuk surat-surat yang berkaitan dengan NIP, KARPEG, KARSU / KARIS dan data pegawai / pejabat.'),
(199, 'KP.02', 'PENILAIAN DAN HUKUMAN', '-'),
(200, 'KP.02.1', 'PENILAIAN', 'Surat-surat yang berkenaan dengan penilaian pelaksanaan pekerjaan, disiplin pegawai, pemalsuan administrasi kepegawaian, rehabilitasi dan pemulihan nama baik.'),
(201, 'KP.02.2', 'HUKUMAN', 'Surat-surat yang berkenaan dengan hukuman pegawai, meliputi :\r\n- teguran tertulis,\r\n- pernyataan tidak puas secara tertulis,\r\n- penundaan kenaikan gaji berkala untuk paling lama 1 (satu) tahun,\r\n- penurunan gaji sebesar 1 (satu) kalli kenaikan gaji berkala untuk paling lama 1 (satu) tahun,\r\n- penundaan kenaikan pangkat untuk paling lama 1 (satu) tahun,\r\n- penurunan pangkat pada pangkat yang setingkat lebih rendah untuk paling lama 1 (satu) tahun,\r\n- pembebasan dan jabatan,\r\n- pemberhentian dengan hormat tidak atas permintaan sendiri sebagai PNS / tenaga teknis / tenaga fungsional,\r\n- pemberhentian tidak dengan hormat sebagai PNS.'),
(202, 'KP.03', 'PEMBINAAN MENTAL', 'Surat-surat yang berkenaan dengan pembinaan mental pegawai, termasuk di dalamnya pembinaan kerohanian.'),
(203, 'KP.04', 'MUTASI', '-'),
(204, 'KP.04.1', 'KEPANGKATAN', 'Surat-surat yang berkenaan dengan kenaikan dengan kenaikan pangkat / golongan, termasuk di dalamnya ujian dinas, ujian penyesuaian ijazah, dan daftar urut kepangkatan.'),
(205, 'KP.04.2', 'KENAIKAN GAJI BERKALA', 'Surat-surat yang berkenaan dengan kenaikan gaji berkala.'),
(206, 'KP.04.3', 'PENYESUAIAN MASA KERJA', 'Surat-surat yang berkenaan dengan penyesuaian masa kerja untuk perubahan ruang gaji dan impassing.'),
(207, 'KP.04.4', 'PENYESUAIAN TUNJANGAN KELUARGA', 'Surat-surat yang berkenaan dengan penyesuaian tunjangan keluarga.'),
(208, 'KP.04.5', 'ALIH TUGAS', 'Surat-surat yang berkenaan dengan alih tugas bagi para pelaksana / staf, perpindahan dalam rangka pemantapan tugas kerja termasuk mengenai fasilitasnya.'),
(209, 'KP.04.6', 'JABATAN STRUKTURAL / FUNGSIONAL', 'Surat-surat yang berkenaan dengan pengangkatan dan pemberhentian dalam jabatan struktural / fungsional, termasuk tunjangan sewaktu penugasan atau pemberian kuasa untuk menjabat sementara.'),
(210, 'KP.05', 'KESEJAHTERAAN', '-'),
(211, 'KP.05.1', 'KESEHATAN', 'Surat-surat yang berkenaan dengan penyelenggaraan kesehatan bagi pegawai, meliputi :\r\n- asiuansi kesehatan,\r\n- general check up bagi pimpinan dan pejabat.'),
(212, 'KP.05.2', 'CUTI', 'Surat-surat yang berkenaan dengan cuti pegawai, meliputi :\r\n- cuti sakit,\r\n- cuti hamil / bersalin, dan\r\n- cuti diluar tanggungan negara.'),
(213, 'KP.05.3', 'REKREASI DAN OLAH RAGA', 'Surat-surat yang berkenaan dengan rekreasi dan olah raga.'),
(214, 'KP.05.4', 'BANTUAN SOSIAL', 'Surat-surat yang berkenaan dengan pemberian bantuan / tunjangan sosial kepada pegawai dan keluarga yang mengalamai musibah, termasuk ucapan bela sungkawa'),
(215, 'KP.05.5', 'KOPERASI', 'Surat-surat yang berkenaan dengan organisasi koperasi termasuk didalamnya masalah pengurusan kebutuhan pokok.'),
(216, 'KP.05.6', 'PERUMAHAN', 'Surat-surat yang berkenaan dengan perumahan pegawai, pejabat struktural / fungsional, pimpinan dan hakim agung.'),
(217, 'KP.05.7', 'ANTAR JEMPUT', 'Surat-surat yang berkenaan dengan transportasi pegawai.'),
(218, 'KP.05.8', 'PENGHARGAAN', 'Surat-surat yang berkenaan dengan penghargaan, tanda jasa, piagam, satya lencana, dan sejenisnya.'),
(219, 'KP.06', 'PEMUTUSAN HUBUNGAN KERJA', 'Surat-surat yang berhubungan dengan pensiun pegawai, termasuk jaminan-jaminan asuransi karena berhenti atas permintaan sendiri, berhenti dengan hormat bukan karena hukuman, pindah / keluar dari MA RI dan meninggal dunia.'),
(220, 'KS', 'KESEKRETARIATAN', '-'),
(221, 'KS.00', 'KERUMAHTANGGAN', 'Surat-surat yang berkenaan dengan :\r\n- penggunaan fasilitas,\r\n- ketertiban dan keamanan,\r\n- konsumsi,\r\n- pakaian dinas,\r\n- papan nama,\r\n- stempel,\r\n- lambang,\r\n- alamat kantor dan pejabat,\r\n- telekomunikasi, listrik, air,\r\n- dan lain sebagainya.'),
(222, 'KU', 'KEUANGAN', '-'),
(223, 'KU.00', 'AKUNTANSI', 'Surat-surat yang berkenaan dengan penyiapan bahan pelaksanaan dan pembinaan pembukuan keuangan serta penyusunan perhitungan anggaran.'),
(224, 'KU.01', 'PELAKSANAAN ANGGARAN', 'Surat-surat yang berkenaan dengan penyiapan bahan bimbingan dalam pelaksanaan penggunaan anggaran dan pertanggung jawaban keuangan.'),
(225, 'KU.02', 'VERIVIKASI DAN TUNTUTAN GANTI RUGI', 'Surat-surat yang berkenaan dengan penyiapan bahan pencatatan, penelitian, pembinaan, dan penyusunan laporan tentang verivikasi dan tuntutan ganti rugi.'),
(226, 'KU.03', 'PERBENDAHARAAN', 'Surat-surat yang berkenaan dengan penyiapan bahan bimbingan dalam ketatausahaan perbendaharaan, penyelesaian masalah perbendaharaan, dan pelaksanaan pembinaan bendaharawan.'),
(227, 'KU.04', 'PENDAPATAN NEGARA', '-'),
(228, 'KU.04.1', 'PAJAK', 'Surat-surat yang berkenaan dengan pendapatan negara dan hasil pajak yang meliputi :\r\n- MPO (Menghitung Pajak Orang),\r\n- PPN (Pajak Pendapatan Negara),\r\n- Pajak Jasa,\r\n- PPH (Pajak Pendapatan Penghasilan),\r\n- PPN (Pajak Pertambahan Nilai),\r\n- dan pajak lainnya.'),
(229, 'KU.04.2', 'BUKAN PAJAK', 'Surat-surat yang berkenaan dengan pendapatan negara dan hasil bukan pajak yang meliputi penerimaan dan :\r\n- biaya perkara,\r\n- biaya salinan putusan,\r\n- biaya sewa dari inventaris negara,\r\n- hasil penjualan barang-barang inventaris yang dihapus,\r\n- dan penerimaan negara bukan pajak lainnya.'),
(230, 'KU.05', 'PERBANKAN', 'Surat-surat yang berkenaan dengan perbankan, antara lain :\r\n- pembukaan rekening,\r\n- spasement tanda tangan,\r\n- valuta asing,\r\n- rekening koran, dan\r\n- proyek perbankan lainnya.'),
(231, 'KU.06', 'SUMBANGAN / BANTUAN', 'Surat-surat yang berkenaan dengan permintaan, pemberian sumbangan / bantuan khusus diluar tugas pokok Mahkamah Agung RI, seperti :\r\n- bencana alam,\r\n- kebakaran,\r\n- banjir,\r\n- qurban,\r\n- pekan olah raga,\r\n- dan lain sebagainya.'),
(232, 'OT', 'ORGANISASI DAN TATA LAKSANA', '-'),
(233, 'OT.00', 'ORGANISASI', 'Surat surat yang berhubungan dengan pembentukan, perubahan organisasi, uraian pekerjaan dan pembahasannya mulai dari awal sampai akhir dan jalur pertanggung jawabannya'),
(234, 'OT.01.1', 'PERENCANAAN', 'Surat surat yang berhubungan dengan penyusunan perencanaan / program kerja oleh unit-unit kerja Mahkamah Agung secara keseluruhan, termasuk segala jenis pertemuan dalam rangka penentuan kebijaksanaan perencanaan.'),
(235, 'OT.01.2', 'LAPORAN', 'Surat surat yang berhubungan dengan laporan umum, monitoring, evaluasi dan unit kerja, baik laporan :\r\n- bulanan,\r\n- triwulan,\r\n- semester, dan\r\n- tahunan.'),
(236, 'OT.01.3', 'PENYUSUNAN PROSEDUR KERJA', 'Surat-surat yang berkenaan dengan penyusunan sistem, prosedur, pedoman, petunjuk pelaksanaan, tata kerja dan hubungan kerja.'),
(237, 'OT.01.4', 'PENYUSUNAN PEMBAKUAN SARANA KERJA', 'Surat-surat yang berhubungan dengan penyusunan pembakuan sarana kerja, yakni penentuan kualitas dan kuantitas yang meliputi :\r\n- ukuran,\r\n- jenis,\r\n- merek dan sebagainya.'),
(238, 'PB', 'PENELITIAN DAN PENGEMBANGAN', '-'),
(239, 'PB.00', 'PENELITIAN HUKUM', 'Surat-surat yang berkenaan dengan penelitian dan pengembangan hukum, sejak dari awal perencanaan, perizinan, pelaksanaan, sampai dengan pelaporan hasil penelitian.'),
(240, 'PB.01', 'PENELITIAN PERADILAN', 'Surat-surat yang berkenaan dengan penelitian dan pengembangan peradilan, sejak dari perencanaan, perizinan, pelaksanaan, sampai dengan pelaporan hasil penelitian.'),
(241, 'PB.02', 'PENGEMBANGAN PENELITIAN', 'Surat-surat yang berkenaan dengan masalah-masalah pengembangan penelitian dan perencanaan, pelaksanaan, sampai dengan pelaporan'),
(242, 'PL', 'PERLENGKAPAN', '-'),
(243, 'PL.01', 'GEDUNG DAN RUMAH DINAS', 'Surat-surat yang berkenaan dengan perencanaan, pengadaan, pelelangan, pendistribusian, pemeliharaan dan penghapusan, antara lain :\r\n- bangunan kantor,\r\n- rumah dinas,\r\n- mes,\r\n- pos jaga,\r\n- persetujuan gambar gedung,\r\n- dan lain sebagainya.'),
(244, 'PL.02', 'TANAH', 'Surat-surat yang berkenaan dengan perencanaan, pengadan /pelelangan, pemeliharaan, penghapusan dan tukar guling tanah.'),
(245, 'PL.03', 'ALAT KANTOR', 'Surat-surat yang berkenaan dengan perencaan, pengadaan, pelelangan, pendistribusian, pemeliharaan dan penghapusan, antara lain :\r\n- ATK (Alat Tulis Kantor),\r\n- formulir-formulir,\r\n- dan lain-lain.'),
(246, 'PL.04', 'MESIN KANTOR / ALAT-ALAT ELEKTRONIK', 'Surat-surat yang berkenaan dengan perencanaan, pengadaan, pelelangan, pendistribusian, pemeliharaan dan penghapusan, antara lain :\r\n- AC,\r\n- laptop,\r\n- komputer / PC,\r\n- radio,\r\n- slide,\r\n- mesin stensil,\r\n- tape recorder,\r\n- teleks,\r\n- video taper,\r\n- infocus,\r\n- amplifier,\r\n- foto copy,\r\n- kamera,\r\n- kalkulator / mesin hitung,\r\n- mesin ketik,\r\n- overhead proyektor,\r\n- proyektor film\r\n- dan sebagainya.'),
(247, 'PL.05', 'PERABOT KANTOR', 'Surat-surat yang berkenaan dengan perencanaan, pengadaan, pelelangan, pendistribusian, pemeliharaan, dan penghapusan, antara lain :\r\n- kursi,\r\n- meja,\r\n- lemari,\r\n- filing cabinet rak,\r\n- dan lain-lain yang sejenis.'),
(248, 'PL.06', 'KENDARAAN', 'Surat-surat yang berkenaan dengan masalah kendaraan dari perencanaan, pengadaan, pelelangan, pendistribusian, pemeliharaan dan penghapusan.'),
(249, 'PL.07', 'INVENTARIS PERLENGKAPAN', 'Surat-surat yang berkenaan dengan inventaris perlengkapan, laporan inventaris perlengkapan baik pusat maupun daerah.'),
(250, 'PL.08', 'PENAWARAN UMUM', 'Surat-surat yang berkenaan dengan pelelangan dari mulai persiapan pelelangan, penyusunan RKS, pelaksanaan pelelangan dan pengumuman pemenang, serta hal-hal lain yang berkaitan dengan pelaksanaan pelelangan.'),
(251, 'PL.09', 'KETATAUSAHAAN', 'Surat-surat yang berkenaan dengan korespondensi, kearsipan, penandatanganan surat dan wewenangnya, cap dinas, dan lain sebagainya.'),
(252, 'PP', 'PENDIDIKAN DAN PELATIHAN', ''),
(253, 'PP.00', 'PENDIDIKAN DAN PELATIHAN TEKNIS', ''),
(254, 'PP.00.1', 'HAKIM', 'Surat-surat yang berkenaan dengan perencanaan, pelaksanaan, dan evaluasi penyelenggaraan pendidikan dan pelatihan hakim.'),
(255, 'PP.00.2', 'PANITERA', 'Surat-surat yang berkenaan dengan perencanaan, pelaksanaan, dan evaluasi penyelenggaraan pendidikan dan pelatihan panitera.'),
(256, 'PP.00.3', 'JURU SITA', 'Surat-surat yang berkenaan dengan perencanaan, pelaksanaan, dan evaluasi penyelenggaraan pendidikan dan pelatihan juru sita.'),
(257, 'PP.00.4', 'TEKNIS LAINNYA', '	\r\nSurat-surat yang berkenaan dengan perencanaan, pelaksanaan, dan evaluasi penyelenggaraan pendidikan dan pelatihan teknis lainnya.'),
(258, 'PP.01', 'PENDIDIKAN DAN LATIHAN MANAJEMEN', ''),
(259, 'PP.01.1', 'PENJENJANGAN', 'Surat-surat yang berkenaan dengan pendidikan penjenjangan, antara lain :\r\n- Diklatpim tingkat IV,\r\n- Dilatpim tingkat III,\r\n- Diklatpim tingkat II,\r\n- Diklatpim tingkat I,\r\n- LEMHANAS\r\nmulai dari perencanaan, pelaksanaan dan evaluasi.'),
(260, 'PP.01.2', 'KEPANGKATAN', 'Surat-surat yang berkenaan dengan pendidikan dan kepangkatan, antara lain :\r\n- Pra Jabatan,\r\n- SUSCATUR (Kursus Calon Pengatur),\r\n- SUSCATA (Kursus Calon Penata),\r\n- SUSCABIN (Kursus Calon Pembina),\r\nmulai dari perencanaan, pelaksanaan dan evaluasi.'),
(261, 'PP.01.3', 'LATIHAN / KURSUS / PENATARAN MANAJEMEN', 'Surat-surat yang berkenaan dengan latihan tenaga administrasi, kursus, dan penataran, di bidang manajemen atau lainnya, baik dalam maupun luar negeri, mulai dari perencanaan, pelaksanaan dan evaluasi.'),
(262, 'PS', 'PENGAWASAN', '-'),
(263, 'PS.00', 'ADMINISTRASI UMUM', 'Surat-surat yang berkenaan dengan pengawasan administrasi umum, meliputi :\r\n- pengawasan ketatausahaan,\r\n- pengawasan kepegawaian,\r\n- pengawasan keuangan,\r\n- pengawasan perlengkapan,\r\ntermasuk Laporan Hasil Pemeriksaan (LHP) dan tindak lanjut pemeriksaan.'),
(264, 'PS.01', 'TEKNIS', 'Surat-surat yang berkenaan dengan pengawasan di bidang teknis peradilan mulai dari perencanaan, pelaksanaan dan Laporan Hasil Pemeriksaan (LHP) dan tindak lanjut pemeriksaan.');
-- --------------------------------------------------------
--
-- Table structure for table `tb_asal_tujuan`
--
CREATE TABLE `tb_asal_tujuan` (
  `id_asal_tujuan` int(11) NOT NULL,
  `asal_tujuan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `tb_asal_tujuan`
--
INSERT INTO `tb_asal_tujuan` (`id_asal_tujuan`, `asal_tujuan`) VALUES
(2, 'Kantor desa'),
(3, 'Kantor Pengadilan');
-- --------------------------------------------------------
--
-- Table structure for table `tb_disposisi`
--
CREATE TABLE `tb_disposisi` (
  `id` int(9) NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tanggal_terima` date NOT NULL,
  `asal_surat` varchar(255) NOT NULL,
  `sifat_surat` varchar(255) NOT NULL,
  `perihal` text NOT NULL,
  `no_agenda` varchar(40) NOT NULL,
  `teruskan` varchar(255) NOT NULL,
  `ket` text NOT NULL,
  `sifat_dispos` varchar(50) NOT NULL,
  `batas` date NOT NULL,
  `indeks` varchar(100) NOT NULL,
  `kode_surat` int(11) NOT NULL,
  `tujuan` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------
--
-- Table structure for table `tb_profile`
--
CREATE TABLE `tb_profile` (
  `kota` varchar(255) NOT NULL,
  `lembaga` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telpon` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
--
-- Dumping data for table `tb_profile`
--
INSERT INTO `tb_profile` (`kota`, `lembaga`, `alamat`, `telpon`, `foto`) VALUES
('Kab.  Contoh', 'Contoh Lembaga', 'Alamat : Jl. Contoh ', '0217878473', 'logo.png');
-- --------------------------------------------------------
--
-- Table structure for table `tb_surat_keluar`
--
CREATE TABLE `tb_surat_keluar` (
  `id` int(9) NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `tgl_surat` date NOT NULL,
  `kepada` int(11) NOT NULL,
  `sifat_surat` varchar(255) NOT NULL,
  `perihal` text NOT NULL,
  `no_agenda` varchar(50) NOT NULL,
  `kode_surat` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tujuan` int(11) NOT NULL,
  `tahun` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------
--
-- Table structure for table `tb_surat_masuk`
--
CREATE TABLE `tb_surat_masuk` (
  `id` int(9) NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tanggal_terima` date NOT NULL,
  `asal_surat` int(11) NOT NULL,
  `sifat_surat` varchar(255) NOT NULL,
  `perihal` text NOT NULL,
  `no_agenda` varchar(20) NOT NULL,
  `file_surat` varchar(255) NOT NULL,
  `status` int(2) NOT NULL,
  `tujuan` int(11) NOT NULL,
  `kode_surat` int(11) NOT NULL,
  `indeks` varchar(255) NOT NULL,
  `disposisi` int(11) NOT NULL,
  `tahun` varchar(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
-- --------------------------------------------------------
--
-- Table structure for table `tb_tujuan`
--
CREATE TABLE `tb_tujuan` (
  `id_tujuan` int(11) NOT NULL,
  `nama_tujuan` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `tb_tujuan`
--
INSERT INTO `tb_tujuan` (`id_tujuan`, `nama_tujuan`, `no_hp`) VALUES
(1, 'DIRJEN BADILUM', '6285781480396'),
(2, 'SEKRETARIS DIRJEN BADILUM', '6285781480396'),
(3, 'DIREKTUR PEMBINAAN PERADILAN UMUM', '6285781480396'),
(4, 'DIREKTUR BINGGANIS', '6285781480396');
-- --------------------------------------------------------
--
-- Table structure for table `tb_user`
--
CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama_user` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `level` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `foto` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `level_pimpinan` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
--
-- Dumping data for table `tb_user`
--
INSERT INTO `tb_user` (`id`, `username`, `password`, `nama_user`, `level`, `foto`, `level_pimpinan`) VALUES
(1, 'admin', 'admin', 'Parman', 'admin', 'login.png', 0),
(7, 'user_badilum', '12345', 'Dirjen Badilum', 'user', 'admin.png', 1),
(8, 'user_sekretaris', '12345', 'Sekretaris Badilum', 'user', 'admin.png', 2);
--
-- Indexes for dumped tables
--
--
-- Indexes for table `m_dispos`
--
ALTER TABLE `m_dispos`
  ADD PRIMARY KEY (`id_dispos`);
--
-- Indexes for table `ref_klasifikasi`
--
ALTER TABLE `ref_klasifikasi`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `tb_asal_tujuan`
--
ALTER TABLE `tb_asal_tujuan`
  ADD PRIMARY KEY (`id_asal_tujuan`);
--
-- Indexes for table `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  ADD PRIMARY KEY (`id`);
--
-- Indexes for table `tb_tujuan`
--
ALTER TABLE `tb_tujuan`
  ADD PRIMARY KEY (`id_tujuan`);
--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);
--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `m_dispos`
--
ALTER TABLE `m_dispos`
  MODIFY `id_dispos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ref_klasifikasi`
--
ALTER TABLE `ref_klasifikasi`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=265;
--
-- AUTO_INCREMENT for table `tb_asal_tujuan`
--
ALTER TABLE `tb_asal_tujuan`
  MODIFY `id_asal_tujuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_disposisi`
--
ALTER TABLE `tb_disposisi`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tb_surat_keluar`
--
ALTER TABLE `tb_surat_keluar`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tb_surat_masuk`
--
ALTER TABLE `tb_surat_masuk`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tb_tujuan`
--
ALTER TABLE `tb_tujuan`
  MODIFY `id_tujuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
