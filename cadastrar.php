<?php 
include_once("conexao.php");

$nome=$_POST['nome'];
$descricao=$_POST['descricao'];
$foto=$_FILES['imagem'];
$preco=$_POST['preco'];

$ext = explode(".", $foto["name"]); // [foto][crisantemo][jpg]
		$ext = array_reverse($ext); // [jpg][crisantemo][foto]
		$ext = $ext[0];
		
		if ($ext != "jpg" && $ext != "jpeg" && $ext != "png" && $ext != "gif") {
			echo "Arquivo inválido!";
		} else if ($foto["size"] > 1024*1000) {
			echo "Tamanho excedido!";
		} else {
		
		// abrir conexão com o banco:
		
		
		$nomefoto = date("YmdHis").rand(0000,9999).".".$ext;
		// montar a instrução para gravar no banco:
		$sql = $con->query("INSERT INTO produtos (nome_produto, imagem_produto, descricao_produto, preco_produto)VALUES('".$nome."', '".$nomefoto."', '".$descricao."', '".$preco."')");
		
		// 3 ----------->> Gravar no banco:
		
		
		if (!$sql) {
			echo "ERRO AO GRAVAR";
			// criar o arquivo no Servidor:
			move_uploaded_file ($foto["tmp_name"],"img/".$nomefoto);
		} else {
			echo "GRAVADO COM SUCESSO!!";
		}
		
		//4 --->> Fechar conexão com o banco:
		$con->close();
		
		}

 ?>