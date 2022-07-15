-- banco.corrida definition

CREATE TABLE `corrida` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `passageiro_id` bigint(20) unsigned NOT NULL,
  `motorista_id` bigint(20) unsigned DEFAULT NULL,
  `origem_endereco` varchar(255) NOT NULL,
  `origem_lat` varchar(16) NOT NULL,
  `origem_lng` varchar(16) NOT NULL,
  `destino_endereco` varchar(255) NOT NULL,
  `destino_lat` varchar(16) NOT NULL,
  `destino_lng` varchar(16) NOT NULL,
  `data_hora_incio` datetime DEFAULT NULL,
  `status` varchar(12) NOT NULL,
  `previsao_chegada` datetime DEFAULT NULL,
  `tarifa` varchar(8) DEFAULT NULL,
  `data_hora_finalizacao` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `motorista_id` (`passageiro_id`),
  KEY `passageiro_id` (`motorista_id`),
  CONSTRAINT `motorista_id` FOREIGN KEY (`passageiro_id`) REFERENCES `motorista` (`id`),
  CONSTRAINT `passageiro_id` FOREIGN KEY (`motorista_id`) REFERENCES `passageiro` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;