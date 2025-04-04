CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` bigint(22) NOT NULL,
  `prefix_user_id` varchar(252) NOT NULL,
  `role` varchar(252) NOT NULL,
  `username` varchar(252) NOT NULL,
  `name` varchar(252) NOT NULL,
  `email` varchar(252) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(252) NOT NULL,
  `hint` varchar(252) NOT NULL,
  `profile_image` varchar(252) DEFAULT NULL,
  `status` int(12) NOT NULL DEFAULT 0,
  `deleted` int(12) NOT NULL DEFAULT 0,
  `delete_datetime` timestamp NULL DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


ALTER TABLE `users` ADD PRIMARY KEY (`id`);

ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

COMMIT;

INSERT INTO `users` (`user_id`, `prefix_user_id`, `role`, `username`, `name`, `email`, `mobile`, `password`, `hint`, `profile_image`, `status`) VALUES
(1, 'STAFF_1', 'superadmin', 'insurance', 'Insurance SuperAdmin', 'superadmin@insurance.com', '8819945752', '$2y$10$/w2sddYGfaP8cH32IFjXXuRZKf8v6LoZEvr9XvpycKRM5gx6ndL9K', '12345678', NULL, 1)