<?php
	$execute = false;
	if($execute) {

		$query = "
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
				'Manchester United', 		# TIME
				'UCL', 		# CAMP
				'0', 			# GOLS
				'1', 			# ASSIST
				'0', 			# DENTRO AREA
				'0', 			# FORA AREA
				'0', 			# FALTA
				'0', 			# PENALTI
				'0', 			# CABECA
				'0', 			# PE DIREITO
				'0', 			# COBERTURA
				'0', 			# VOLEIO
				'0', 			# CART AMARELO
				'0', 			# CART VERMELHO
				'0', 			# LESAO
				'1-0', 			# RESULTADO JOGO
				'C',			# CASA/FORA
				23				# FINAL CAMP
			);
		";

		$dbConn = new mysqli('localhost', 'root', '', 'fifa_stats');

		if ($dbConn->connect_error) {
		    die("Connection failed: " . $dbConn->connect_error);
		} 

		if ($dbConn->query($query) === TRUE)
		    echo "Registro ".$dbConn->insert_id." inserido com sucesso.";
		else 
		    echo "Error: " . $query . "<br>" . $dbConn->error;
	}
	else echo "Sistema desativado por segurança";
?>