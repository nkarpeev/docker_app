CREATE DATABASE testcase_dostavka_lab;
CREATE USER 'user_dostavka_lab'@'localhost' IDENTIFIED BY '123456';
GRANT ALL PRIVILEGES ON testcase_dostavka_lab.* TO 'user_dostavka_lab'@'localhost';