<?php
class Home extends Controller {

	public static function index() {
		$year = $_GET['year'];
		$bag = array(
			//"dados" => self::getAllMatchesByYear($year),
			//"total" => self::getAllData()
			"last" => self::getLastMatch(),
			"historico" => self::getHistorico(),
			"last_five_matches" => self::getLastFive()
		);

		echo self::render("home/index.html", $bag);
	}

	private static function getAllMatchesByYear($year) {
		$matches = array();

		$query = "
			SELECT *
			FROM partida
			WHERE ano = {$year}
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

	private static function getLastMatch() {
		global $dbConn;
		$array = array();

		$query  = "
			SELECT *
			FROM partida 
			ORDER BY id DESC 
			LIMIT 1
		";
		$result = mysqli_query($dbConn, $query);
		$fetch = mysqli_fetch_object($result);

		// edit for view::
		$fetch->campeonato = self::getCampeonato($fetch->campeonato);
		$fetch->lesao = self::getLesao($fetch->lesao);
		$fetch->cartao_amarelo = self::getCard($fetch->cartao_amarelo, 'Y');
		$fetch->cartao_vermelho = self::getCard($fetch->cartao_vermelho, 'R');
		$fetch->participacao = (int)(($fetch->gol + $fetch->assistencia) / array_shift(explode("-", $fetch->resultado)) * 100);
		$fetch->participacao_class = self::getParticipacao($fetch->participacao);

		if($fetch->partida == "C") {
			$array['casa']['time'] = "Real Madrid";
			$array['casa']['imagem_time'] = "real_madrid";
			$array['casa']['placar'] = array_shift(explode("-", $fetch->resultado));
			$array['visitante']['time'] = $fetch->time;
			$array['visitante']['imagem_time'] = self::getImagemTime($fetch->time);
			$array['visitante']['placar'] = end(explode("-", $fetch->resultado));
		}
		else {
			$array['casa']['time'] = $fetch->time;
			$array['casa']['imagem_time'] = self::getImagemTime($fetch->time);
			$array['casa']['placar'] = end(explode("-", $fetch->resultado));
			$array['visitante']['time'] = "Real Madrid";
			$array['visitante']['imagem_time'] = "real_madrid";
			$array['visitante']['placar'] = array_shift(explode("-", $fetch->resultado));
		}
		$array['dados'] = toUTF($fetch);

		return $array;
	}

	private static function getHistorico() {
		$historico = array(
			"vitorias" => 0,
			"empates" => 0,
			"derrotas" => 0
		);

		// get last match's team
		$query = "
			SELECT time
			FROM partida
			ORDER BY id DESC
			LIMIT 1
		";
		$result = mysqli_query(static::$dbConn, $query);
		$fetch = mysqli_fetch_object($result);
		$time = $fetch->time;
		$historico['time'] = $time;

		$query = "
			SELECT resultado
			FROM partida
			WHERE time = '{$time}'
		";
		$result = mysqli_query(static::$dbConn, $query);
		while($fetch = mysqli_fetch_object($result)) {
			$pieces = explode("-", $fetch->resultado);
			if($pieces[0] > $pieces[1])
				$historico['vitorias']++;
			else if($pieces[0] == $pieces[1])
				$historico['empates']++;
			else
				$historico['derrotas']++;
		}

		$aproveitamento = ($historico['vitorias']*3 + $historico['empates']) / (3*($historico['vitorias'] + $historico['empates'] + $historico['derrotas']));
		$historico['aproveitamento'] = (int)($aproveitamento*100);
		
		$historico['maior'] = max(array($historico['vitorias'], $historico['empates'], $historico['derrotas']));
		
		if($historico['maior'] == $historico['vitorias'])
			$historico['maior'] = "#4CAF50";
		else if ($historico['maior'] == $historico['empates'])
			$historico['maior'] = "#B0BEC5";
		else 
			$historico['maior'] = "#f44336";
		
		return $historico;
	}

	private static function  getLastFive() {
		$last = array();

		// get last match's team
		$query = "
			SELECT time
			FROM partida
			ORDER BY id DESC
			LIMIT 1
		";
		$result = mysqli_query(static::$dbConn, $query);
		$fetch = mysqli_fetch_object($result);
		$time = $fetch->time;

		$query = "
			SELECT resultado
			FROM partida
			WHERE time = '{$time}'
			ORDER BY id DESC
			LIMIT 5
		";
		$result = mysqli_query(static::$dbConn, $query);
		while($fetch = mysqli_fetch_object($result)) {
			$pieces = explode("-", $fetch->resultado);

			if($pieces[0] > $pieces[1])
				$fetch->class = "#4CAF50";
			else if ($pieces[0] == $pieces[1])
				$fetch->class = "#B0BEC5";
			else 
				$fetch->class = "#f44336";
			
			$last[] = $fetch;
		}

		return array_reverse($last);		
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

Home::exec($app);