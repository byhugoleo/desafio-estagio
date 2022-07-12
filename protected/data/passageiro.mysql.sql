CREATE TABLE `passageiro` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `nome` varchar(100) NOT NULL,
    `nascimento` date NOT NULL,
    `email` varchar(255) NOT NULL,
    `telefone` varchar(16) NOT NULL,
    `status` char(1) NOT NULL,
    `data_hora_status` datetime NOT NULL,
    `obs` varchar(200) DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`),
    UNIQUE KEY `telefone` (`telefone`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;
