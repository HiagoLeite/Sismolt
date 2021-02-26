-- BANCO DE TESTES 
CREATE DATABASE bancoSistema;
USE bancoSistema;
DROP TABLE usuarios;
DROP TABLE dadoMonitorado;

CREATE TABLE usuarios(
	idUsuario INT NOT NULL AUTO_INCREMENT,
	nome VARCHAR(20) NOT NULL,
	email VARCHAR(45) NOT NULL,
	cep INT NOT NULL,
	endereco VARCHAR(45) NOT NULL,
	numero INT NOT NULL,
	senha INT(25) NOT NULL,
	senhaC INT(25) NOT NULL,
	PRIMARY KEY(idUsuario)
);
CREATE TABLE dadoMonitorado(
    registro INT NOT NULL AUTO_INCREMENT,
	estado VARCHAR(10) NOT NULL,
	umidadeSolo INT NOT NULL,
	grauPerigo VARCHAR(10) NOT NULL,
	dataAtual DATETIME,
	PRIMARY KEY (registro),
	idUsuario INT NOT NULL,
	FOREIGN KEY (idUsuario) REFERENCES usuarios(idUsuario)
);
-- INSERTS TESTE
INSERT INTO usuarios(nome,email,cep,endereco,numero,senha,senhaC)
VALUES("adimin","adm@gmail.com",00001111,"xxxxxxx",354,123,123);

INSERT INTO dadoMonitorado(estado,umidadeSolo,grauPerigo,dataAtual,idUsuario) 
VALUES("umido",0425,"medio",CURRENT_TIMESTAMP(),1);
