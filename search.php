<?php
$connect = new PDO("mysql:host=localhost;dbname=tutorial", "root", "");
if (isset($_POST["nome"])) {
	$busca = $_POST["nome"];
	$query = "select * from tb_name where nome like '%".$busca."%' order by nome";
}
else {
	$query = "select * from tb_name order by nome";
}
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$rowCount = $statement->rowCount();

if ($rowCount > 0) {
	$data = '<div class="table-responsive">
		<table class="table bordered">
		<tr>
			<th>Nome</th>
			<th>Telefone</th>
			<th>Cidade</th>
		</tr>
	';
	foreach($result as $row) {
		$data .= '
			<tr>
				<td>'.$row["nome"].'</td>
				<td>'.$row["telefone"].'</td>
				<td>'.$row["cidade"].'</td>
			</tr>
		';
	}
	$data .= '</table></div>';
}
else {
	$data = "Nenhum registro localizado.";
}

echo $data;
