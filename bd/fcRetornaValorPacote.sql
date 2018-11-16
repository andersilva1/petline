CREATE DEFINER=`root`@`localhost` FUNCTION `fcRetornaValorPacote`(pIdUsuario INT) RETURNS varchar(6) CHARSET utf8
BEGIN

DECLARE vPacote VARCHAR(255);
DECLARE vValor VARCHAR(6);

SET vPacote = (
	SELECT
		nome
	FROM pacote
	WHERE
		id_usuario = pIdUsuario
	AND ativo = 1
	GROUP BY nome
	);

IF (vPacote IS NOT NULL) THEN
		IF (vPacote = 'LINE_BASIC') THEN SET vValor = '339,72';
				ELSE 
						IF (vPacote = 'RICH_DOG') THEN SET vValor = '482,76';
				ELSE
						SET vValor = '835,89';
		END IF;
		END IF;
ELSE
		SET vValor = '0,00';
END IF;
	RETURN vValor;
END