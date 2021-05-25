<?php


class Dashboard{
	public $dataInicio;
	public $dataFinal;
	public $numeroVendas;
	public $totalVendas;
	public $clientesAtivos;
	public $clientesInativos;
	public $totalElogios;
	public $totalSugestoes;
	public $totalReclamacoes;
	public $totalDespesas;

	public function __get($att) {
		return $this->$att;}

	public function __set($att, $valor) {
		$this->$att = $valor;
		return $this;}
}


class Conexao{
	public $host = 'localhost';
	public $db = 'dashboard';
	public $user = 'root';
	public $password = '';

	public function conectar() {

		try{
			$conexao = new PDO("mysql:host=$this->host;dbname=$this->db", "$this->user", "$this->password");

			$conexao->exec("set charset utf8");

			return $conexao;
		
		} catch(PDOException $e) {
			echo 'Erro: ' . $e->getMessage();}
	}
}



class Bd {
	private $dashboard;
	private $conexao;
	
	public function __construct(Dashboard $dashboard, Conexao $conexao)
	{
		$this->conexao = $conexao->conectar();
		$this->dashboard = $dashboard;

	}


	function getNumeroVendas() {
		$query = 'select count(*) as numero_vendas from tb_vendas where data_venda between :dataInicio and :dataFinal';

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':dataInicio', $this->dashboard->__get('dataInicio'));
		$stmt->bindValue(':dataFinal', $this->dashboard->__get('dataFinal'));

		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_OBJ)->numero_vendas;

	}

	function getTotalVendas() {
		$query = 'select SUM(total) as total_vendas from tb_vendas where data_venda between :dataInicio and :dataFinal';

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':dataInicio', $this->dashboard->__get('dataInicio'));
		$stmt->bindValue(':dataFinal', $this->dashboard->__get('dataFinal'));

		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_OBJ)->total_vendas;

	}

	function getTotalDespesas() {
		$query = 'select SUM(total) as total_despesas from tb_despesas where data_despesa between :dataInicio and :dataFinal';

		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':dataInicio', $this->dashboard->__get('dataInicio'));
		$stmt->bindValue(':dataFinal', $this->dashboard->__get('dataFinal'));

		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_OBJ)->total_despesas;
	}


	function getClientesAtivos(){
		$query = 'select count(*) as clientes_ativos from tb_clientes where cliente_ativo = 1';

		$stmt = $this->conexao->prepare($query);

		$stmt->execute();


		return $stmt->fetch(PDO::FETCH_OBJ)->clientes_ativos;
}	
	
	function getClientesInativos(){
		$query = 'select count(*) as clientes_inativos from tb_clientes where cliente_ativo = 0';

		$stmt = $this->conexao->prepare($query);

		$stmt->execute();


		return $stmt->fetch(PDO::FETCH_OBJ)->clientes_inativos;
}
	
	function getTotalElogios(){
		$query = 'select count(*) as elogios from tb_contatos where  tipo_contato = 1';

		$stmt = $this->conexao->prepare($query);

		$stmt->execute();


		return $stmt->fetch(PDO::FETCH_OBJ)->elogios;
}

	function getTotalSugestoes(){
		$query = 'select count(*) as sugestoes from tb_contatos where  tipo_contato = 2';

		$stmt = $this->conexao->prepare($query);

		$stmt->execute();


		return $stmt->fetch(PDO::FETCH_OBJ)->sugestoes;
}
	function getTotalReclamacoes(){
		$query = 'select count(*) as reclamacoes from tb_contatos where  tipo_contato = 3';

		$stmt = $this->conexao->prepare($query);

		$stmt->execute();


		return $stmt->fetch(PDO::FETCH_OBJ)->reclamacoes;
}



}


$dashboard = new Dashboard();
$conexao = new Conexao();

$competencia = explode('-', $_GET['competencia']);
$ano = $competencia[0];
$mes = $competencia[1];
$dias = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);


$dashboard->__set('dataInicio',  $ano . '-' . $mes . '-01');
$dashboard->__set('dataFinal',  $ano . '-' . $mes. '-' .$dias);


$bd = new Bd($dashboard, $conexao);


$dashboard->__set('numeroVendas', $bd->getNumeroVendas());
$dashboard->__set('totalVendas', $bd->getTotalVendas());
$dashboard->__set('totalDespesas', $bd->getTotalDespesas());

$dashboard->__set('clientesAtivos', $bd->getClientesAtivos());
$dashboard->__set('clientesInativos', $bd->getClientesInativos());

$dashboard->__set('totalElogios', $bd->getTotalElogios());
$dashboard->__set('totalSugestoes', $bd->getTotalSugestoes());
$dashboard->__set('totalReclamacoes', $bd->getTotalReclamacoes());

//Retorna a resposta em JSON
echo json_encode($dashboard);

?>