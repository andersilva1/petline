CREATE OR REPLACE VIEW vw_pacote AS
SELECT
	CONCAT(U.nome,' ',U.sobrenome) as passeador,
	CONCAT(U1.nome,' ',U1.sobrenome) as cliente,
	(SELECT MIN(P.nome) FROM pacote P WHERE P.id_usuario = U1.id) as pacote,
	(SELECT MIN(P.dt_passeio) FROM pacote P WHERE P.id_usuario = U1.id) as data_contratacao,
	fcRetornaValorPacote(U1.id) as valor_pacote
FROM servico S
INNER JOIN usuario U ON (S.id_passeador = U.id)
INNER JOIN usuario U1 ON (S.id_cliente = U1.id)