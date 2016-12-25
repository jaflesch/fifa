<?php
class Liga extends Controller {

	public static function index() {
		$year = (isset($_GET['year']))? $_GET['year'] : 2014;
		$bag = array(
			"dados" => self::getAllLigaMatchesByYear($year),
		);

		echo self::render("liga/index.html", $bag);
	}

	private static function getAllLigaMatchesByYear($year) {
		$matches = array();

		$query = "
			SELECT *
			FROM partida
			WHERE ano = {$year} AND campeonato = 'LIGA'
		";

		// auxiliares::
		$gols = 0;
		$assistencias = 0;
		$yc = 0;
		$rc = 0;
		$lesoes = 0;
		$vitorias = 0;
		$empates = 0;
		$derrotas = 0;
		$sem_gols = 0;
		$sem_participar = 0;
		$jogos = 0;

		$result = mysqli_query(static::$dbConn, $query);
		while($fetch = mysqli_fetch_object($result)) {
			// proccess data::
			if($fetch->gol > 0) {
				$gols += $fetch->gol;
			}
			else if ($fetch->assistencia > 0) {
				$sem_gols++;
			}
			else {
				$sem_gols++;
				$sem_participar++;
			}

			$assistencias += $fetch->assistencia;
			$lesoes += $fetch->lesao;
			$yc += $fetch->cartao_amarelo;
			$rc += $fetch->cartao_vermelho;

			$placar = explode("-", $fetch->resultado);			
			if($placar[0] > $placar[1]) {
				$vitorias++;
			}
			else if ($placar[0] == $placar[1]) {
				$empates++;
			}
			else $derrotas++;

			$jogos++;

			// edit for view::
			$fetch->campeonato = self::getCampeonato($fetch->campeonato);
			$fetch->lesao = self::getLesao($fetch->lesao);
			$fetch->cartao_amarelo = self::getCard($fetch->cartao_amarelo, 'Y');
			$fetch->cartao_vermelho = self::getCard($fetch->cartao_vermelho, 'R');

			$matches[] = $fetch;
		}

		$matches = toUTF($matches);

		$dados = array(
			"partidas" => $matches,
			"total" => array(
				"gol" => $gols,
				"assistencia" => $assistencias,
				"yc" => $yc,
				"rc" => $rc,
				"lesao" => $lesoes,
				"sem_gol" => $sem_gols,
				"sem_participar" => $sem_participar,
				"vitoria" => $vitorias,
				"empate" => $empates,
				"derrota" => $derrotas,
				"jogos" => $jogos
			)
		);

		return $dados;
	}

	private static function getAllData() {
		$matches = array();

		$query = "
			SELECT *
			FROM partida
		";

		// auxiliares::
		$gols = 0;
		$assistencias = 0;
		$yc = 0;
		$rc = 0;
		$lesoes = 0;
		$vitorias = 0;
		$empates = 0;
		$derrotas = 0;
		$sem_gols = 0;
		$sem_participar = 0;
		$jogos = 0;

		$dentro_area = 0;
		$fora_area = 0;
		$cabeca = 0;
		$falta = 0;
		$direita = 0;
		$penalti = 0;
		$voleio = 0;
		$cobertura = 0;

		$result = mysqli_query(static::$dbConn, $query);
		while($fetch = mysqli_fetch_object($result)) {
			// proccess data::
			if($fetch->gol > 0) {
				$gols += $fetch->gol;
			}
			else if ($fetch->assistencia > 0) {
				$sem_gols++;
			}
			else {
				$sem_gols++;
				$sem_participar++;
			}

			$assistencias += $fetch->assistencia;
			$lesoes += $fetch->lesao;
			$yc += $fetch->cartao_amarelo;
			$rc += $fetch->cartao_vermelho;

			$placar = explode("-", $fetch->resultado);			
			if($placar[0] > $placar[1]) {
				$vitorias++;
			}
			else if ($placar[0] == $placar[1]) {
				$empates++;
			}
			else $derrotas++;

			$jogos++;

			$dentro_area += $fetch->dentro_area;
			$fora_area += $fetch->fora_area;
			$cabeca += $fetch->cabeca;
			$falta += $fetch->falta;
			$direita += $fetch->perna_trocada;
			$penalti += $fetch->penalti;
			$voleio += $fetch->voleio;
			$cobertura += $fetch->cobertura;
		}

		$dados = array(
			"gol" => $gols,
			"assistencia" => $assistencias,
			"yc" => $yc,
			"rc" => $rc,
			"lesao" => $lesoes,
			"sem_gol" => $sem_gols,
			"sem_participar" => $sem_participar,
			"vitoria" => $vitorias,
			"empate" => $empates,
			"derrota" => $derrotas,
			"jogos" => $jogos,
			"dentro_area" => $dentro_area + $penalti,
			"fora_area" => $fora_area + $falta,
			"cabeca" => $cabeca,
			"falta" => $falta,
			"direita" => $direita,
			"penalti" => $penalti,
			"voleio" => $voleio,
			"cobertura" => $cobertura
		);

		return $dados;
	}
	
	public static function render($tpl, $vars=array()) {
		return parent::render($tpl,$vars);
	}

	private static function getCampeonato($string) {
		switch ($string) {
			case 'A': return 'Amistoso';
			case 'LIGA': return 'Liga BBVA';
			case 'COPA': return 'Copa do Rei';
			case 'SCES': return 'Supercopa da Espanha';
			case 'SCEU': return 'Supercopa da Europa';
			case 'UCL': return 'UEFA Champions League';
			case 'AMS': return 'Amistoso Seleção';
			case 'ELIM': return 'Eliminatórias da Copa';
		}
	}

	private static function getLesao($int) {
		return ($int == 1)? '<i class="fa fa-ambulance text-danger"></i>' : '-';
	}

	private static function getCard($int, $card_type) {
		if($card_type == "Y")
			return ($int == 1)? "<div style='height: 15px; width: 10px; margin: 0 auto; background: #ffda5d; border: 1px solid #f7cf4c;' class='alert-warning'></div>" : "-";
		else
			return ($int == 1)? "<div style='height: 10px; width: 5px; margin: 0 auto; background: #fb4949; border: 1px solid #ef3b3b;' class='alert-danger'></div>" : "-";
	}

	private static function getImagemTime($string) {
		$string = str_replace(" ", "_", $string);
		$string = str_replace(array('e','è','é','ê'), "e", $string);
		$string = str_replace(array('á','à','â','ã'), "_", $string);
		$string = str_replace(array('í','ì','î'), "_", $string);
		$string = str_replace(array('ó','ò','ô','õ'), "_", $string);
		$string = str_replace(array('ú','ù','û'), "_", $string);
		
		return strtolower($string);
	}

	private static function getParticipacao($int) {
		$string = "";
		
		if($int == 100) {
			$string = "#27ae60";
		}
		else if($int >= 90) {
			$string = "#2ecc71";
		}
		else if($int >= 75) {
			$string = "#c9f10f";
		}
		else if($int >= 60) {
			$string = "#f1c40f";
		}
		else if($int >= 50) {
			$string = "#f39c12";
		}
		else if($int >= 40) {
			$string = "#e67e22";
		}
		else if($int >= 30) {
			$string = "#d35400";
		}
		else if($int >= 15) {
			$string = "#e74c3c";
		}
		else $string = "#c0392b";
		
		return $string;
	}
}

Liga::exec($app);