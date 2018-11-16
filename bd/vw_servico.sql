CREATE OR REPLACE VIEW vw_servico AS
SELECT DISTINCT
	CONCAT(U.nome,' ',U.sobrenome) as passeador,
	CONCAT(U1.nome,' ',U1.sobrenome) as cliente,
	P.dt_passeio,
	P.hora_inicio,
	P.hora_fim,
	PE.nome as nome_pet,
	P.nome as pacote
FROM servico S
INNER JOIN usuario U ON (S.id_passeador = U.id AND U.perfil = 'pas')
INNER JOIN usuario U1 ON (S.id_cliente = U1.id AND U1.perfil = 'cli')
INNER JOIN pacote P ON (P.id_usuario = U1.id)
INNER JOIN pet PE ON (PE.id = S.id_pet)