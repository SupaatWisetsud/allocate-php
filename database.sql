CREATE DATABASE db_allocate CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE tb_member(
    m_id INT PRIMARY KEY AUTO_INCREMENT,
    m_username VARCHAR(50) NOT NULL,
    m_password VARCHAR(250) NOT NULL,
    m_firstname VARCHAR(80) NOT NULL,
    m_lastname VARCHAR(80) NOT NULL,
    m_email VARCHAR(90) NOT NULL,
    m_img VARCHAR(500) DEFAULT "assets/img/user.jpg",
    m_numberphone VARCHAR(10) NOT NULL,
    m_status ENUM('admin', 'user')
);

CREATE TABLE tb_work(
    w_id INT PRIMARY KEY AUTO_INCREMENT,
    w_title VARCHAR(50) NOT NULL,
    w_detail VARCHAR(250),
    w_worker INT,
    w_commander INT NOT NULL,
    w_deadline datetime,
    w_datestatus datetime DEFAULT NOW(),
    w_datesubmit datetime,
    w_status ENUM("send", "proceed", "success"),
    w_path VARCHAR(950),
    FOREIGN KEY (w_worker) REFERENCES tb_member(m_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (w_commander) REFERENCES tb_member(m_id) ON UPDATE CASCADE ON DELETE CASCADE
);