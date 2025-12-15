-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th12 15, 2025 lúc 08:52 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duan1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binh_luans`
--

CREATE TABLE `binh_luans` (
  `id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `tai_khoan_id` int(11) NOT NULL,
  `noi_dung` text NOT NULL,
  `ngay_dang` date NOT NULL,
  `trang_thai` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `binh_luans`
--

INSERT INTO `binh_luans` (`id`, `san_pham_id`, `tai_khoan_id`, `noi_dung`, `ngay_dang`, `trang_thai`) VALUES
(1, 1, 3, 'Sản phẩm đẹp, giao nhanh, đóng gói cẩn thận.', '2025-12-12', 1),
(2, 4, 3, 'Laptop chạy mượt, rất ưng.', '2025-12-12', 1),
(3, 1, 3, 'Hiệu năng mạnh, pin tốt.', '2025-12-12', 1),
(4, 1, 3, 'Camera chụp rất đẹp!', '2025-12-12', 1),
(5, 1, 3, 'Dùng 1 tuần thấy rất hài lòng.', '2025-12-12', 1),
(6, 2, 3, 'Máy mượt, màn hình đẹp.', '2025-12-12', 1),
(7, 2, 3, 'Giá hơi cao nhưng đáng tiền.', '2025-12-12', 1),
(8, 2, 3, 'Pin rất trâu, dùng cả ngày.', '2025-12-12', 1),
(9, 3, 3, 'Cấu hình mạnh trong tầm giá.', '2025-12-12', 1),
(10, 3, 3, 'Thiết kế hiện đại, đẹp.', '2025-12-12', 1),
(11, 3, 3, 'Sạc rất nhanh.', '2025-12-12', 1),
(12, 4, 3, 'Máy rất nhẹ và mát.', '2025-12-12', 1),
(13, 4, 3, 'Pin dùng được hơn 10 tiếng.', '2025-12-12', 1),
(14, 4, 3, 'Hiệu năng đủ cho công việc.', '2025-12-12', 1),
(15, 5, 3, 'Laptop gaming giá hợp lý.', '2025-12-12', 1),
(16, 5, 3, 'Quạt kêu hơi to nhưng hiệu năng tốt.', '2025-12-12', 1),
(17, 5, 3, 'FPS cao khi chơi game.', '2025-12-12', 1),
(18, 6, 3, 'Phù hợp học tập và làm việc.', '2025-12-12', 1),
(19, 6, 3, 'Thiết kế đẹp, nhẹ.', '2025-12-12', 1),
(20, 6, 3, 'Pin tạm ổn.', '2025-12-12', 1),
(21, 7, 3, 'Rất mạnh cho công việc.', '2025-12-12', 1),
(22, 7, 3, 'Màn hình rất đẹp.', '2025-12-12', 1),
(23, 7, 3, 'Bút Apple Pencil viết mượt.', '2025-12-12', 1),
(24, 8, 3, 'Màn hình AMOLED đỉnh.', '2025-12-12', 1),
(25, 8, 3, 'Hiệu năng ổn.', '2025-12-12', 1),
(26, 8, 3, 'Giá tốt trong tầm.', '2025-12-12', 1),
(27, 9, 3, 'Render video rất nhanh.', '2025-12-12', 1),
(28, 9, 3, 'Build chắc chắn.', '2025-12-12', 1),
(29, 9, 3, 'Chơi game max setting mượt.', '2025-12-12', 1),
(30, 10, 3, 'Chống ồn cực đỉnh.', '2025-12-12', 1),
(31, 10, 3, 'Âm thanh trong trẻo.', '2025-12-12', 1),
(32, 10, 3, 'Đeo lâu không đau tai.', '2025-12-12', 1),
(33, 11, 3, 'Sạc rất nhanh.', '2025-12-12', 1),
(34, 11, 3, 'Không bị nóng.', '2025-12-12', 1),
(35, 11, 3, 'Chất lượng tốt.', '2025-12-12', 1),
(36, 12, 3, 'Cáp dày, chắc chắn.', '2025-12-12', 1),
(37, 12, 3, 'Sạc nhanh OK.', '2025-12-12', 1),
(38, 12, 3, 'Giá hợp lý.', '2025-12-12', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_don_hangs`
--

CREATE TABLE `chi_tiet_don_hangs` (
  `id` int(11) NOT NULL,
  `don_hang_id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `don_gia` decimal(10,2) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `thanh_tien` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_don_hangs`
--

INSERT INTO `chi_tiet_don_hangs` (`id`, `don_hang_id`, `san_pham_id`, `don_gia`, `so_luong`, `thanh_tien`) VALUES
(1, 1, 1, 26990000.00, 1, 26990000.00),
(2, 2, 4, 27990000.00, 1, 27990000.00),
(3, 2, 12, 199000.00, 1, 199000.00),
(4, 3, 1, 26990000.00, 1, 26990000.00),
(5, 3, 10, 4990000.00, 2, 9980000.00),
(6, 4, 10, 4990000.00, 1, 4990000.00),
(7, 5, 2, 25990000.00, 1, 25990000.00),
(8, 6, 3, 13990000.00, 1, 13990000.00),
(9, 7, 3, 13990000.00, 1, 13990000.00),
(10, 8, 3, 13990000.00, 1, 13990000.00),
(11, 9, 2, 25990000.00, 1, 25990000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_gio_hangs`
--

CREATE TABLE `chi_tiet_gio_hangs` (
  `id` int(11) NOT NULL,
  `gio_hang_id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_gio_hangs`
--

INSERT INTO `chi_tiet_gio_hangs` (`id`, `gio_hang_id`, `san_pham_id`, `so_luong`) VALUES
(9, 8, 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuc_vus`
--

CREATE TABLE `chuc_vus` (
  `id` int(11) NOT NULL,
  `ten_chuc_vu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chuc_vus`
--

INSERT INTO `chuc_vus` (`id`, `ten_chuc_vu`) VALUES
(1, 'Admin'),
(2, 'Nhân viên'),
(3, 'Khách hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_mucs`
--

CREATE TABLE `danh_mucs` (
  `id` int(11) NOT NULL,
  `ten_danh_muc` varchar(255) NOT NULL,
  `mo_ta` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danh_mucs`
--

INSERT INTO `danh_mucs` (`id`, `ten_danh_muc`, `mo_ta`) VALUES
(1, 'Điện thoại', 'Các mẫu điện thoại smartphone: Apple, Samsung, Xiaomi, ...'),
(2, 'Laptop', 'Laptop văn phòng, ultrabook và gaming'),
(3, 'Tablet', 'Máy tính bảng từ nhiều hãng'),
(4, 'PC - Máy tính để bàn', 'Máy để bàn, workstation, gaming PC'),
(5, 'Phụ kiện', 'Sạc, cáp, tai nghe, ốp lưng, phụ kiện');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hangs`
--

CREATE TABLE `don_hangs` (
  `id` int(11) NOT NULL,
  `ma_don_hang` varchar(50) NOT NULL,
  `tai_khoan_id` int(11) NOT NULL,
  `ten_nguoi_nhan` varchar(255) NOT NULL,
  `email_nguoi_nhan` varchar(255) NOT NULL,
  `sdt_nguoi_nhan` varchar(15) NOT NULL,
  `dia_chi_nguoi_nhan` text NOT NULL,
  `ngay_dat` date NOT NULL,
  `tong_tien` decimal(10,2) NOT NULL,
  `ghi_chu` text DEFAULT NULL,
  `phuong_thuc_thanh_toan_id` int(11) NOT NULL,
  `trang_thai_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `don_hangs`
--

INSERT INTO `don_hangs` (`id`, `ma_don_hang`, `tai_khoan_id`, `ten_nguoi_nhan`, `email_nguoi_nhan`, `sdt_nguoi_nhan`, `dia_chi_nguoi_nhan`, `ngay_dat`, `tong_tien`, `ghi_chu`, `phuong_thuc_thanh_toan_id`, `trang_thai_id`) VALUES
(1, 'DH1001', 3, 'Nguyễn Khách', 'user@shop.com', '0900000003', 'Số 1, Đường A, Đà Nẵng', '2025-12-12', 31990000.00, 'Giao trong ngày', 1, 1),
(2, 'DH1002', 3, 'Nguyễn Khách', 'user@shop.com', '0900000003', 'Số 1, Đường A, Đà Nẵng', '2025-12-12', 9998000.00, 'Giao giờ hành chính', 2, 2),
(3, 'DH7232', 3, 'Nguyễn Văn b', 'user@shop.com', '0900000003', 'Đà Nẵng', '2025-12-12', 37000000.00, '', 1, 1),
(4, 'DH1261', 3, 'Nguyễn Văn bbb', 'user@shop.com', '0900000003', 'Đà Nẵng', '2025-12-12', 5020000.00, '', 1, 8),
(5, 'DH4060', 3, 'Nguyễn Văn a', 'user@shop.com', '0900000003', 'Đà Nẵng', '2025-12-13', 26020000.00, '', 1, 1),
(6, 'DH1311', 3, 'Nguyễn Văn a', 'user@shop.com', '0900000003', 'Đà Nẵng', '2025-12-13', 14020000.00, '', 1, 1),
(7, 'DH5608', 3, 'Nguyễn Văn a', 'user@shop.com', '0900000003', 'Đà Nẵng', '2025-12-14', 14020000.00, '', 1, 1),
(8, 'DH1141', 3, 'Nguyễn Văn a', 'user@shop.com', '0900000003', 'Đà Nẵng', '2025-12-14', 14020000.00, '', 1, 1),
(9, 'DH8373', 3, 'Nguyễn Văn a', 'user@shop.com', '0900000003', 'Đà Nẵng', '2025-12-14', 26020000.00, '', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gio_hangs`
--

CREATE TABLE `gio_hangs` (
  `id` int(11) NOT NULL,
  `tai_khoan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `gio_hangs`
--

INSERT INTO `gio_hangs` (`id`, `tai_khoan_id`) VALUES
(8, 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinh_anh_san_phams`
--

CREATE TABLE `hinh_anh_san_phams` (
  `id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `link_hinh_anh` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hinh_anh_san_phams`
--

INSERT INTO `hinh_anh_san_phams` (`id`, `san_pham_id`, `link_hinh_anh`) VALUES
(1, 1, 'uploads/1.jpeg'),
(2, 2, 'uploads/2.jpeg'),
(3, 3, 'uploads/3.jpeg'),
(4, 4, 'uploads/4.jpeg'),
(5, 5, 'uploads/1.jpeg'),
(6, 6, 'uploads/2.jpeg'),
(7, 7, 'uploads/3.jpeg'),
(8, 8, 'uploads/4.jpeg'),
(9, 9, 'uploads/1.jpeg'),
(10, 10, 'uploads/2.jpeg'),
(11, 11, 'uploads/3.jpeg'),
(12, 12, 'uploads/4.jpeg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuong_thuc_thanh_toans`
--

CREATE TABLE `phuong_thuc_thanh_toans` (
  `id` int(11) NOT NULL,
  `ten_phuong_thuc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `phuong_thuc_thanh_toans`
--

INSERT INTO `phuong_thuc_thanh_toans` (`id`, `ten_phuong_thuc`) VALUES
(1, 'Thanh toán khi nhận hàng'),
(2, 'Chuyển khoản ngân hàng'),
(3, 'Ví điện tử Momo');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_phams`
--

CREATE TABLE `san_phams` (
  `id` int(11) NOT NULL,
  `ten_san_pham` varchar(255) NOT NULL,
  `gia_san_pham` decimal(10,2) NOT NULL,
  `gia_khuyen_mai` decimal(10,2) DEFAULT NULL,
  `hinh_anh` text DEFAULT NULL,
  `so_luong` int(11) NOT NULL,
  `luot_xem` int(11) DEFAULT 0,
  `ngay_nhap` date NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `danh_muc_id` int(11) NOT NULL,
  `trang_thai` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `san_phams`
--

INSERT INTO `san_phams` (`id`, `ten_san_pham`, `gia_san_pham`, `gia_khuyen_mai`, `hinh_anh`, `so_luong`, `luot_xem`, `ngay_nhap`, `mo_ta`, `danh_muc_id`, `trang_thai`) VALUES
(1, 'iPhone 15 Pro', 28990000.00, 26990000.00, 'uploads/1.jpeg', 12, 150, '2025-11-01', 'iPhone 15 Pro - chip A17, camera chuyên nghiệp', 1, 1),
(2, 'Samsung Galaxy S24 Ultra', 27990000.00, 25990000.00, 'uploads/2.jpeg', 10, 120, '2025-10-20', 'Galaxy S24 Ultra - màn hình QHD, camera 200MP', 1, 1),
(3, 'Xiaomi 14', 14990000.00, 13990000.00, 'uploads/3.jpeg', 25, 80, '2025-09-15', 'Xiaomi 14 - cấu hình mạnh, pin tốt', 1, 1),
(4, 'MacBook Air M3 13\"', 28990000.00, 27990000.00, 'uploads/4.jpeg', 8, 95, '2025-10-30', 'MacBook Air M3 - mỏng nhẹ, pin trâu', 2, 1),
(5, 'Asus TUF Gaming A15', 23990000.00, 21990000.00, 'uploads/1.jpeg', 6, 60, '2025-09-05', 'Asus TUF - laptop gaming cấu hình tốt', 2, 1),
(6, 'HP 15s', 12990000.00, 11990000.00, 'uploads/2.jpeg', 15, 40, '2025-08-10', 'HP 15s - laptop văn phòng giá hợp lý', 2, 1),
(7, 'iPad Pro 11\" (M2)', 21990000.00, 20990000.00, 'uploads/3.jpeg', 7, 30, '2025-07-25', 'iPad Pro M2 - hiệu năng cao cho sáng tạo', 3, 1),
(8, 'Samsung Galaxy Tab S9', 17990000.00, 16990000.00, 'uploads/4.jpeg', 5, 20, '2025-06-10', 'Tablet Samsung - phù hợp giải trí và công việc nhẹ', 3, 1),
(9, 'PC Gaming - RTX 4060', 25990000.00, 24990000.00, 'uploads/1.jpeg', 3, 12, '2025-05-01', 'PC gaming build với RTX 4060', 4, 1),
(10, 'AirPods Pro (Gen 2)', 5490000.00, 4990000.00, 'uploads/2.jpeg', 30, 200, '2025-04-15', 'Tai nghe chống ồn chủ động', 5, 1),
(11, 'Củ sạc USB-C 65W', 690000.00, 590000.00, 'uploads/3.jpeg', 50, 75, '2025-03-01', 'Sạc nhanh 65W cho laptop và điện thoại', 5, 1),
(12, 'Cáp Type-C bền', 250000.00, 199000.00, 'uploads/4.jpeg', 80, 60, '2025-02-20', 'Cáp Type-C chịu lực, sạc nhanh', 5, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tai_khoans`
--

CREATE TABLE `tai_khoans` (
  `id` int(11) NOT NULL,
  `ho_ten` varchar(255) NOT NULL,
  `anh_dai_dien` varchar(255) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `gioi_tinh` tinyint(1) NOT NULL DEFAULT 1,
  `dia_chi` varchar(255) DEFAULT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `chuc_vu_id` int(11) NOT NULL,
  `trang_thai` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tai_khoans`
--

INSERT INTO `tai_khoans` (`id`, `ho_ten`, `anh_dai_dien`, `ngay_sinh`, `email`, `so_dien_thoai`, `gioi_tinh`, `dia_chi`, `mat_khau`, `chuc_vu_id`, `trang_thai`) VALUES
(1, 'Admin Hệ Thống', NULL, '1990-01-01', 'admin@shop.com', '0900000001', 1, 'Hà Nội', '$2y$10$Il5LPXo59fEu8oOnimqTCeivUGMh32VvMizxkzjC9jxL5cguKK4G6', 1, 1),
(2, 'Nhân viên Bán hàng', NULL, '1995-05-10', 'staff@shop.com', '0900000002', 1, 'Hồ Chí Minh', '$2y$10$8Oh0n2Ea2KNqnFrvR7dX/.KxYRj7wjT0QNCN/UOZj2aHjJ5meahky', 2, 1),
(3, 'Nguyễn Văn a', NULL, '2000-07-15', 'user@shop.com', '0900000003', 1, 'Đà Nẵng', '$2y$10$Kbe3Q11XENreF8GmBgJrTullwQ7uNge0l32qoS/NhmQQNIujKPnpy', 3, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `trang_thai_don_hangs`
--

CREATE TABLE `trang_thai_don_hangs` (
  `id` int(11) NOT NULL,
  `ten_trang_thai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `trang_thai_don_hangs`
--

INSERT INTO `trang_thai_don_hangs` (`id`, `ten_trang_thai`) VALUES
(1, 'Chờ xác nhận'),
(2, 'Đã xác nhận'),
(3, 'Đang chuẩn bị hàng'),
(4, 'Đang giao hàng'),
(5, 'Giao hàng thành công'),
(6, 'Đã hoàn thành'),
(7, 'Khách hủy đơn'),
(8, 'Shop hủy đơn');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binh_luans`
--
ALTER TABLE `binh_luans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_binh_luans_tai_khoans` (`tai_khoan_id`);

--
-- Chỉ mục cho bảng `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chuc_vus`
--
ALTER TABLE `chuc_vus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `danh_mucs`
--
ALTER TABLE `danh_mucs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_giohang_taikhoan` (`tai_khoan_id`);

--
-- Chỉ mục cho bảng `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hinh_anh_san_phams_san_phams` (`san_pham_id`);

--
-- Chỉ mục cho bảng `phuong_thuc_thanh_toans`
--
ALTER TABLE `phuong_thuc_thanh_toans`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `san_phams`
--
ALTER TABLE `san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_san_phams_danh_mucs` (`danh_muc_id`);

--
-- Chỉ mục cho bảng `tai_khoans`
--
ALTER TABLE `tai_khoans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_tai_khoans_chuc_vus` (`chuc_vu_id`);

--
-- Chỉ mục cho bảng `trang_thai_don_hangs`
--
ALTER TABLE `trang_thai_don_hangs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binh_luans`
--
ALTER TABLE `binh_luans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `chuc_vus`
--
ALTER TABLE `chuc_vus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `gio_hangs`
--
ALTER TABLE `gio_hangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `phuong_thuc_thanh_toans`
--
ALTER TABLE `phuong_thuc_thanh_toans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `san_phams`
--
ALTER TABLE `san_phams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT cho bảng `tai_khoans`
--
ALTER TABLE `tai_khoans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `trang_thai_don_hangs`
--
ALTER TABLE `trang_thai_don_hangs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binh_luans`
--
ALTER TABLE `binh_luans`
  ADD CONSTRAINT `fk_binh_luans_tai_khoans` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD CONSTRAINT `fk_giohang_taikhoan` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoans` (`id`);

--
-- Các ràng buộc cho bảng `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  ADD CONSTRAINT `fk_hinh_anh_san_phams_san_phams` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `san_phams`
--
ALTER TABLE `san_phams`
  ADD CONSTRAINT `fk_san_phams_danh_mucs` FOREIGN KEY (`danh_muc_id`) REFERENCES `danh_mucs` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tai_khoans`
--
ALTER TABLE `tai_khoans`
  ADD CONSTRAINT `fk_tai_khoans_chuc_vus` FOREIGN KEY (`chuc_vu_id`) REFERENCES `chuc_vus` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_taikhoan_chucvu` FOREIGN KEY (`chuc_vu_id`) REFERENCES `chuc_vus` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
