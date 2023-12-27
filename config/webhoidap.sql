-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 27, 2023 at 01:59 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webhoidap`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id_answer` int NOT NULL AUTO_INCREMENT,
  `author` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `edited_at` datetime NOT NULL,
  `status` char(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_question` int DEFAULT NULL,
  `upvote` int DEFAULT '0',
  `downvote` int DEFAULT '0',
  PRIMARY KEY (`id_answer`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id_answer`, `author`, `content`, `created_at`, `edited_at`, `status`, `id_question`, `upvote`, `downvote`) VALUES
(32, 'nhan', 'Hello', '2023-12-24 11:46:00', '2023-12-24 11:48:00', 'answer', 7, 0, 0),
(31, 'nhan', 'HI', '2023-12-24 11:46:00', '2023-12-24 11:48:00', 'answer', 7, 0, 0),
(30, 'nhan', 'stop ask any question that you can search on google!', '2023-12-24 11:46:00', '2023-12-24 11:48:00', 'answer', 9, 0, 0),
(28, 'nhan', 'By using GPT you will save a lot of your time', '2023-12-24 11:46:00', '2023-12-24 11:48:00', 'answer', 23, 1, 0),
(29, 'nguyenvanb', 'Have you created a gpt account yet?', '2023-12-24 11:46:00', '2023-12-24 11:48:00', 'answer', 23, 0, 1),
(33, 'nhan', 'No', '2023-12-24 11:46:00', '2023-12-24 11:48:00', 'answer', 7, 0, 0),
(34, 'nhan', 'Minimal Recycler view ready to use Kotlin template for:\nVertical layout\nA single TextView on each row\nResponds to click events (Single and LongPress)\nI know this is an old thread and so answer here. Adding this answer for future reference:\n\nAdd Recycle view in Build dependency\n\n  implementation \'com.google.android.material:material:1.4.0-alpha02\'\n    // RecyclerView\n    implementation \"androidx.recyclerview:recyclerview:1.2.0\"\nAdd a recycle view in your layout\n\n   <androidx.recyclerview.widget.RecyclerView\n            android:id=\"@+id/wifiList\"\n            android:layout_width=\"match_parent\"\n            android:layout_height=\"match_parent\"\n           /> \nCreate a layout to display list items (list_item.xml)\n\n<?xml version=\"1.0\" encoding=\"utf-8\"?>\n<androidx.cardview.widget.CardView\n    xmlns:android=\"http://schemas.android.com/apk/res/android\"\n    android:layout_width=\"match_parent\"\n    android:layout_height=\"wrap_content\">\n    <LinearLayout\n        android:padding=\"5dp\"\n        android:layout_width=\"match_parent\"\n        android:orientation=\"vertical\"\n        android:layout_height=\"wrap_content\">\n\n        <androidx.appcompat.widget.AppCompatTextView\n            android:id=\"@+id/ssid\"\n            android:text=\"@string/app_name\"\n            android:layout_width=\"match_parent\"\n            android:textSize=\"17sp\"\n            android:layout_height=\"wrap_content\" />\n        \n    </LinearLayout>\n\n</androidx.cardview.widget.CardView>\nNow create a minimal Adapter to hold data, code here is self-explanatory\n\n class WifiAdapter(private val wifiList: ArrayList<ScanResult>) : RecyclerView.Adapter<WifiAdapter.ViewHolder>() {\n\n     // holder class to hold reference\n    inner class ViewHolder(view: View) : RecyclerView.ViewHolder(view) {\n        //get view reference\n        var ssid: TextView = view.findViewById(R.id.ssid) as TextView\n    }\n\n     override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {\n         // create view holder to hold reference\n         return ViewHolder( LayoutInflater.from(parent.context).inflate(R.layout.list_item, parent, false))\n     }\n\n    override fun onBindViewHolder(holder: ViewHolder, position: Int) {\n        //set values\n        holder.ssid.text =  wifiList[position].SSID\n    }\n\n    override fun getItemCount(): Int {\n        return wifiList.size\n    }\n      // update your data\n     fun updateData(scanResult: ArrayList<ScanResult>) {\n         wifiList.clear()\n         notifyDataSetChanged()\n         wifiList.addAll(scanResult)\n         notifyDataSetChanged()\n\n     }\n }\nAdd this class to handle Single click and long click events on List Items\n\nimport android.content.Context;\nimport androidx.recyclerview.widget.RecyclerView\nimport androidx.recyclerview.widget.RecyclerView.OnItemTouchListener\nimport android.view.GestureDetector;\nimport android.view.MotionEvent;\nimport android.view.View;\n\npublic class RecyclerTouchListener implements RecyclerView.OnItemTouchListener {\n\n    public interface ClickListener {\n        void onClick(View view, int position);\n\n        void onLongClick(View view, RecyclerView recyclerView, int position);\n\n    }\n    private GestureDetector gestureDetector;\n    private ClickListener clickListener;\n\n    public RecyclerTouchListener(Context context, final RecyclerView recyclerView, final ClickListener clickListener) {\n        this.clickListener = clickListener;\n        gestureDetector = new GestureDetector(context, new GestureDetector.SimpleOnGestureListener() {\n            @Override\n            public boolean onSingleTapUp(MotionEvent e) {\n                return true;\n            }\n\n            @Override\n            public void onLongPress(MotionEvent e) {\n                View child = recyclerView.findChildViewUnder(e.getX(), e.getY());\n                if (child != null && clickListener != null) {\n                    clickListener.onLongClick(child,recyclerView,  recyclerView.getChildPosition(child));\n                }\n            }\n        });\n    }\n\n\n    @Override\n    public boolean onInterceptTouchEvent(RecyclerView rv, MotionEvent e) {\n        View child = rv.findChildViewUnder(e.getX(), e.getY());\n        if (child != null && clickListener != null && gestureDetector.onTouchEvent(e)) {\n            clickListener.onClick(child, rv.getChildPosition(child));\n        }\n        return false;\n    }\n\n    @Override\n    public void onTouchEvent(RecyclerView rv, MotionEvent e) {\n\n    }\n\n    @Override\n    public void onRequestDisallowInterceptTouchEvent(boolean disallowIntercept) {\n\n    }\nLastly Set your adapter to Recycler View and add Touch Listener to start intercepting touch event for a single or double tap on list items', '2023-12-24 11:46:00', '2023-12-24 11:48:00', 'answer', 23, 0, 0),
(35, 'nhan', 'People hunt animals for various reasons, including obtaining food, managing wildlife populations, engaging in recreational activities, and traditional practices.', '2023-12-26 17:28:00', '2023-12-26 17:28:00', 'answer', 58, 1, 0),
(36, 'toilanam', 'Food Source:\n\nHistorically, hunting has been a primary means for people to obtain food, especially in traditional societies and among certain communities.\nWildlife Population Management:\n\nHunting is used as a tool for managing wildlife populations, preventing overpopulation that can lead to ecological imbalances.\nRecreational Activities:\n\nMany individuals engage in hunting as a recreational activity, enjoying the challenge, skill, and connection with nature it provides.\nConservation and Wildlife Management:\n\nSome hunters participate in conservation efforts, contributing to wildlife management programs and habitat preservation.\nCultural and Traditional Practices:\n\nHunting is deeply rooted in the cultural and traditional practices of certain communities, often playing a significant role in their history and heritage.\n\n\n\n\n', '2023-12-26 17:34:00', '2023-12-26 17:34:00', 'answer', 58, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
CREATE TABLE IF NOT EXISTS `bookmarks` (
  `question_id` int NOT NULL,
  `marked_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`question_id`,`marked_by`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`question_id`, `marked_by`, `created_at`) VALUES
(22, 'nhan', '2023-12-21'),
(58, 'nhan', '2023-12-26'),
(7, 'nhan', '2023-12-22'),
(23, 'nhan', '2023-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `hashtags`
--

DROP TABLE IF EXISTS `hashtags`;
CREATE TABLE IF NOT EXISTS `hashtags` (
  `id_hashtag` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_hashtag`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hashtags`
--

INSERT INTO `hashtags` (`id_hashtag`, `name`) VALUES
(1, 'geography'),
(2, 'study'),
(3, 'mountain'),
(12, 'Boostrap'),
(10, 'Programming'),
(11, 'HTML'),
(9, 'world'),
(13, 'JQuery'),
(14, 'Android Studio'),
(15, 'a'),
(16, 'b'),
(17, 'c'),
(18, 'dd2'),
(19, 'animals'),
(20, 'natural'),
(21, 'wild');

-- --------------------------------------------------------

--
-- Table structure for table `hashtag_question`
--

DROP TABLE IF EXISTS `hashtag_question`;
CREATE TABLE IF NOT EXISTS `hashtag_question` (
  `id_hashtag` int NOT NULL,
  `id_question` int NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id_hashtag`,`id_question`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hashtag_question`
--

INSERT INTO `hashtag_question` (`id_hashtag`, `id_question`, `created_at`) VALUES
(9, 9, '2023-12-23 09:16:00'),
(3, 9, '2023-12-23 09:16:00'),
(2, 9, '2023-12-23 09:16:00'),
(1, 9, '2023-12-23 09:16:00'),
(1, 7, '2023-12-23 09:16:00'),
(20, 57, '0000-00-00 00:00:00'),
(19, 57, '0000-00-00 00:00:00'),
(9, 7, '2023-12-23 09:16:00'),
(21, 57, '0000-00-00 00:00:00'),
(20, 58, '0000-00-00 00:00:00'),
(12, 22, '2023-12-23 09:16:00'),
(11, 22, '2023-12-23 09:16:00'),
(13, 22, '2023-12-23 09:16:00'),
(10, 22, '2023-12-23 09:16:00'),
(14, 23, '2023-12-23 09:16:00'),
(10, 23, '2023-12-23 09:16:00'),
(15, 7, '2023-12-23 09:16:00'),
(16, 7, '2023-12-23 09:16:00'),
(19, 58, '0000-00-00 00:00:00'),
(18, 7, '2023-12-23 09:16:00'),
(21, 58, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id_img` varchar(100) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `id_question_answer` int NOT NULL,
  `type` text COLLATE utf8mb4_vietnamese_ci NOT NULL,
  PRIMARY KEY (`id_img`,`id_question_answer`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id_img`, `id_question_answer`, `type`) VALUES
('img_658a9fe9c2565.png', 58, 'question'),
('img_658a9fe9c2696.jpg', 58, 'question'),
('img_658a9fe9c274a.jpg', 58, 'question'),
('img_658a9fe9c27da.jpg', 58, 'question'),
('img_658a9fe9c287f.jpg', 58, 'question'),
('img_658a9fe9c29cc.jpg', 58, 'question');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `edited_at` date DEFAULT NULL,
  `author` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `upvote` int DEFAULT '0',
  `downvote` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `content`, `type`, `created_at`, `edited_at`, `author`, `upvote`, `downvote`) VALUES
(9, 'Where is the highest mountain in the world?', 'question', '2023-12-18', '2023-12-18', 'nhan', 2, 0),
(2, 'what is the biggest river in the world?', 'question', '2023-12-17', '2023-12-17', 'nhan', 1, 0),
(3, 'how many days in a year? ', 'question', '2023-12-17', '2023-12-17', 'nguyenvanb', 0, 1),
(4, 'Why does it seem like everyone thinks they can code, but very few people actually have the skills necessary to be successful as software engineers and programmers?\r\n', 'question', '2023-12-17', '2023-12-17', 'nguyenvanb', 0, 0),
(5, 'How do top students study?', 'question', '2023-12-17', '2023-12-17', 'toilanam', 1, 0),
(6, 'What are some must read books for people in their 20s?', 'question', '2023-12-17', '2023-12-17', 'toilanam', 0, 0),
(7, 'How many people are there in the world?', 'question', '2023-12-18', '2023-12-18', 'van', 0, 1),
(23, 'How to use Recyclerview in Android Studio?  ', 'question', '2023-12-21', '2023-12-21', 'nhan', 2, 0),
(22, 'How to use HTML,Boostrap and Jquery to create a Front-End website?\r\n\r\n', 'question', '2023-12-21', '2023-12-21', 'nhan', 1, 0),
(58, 'Why do people hunt for animals?', 'question', '2023-12-26', '2023-12-26', 'nhan', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

DROP TABLE IF EXISTS `shares`;
CREATE TABLE IF NOT EXISTS `shares` (
  `author` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_id` int NOT NULL,
  `shared_by` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joined_at` date DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `firstname` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `joined_at`, `description`, `firstname`, `lastname`, `avatar`, `role`) VALUES
('nhan', '$2y$10$Kij6wYl7Ielzm9orBrYv/.KpFBHeXkv0HFfQZ50uL2MYTHmWFmpS2', '2023-12-16', '', 'nhan', 'nhan', '', 'user'),
('nguyenvanb', '$2y$10$16BakbZl09i/y3eOHzOozu2yvb4xlyVk1.C50Z6DRG6D9ylR0xpwW', '2023-12-17', '', 'b', 'nguyen van', '', 'user'),
('toilanam', '$2y$10$mASeUakgFay2PDygJPzjHuBk7NnFTodIjjGqiJsEN4hflAboG3wtK', '2023-12-17', '', 'Nam', 'Nguyễn Thành', '', 'user'),
('van', '$2y$10$7V/ETBebRbw/ZPn1j5IZgOdzcki2H8jJWS8n2NZ494U3k14EJc/TO', '2023-12-18', '', 'van', 'van', '', 'admin'),
('username2036480322', '$2y$10$mhPp0ZLKBKV8PEBpeeVwWu1fHNdrgNBkUpxon0yMuC3HK.GknZDhe', '2023-12-27', '', 'Ti', 'Ti', '', 'user'),
('username1745615553', '$2y$10$CS4ONuNrKWSgguCJodP/reU/tEuPkOXvfdoY8.RUEf/GhFmX3FBXK', '2023-12-27', '', 'Bin', 'Ti', '', 'user'),
('username818553713', '$2y$10$KYN2XZnk.xc8G/onCuak2OXa7zhiloc8MiF2w4p6RWCOCk7/PXa6i', '2023-12-27', '', 'Bin', 'Ti', '', 'user'),
('username565452372', '$2y$10$z9HOHrxXB/S07HkKMnG6dODNfUYKvLpOLGAnuQlTVExhmPKAMBKxK', '2023-12-27', '', 'Teo', 'Ti', '', 'user'),
('username1828242986', '$2y$10$iFftjYmS47B8SQ56y14Z7e9G7KnKhw5nXIh1BLc672/5kROeTcXfm', '2023-12-27', '', 'Teo', 'Teo', '', 'user'),
('username1965484231', '$2y$10$3lDAW4sX6Dn7minjvPUyauGOfwZRAQiNUG6MigJZH2MnuM1qU2u7O', '2023-12-27', '', 'Nguyen Van', 'Ti', '', 'user'),
('username501450566', '$2y$10$.nccFUXJVyXlSvFvarYc6OS3GUXW292INWUEFrTM2zalfGBXoM8C2', '2023-12-27', '', 'Huynh Thi', 'Teo', '', 'user'),
('username57806305', '$2y$10$Uw62gFe0GUfjKVVcg5hUrO4I/a5i8y2IjSmTUU8v9A7/hD3zffpu6', '2023-12-27', '', 'Huynh Thi', 'Teo', '', 'user'),
('username1574933702', '$2y$10$Pa06the85RZtj.u0xY9bt.AhJU035CV07zY7WuRSpdR7mK5yMtW7O', '2023-12-27', '', 'Huynh Thi', 'Teo', '', 'user'),
('username446936824', '$2y$10$Ahp7jD3YBeJun4LRFFZWG.MMCwFXNY8K3.rqEFo1aVzNIQWgvTt9u', '2023-12-27', '', NULL, 'Teo', '', 'user'),
('username969359111', '$2y$10$2A3VxNQuHV26hBjAnIppG./m.AttCFMUb2aXUB9/pl1GXQewsnaDK', '2023-12-27', '', 'Teo', 'Huynh Thi', '', 'user'),
('username832549860', '$2y$10$1I.gHjcBmlWCytCPMv.TuuHobCRfrXeiT4DgBbpwVfVhfRXcUrn4u', '2023-12-27', '', 'Teo', 'Nguyen Van', '', 'user'),
('username1694997570', '$2y$10$Oeq2/Uoylw4bTLskfpTFZ.LfhGlh3HL8crhJNYaHAcwZngES3zquW', '2023-12-27', '', 'Ti', 'Nguyen Van', '', 'user'),
('username1032268662', '$2y$10$j/rzytIueYpA117dFTrBZOSn1uOQCHeUIGRQcrjOPq3Aw1qUhA7HG', '2023-12-27', '', 'Teo', 'Huynh Thi', '', 'user'),
('username1727052043', '$2y$10$2XMsmPm8.7WcyJlKbiDp9.lcFNzBhY3zVdHi6gvN8F961fPYCgZeq', '2023-12-27', '', 'Teo', 'Huynh Thi', '', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `vote_answer`
--

DROP TABLE IF EXISTS `vote_answer`;
CREATE TABLE IF NOT EXISTS `vote_answer` (
  `id_answer` int NOT NULL,
  `username` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_answer`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vote_answer`
--

INSERT INTO `vote_answer` (`id_answer`, `username`, `type`) VALUES
(35, 'nhan', 'upvote'),
(29, 'nhan', 'downvote'),
(28, 'nhan', 'upvote'),
(36, 'toilanam', 'upvote');

-- --------------------------------------------------------

--
-- Table structure for table `vote_question`
--

DROP TABLE IF EXISTS `vote_question`;
CREATE TABLE IF NOT EXISTS `vote_question` (
  `id_question` int NOT NULL,
  `username` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_question`,`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vote_question`
--

INSERT INTO `vote_question` (`id_question`, `username`, `type`) VALUES
(22, 'nhan', 'upvote'),
(5, 'nhan', 'upvote'),
(28, 'test', 'downvote'),
(3, 'nhan', 'downvote'),
(58, 'nhan', 'upvote'),
(9, 'nguyenvanb', 'upvote'),
(7, 'nhan', 'downvote'),
(2, 'nhan', 'upvote'),
(58, 'toilanam', 'upvote'),
(23, 'toilanam', 'upvote'),
(9, 'toilanam', 'upvote'),
(56, 'toilanam', 'downvote'),
(55, 'toilanam', 'downvote'),
(54, 'toilanam', 'downvote'),
(53, 'toilanam', 'downvote'),
(54, 'nhan', 'downvote'),
(56, 'nhan', 'downvote'),
(23, 'nhan', 'upvote');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
