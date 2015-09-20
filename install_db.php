<?php
include($_SERVER['DOCUMENT_ROOT'].'/assets/includes/include.php');
$sql = "CREATE TABLE IF NOT EXISTS `users` (
  `id` int(222) NOT NULL AUTO_INCREMENT,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `active` varchar(255) NOT NULL,
  `resetToken` varchar(255) DEFAULT NULL,
  `resetComplete` varchar(3) DEFAULT 'No',
  `last_seen` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rank` varchar(222) NOT NULL,
  `unit` varchar(222) NOT NULL,
  `position` varchar(222) NOT NULL,
  `status` varchar(222) NOT NULL,
  `user_avt` varchar(222) NOT NULL,
  `bio` text NOT NULL,
  `gender` varchar(222) NOT NULL,
  `birthday` varchar(222) NOT NULL,
  `website` text NOT NULL,
  `location` varchar(222) NOT NULL,
  `occupation` varchar(222) NOT NULL,
  `admin` varchar(222) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=MyISAM DEFAULT CHARSET=latin1;";
mysqli_query($conn,$sql);
//
$sql = 'INSERT INTO `users` (`id`, `username`, `password`, `email`, `active`, `resetToken`, `resetComplete`, `last_seen`, `rank`, `unit`, `position`, `status`, `user_avt`, `bio`, `gender`, `birthday`, `website`, `location`, `occupation`, `admin`) VALUES
(1, "Admin", "$2y$10$zrvx5mgvQgORCLOIL.rdPeXwCPqRO71DgfTuqMC.W/PHhKFnbVUq2", "SITEEMAIL", "Yes", NULL, "No", "2015-06-11 00:33:20", "", "", "", "Active", "", "", "Unspecified", "", "", "", "", "true");';
mysqli_query($conn,$sql);
?>