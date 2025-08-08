-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 08 Agu 2025 pada 16.01
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kursus_online_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about_us_sections`
--

CREATE TABLE `about_us_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rounded_text` varchar(255) DEFAULT NULL,
  `learner_count` varchar(255) DEFAULT NULL,
  `learner_count_text` varchar(255) DEFAULT NULL,
  `learner_image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `video_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `about_us_sections`
--

INSERT INTO `about_us_sections` (`id`, `image`, `rounded_text`, `learner_count`, `learner_count_text`, `learner_image`, `title`, `description`, `button_text`, `button_url`, `video_url`, `video_image`, `created_at`, `updated_at`) VALUES
(1, '/uploads/ha_cource688f09973a293.png', 'take the worldwide best online course', '20K+', 'ENROLLED LEARNERS', '/uploads/ha_cource688f09973a985.png', '20K+ Enrolled Learners Photo take the worldwide best online course Learn More About Us Study & Develop Your Skills Regardless of Location.', '<div class=\"col-xxl-6 col-lg-5 wow fadeInLeft\">\r\n<div class=\"wsus__about_3_img\">\r\n<div class=\"text\">&nbsp;</div>\r\n</div>\r\n</div>\r\n<div class=\"col-xxl-6 col-lg-6 wow fadeInRight\">\r\n<div class=\"wsus__about_3_text\">\r\n<div class=\"wsus__section_heading heading_left mb_15\">&nbsp;</div>\r\n<p>Nullam tincidunt tortor est, ac maximus justo gravida non phasellus dignissim quam odio ipsum sollicitudin rhoncus venenatis ex metus in turpis.</p>\r\n<ul>\r\n<li>Expert Trainers</li>\r\n<li>Online Remote Learning</li>\r\n<li>Lifetime Access</li>\r\n</ul>\r\n</div>\r\n</div>', 'Start Free Trial', '/', 'https://www.youtube.com/watch?v=bixZggaAiJk ', '/uploads/ha_cource688f09a47efaf.jpg', '2025-08-03 00:02:47', '2025-08-03 00:03:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'User updated their profile', 'App\\Models\\User', NULL, 21, 'App\\Models\\User', 21, '{\"attributes\":{\"image\":\"\\/uploads\\/ha_cource689076b4d8f18.jpg\"}}', NULL, '2025-08-04 02:00:36', '2025-08-04 02:00:36'),
(2, 'default', 'User updated their profile', 'App\\Models\\User', NULL, 20, 'App\\Models\\User', 20, '{\"attributes\":{\"image\":\"\\/uploads\\/ha_cource68918e46bca82.jpg\"}}', NULL, '2025-08-04 21:53:26', '2025-08-04 21:53:26'),
(3, 'default', 'User updated their profile', 'App\\Models\\User', NULL, 19, 'App\\Models\\User', 19, '{\"attributes\":{\"image\":\"\\/uploads\\/ha_cource6891951615864.jpg\"}}', NULL, '2025-08-04 22:22:30', '2025-08-04 22:22:30'),
(4, 'default', 'User updated their profile', 'App\\Models\\User', NULL, 18, 'App\\Models\\User', 18, '{\"attributes\":{\"image\":\"\\/uploads\\/ha_cource68919565dd766.JPG\"}}', NULL, '2025-08-04 22:23:49', '2025-08-04 22:23:49'),
(5, 'default', 'User updated their profile', 'App\\Models\\User', NULL, 18, 'App\\Models\\User', 18, '{\"attributes\":{\"image\":\"\\/uploads\\/ha_cource6891956f90010.jpg\"}}', NULL, '2025-08-04 22:23:59', '2025-08-04 22:23:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `image`, `name`, `email`, `email_verified_at`, `password`, `bio`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin', 'admin@gmail.com', NULL, '$2y$12$z1UfYzhFA9HXLdZ5y2cfB.WLxe7I.diWKd9Se2f6Xs.8HvNFKrzEi', NULL, NULL, '2025-08-02 23:04:59', '2025-08-02 23:04:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `become_instructor_sections`
--

CREATE TABLE `become_instructor_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `become_instructor_sections`
--

INSERT INTO `become_instructor_sections` (`id`, `image`, `title`, `subtitle`, `button_text`, `button_url`, `created_at`, `updated_at`) VALUES
(1, '/uploads/ha_cource688f0a5b18088.png', 'Be a Member & Share Your Knowledge.', 'LMS allows administrators and instructors to create, organize, and deliver courses. This includes uploading course content, managing materials, and setting assessments.', 'Become An Instructor', '/', '2025-08-03 00:06:03', '2025-08-03 00:06:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `blog_category_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `blogs`
--

INSERT INTO `blogs` (`id`, `user_id`, `blog_category_id`, `image`, `title`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(11, 1, 1, '/uploads/ha_cource688f1da574c18.jpg', 'Exploring Learning Landscapes in Academic.', 'exploring-learning-landscapes-in-academic', '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>', 1, '2025-08-03 01:27:00', '2025-08-03 01:28:21'),
(12, 1, 2, '/uploads/ha_cource688f1df99ac66.jpg', 'Internationally Distinguished Skillful Educators.', 'internationally-distinguished-skillful-educators', '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>', 1, '2025-08-03 01:29:45', '2025-08-03 01:29:45'),
(13, 1, 2, '/uploads/ha_cource688f1e3a6c7c9.jpg', 'Uncovering Learning Opportunities in Academia.', 'uncovering-learning-opportunities-in-academia', '<p>or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing&nbsp;</p>', 1, '2025-08-03 01:30:50', '2025-08-03 01:30:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'News & Events', 'news-events', 1, '2025-08-02 23:37:00', '2025-08-02 23:37:52'),
(2, 'Learning Tips', 'learning-tips', 1, '2025-08-02 23:37:42', '2025-08-02 23:37:57'),
(3, 'Career Development', 'career-development', 1, '2025-08-02 23:38:05', '2025-08-02 23:38:05'),
(4, 'Technology & Trends', 'technology-trends', 1, '2025-08-02 23:38:15', '2025-08-02 23:38:15'),
(5, 'Tutorials & Guides', 'tutorials-guides', 1, '2025-08-02 23:38:23', '2025-08-02 23:38:23'),
(6, 'Success Stories', 'success-stories', 1, '2025-08-02 23:38:34', '2025-08-02 23:38:34'),
(7, 'Announcements & Updates', 'announcements-updates', 1, '2025-08-02 23:38:45', '2025-08-02 23:38:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `brands`
--

INSERT INTO `brands` (`id`, `image`, `url`, `status`, `created_at`, `updated_at`) VALUES
(1, '/uploads/ha_cource688f0c281d3df.png', 'https://youtube.com', 1, '2025-08-03 00:13:44', '2025-08-03 00:13:44'),
(2, '/uploads/ha_cource688f0c838efa7.png', 'https://youtube.com', 1, '2025-08-03 00:15:15', '2025-08-03 00:15:15'),
(3, '/uploads/ha_cource688f0c8f26ec9.png', 'https://youtube.com', 1, '2025-08-03 00:15:27', '2025-08-03 00:15:27'),
(4, '/uploads/ha_cource688f0c9c2f101.png', 'https://youtube.com', 1, '2025-08-03 00:15:40', '2025-08-03 00:15:40'),
(5, '/uploads/ha_cource688f0ca54ddba.png', 'https://youtube.com', 1, '2025-08-03 00:15:49', '2025-08-03 00:15:49'),
(6, '/uploads/ha_cource688f0cb267162.png', 'https://youtube.com', 1, '2025-08-03 00:16:02', '2025-08-03 00:16:02'),
(7, '/uploads/ha_cource688f0cbf3dd5e.png', 'https://youtube.com', 1, '2025-08-03 00:16:15', '2025-08-03 00:16:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `course_id`, `created_at`, `updated_at`) VALUES
(8, 21, 6, '2025-08-04 02:01:26', '2025-08-04 02:01:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `certificate_builders`
--

CREATE TABLE `certificate_builders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `background` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `certificate_builder_items`
--

CREATE TABLE `certificate_builder_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `element_id` varchar(255) DEFAULT NULL,
  `x_position` varchar(255) DEFAULT NULL,
  `y_position` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `line_one` varchar(255) DEFAULT NULL,
  `line_two` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `contacts`
--

INSERT INTO `contacts` (`id`, `icon`, `title`, `line_one`, `line_two`, `status`, `created_at`, `updated_at`) VALUES
(1, '/uploads/ha_cource688f105cdcc04.png', 'Office Address', '7232 Broadway Suite 3087', 'Madison Heights, 57256', 1, '2025-08-03 00:31:40', '2025-08-03 00:31:40'),
(2, '/uploads/ha_cource688f109f2a973.png', 'Send a Message', 'contact@hafidtech.com', 'afidzpratama@gmail.com', 1, '2025-08-03 00:32:47', '2025-08-03 00:32:47'),
(3, '/uploads/ha_cource688f10fe97fb7.png', 'Let\'s Discuss', '0882 9865 4539', '88 6548 658 54', 1, '2025-08-03 00:34:22', '2025-08-03 00:34:22'),
(4, '/uploads/ha_cource688f1123bbff5.png', 'Team Up With Us', 'Sed nec libero ante odio mauris', 'pellentesque eget et neque.', 1, '2025-08-03 00:34:59', '2025-08-03 00:34:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact_settings`
--

CREATE TABLE `contact_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `map_url` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `contact_settings`
--

INSERT INTO `contact_settings` (`id`, `image`, `map_url`, `created_at`, `updated_at`) VALUES
(1, '/uploads/ha_cource688f0fd0bdd37.JPG', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4193.755696335635!2d106.8880648!3d-6.1965257!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f556d8bb18ef%3A0xaec644895d9e837e!2sTOMORO%20COFFEE%20-%20Rawamangun!5e1!3m2!1sid!2sid!4v1754206091554!5m2!1sid!2sid', '2025-08-03 00:29:20', '2025-08-03 00:29:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `counters`
--

CREATE TABLE `counters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `counter_one` varchar(255) DEFAULT NULL,
  `title_one` varchar(255) DEFAULT NULL,
  `counter_two` varchar(255) DEFAULT NULL,
  `title_two` varchar(255) DEFAULT NULL,
  `counter_three` varchar(255) DEFAULT NULL,
  `title_three` varchar(255) DEFAULT NULL,
  `counter_four` varchar(255) DEFAULT NULL,
  `title_four` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `counters`
--

INSERT INTO `counters` (`id`, `counter_one`, `title_one`, `counter_two`, `title_two`, `counter_three`, `title_three`, `counter_four`, `title_four`, `created_at`, `updated_at`) VALUES
(1, '745', 'LEARNERS & COUNTING', '578', 'COURSES & VIDEO', '2457', 'CERTIFIED STUDENTS', '378', 'BEST PROFESSORS', '2025-08-03 00:26:37', '2025-08-03 00:26:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_type` enum('course') NOT NULL DEFAULT 'course',
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `time_zone` varchar(255) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `demo_video_storage` enum('upload','youtube','vimeo','external_link') DEFAULT NULL,
  `demo_video_source` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `certificate` tinyint(1) DEFAULT 0,
  `qna` tinyint(1) DEFAULT 0,
  `message_for_reviewer` text DEFAULT NULL,
  `is_approved` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `status` enum('active','inactive','draft') NOT NULL DEFAULT 'draft',
  `course_level_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_language_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `courses`
--

INSERT INTO `courses` (`id`, `instructor_id`, `category_id`, `course_type`, `title`, `slug`, `seo_description`, `duration`, `time_zone`, `thumbnail`, `demo_video_storage`, `demo_video_source`, `description`, `capacity`, `price`, `discount`, `certificate`, `qna`, `message_for_reviewer`, `is_approved`, `status`, `course_level_id`, `course_language_id`, `created_at`, `updated_at`) VALUES
(1, 18, 36, 'course', '30 Days to Learning Laravel', '30-days-to-learning-laravel', '30 Days to Learning Laravel', '560', NULL, '/uploads/ha_cource688f21b638e46.jpg', 'youtube', 'https://www.youtube.com/watch?v=1NjOWtQ7S2o&list=PL3VM-unCzF8hy47mt9-chowaHNjfkuEVz&index=1', '<p>this is course about 30 Days to Learning Laravel</p>', 1000000, 599, NULL, 0, 0, NULL, 'approved', 'active', 1, 1, '2025-08-03 01:45:42', '2025-08-03 02:17:42'),
(2, 18, 36, 'course', 'Running Clock', 'running-clock', 'Running Clock', '120', NULL, '/uploads/ha_cource688f2a311aa9a.jpg', 'youtube', 'https://www.youtube.com/watch?v=3kprwEDQIp0', '<p>Dalam wawancara mendalam ini, Matt Stauffer — salah satu pendiri Tighten dan penulis Laravel Up & Running — berbagi bagaimana Laravel telah membentuk proses perekrutan, manajemen proyek, dan struktur tim di agensinya. Ia menjelaskan mengapa Laravel yang bersifat full-stack memungkinkan tim yang gesit dan efisien serta meminimalkan kesenjangan komunikasi. Matt juga berbagi tentang pengelolaan ekspektasi klien tanpa anggaran yang kaku, dan bagaimana kejujuran dan fleksibilitas menghasilkan hasil proyek yang lebih baik. Selain itu, ia merefleksikan nilai pribadi dan profesional dari penulisan bukunya, dan menawarkan saran bagi para pengembang solo yang bermimpi menjalankan agensi. Buku ini wajib ditonton oleh para pengembang, pekerja lepas, dan siapa pun yang berkecimpung di ekosistem Laravel!</p>', 1000000, 299, NULL, 0, 1, 'Thank for Review This Course!', 'approved', 'active', 2, 2, '2025-08-03 02:21:53', '2025-08-04 17:28:02'),
(3, 18, 35, 'course', 'How To Contribute to Open Source', 'how-to-contribute-to-open-source', 'how to contribute to open source', '32', NULL, '/uploads/ha_cource688f2bcbd14d6.jpg', 'youtube', 'https://www.youtube.com/watch?v=cAhVwrWpGlo&list=PL3VM-unCzF8jTUFqg8f-UropbAGu4VDIt&index=1', '<p><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\">Watch full series at Laracasts: </span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\"><a class=\"yt-core-attributed-string__link yt-core-attributed-string__link--call-to-action-color\" tabindex=\"0\" href=\"https://www.youtube.com/redirect?event=video_description&redir_token=QUFFLUhqbDd1Y21Rd0N3dDhNamRJejRZN04wRnpTTlFDQXxBQ3Jtc0tuZHRJYjBkc1R2MUhUMXd1UjYtSF9IVURXalJEUElOQ2wxX2lyZWxRMklPX3lTQTRiZVYxLVVvYTR0RWtZdU9abzhJcFhmOVB3ZFZmUGV6R0owVU1fbzY1eTZTMzJQQnlxalp1ZWw0aXFfaEdhektiZw&q=https%3A%2F%2Flaracasts.com%2Fseries%2Flets-build-a-saas-in-laravel&v=cAhVwrWpGlo\" target=\"_blank\" rel=\"nofollow noopener\">https://laracasts.com/series/lets-bui...</a></span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\"> No matter what you\'re building, the first steps are going to be similar. In this course we\'ll take a look at the first steps I take on every project, regardless of what else it\'s going to do.</span></p>', 100000, 30, 21, 0, 1, NULL, 'approved', 'active', 1, 2, '2025-08-03 02:28:43', '2025-08-03 02:32:08'),
(4, 19, 37, 'course', 'JavaScript Tutorial For Beginners', 'javascript-tutorial-for-beginners', 'javascript tutorial', '900', NULL, '/uploads/ha_cource688f2df07e26c.jpg', 'youtube', 'https://www.youtube.com/watch?v=I68O9oazLbo&list=PLZPZq0r_RZOMRMjHB_IEBjOW_ufr00yG1', '<p>/ konversi tipe = mengubah tipe data suatu nilai ke tipe data lain // (string, angka, boolean) let age = window.prompt(\"Berapa umurmu?\"); console.log(typeof age); age = Number(age); age += 1; console.log(\"Selamat Ulang Tahun! Kamu berumur\", age, \"tahun\"); /* let x; let y; let z; x = Number(\"pizza\"); y = String(3.14); z = Boolean(\"pizza\"); console.log(x, typeof x); console.log(y, typeof y); console.log(z, typeof z);</p>', 578, 21, 4, 0, 1, 'Hi, Happy Coding!', 'approved', 'active', 1, 2, '2025-08-03 02:37:52', '2025-08-05 08:13:22'),
(5, 19, 40, 'course', 'C++ Tutorial For Beginners', 'c-tutorial-for-beginners', 'C++ tutorial for begginers', '345', NULL, '/uploads/ha_cource688f2fe833240.jpg', 'youtube', 'https://www.youtube.com/watch?v=S3nx34WFXjI', '<p><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\">(</span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\"><a class=\"yt-core-attributed-string__link yt-core-attributed-string__link--call-to-action-color\" tabindex=\"0\" href=\"https://www.youtube.com/watch?v=S3nx34WFXjI&list=PLZPZq0r_RZOMHoXIcxze_lP97j2Ase2on&index=1\" target=\"\">00:00:00</a></span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\">) Why you should learn C++ (</span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\"><a class=\"yt-core-attributed-string__link yt-core-attributed-string__link--call-to-action-color\" tabindex=\"0\" href=\"https://www.youtube.com/watch?v=S3nx34WFXjI&list=PLZPZq0r_RZOMHoXIcxze_lP97j2Ase2on&index=1&t=168s\" target=\"\">00:02:48</a></span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\">) VS Code install (</span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\"><a class=\"yt-core-attributed-string__link yt-core-attributed-string__link--call-to-action-color\" tabindex=\"0\" href=\"https://www.youtube.com/watch?v=S3nx34WFXjI&list=PLZPZq0r_RZOMHoXIcxze_lP97j2Ase2on&index=1&t=234s\" target=\"\">00:03:54</a></span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\">) create a project folder (</span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\"><a class=\"yt-core-attributed-string__link yt-core-attributed-string__link--call-to-action-color\" tabindex=\"0\" href=\"https://www.youtube.com/watch?v=S3nx34WFXjI&list=PLZPZq0r_RZOMHoXIcxze_lP97j2Ase2on&index=1&t=254s\" target=\"\">00:04:14</a></span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\">) create a C++ file (</span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\"><a class=\"yt-core-attributed-string__link yt-core-attributed-string__link--call-to-action-color\" tabindex=\"0\" href=\"https://www.youtube.com/watch?v=S3nx34WFXjI&list=PLZPZq0r_RZOMHoXIcxze_lP97j2Ase2on&index=1&t=275s\" target=\"\">00:04:35</a></span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\">) documentation (</span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\"><a class=\"yt-core-attributed-string__link yt-core-attributed-string__link--call-to-action-color\" tabindex=\"0\" href=\"https://www.youtube.com/watch?v=S3nx34WFXjI&list=PLZPZq0r_RZOMHoXIcxze_lP97j2Ase2on&index=1&t=305s\" target=\"\">00:05:05</a></span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\">) GCC compiler for Linux (</span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\"><a class=\"yt-core-attributed-string__link yt-core-attributed-string__link--call-to-action-color\" tabindex=\"0\" href=\"https://www.youtube.com/watch?v=S3nx34WFXjI&list=PLZPZq0r_RZOMHoXIcxze_lP97j2Ase2on&index=1&t=328s\" target=\"\">00:05:28</a></span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\">) Clang compiler for Mac OS (</span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\"><a class=\"yt-core-attributed-string__link yt-core-attributed-string__link--call-to-action-color\" tabindex=\"0\" href=\"https://www.youtube.com/watch?v=S3nx34WFXjI&list=PLZPZq0r_RZOMHoXIcxze_lP97j2Ase2on&index=1&t=341s\" target=\"\">00:05:41</a></span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\">) GCC compiler for Windows (</span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\"><a class=\"yt-core-attributed-string__link yt-core-attributed-string__link--call-to-action-color\" tabindex=\"0\" href=\"https://www.youtube.com/watch?v=S3nx34WFXjI&list=PLZPZq0r_RZOMHoXIcxze_lP97j2Ase2on&index=1&t=550s\" target=\"\">00:09:10</a></span><span class=\"yt-core-attributed-string--link-inherit-color\" dir=\"auto\">) Your first C++ program </span></p>', 1000000, 43, 19, 0, 1, 'Happy coding!', 'approved', 'active', 1, 2, '2025-08-03 02:46:16', '2025-08-05 08:12:24'),
(6, 20, 23, 'course', 'Psychiatric Mental Health Nursing', 'psychiatric-mental-health-nursing', 'menta health nursing', '529', NULL, '/uploads/ha_cource688f320ee05bb.jpg', 'youtube', 'https://www.youtube.com/watch?v=Id0eQe8-0OY&list=PLj9YgcGzjQqxzyE7PjC30JUQN7Tjb67IO', '<p>reviews what we changed in our Psychiatric Mental Health flashcards, Edition 3, based on your feedback, and what great stuff stayed the same! If you love our flashcards, we think you\'ll find that our new ones have Leveled Up. Thank you for all your great feedback, comments, and suggestions that make our flashcards a must-have for any nurse!</p>', 190000, 12, NULL, 0, 0, 'Hi, thank for enroll this course', 'approved', 'active', 1, 2, '2025-08-03 02:55:26', '2025-08-04 21:41:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `course_categories`
--

CREATE TABLE `course_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `background` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `show_at_trending` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `course_categories`
--

INSERT INTO `course_categories` (`id`, `image`, `background`, `icon`, `name`, `slug`, `parent_id`, `show_at_trending`, `status`, `created_at`, `updated_at`) VALUES
(1, '/uploads/ha_cource688efe203caaa.png', '/uploads/ha_cource68914aabd5e99.jpg', NULL, 'Digital Marketing', 'digital-marketing', NULL, 1, 1, '2025-08-02 23:13:52', '2025-08-08 06:49:42'),
(2, '/uploads/ha_cource688efe42aede8.png', '/uploads/ha_cource6890c2fe948b4.jpg', NULL, 'Health & Fitness', 'health-fitness', NULL, 1, 1, '2025-08-02 23:14:26', '2025-08-04 07:26:11'),
(3, '/uploads/ha_cource688efe544bfc8.png', '/uploads/ha_cource68914abcc803e.jpg', NULL, 'Motion Graphics', 'motion-graphics', NULL, 1, 1, '2025-08-02 23:14:44', '2025-08-04 17:05:16'),
(4, '/uploads/ha_cource688efe64cacda.png', '/uploads/ha_cource68914ad0e8ba7.jpg', NULL, 'HTML & CSS', 'html-css', NULL, 1, 1, '2025-08-02 23:15:00', '2025-08-04 17:05:36'),
(5, '/uploads/ha_cource688efe75d822f.png', '/uploads/ha_cource68914ae28e8f2.jpg', NULL, 'Adobe Illustrator', 'adobe-illustrator', NULL, 1, 1, '2025-08-02 23:15:17', '2025-08-04 17:05:54'),
(6, '/uploads/ha_cource688efea231c6a.png', '/uploads/ha_cource68914b040d768.jpg', NULL, 'Business Strategy', 'business-strategy', NULL, 1, 1, '2025-08-02 23:16:02', '2025-08-04 17:06:28'),
(7, '/uploads/ha_cource688efeb911004.png', '/uploads/ha_cource68914b0fb6b8b.jpg', NULL, 'Mobile App Design', 'mobile-app-design', NULL, 1, 1, '2025-08-02 23:16:25', '2025-08-04 17:06:39'),
(8, '/uploads/ha_cource688efec774836.png', '/uploads/ha_cource68914b231ce83.jpg', NULL, 'Development', 'development', NULL, 1, 1, '2025-08-02 23:16:39', '2025-08-04 17:06:59'),
(9, '/uploads/ha_cource688efee6465b5.png', '/uploads/ha_cource68914b2f08d64.jpg', NULL, 'Product Design', 'product-design', NULL, 0, 1, '2025-08-02 23:17:10', '2025-08-04 17:07:11'),
(10, '/uploads/ha_cource688efefe427d8.png', '/uploads/ha_cource68914b3c7b1dc.jpg', NULL, 'Computer Science', 'computer-science', NULL, 0, 1, '2025-08-02 23:17:34', '2025-08-04 17:07:24'),
(11, '/uploads/ha_cource688eff1135fd8.png', '/uploads/ha_cource68914b50a7eb2.jpg', NULL, 'Music Class', 'music-class', NULL, 0, 1, '2025-08-02 23:17:53', '2025-08-04 17:07:44'),
(12, '/uploads/ha_cource688eff24c14c5.png', '/uploads/ha_cource68914ea927027.jpg', NULL, 'IT & Software', 'it-software', NULL, 0, 1, '2025-08-02 23:18:12', '2025-08-04 17:22:01'),
(13, NULL, NULL, NULL, 'Social Media Marketing', 'social-media-marketing', 1, 0, 1, '2025-08-03 02:01:46', '2025-08-03 02:01:46'),
(14, NULL, NULL, NULL, 'Search Engine Optimization (SEO)', 'search-engine-optimization-seo', 1, 1, 1, '2025-08-03 02:01:54', '2025-08-03 02:02:21'),
(15, NULL, NULL, NULL, 'Email Marketing', 'email-marketing', 1, 0, 1, '2025-08-03 02:02:07', '2025-08-03 02:02:07'),
(16, NULL, NULL, NULL, 'Content Marketing', 'content-marketing', 1, 0, 1, '2025-08-03 02:02:32', '2025-08-03 02:02:32'),
(17, NULL, NULL, NULL, 'Affiliate Marketing', 'affiliate-marketing', 1, 0, 1, '2025-08-03 02:02:41', '2025-08-03 02:02:41'),
(18, NULL, NULL, NULL, 'Digital Advertising (Google Ads, Facebook Ads)', 'digital-advertising-google-ads-facebook-ads', 1, 0, 1, '2025-08-03 02:02:50', '2025-08-03 02:02:50'),
(19, NULL, NULL, NULL, 'Analytics & Data Tracking', 'analytics-data-tracking', 1, 0, 1, '2025-08-03 02:03:00', '2025-08-03 02:03:00'),
(20, NULL, NULL, NULL, 'Nutrition & Diet', 'nutrition-diet', 2, 0, 1, '2025-08-03 02:03:27', '2025-08-03 02:03:27'),
(21, NULL, NULL, NULL, 'Yoga', 'yoga', 2, 0, 1, '2025-08-03 02:03:36', '2025-08-03 02:03:36'),
(22, NULL, NULL, NULL, 'Home Workouts', 'home-workouts', 2, 0, 1, '2025-08-03 02:03:47', '2025-08-03 02:03:47'),
(23, NULL, NULL, NULL, 'Mental Health', 'mental-health', 2, 0, 1, '2025-08-03 02:03:56', '2025-08-03 02:03:56'),
(24, NULL, NULL, NULL, 'Strength Training', 'strength-training', 2, 1, 1, '2025-08-03 02:04:05', '2025-08-03 02:04:24'),
(25, NULL, NULL, NULL, 'Weight Loss', 'weight-loss', 2, 0, 1, '2025-08-03 02:04:33', '2025-08-03 02:04:33'),
(26, NULL, NULL, NULL, 'Meditation & Mindfulness', 'meditation-mindfulness', 2, 0, 1, '2025-08-03 02:04:43', '2025-08-03 02:04:43'),
(27, NULL, NULL, NULL, 'After Effects Basics', 'after-effects-basics', 3, 0, 1, '2025-08-03 02:06:34', '2025-08-03 02:06:34'),
(28, NULL, NULL, NULL, '2D Animation', '2d-animation', 3, 0, 1, '2025-08-03 02:06:43', '2025-08-03 02:06:43'),
(29, NULL, NULL, NULL, '3D Motion Design', '3d-motion-design', 3, 0, 1, '2025-08-03 02:06:51', '2025-08-03 02:06:51'),
(30, NULL, NULL, NULL, 'Logo Animation', 'logo-animation', 3, 0, 1, '2025-08-03 02:07:00', '2025-08-03 02:07:00'),
(31, NULL, NULL, NULL, 'Typography Animation', 'typography-animation', 3, 0, 1, '2025-08-03 02:07:07', '2025-08-03 02:07:07'),
(32, NULL, NULL, NULL, 'HTML5 Fundamentals', 'html5-fundamentals', 4, 0, 1, '2025-08-03 02:07:33', '2025-08-03 02:07:33'),
(33, NULL, NULL, NULL, 'Responsive Web Design', 'responsive-web-design', 4, 0, 1, '2025-08-03 02:07:44', '2025-08-03 02:07:44'),
(34, NULL, NULL, NULL, 'Web Accessibility', 'web-accessibility', 4, 0, 1, '2025-08-03 02:07:52', '2025-08-03 02:07:52'),
(35, NULL, NULL, NULL, 'Sass & CSS Preprocessors', 'sass-css-preprocessors', 4, 0, 1, '2025-08-03 02:08:00', '2025-08-03 02:08:00'),
(36, NULL, NULL, NULL, 'Laravel', 'laravel', 8, 0, 1, '2025-08-03 02:09:25', '2025-08-03 02:09:25'),
(37, NULL, NULL, NULL, 'Javascript', 'javascript', 8, 0, 1, '2025-08-03 02:09:30', '2025-08-03 02:09:30'),
(38, NULL, NULL, NULL, 'Golang', 'golang', 8, 0, 1, '2025-08-03 02:09:35', '2025-08-03 02:09:35'),
(39, NULL, NULL, NULL, 'Ruby on Rails', 'ruby-on-rails', 8, 0, 1, '2025-08-03 02:09:46', '2025-08-03 02:09:46'),
(40, NULL, NULL, NULL, 'C++', 'c', 8, 0, 1, '2025-08-03 02:09:51', '2025-08-03 02:09:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `course_chapters`
--

CREATE TABLE `course_chapters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `course_chapters`
--

INSERT INTO `course_chapters` (`id`, `title`, `instructor_id`, `course_id`, `order`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Chapter 1', 18, 1, 1, 1, '2025-08-03 02:12:07', '2025-08-03 02:12:07'),
(2, 'Chapter 2', 18, 1, 2, 1, '2025-08-03 02:14:47', '2025-08-03 02:14:47'),
(3, 'Chapter 1', 18, 2, 1, 1, '2025-08-03 02:22:43', '2025-08-03 02:22:43'),
(4, 'Chapter 1', 18, 3, 1, 1, '2025-08-03 02:29:44', '2025-08-03 02:29:44'),
(5, 'Chapter 1', 19, 4, 1, 1, '2025-08-03 02:38:31', '2025-08-03 02:38:31'),
(6, 'Chapter 1', 19, 5, 1, 1, '2025-08-03 02:47:03', '2025-08-03 02:47:03'),
(7, 'Chapter 1', 20, 6, 1, 1, '2025-08-03 02:56:15', '2025-08-03 02:56:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `course_chapter_lessions`
--

CREATE TABLE `course_chapter_lessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `chapter_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` text NOT NULL,
  `storage` enum('upload','youtube','vimeo','external_link') NOT NULL,
  `volume` varchar(255) DEFAULT NULL,
  `duration` varchar(255) NOT NULL,
  `file_type` enum('video','audio','doc','file','pdf') NOT NULL,
  `downloadable` tinyint(1) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL,
  `is_preview` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `lesson_type` enum('lesson','live') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `course_chapter_lessions`
--

INSERT INTO `course_chapter_lessions` (`id`, `title`, `slug`, `description`, `instructor_id`, `course_id`, `chapter_id`, `file_path`, `storage`, `volume`, `duration`, `file_type`, `downloadable`, `order`, `is_preview`, `status`, `lesson_type`, `created_at`, `updated_at`) VALUES
(1, 'Your First Route and View', 'your-first-route-and-view', 'Whenever I learn a new framework, I transform into a beginner who wants to build a laughably basic three-page layout. It\'s a great way to learn how a request flows through your codebase! In this episode, you\'ll learn about basic routing and views.', 18, 1, 1, 'https://www.youtube.com/watch?v=KHxGAOv2Emc&list=PL3VM-unCzF8hy47mt9-chowaHNjfkuEVz&index=2', 'youtube', NULL, '6', 'video', 1, 1, 1, 1, 'lesson', '2025-08-03 02:12:49', '2025-08-03 02:12:49'),
(2, 'Create a Layout File Using Blade Components', 'create-a-layout-file-using-blade-components', 'We should create a layout file to reduce the amount of HTML duplication from the previous episode. This will provide the perfect opportunity to discuss Laravel components.', 18, 1, 1, 'https://www.youtube.com/watch?v=H5R3vV38QiM&list=PL3VM-unCzF8hy47mt9-chowaHNjfkuEVz&index=3', 'youtube', NULL, '11', 'video', 1, 2, 0, 1, 'lesson', '2025-08-03 02:13:44', '2025-08-03 02:13:44'),
(3, 'Make a Pretty Layout Using Tailwind CSS', 'make-a-pretty-layout-using-tailwind-css', 'Now that we understand the basics of how to link from page to page, let\'s take one episode to make a simple, but attractive HTML and CSS layout. Luckily, TailwindCSS and its components will make this work a cinch.', 18, 1, 1, 'https://www.youtube.com/watch?v=37QPJZ1la2g&list=PL3VM-unCzF8hy47mt9-chowaHNjfkuEVz&index=4', 'youtube', NULL, '28', 'video', 1, 3, 0, 1, 'lesson', '2025-08-03 02:14:32', '2025-08-03 02:14:32'),
(4, 'Style the Currently Active Navigation Link', 'style-the-currently-active-navigation-link', 'In this lesson, we\'ll learn how to apply special styling to the navigation link that matches the current page. Laravel provides a Request object that makes things like this a cinch.', 18, 1, 2, 'https://www.youtube.com/watch?v=3LvpPl5NjCg&list=PL3VM-unCzF8hy47mt9-chowaHNjfkuEVz&index=5', 'youtube', NULL, '13', 'video', 1, 1, 1, 1, 'lesson', '2025-08-03 02:15:56', '2025-08-03 02:15:56'),
(5, 'View Data and Route Wildcards', 'view-data-and-route-wildcards', 'We can pass an array of data as the second argument of the view() function. Each key in this array will then be extracted into a variable within your view. Let\'s build a basic two-page Job listings section to illustrate this.', 18, 1, 2, 'https://www.youtube.com/watch?v=mQHcDXYHUwY&list=PL3VM-unCzF8hy47mt9-chowaHNjfkuEVz&index=6', 'youtube', NULL, '20', 'video', 1, 2, 0, 1, 'lesson', '2025-08-03 02:16:39', '2025-08-03 02:16:39'),
(6, 'Apa yang melatarbelakangi penyelenggaraan Laracon?', 'apa-yang-melatarbelakangi-penyelenggaraan-laracon', 'Di episode ini, saya berbincang dengan Michael Dyrynda — pengembang dan penyelenggara Laracon AU — untuk melihat langsung di balik layar salah satu konferensi Laravel favorit dunia. Michael berbagi pengalamannya saat pertama kali dibuka, mengapa proses pendaftaran selalu menjadi tantangan, dan kegembiraan membantu pembicara pemula berhasil. Ia juga mengungkapkan detail-detail kecil yang menjadi obsesinya dan apa yang dapat dilakukan setiap pembicara untuk mempermudah hidup seorang penyelenggara. Baik Anda tertarik dengan Laravel, perencanaan acara, atau sekadar menyukai cerita-cerita menarik, percakapan singkat dan menarik ini sarat dengan wawasan dan kehangatan. Tekan tombol putar dan nikmati prosesnya!', 18, 2, 3, 'https://www.youtube.com/watch?v=9Kc3YinZkCg&list=PL3VM-unCzF8jcuDnK0PCrf3zrX5wLh_t0&index=2', 'youtube', NULL, '5', 'video', 0, 1, 1, 1, 'lesson', '2025-08-03 02:23:35', '2025-08-03 02:23:35'),
(7, 'Keajaiban Inertia.js - Menjalankan Jam Bersama Joe Tannenbaum', 'keajaiban-inertiajs-menjalankan-jam-bersama-joe-tannenbaum', 'Episode kali ini, kami berbincang dengan Joe Tannenbaum, yang bekerja di tim inti Laravel. Ia juga instruktur seri Laracasts, CLI Experiments.', 18, 2, 3, 'https://www.youtube.com/watch?v=XeNl7jjSUxo&list=PL3VM-unCzF8jcuDnK0PCrf3zrX5wLh_t0&index=3', 'youtube', NULL, '5', 'video', 1, 2, 0, 1, 'lesson', '2025-08-03 02:24:25', '2025-08-03 02:24:25'),
(8, 'Tidak Ada Penyesalan TypeScript? - Running Clock Bersama Matt Pocock', 'tidak-ada-penyesalan-typescript-running-clock-bersama-matt-pocock', 'Selamat datang di \"Running Clock,\" seri wawancara baru saya tempat saya melontarkan pertanyaan kepada para pengembang papan atas tentang alat, kerangka kerja, dan obsesi pengkodean favorit mereka. Masalahnya? Kita hanya punya waktu lima menit untuk menjawab semua pertanyaan saya...dan waktunya terus berjalan!', 18, 2, 3, 'https://www.youtube.com/watch?v=rBzlUjfqWko&list=PL3VM-unCzF8jcuDnK0PCrf3zrX5wLh_t0&index=4', 'youtube', NULL, '5', 'video', 1, 3, 0, 1, 'lesson', '2025-08-03 02:25:18', '2025-08-03 02:25:18'),
(9, 'Let\'s Build a SaaS in Laravel', 'lets-build-a-saas-in-laravel', 'There are endless tutorials online for how to build an idealized project, based on what\'s easy to teach. In this course, we\'re going to walk through the real-life, actual process to build a software-as-a-service, including the mistakes and misconceptions I ran into along the way. We\'ll build not based on what\'s easy to teach, but based on the weird and often-inconvenient stuff users request!', 18, 3, 4, 'https://www.youtube.com/watch?v=kk9Z9qs4tco&list=PL3VM-unCzF8jTUFqg8f-UropbAGu4VDIt&index=2', 'youtube', NULL, '3', 'video', 1, 1, 0, 1, 'lesson', '2025-08-03 02:31:05', '2025-08-03 02:31:05'),
(10, 'Variables and data types in JavaScript', 'variables-and-data-types-in-javascript', '// A variable is a container for storing data\r\n// A variable behaves as if it was the value that it contains\r\n\r\n// Two steps:\r\n// 1. Declaration (var, let, const)\r\n// 2. Assignment ( = assignment operator)\r\n\r\nlet firstName = \"Bro\"; //strings\r\nlet age = 21; //number\r\nlet student = true; //booleans\r\n\r\nconsole.log(\"Hello\", firstName);\r\nconsole.log(\"You are\", age, \"years old\");\r\nconsole.log(\"Enrolled:\", student);\r\n\r\ndocument.getElementById(\"p1\").innerHTML = \"Hello \" + firstName;\r\ndocument.getElementById(\"p2\").innerHTML = \"You are \" + age + \" years old\";\r\ndocument.getElementById(\"p3\").innerHTML = \"Enrolled: \" + student;', 19, 4, 5, 'https://www.youtube.com/watch?v=my3f_sUObhE&list=PLZPZq0r_RZOMRMjHB_IEBjOW_ufr00yG1&index=2', 'youtube', NULL, '8', 'video', 1, 1, 1, 1, 'lesson', '2025-08-03 02:39:25', '2025-08-03 02:39:25'),
(11, 'Arithmetic expressions in JavaScript', 'arithmetic-expressions-in-javascript', '/* \r\n   arithmetic expression is a combination of...\r\n   operands (values, variables, etc.)\r\n   operators (+ - * / %)\r\n   that can be evaluated to a value\r\n   ex. y = x + 5;\r\n*/\r\n\r\nlet students = 20;\r\n\r\n//students = students + 1;\r\n//students = students - 1;\r\n//students = students * 2;\r\n//students = students / 2;\r\n//let extraStudents = students % 2;\r\n//students = students ** 2;\r\n\r\nconsole.log(students);', 19, 4, 5, 'https://www.youtube.com/watch?v=WBiq2j95DP8&list=PLZPZq0r_RZOMRMjHB_IEBjOW_ufr00yG1&index=3', 'youtube', NULL, '8', 'video', 1, 2, 0, 1, 'lesson', '2025-08-03 02:40:20', '2025-08-03 02:40:20'),
(12, 'Variables and basic data types', 'variables-and-basic-data-types', 'C++ data types and variables tutorial example explained for beginners', 19, 5, 6, 'https://www.youtube.com/watch?v=4psGUiKacPQ&list=PLZPZq0r_RZOMHoXIcxze_lP97j2Ase2on&index=2', 'youtube', NULL, '10', 'video', 1, 1, 1, 1, 'lesson', '2025-08-03 02:47:42', '2025-08-03 02:47:42'),
(13, 'What is a const?', 'what-is-a-const', 'Const keyword C++ tutorial example explained', 19, 5, 6, 'https://www.youtube.com/watch?v=MwQEaCsS6UM&list=PLZPZq0r_RZOMHoXIcxze_lP97j2Ase2on&index=3', 'youtube', NULL, '3', 'video', 1, 2, 0, 1, 'lesson', '2025-08-03 02:49:02', '2025-08-03 02:49:02'),
(14, 'Introduction, Patient Rights', 'introduction-patient-rights', 'An introduction to our Psychiatric Mental Health Nursing video series. Learn PMH principles, starting with types of admissions/commitments (voluntary admission, involuntary commitment, emergency commitment) and patient rights (patient confidentiality, right to refuse treatment, right to least restrictive environment).', 20, 6, 7, 'https://www.youtube.com/watch?v=ZsEyrOWH6Mk&list=PLj9YgcGzjQqxb8eR0DCKHFWt3MEHSz2GY&index=2', 'youtube', NULL, '7', 'video', 0, 1, 1, 1, 'lesson', '2025-08-03 02:57:09', '2025-08-03 02:57:09'),
(15, 'Nursing Ethical Principles - Psychiatric Mental Health Nursing', 'nursing-ethical-principles-psychiatric-mental-health-nursing', 'Learn about Informed Consent, including the provider\'s and nurse\'s responsibilities with Informed Consent. Who IS and ISN\'T competent to provide informed consent. A review of nursing ethical principles, including: autonomy, beneficence, nonmaleficence, justice, fidelity, advocacy, and veracity.', 20, 6, 7, 'https://www.youtube.com/watch?v=V2H3qV67wUc&list=PLj9YgcGzjQqxb8eR0DCKHFWt3MEHSz2GY&index=3', 'youtube', NULL, '8', 'video', 1, 2, 0, 1, 'lesson', '2025-08-03 02:58:20', '2025-08-03 02:58:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `course_languages`
--

CREATE TABLE `course_languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `course_languages`
--

INSERT INTO `course_languages` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Indonesian', 'indonesian', '2025-08-02 23:33:52', '2025-08-02 23:33:52'),
(2, 'English', 'english', '2025-08-02 23:33:57', '2025-08-02 23:33:57'),
(3, 'Melayu', 'melayu', '2025-08-02 23:34:29', '2025-08-02 23:34:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `course_levels`
--

CREATE TABLE `course_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `course_levels`
--

INSERT INTO `course_levels` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Beginner', 'begginer', '2025-08-02 23:34:45', '2025-08-02 23:35:03'),
(2, 'Intermediate', 'intermediate', '2025-08-02 23:35:08', '2025-08-02 23:35:08'),
(3, 'Expert', 'expert', '2025-08-02 23:35:14', '2025-08-02 23:35:14');

-- --------------------------------------------------------

--
-- Struktur dari tabel `custom_pages`
--

CREATE TABLE `custom_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `show_at_nav` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `enrollments`
--

CREATE TABLE `enrollments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `have_access` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `enrollments`
--

INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `instructor_id`, `have_access`, `created_at`, `updated_at`) VALUES
(1, 18, 5, 19, 1, '2025-08-04 00:25:28', '2025-08-04 00:25:28'),
(2, 18, 6, 20, 1, '2025-08-04 00:25:28', '2025-08-04 00:25:28'),
(3, 21, 3, 18, 1, '2025-08-04 01:16:52', '2025-08-04 01:16:52'),
(4, 21, 5, 19, 1, '2025-08-04 01:17:41', '2025-08-04 01:17:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `featured_instructors`
--

CREATE TABLE `featured_instructors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `featured_courses` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`featured_courses`)),
  `instructor_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `featured_instructors`
--

INSERT INTO `featured_instructors` (`id`, `title`, `subtitle`, `button_text`, `button_url`, `instructor_id`, `featured_courses`, `instructor_image`, `created_at`, `updated_at`) VALUES
(1, 'Find Your Match From Spotlighted Collection', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 'All Featured Courses', '/', 18, '[\"1\",\"2\",\"3\"]', '/uploads/ha_cource68907cda43b4c.png', '2025-08-04 02:26:50', '2025-08-04 02:26:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_one` varchar(255) DEFAULT NULL,
  `title_one` varchar(255) DEFAULT NULL,
  `subtitle_one` varchar(255) DEFAULT NULL,
  `image_two` varchar(255) DEFAULT NULL,
  `title_two` varchar(255) DEFAULT NULL,
  `subtitle_two` varchar(255) DEFAULT NULL,
  `image_three` varchar(255) DEFAULT NULL,
  `title_three` varchar(255) DEFAULT NULL,
  `subtitle_three` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `features`
--

INSERT INTO `features` (`id`, `image_one`, `title_one`, `subtitle_one`, `image_two`, `title_two`, `subtitle_two`, `image_three`, `title_three`, `subtitle_three`, `created_at`, `updated_at`) VALUES
(1, '/uploads/ha_cource688f07ae6dd43.png', 'Learn From Experts', 'LMS allows users to create organize and manage courses.', '/uploads/ha_cource688f07ae6e7d1.png', 'Earn a Certificate', 'LMS allows users to create organize and manage courses.', '/uploads/ha_cource688f07ae6ea2d.png', 'Features 5400+ Courses', 'LMS allows users to create organize and manage courses.', '2025-08-02 23:53:31', '2025-08-02 23:54:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `footers`
--

CREATE TABLE `footers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `copyright` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `footers`
--

INSERT INTO `footers` (`id`, `description`, `copyright`, `phone`, `address`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Nunc in sollicitudin diam, ut bibendum malesuada sodales porttitor.', 'hafidtech.com', '+6288298654539', 'Jl.Pemuda No.0, Rawamangun, Jakarta Timur', 'contact@hafidtech.com', '2025-08-03 01:00:18', '2025-08-03 01:00:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `footer_column_ones`
--

CREATE TABLE `footer_column_ones` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `footer_column_ones`
--

INSERT INTO `footer_column_ones` (`id`, `title`, `url`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Life Coach', '/', 1, '2025-08-03 01:00:40', '2025-08-03 01:00:40'),
(2, 'Business Coach', '/', 1, '2025-08-03 01:00:54', '2025-08-03 01:00:54'),
(3, 'Health Coach', '/', 1, '2025-08-03 01:01:05', '2025-08-03 01:01:05'),
(4, 'Development', '/', 1, '2025-08-03 01:01:17', '2025-08-03 01:01:17'),
(5, 'SEO Optimize', '/', 1, '2025-08-03 01:01:28', '2025-08-03 01:01:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `footer_column_twos`
--

CREATE TABLE `footer_column_twos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `footer_column_twos`
--

INSERT INTO `footer_column_twos` (`id`, `title`, `url`, `status`, `created_at`, `updated_at`) VALUES
(1, 'The Arts', '/', 1, '2025-08-03 01:01:39', '2025-08-03 01:01:39'),
(2, 'Human Sciences', '/', 1, '2025-08-03 01:02:08', '2025-08-03 01:02:08'),
(3, 'Economics', '/', 1, '2025-08-03 01:02:20', '2025-08-03 01:02:20'),
(4, 'Natural Sciences', '/', 1, '2025-08-03 01:02:39', '2025-08-03 01:02:39'),
(5, 'Business', '/', 1, '2025-08-03 01:03:04', '2025-08-03 01:03:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `heroes`
--

CREATE TABLE `heroes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `video_button_text` varchar(255) DEFAULT NULL,
  `video_button_url` varchar(255) DEFAULT NULL,
  `banner_item_title` varchar(255) DEFAULT NULL,
  `banner_item_subtitle` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `round_text` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `heroes`
--

INSERT INTO `heroes` (`id`, `label`, `title`, `subtitle`, `button_text`, `button_url`, `video_button_text`, `video_button_url`, `banner_item_title`, `banner_item_subtitle`, `image`, `round_text`, `created_at`, `updated_at`) VALUES
(1, 'Show Up For Learning', 'Premier E-Learning Courses From EduCore', 'Nullam tincidunt tortor est, ac maximus justo gravida non phasellus dignissim quam odio ipsum sollicitudin rhoncus venenatis ex metus in turpis.', 'Start Free Trial', '/', 'See Our Lesson Showcase', 'https://www.youtube.com/watch?v=3ToEb_WMYzg&list=RD3ToEb_WMYzg&start_radio=1', '250+ Popular Course', 'Explore a variety of fresh topics', '/uploads/ha_cource688f0640c66e4.png', 'BEST ONLINE COURSE TAKE THE WORLDWIDE', '2025-08-02 23:48:32', '2025-08-02 23:48:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `instructor_payout_information`
--

CREATE TABLE `instructor_payout_information` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `gateway` varchar(255) NOT NULL,
  `information` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `latest_course_sections`
--

CREATE TABLE `latest_course_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_one` bigint(20) UNSIGNED DEFAULT NULL,
  `category_two` bigint(20) UNSIGNED DEFAULT NULL,
  `category_three` bigint(20) UNSIGNED DEFAULT NULL,
  `category_four` bigint(20) UNSIGNED DEFAULT NULL,
  `category_five` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_04_06_065626_create_admins_table', 1),
(5, '2025_04_20_060514_create_course_languages_table', 1),
(6, '2025_04_20_123442_create_course_levels_table', 1),
(7, '2025_04_20_133841_create_course_categories_table', 1),
(8, '2025_04_25_073033_create_courses_table', 1),
(9, '2025_05_01_053420_create_course_chapters_table', 1),
(10, '2025_05_01_065143_create_course_chapter_lessions_table', 1),
(11, '2025_05_12_100932_create_carts_table', 1),
(12, '2025_05_14_143025_create_orders_table', 1),
(13, '2025_05_14_143427_create_order_items_table', 1),
(14, '2025_05_15_075158_create_enrollments_table', 1),
(15, '2025_05_15_083244_create_payment_settings_table', 1),
(16, '2025_05_20_213104_create_settings_table', 1),
(17, '2025_05_26_225843_create_payout_gateways_table', 1),
(18, '2025_05_27_090623_create_withdraws_table', 1),
(19, '2025_05_27_211755_create_instructor_payout_information_table', 1),
(20, '2025_05_29_075309_create_watch_histories_table', 1),
(21, '2025_06_01_082428_create_certificate_builders_table', 1),
(22, '2025_06_03_081335_create_certificate_builder_items_table', 1),
(23, '2025_06_05_100155_create_heroes_table', 1),
(24, '2025_06_06_134850_create_features_table', 1),
(25, '2025_06_08_043622_create_about_us_sections_table', 1),
(26, '2025_06_08_074835_create_latest_course_sections_table', 1),
(27, '2025_06_09_085124_create_newsletters_table', 1),
(28, '2025_06_09_204052_create_become_instructor_sections_table', 1),
(29, '2025_06_10_085951_create_video_sections_table', 1),
(30, '2025_06_10_205326_create_brands_table', 1),
(31, '2025_06_12_053330_create_featured_instructors_table', 1),
(32, '2025_06_15_093336_create_testimonials_table', 1),
(33, '2025_06_16_194510_create_counters_table', 1),
(34, '2025_06_18_082920_create_contacts_table', 1),
(35, '2025_06_19_092200_create_contact_settings_table', 1),
(36, '2025_06_22_044900_create_reviews_table', 1),
(37, '2025_06_23_063540_create_top_bars_table', 1),
(38, '2025_06_24_091608_create_footers_table', 1),
(39, '2025_06_25_073411_create_social_links_table', 1),
(40, '2025_06_26_073649_create_footer_column_ones_table', 1),
(41, '2025_06_26_073650_create_footer_column_twos_table', 1),
(42, '2025_06_29_082857_create_custom_pages_table', 1),
(43, '2025_07_01_091929_create_blog_categories_table', 1),
(44, '2025_07_02_050742_create_blogs_table', 1),
(45, '2025_07_14_063611_update_course_chapter_lessions_foreign_key', 1),
(46, '2025_07_20_113221_create_blog_comments_table', 1),
(47, '2025_07_22_215408_create_oauth_auth_codes_table', 1),
(48, '2025_07_22_215409_create_oauth_access_tokens_table', 1),
(49, '2025_07_22_215410_create_oauth_refresh_tokens_table', 1),
(50, '2025_07_22_215411_create_oauth_clients_table', 1),
(51, '2025_07_22_215412_create_oauth_device_codes_table', 1),
(52, '2025_07_22_215546_create_personal_access_tokens_table', 1),
(53, '2025_07_30_113953_create_activity_log_table', 1),
(54, '2025_07_30_113954_add_event_column_to_activity_log_table', 1),
(55, '2025_07_30_113955_add_batch_uuid_column_to_activity_log_table', 1),
(56, '2025_08_03_082508_update_blogs_table', 2),
(57, '2025_08_05_232252_add_document_status_to_users_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` char(80) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` char(80) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` char(36) NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` char(36) NOT NULL,
  `owner_type` varchar(255) DEFAULT NULL,
  `owner_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(255) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect_uris` text NOT NULL,
  `grant_types` text NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_device_codes`
--

CREATE TABLE `oauth_device_codes` (
  `id` char(80) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` char(36) NOT NULL,
  `user_code` char(8) NOT NULL,
  `scopes` text NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `user_approved_at` datetime DEFAULT NULL,
  `last_polled_at` datetime DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` char(80) NOT NULL,
  `access_token_id` char(80) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `buyer_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved') NOT NULL DEFAULT 'pending',
  `total_amount` double NOT NULL,
  `paid_amount` double NOT NULL,
  `currency` varchar(255) NOT NULL,
  `has_coupon` tinyint(1) NOT NULL DEFAULT 0,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_amount` double DEFAULT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `invoice_id`, `buyer_id`, `status`, `total_amount`, `paid_amount`, `currency`, `has_coupon`, `coupon_code`, `coupon_amount`, `transaction_id`, `payment_method`, `created_at`, `updated_at`) VALUES
(1, '689060682f86c', 18, 'approved', 31, 31, 'USD', 0, NULL, NULL, '49U29452H71928241', 'paypal', '2025-08-04 00:25:28', '2025-08-04 00:25:28'),
(2, '68906c741855f', 21, 'approved', 21, 21, 'USD', 0, NULL, NULL, '17K4599372713860R', 'paypal', '2025-08-04 01:16:52', '2025-08-04 01:16:52'),
(3, '68906ca52e23c', 21, 'approved', 19, 19, 'USD', 0, NULL, NULL, '1E300998YC051601E', 'paypal', '2025-08-04 01:17:41', '2025-08-04 01:17:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `price` double NOT NULL,
  `commission_rate` double DEFAULT NULL,
  `item_type` enum('course') NOT NULL DEFAULT 'course',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `course_id`, `qty`, `price`, `commission_rate`, `item_type`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 1, 19, 70, 'course', '2025-08-04 00:25:28', '2025-08-04 00:25:28'),
(2, 1, 6, 1, 12, 70, 'course', '2025-08-04 00:25:28', '2025-08-04 00:25:28'),
(3, 2, 3, 1, 21, 70, 'course', '2025-08-04 01:16:52', '2025-08-04 01:16:52'),
(4, 3, 5, 1, 19, 70, 'course', '2025-08-04 01:17:41', '2025-08-04 01:17:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_settings`
--

CREATE TABLE `payment_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'paypal_mode', 'sandbox', '2024-10-09 00:07:45', '2024-10-09 02:49:14'),
(2, 'paypal_client_id', 'AWPDtCm44vXv5NDEavf4026oMpPS1tlOSMfIF-NRqbgE9WKTXFcvAyn9DHb2Y-AMdsj2WckhSuKPqTY2', '2024-10-09 00:07:45', '2024-10-09 02:49:08'),
(3, 'paypal_client_secret', 'EKkvn-FnfwoszpgcImTjxxo-Apd-2UNbxRbivkf2HcoIa4ZJv24_lywlaNRJmiPD4LQEd05mWsBIrdS6', '2024-10-09 00:07:45', '2024-10-09 02:49:08'),
(4, 'paypal_currency', 'USD', '2024-10-09 00:07:45', '2024-10-09 02:48:23'),
(5, 'paypal_rate', '1', '2024-10-09 00:07:45', '2024-10-09 02:47:56'),
(6, 'paypal_app_id', 'XJC46AEBAMYBC', '2024-10-09 00:07:45', '2025-08-03 22:59:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payout_gateways`
--

CREATE TABLE `payout_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `review` text NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `course_id`, `review`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 21, 3, 'test', 4, 1, '2025-08-04 01:59:32', '2025-08-04 02:00:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Hafid Tech Course', '2024-10-12 23:07:49', '2024-10-12 23:11:58'),
(2, 'default_currency', 'USD', '2024-10-12 23:07:49', '2024-10-12 23:11:58'),
(3, 'currency_icon', '$', '2024-10-12 23:07:49', '2024-10-12 23:11:58'),
(4, 'phone', '+1 (228) 498-7767', '2024-10-12 23:09:47', '2024-10-12 23:10:06'),
(5, 'location', 'Sint nostrud laboru', '2024-10-12 23:10:06', '2024-10-12 23:10:06'),
(6, 'commission_rate', '70', '2024-10-13 02:43:53', '2024-10-13 02:43:53'),
(7, 'receiver_email', 'admin.support@gmail.com', '2024-10-30 21:35:32', '2024-10-30 21:35:32'),
(8, 'sender_email', 'admin@gmail.com', '2024-10-30 21:35:32', '2024-10-30 21:35:32'),
(9, 'site_logo', '/uploads/ha_cource6890bda70e9d2.png', '2024-11-10 02:50:10', '2025-08-04 07:03:19'),
(10, 'site_footer_logo', '/uploads/ha_cource6890bda712b0b.png', '2024-11-10 02:50:10', '2025-08-04 07:03:19'),
(11, 'site_favicon', '/uploads/ha_cource6890bda712c69.png', '2024-11-10 02:50:10', '2025-08-04 07:03:19'),
(12, 'site_breadcrumb', '/uploads/ha_cource6890bda712d44.jpg', '2024-11-10 02:50:10', '2025-08-04 07:03:19'),
(13, 'mail_mailer', 'smtp', '2024-11-10 04:50:17', '2024-11-10 04:50:49'),
(14, 'mail_host', 'sandbox.smtp.mailtrap.io', '2024-11-10 04:50:17', '2024-11-10 04:50:49'),
(15, 'mail_port', '2525', '2024-11-10 04:50:17', '2024-11-10 04:50:49'),
(16, 'mail_username', '64873daf495440', '2024-11-10 04:50:17', '2025-08-06 01:29:01'),
(17, 'mail_password', 'ad63d0846ee854', '2024-11-10 04:50:17', '2025-08-06 01:29:01'),
(18, 'mail_encryption', 'tls', '2024-11-10 04:50:17', '2024-11-10 04:50:49'),
(19, 'mail_queue', '1', '2024-11-10 04:50:17', '2024-11-10 04:50:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `social_links`
--

CREATE TABLE `social_links` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `social_links`
--

INSERT INTO `social_links` (`id`, `icon`, `url`, `status`, `created_at`, `updated_at`) VALUES
(1, 'fab fa-facebook-f', 'https://facebook.com', 1, '2025-08-03 01:03:57', '2025-08-03 01:03:57'),
(2, 'fab fa-twitter', 'https://twitter.com', 1, '2025-08-03 01:04:14', '2025-08-03 01:04:14'),
(3, 'fab fa-linkedin', 'https://linkedin.com', 1, '2025-08-03 01:04:28', '2025-08-03 01:04:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `review` text NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `top_bars`
--

CREATE TABLE `top_bars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `offer_name` varchar(255) DEFAULT NULL,
  `offer_short_description` varchar(255) DEFAULT NULL,
  `offer_button_text` varchar(255) DEFAULT NULL,
  `offer_button_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `top_bars`
--

INSERT INTO `top_bars` (`id`, `email`, `phone`, `offer_name`, `offer_short_description`, `offer_button_text`, `offer_button_url`, `created_at`, `updated_at`) VALUES
(1, 'contact@hafidtech.com', '+6288298654539', '2025 Big Discount %', 'Lorem Ipsum is simply dummy text.', 'Click Here!', 'https://hafidtech.id', '2025-08-03 00:59:44', '2025-08-03 00:59:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('instructor','student') NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `headline` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `bio` text DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `x` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `approve_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `login_as` enum('student','instructor') DEFAULT NULL,
  `wallet` double NOT NULL DEFAULT 0,
  `gauth_id` varchar(255) DEFAULT NULL,
  `gauth_type` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `document_status` enum('pending','approved','rejected') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `role`, `image`, `name`, `headline`, `email`, `bio`, `gender`, `document`, `email_verified_at`, `password`, `facebook`, `x`, `linkedin`, `website`, `github`, `approve_status`, `login_as`, `wallet`, `gauth_id`, `gauth_type`, `remember_token`, `created_at`, `updated_at`, `document_status`) VALUES
(18, 'instructor', '/uploads/ha_cource6891956f90010.jpg', 'Kim Jong Un', NULL, 'kimjongun@gmail.com', NULL, NULL, '/uploads/ha_cource688f2d1d01af5.png', '2025-08-03 01:36:21', '$2y$12$7Vg6PqTzo.Vmf6J7rWWA0.z/qRyE2IO5LqxuKf.HdQWbUVm0oRtSO', NULL, NULL, NULL, NULL, NULL, 'approved', NULL, 14.7, NULL, NULL, NULL, NULL, '2025-08-04 22:23:59', 'approved'),
(19, 'instructor', '/uploads/ha_cource6891951615864.jpg', 'Bruno Earth', NULL, 'bruno@gmail.com', NULL, NULL, '/uploads/ha_cource688f2d1d01af5.png', '2025-08-03 02:34:50', '$2y$12$EUeb1ghMC5c.9kiDiL0/Ru9qk0zm6qTef4GIue3grvAk.z.7yx7OS', NULL, NULL, NULL, NULL, NULL, 'approved', NULL, 26.6, NULL, NULL, NULL, '2025-08-03 02:34:21', '2025-08-04 22:22:30', 'approved'),
(20, 'instructor', '/uploads/ha_cource68918e46bca82.jpg', 'Sally Fatimah', NULL, 'sally@gmail.com', NULL, NULL, '/uploads/ha_cource688f31769a5e0.jpg', '2025-08-03 02:53:10', '$2y$12$cjQPnqLRNC8uxneKRgJ5DeOHTAE9euE7wZ/ZomKx8n.BASEwNMzba', NULL, NULL, NULL, NULL, NULL, 'approved', NULL, 8.4, NULL, NULL, NULL, '2025-08-03 02:52:55', '2025-08-04 21:53:26', 'approved'),
(21, 'instructor', '/uploads/ha_cource689076b4d8f18.jpg', 'Khafid', NULL, 'afidzpratama@gmail.com', NULL, NULL, '/uploads/ha_cource6895ffa45e759.png', '2025-08-03 03:18:38', '$2y$12$s75ZlGVRIbwK9VeKFBohGuHi2AxmIgVicNK0smWEoj2xEv9R/PaAa', NULL, NULL, NULL, NULL, NULL, 'approved', NULL, 0, '105235256157177159515', 'google', NULL, '2025-08-03 03:18:38', '2025-08-08 06:46:18', 'approved'),
(23, 'instructor', NULL, 'Aulia Rahma', NULL, 'aulia@gmail.com', NULL, NULL, '/uploads/ha_cource6895b07728ec3.jpg', '2025-08-06 01:30:09', '$2y$12$qYJiD2O/cwVt7Yd2L5SFJu8xMwks8ZhlGIavlRuHkH.twmn2v2FJ.', NULL, NULL, NULL, NULL, NULL, 'approved', NULL, 0, NULL, NULL, NULL, '2025-08-06 01:29:51', '2025-08-08 01:09:04', 'approved');

-- --------------------------------------------------------

--
-- Struktur dari tabel `video_sections`
--

CREATE TABLE `video_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `background` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `video_sections`
--

INSERT INTO `video_sections` (`id`, `background`, `video_url`, `description`, `button_text`, `button_url`, `created_at`, `updated_at`) VALUES
(1, '/uploads/ha_cource688f0b3fca631.jpg', 'https://www.youtube.com/watch?v=bixZggaAiJk', 'LMS allows administrators and instructors to create, organize, and deliver courses. This includes uploading course content, managing materials, and setting assessments.Cras quis ligula ac felis Donec cursus augue quis maximus morbi senectus.', 'Free Online Courses', '/', '2025-08-03 00:09:51', '2025-08-03 00:09:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `watch_histories`
--

CREATE TABLE `watch_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `chapter_id` bigint(20) UNSIGNED NOT NULL,
  `lesson_id` bigint(20) UNSIGNED NOT NULL,
  `is_completed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `watch_histories`
--

INSERT INTO `watch_histories` (`id`, `user_id`, `course_id`, `chapter_id`, `lesson_id`, `is_completed`, `created_at`, `updated_at`) VALUES
(1, 21, 3, 4, 9, 0, '2025-08-04 01:17:10', '2025-08-08 01:25:12'),
(2, 21, 5, 6, 12, 1, '2025-08-04 01:18:00', '2025-08-04 02:28:02'),
(3, 21, 5, 6, 13, 1, '2025-08-04 01:18:01', '2025-08-04 07:05:02'),
(4, 18, 5, 6, 12, 1, '2025-08-04 01:41:44', '2025-08-04 01:42:29'),
(5, 18, 5, 6, 13, 1, '2025-08-04 01:42:31', '2025-08-04 01:42:36'),
(6, 18, 6, 7, 14, 0, '2025-08-06 22:48:23', '2025-08-06 22:48:23'),
(7, 18, 6, 7, 15, 0, '2025-08-06 22:48:28', '2025-08-06 22:48:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `withdraws`
--

CREATE TABLE `withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructor_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `about_us_sections`
--
ALTER TABLE `about_us_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indeks untuk tabel `become_instructor_sections`
--
ALTER TABLE `become_instructor_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_blog_category_id_foreign` (`blog_category_id`),
  ADD KEY `blogs_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_comments_user_id_foreign` (`user_id`),
  ADD KEY `blog_comments_blog_id_foreign` (`blog_id`),
  ADD KEY `blog_comments_parent_id_foreign` (`parent_id`);

--
-- Indeks untuk tabel `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_course_id_foreign` (`course_id`);

--
-- Indeks untuk tabel `certificate_builders`
--
ALTER TABLE `certificate_builders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `certificate_builder_items`
--
ALTER TABLE `certificate_builder_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `contact_settings`
--
ALTER TABLE `contact_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `counters`
--
ALTER TABLE `counters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_instructor_id_foreign` (`instructor_id`);

--
-- Indeks untuk tabel `course_categories`
--
ALTER TABLE `course_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_categories_name_unique` (`name`),
  ADD UNIQUE KEY `course_categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `course_chapters`
--
ALTER TABLE `course_chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_chapters_instructor_id_foreign` (`instructor_id`),
  ADD KEY `course_chapters_course_id_foreign` (`course_id`);

--
-- Indeks untuk tabel `course_chapter_lessions`
--
ALTER TABLE `course_chapter_lessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_chapter_lessions_instructor_id_foreign` (`instructor_id`),
  ADD KEY `course_chapter_lessions_chapter_id_foreign` (`chapter_id`),
  ADD KEY `course_chapter_lessions_course_id_foreign` (`course_id`);

--
-- Indeks untuk tabel `course_languages`
--
ALTER TABLE `course_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_languages_slug_unique` (`slug`);

--
-- Indeks untuk tabel `course_levels`
--
ALTER TABLE `course_levels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_levels_slug_unique` (`slug`);

--
-- Indeks untuk tabel `custom_pages`
--
ALTER TABLE `custom_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrollments_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `featured_instructors`
--
ALTER TABLE `featured_instructors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `featured_instructors_instructor_id_foreign` (`instructor_id`);

--
-- Indeks untuk tabel `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `footers`
--
ALTER TABLE `footers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `footer_column_ones`
--
ALTER TABLE `footer_column_ones`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `footer_column_twos`
--
ALTER TABLE `footer_column_twos`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `heroes`
--
ALTER TABLE `heroes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `instructor_payout_information`
--
ALTER TABLE `instructor_payout_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructor_payout_information_instructor_id_foreign` (`instructor_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `latest_course_sections`
--
ALTER TABLE `latest_course_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indeks untuk tabel `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indeks untuk tabel `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_owner_type_owner_id_index` (`owner_type`,`owner_id`);

--
-- Indeks untuk tabel `oauth_device_codes`
--
ALTER TABLE `oauth_device_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `oauth_device_codes_user_code_unique` (`user_code`),
  ADD KEY `oauth_device_codes_user_id_index` (`user_id`),
  ADD KEY `oauth_device_codes_client_id_index` (`client_id`);

--
-- Indeks untuk tabel `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_buyer_id_foreign` (`buyer_id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payout_gateways`
--
ALTER TABLE `payout_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indeks untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_course_id_foreign` (`course_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `social_links`
--
ALTER TABLE `social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `top_bars`
--
ALTER TABLE `top_bars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `video_sections`
--
ALTER TABLE `video_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `watch_histories`
--
ALTER TABLE `watch_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `watch_histories_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdraws_instructor_id_foreign` (`instructor_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `about_us_sections`
--
ALTER TABLE `about_us_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `become_instructor_sections`
--
ALTER TABLE `become_instructor_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `certificate_builders`
--
ALTER TABLE `certificate_builders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `certificate_builder_items`
--
ALTER TABLE `certificate_builder_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `contact_settings`
--
ALTER TABLE `contact_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `counters`
--
ALTER TABLE `counters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `course_categories`
--
ALTER TABLE `course_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `course_chapters`
--
ALTER TABLE `course_chapters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `course_chapter_lessions`
--
ALTER TABLE `course_chapter_lessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `course_languages`
--
ALTER TABLE `course_languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `course_levels`
--
ALTER TABLE `course_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `custom_pages`
--
ALTER TABLE `custom_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `featured_instructors`
--
ALTER TABLE `featured_instructors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `footers`
--
ALTER TABLE `footers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `footer_column_ones`
--
ALTER TABLE `footer_column_ones`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `footer_column_twos`
--
ALTER TABLE `footer_column_twos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `heroes`
--
ALTER TABLE `heroes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `instructor_payout_information`
--
ALTER TABLE `instructor_payout_information`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `latest_course_sections`
--
ALTER TABLE `latest_course_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `payout_gateways`
--
ALTER TABLE `payout_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `social_links`
--
ALTER TABLE `social_links`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `top_bars`
--
ALTER TABLE `top_bars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `video_sections`
--
ALTER TABLE `video_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `watch_histories`
--
ALTER TABLE `watch_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD CONSTRAINT `blog_comments_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_comments_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `blog_comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blog_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `course_chapters`
--
ALTER TABLE `course_chapters`
  ADD CONSTRAINT `course_chapters_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_chapters_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `course_chapter_lessions`
--
ALTER TABLE `course_chapter_lessions`
  ADD CONSTRAINT `course_chapter_lessions_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `course_chapters` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_chapter_lessions_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_chapter_lessions_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `featured_instructors`
--
ALTER TABLE `featured_instructors`
  ADD CONSTRAINT `featured_instructors_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `instructor_payout_information`
--
ALTER TABLE `instructor_payout_information`
  ADD CONSTRAINT `instructor_payout_information_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Ketidakleluasaan untuk tabel `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `watch_histories`
--
ALTER TABLE `watch_histories`
  ADD CONSTRAINT `watch_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `withdraws`
--
ALTER TABLE `withdraws`
  ADD CONSTRAINT `withdraws_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
