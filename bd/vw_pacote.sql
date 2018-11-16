CREATE OR REPLACE VIEW vw_pacote AS
SELECT
	CONCAT(U.nome,' ',U.sobrenome) as passeador,
	CONCAT(U1.nome,' ',U1.sobrenome) as cliente,
	P.nome as pacote,
	MIN(P.dt_passeio) as data_contratacao,
	CAST(fcRetornaValorPacote(U1.id) AS DECIMAL) as valor_pacote
FROM servico S
INNER JOIN usuario U ON (S.id_passeador = U.id AND U.perfil = 'pas')
INNER JOIN usuario U1 ON (S.id_cliente = U1.id AND U1.perfil = 'cli')
INNER JOIN pacote P ON (P.id_usuario = U1.id)
GROUP BY U.id