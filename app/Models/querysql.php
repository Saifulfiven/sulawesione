<?php
// Update panjang length empatbelas menjadi 100
//[2024-05-08 10:25:50.452][local][000008][MYSQL]
ALTER TABLE `laravel_alumni`.`step_tiga_duas` 
MODIFY COLUMN `empatbelas` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL AFTER `tigabelasdiskusi`
Time: 0.172s

?>