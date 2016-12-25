<?php
class Estatisticas extends Controller {

	public static function index() {
		$year = (isset($_GET['year']))? $_GET['year'] : 2014;
		$bag = array(
			"total" => self::getTotals(),
			"times" => self::getAllGoalsOnEachTeam(),
			"selecoes" => self::getAllGoalsOnEachCountry(),
			"player" => array(
				"hattrick" => self::getGoalsQtdOnMatch(3),
				"poker" => self::getGoalsQtdOnMatch(4),
				"repoker" => self::getGoalsQtdOnMatch(5),
				"seca" => self::getMaxMatchWithoutGoals(),
				"idade" => self::getPlayerAge(),
				"gol" => array(
					"100" => self::getMatchWhereHasGoal(100),
					"200" => self::getMatchWhereHasGoal(200),
					"300" => self::getMatchWhereHasGoal(300),
					"400" => self::getMatchWhereHasGoal(400),
					"500" => self::getMatchWhereHasGoal(500)
				),
			),
			"curiosidades" => self::getCuriosidades()
		);

		self::debug();
		echo self::render("estatisticas/index.html", $bag);
	}

	public static function vd($tpl, $vars=array()) {
		$bag = array(
			"participacao" => self::getTotalGoalsByYear(),
			"pontuacao" => self::getRendimentoEquipe()
		);

		echo self::render("estatisticas/graficos.html", $bag);
	}

	private static function getRendimentoEquipe() {
		$rendimento = array();

		$query = "
			SELECT *
			FROM partida 
		";
		$result = mysqli_query(static::$dbConn, $query);

		$year = 2014;
		$victory = 0;
		$draw = 0;
		$lose = 0;
		while($fetch = mysqli_fetch_object($result)) {
			if($year != $fetch->ano) {
				$victory = 0;
				$draw = 0;
				$lose = 0;

				$year++;
			}

			$placar = explode("-", $fetch->resultado);
			if($placar[0] > $placar[1])
				$victory++;

			else if($placar[0] == $placar[1])
				$draw++;

			else $lose++;

			$rendimento[$year]['V'] = $victory;
			$rendimento[$year]['E'] = $draw;
			$rendimento[$year]['D'] = $lose;
		}

		foreach ($rendimento as $key => $value) {
			$rendimento[$key]['rendimento'] = number_format((3 * $rendimento[$key]['V'] + $rendimento[$key]['E']) / (3 * ($rendimento[$key]['V'] + $rendimento[$key]['E'] + $rendimento[$key]['D'])) * 100, 2);

			$rendimento[$key]['ano'] = $key;
		}
		
		return $rendimento;
	}

	private static function getTotalGoalsByYear() {
		global $dbConn;
		$gols = array(
			"ano"=> array()
		);
		$gol_total = 0;
		$assist_total = 0;

		$query = "
			SELECT sum(gol) gol, sum(assistencia) assistencia, ano, count(*) partidas
			FROM `partida`
			GROUP BY ano
		";
		$result = mysqli_query($dbConn, $query);
		while ($fetch = mysqli_fetch_object($result)) {
			$gol_total += $fetch->gol;
			$assist_total += $fetch->assistencia;
			$gols['ano'][] = $fetch;
		}
		$gols['gol_total'] = $total;

		return $gols;
	}

	private static function debug() {
		global $dbConn;
		$query = "
			SELECT *
			FROM `partida`
		";
		$result = mysqli_query($dbConn, $query);
		while ($fetch = mysqli_fetch_object($result)) {
			$gol = $fetch->dentro_area + $fetch->fora_area + $fetch->falta + $fetch->penalti;
			
			if($gol != $fetch->gol)
				print_r($fetch);
		}
	}

	private static function getPlayerAge() {
		global $dbConn;

		$query = "
			SELECT ano
			FROM partida
			ORDER BY id DESC
			LIMIT 1
		";
		$result = mysqli_query($dbConn, $query);
		$fetch = mysqli_fetch_object($result);

		return $fetch->ano - 2014 + 16;
	}
	private static function getTotals() {
		global $dbConn;
		
		$total = array();

		$gols = 0;
		$assistencias = 0;
		$partidas = 0;
		
		$dentro_area = 0;
		$fora_area = 0;
		$cabeca = 0;
		$falta = 0;
		$penalti = 0;
		$perna_direita = 0;
		$voleio = 0;
		$cobertura = 0;

		$liga = 0;
		$copa = 0;
		$ucl = 0;
		$selecao = 0;
		$sces = 0;
		$sceu = 0;
		$amistoso = 0;

		$query = "
			SELECT *
			FROM `partida`
		";
		$result = mysqli_query($dbConn, $query);
		while ($fetch = mysqli_fetch_object($result)) {
			$gols += $fetch->gol;
			$assistencias += $fetch->assistencia;

			$dentro_area += $fetch->dentro_area;
			$fora_area += $fetch->fora_area;
			$falta += $fetch->falta;
			$cabeca += $fetch->cabeca;
			$penalti += $fetch->penalti;
			$perna_direita += $fetch->perna_trocada;
			$voleio += $fetch->voleio;
			$cobertura += $fetch->cobertura;

			switch ($fetch->campeonato) {
				case 'UCL': $ucl++; break;				
				case 'COPA': $copa++; break;
				case 'LIGA': $liga++; break;
				case 'SCEU': $sceu++; break;
				case 'SCES': $sces++; break;
				case 'A': $amistoso++; break;
				case 'CONF': 
				case 'ELIM':
				case 'AMS': $selecao++; 
			}

			$partidas++;
		}

		$total['gol'] = $gols;
		$total['assistencia'] = $assistencias;
		$total['partidas'] = $partidas;
		$total['media_gol'] = number_format($gols / $partidas, 2);
		$total['media_assistencia'] = number_format($assistencias / $partidas, 2);
		$total['dentro_area'] = $dentro_area + $penalti;
		$total['fora_area'] = $fora_area + $falta;
		$total['cabeca'] = $cabeca;
		$total['falta'] = $falta;
		$total['penalti'] = $penalti;
		$total['perna_esquerda'] = $gols - $perna_direita;
		$total['perna_direita'] = $perna_direita;
		$total['voleio'] = $voleio;
		$total['cobertura'] = $cobertura;
		$total['ucl'] = $ucl;
		$total['liga'] = $liga;
		$total['copa'] = $copa;
		$total['sceu'] = $sceu;
		$total['sces'] = $sces;
		$total['a'] = $amistoso;
		$total['clube'] = $gols - $selecao;
		$total['selecao'] = $selecao;

		return $total;
	}

	private static function getMaxMatchWithoutGoals() {
		global $dbConn;
		
		$jejums = array();

		$jejum_atual = 0;

		$query = "
			SELECT gol
			FROM `partida`
		";
		$result = mysqli_query($dbConn, $query);
		while ($fetch = mysqli_fetch_object($result)) {
			if($fetch->gol == 0){
				$jejum_atual++;
			}
			else {
				if($jejum_atual > 0) {
					$jejums[] = $jejum_atual;
					$jejum_atual = 0;
				}
			} 
		}
		
		return max($jejums);
	}

	private static function getAllGoalsOnEachTeam() {
		global $dbConn;
		$array = array();

		$query = "
			SELECT sum(gol) gol, count(id) partidas, time
			FROM `partida`
			WHERE campeonato != 'AMS' AND campeonato != 'ELIM' AND campeonato != 'COMU' AND campeonato != 'CONF'
			GROUP BY time
			ORDER BY gol DESC, partidas ASC
		";
		$result = mysqli_query($dbConn, $query);
		while($fetch = mysqli_fetch_object($result)) {
			$fetch->imagem = self::getImagemTime($fetch->time);
			$array[] = $fetch;
		}

		return toUTF($array);
	}

	private static function getAllGoalsOnEachCountry() {
		global $dbConn;
		$array = array();

		$query = "
			SELECT sum(gol) gol, count(id) partidas, time
			FROM `partida`
			WHERE campeonato = 'AMS' OR campeonato = 'ELIM' OR campeonato = 'COMU' OR campeonato = 'CONF'
			GROUP BY time
			ORDER BY gol DESC, partidas ASC
		";
		$result = mysqli_query($dbConn, $query);
		while($fetch = mysqli_fetch_object($result)) {
			$fetch->imagem = self::getImagemTime($fetch->time);
			$array[] = $fetch;
		}

		return toUTF($array);
	}

	private static function getGoalsQtdOnMatch($int) {

		$query = "
			SELECT count(*) total
			FROM partida
			WHERE gol = {$int}
		";
		$result = mysqli_query(static::$dbConn, $query);
		$fetch = mysqli_fetch_object($result);

		return $fetch->total;
	}

	private static function getMatchWhereHasGoal($int) {
		$gols = 0;

		$query = "
			SELECT gol, time, id partida
			FROM partida
		";
		$result = mysqli_query(static::$dbConn, $query);
		while ($fetch = mysqli_fetch_object($result)) {
			if($gols >= $int)
				break;

			$gols += $fetch->gol;
			$match = $fetch;
		}

		$match->total_gols = $gols;
		$match->result = $gols >= $int;
		
		return $match;
	}

	private static function getCuriosidades() {
		global $dbConn;
		$array = array();

		$query = "
			SELECT count(*) total
			FROM partida 
			WHERE gol = 0
		";
		$result = mysqli_query($dbConn, $query);
		$fetch = mysqli_fetch_object($result);
		$array[] = "Em ".$fetch->total. " ocasiões não marcou gols na partida.";

		$query = "
			SELECT count(*) total
			FROM artilharia 
			WHERE campeonato = 'UCL'
		";
		$result = mysqli_query($dbConn, $query);
		$fetch = mysqli_fetch_object($result);
		$array[] = "Foi ".$fetch->total. " vezes artilheiro da UEFA Champions League.";

		$query = "
			SELECT count(*) total
			FROM artilharia 
			WHERE campeonato = 'LIGA'
		";
		$result = mysqli_query($dbConn, $query);
		$fetch = mysqli_fetch_object($result);
		$array[] = "Foi ".$fetch->total. " vezes artilheiro da Liga BBVA.";

		$query = "
			SELECT count(*) total
			FROM artilharia 
			WHERE campeonato = 'COPA'
		";
		$result = mysqli_query($dbConn, $query);
		$fetch = mysqli_fetch_object($result);
		$array[] = "Foi ".$fetch->total. " vezes artilheiro da Copa do Rei.";

		return $array;
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
		$string = toUTF($string);

		$string = str_replace(" ", "_", $string);
		$string = str_replace(array('e','è','é','ê'), "e", $string);
		$string = str_replace(array('á','à','â','ã'), "a", $string);
		$string = str_replace(array('í','ì','î'), "i", $string);
		$string = str_replace(array('ó','ò','ô','õ'), "o", $string);
		$string = str_replace(array('ú','ù','û'), "u", $string);
		$string = str_replace("ç", "c", $string);
		
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

Estatisticas::exec($app);