<?php
class Home extends Controller {

	public static function index() {
		$year = $_GET['year'];
		$bag = array(
			"team" => self::getTeamTrophies(),
			"mundial" => self::getMundial(),
			"individual" => self::getIndividualTrophies(),
			"ballondor" => self::getBallonDor()
		);

		print_r($bag);
		echo self::render("premios/index.html", $bag);
	}

	private static function getTeamTrophies() {
		$trophies = array();

		$query = "
			SELECT nome, nome sigla, count(nome) qtd, posicao 
			FROM `campeonato` 
			WHERE posicao = 1
			GROUP BY nome
		";
		$result = mysqli_query(static::$dbConn, $query);
		while($fetch = mysqli_fetch_object($result)) {
			$fetch->nome = self::getCampeonato($fetch->sigla);
			$trophies[strtolower($fetch->sigla)] = $fetch;
		}

		return toUTF($trophies);
	}

	private static function getMundial() {
		global $dbConn;

		$query = "
			SELECT ano, QTD
			FROM (
			    SELECT count(ano) qtd, ano
				FROM campeonato
			    WHERE posicao = 1
				GROUP BY ano
			) AS S1
			WHERE qtd > 4
		";
		$result = mysqli_query($dbConn, $query);

		return mysqli_num_rows($result);
	}

	private static function getIndividualTrophies() {
		global $dbConn;
		$trophies = array();

		$query = "
			SELECT *
			FROM artilharia
			ORDER BY ano DESC
		";
		$result = mysqli_query($dbConn, $query);
		while ($fetch = mysqli_fetch_object($result)) {
			$fetch->campeonato = self::getCampeonato($fetch->campeonato);
			$trophies[] = $fetch;
		}
		
		return toUTF($trophies);
	}

	private static function getBallonDor() {
		global $dbConn;
		$years = array();

		$query = "
			SELECT T1.ano
			FROM (
				SELECT ano , count(nome) premio
				FROM campeonato 
				WHERE posicao = 1
				GROUP BY ano
			) AS T1,
			(
				SELECT ano , count(campeonato) premio
				FROM artilharia 
				GROUP BY ano
			) AS T2
			
			WHERE T1.ano = T2.ano AND T1.premio >= 4  AND T2.premio >= 3
		";
		$result = mysqli_query($dbConn, $query);
		while ($fetch = mysqli_fetch_object($result)) {
			$years[] = $fetch->ano;
		}

		return $years;
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
			case 'CONF': return 'Copa das Confederações';
		}
	}
}

Home::exec($app);