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
-- INCLUA ESSA PROCEDURE NO SEU BANCO !
DELIMITER $$
CREATE PROCEDURE chuvaMes ( IN ano int )
BEGIN

DECLARE mesValor INT DEFAULT 0;
DECLARE mes INT DEFAULT 1;
DECLARE jane INT DEFAULT 0;DECLARE feve INT DEFAULT 0;
DECLARE marc INT DEFAULT 0;DECLARE abri INT DEFAULT 0;
DECLARE maio INT DEFAULT 0;DECLARE junh INT DEFAULT 0;
DECLARE julh INT DEFAULT 0;DECLARE agos INT DEFAULT 0;
DECLARE setem INT DEFAULT 0;DECLARE outu INT DEFAULT 0;
DECLARE nove INT DEFAULT 0;DECLARE deze INT DEFAULT 0;
	
	WHILE(mes<=12)DO  
		SET mesValor =(SELECT COUNT(umidadeSolo) FROM dadomonitorado 
		WHERE MONTH(dataAtual) = mes AND YEAR(dataAtual) = ano);
		
			IF(mes=1)THEN
				SET jane = mesValor;
					ELSEIF(mes=2)THEN
						SET feve=mesValor;
					ELSEIF(mes=3)THEN
						SET marc=mesValor;
					ELSEIF(mes=4)THEN
						SET abri=mesValor;
					ELSEIF(mes=5)THEN
						SET maio=mesValor;
					ELSEIF(mes=6)THEN
						SET junh=mesValor;
					ELSEIF(mes=7)THEN
						SET julh=mesValor;
					ELSEIF(mes=8)THEN
						SET agos=mesValor;
					ELSEIF(mes=9)THEN
						SET setem=mesValor;
					ELSEIF(mes=10)THEN
						SET outu=mesValor;
					ELSEIF(mes=11)THEN
						SET nove=mesValor;
					ELSEIF(mes=12)THEN
						SET deze=mesValor;		
			END IF;
		SET mes=mes+1;	
	END WHILE;
	SELECT jane,feve,marc,abri,maio,junh,julh,agos,setem,outu,nove,deze;
END $$
DELIMITER ;

CALL chuvaMes(2021);
DROP PROCEDURE chuvaMes(2021);
SHOW PROCEDURE STATUS;

-- INSERTS TESTE DO BANCO
/* PS 
ESTES INSERTS SO SERVEM PARA VERIFICAR O BANCO MESMO NÃO SENDO NECESSARIO,CASO VOCÊ
REALIZE ESSES INSERTS NÃO SERA POSSIVEL LOGAR COM ESTE USUARIO DEVIDO A CRIPTOGRAFIA
MD5 UTILIZADA.(REALIZE O CADASTRO PELA PAGINA 
OU APLIQUE A CRIPTOGRAFICA MD5 NO CAMPO SENHA LA NO BANCO).
*/
INSERT INTO usuarios(nome,email,cep,endereco,numero,senha,senhaC)
VALUES("adimin","adm@gmail.com",00001111,"xxxxxxx",354,123,123);

INSERT INTO dadoMonitorado(estado,umidadeSolo,grauPerigo,dataAtual,idUsuario) 
VALUES("umido",0425,"medio",CURRENT_TIMESTAMP(),1);
