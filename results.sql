INSERT INTO `partida` (
	`id`,
	`ano`, 
	`time`, 
	`campeonato`, 
	`gol`, 
	`assistencia`, 
	`dentro_area`, 
	`fora_area`, 
	`falta`, 
	`penalti`, 
	`cabeca`, 
	`perna_trocada`, 
	`cobertura`, 
	`voleio`, 
	`cartao_amarelo`, 
	`cartao_vermelho`, 
	`lesao`, 
	`resultado`, 
	`partida`,
	`id_campeonato_final`
) 
VALUES (
	NULL, 
	'2019', 
	'Barcelona', 		# TIME
	'LIGA', 		# CAMP
	'2', 			# GOLS
	'2', 			# ASSIST
	'1', 			# DENTRO AREA
	'0', 			# FORA AREA
	'1', 			# FALTA
	'0', 			# PENALTI
	'0', 			# CABECA
	'0', 			# PE DIREITO
	'0', 			# COBERTURA
	'0', 			# VOLEIO
	'0', 			# CART AMARELO
	'0', 			# CART VERMELHO
	'0', 			# LESAO
	'5-0', 			# RESULTADO JOGO
	'C',			# CASA/FORA
	0				# FINAL CAMP
);