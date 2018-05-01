<?php
include_once('conexao.php');


if(isset($_POST['save'])){
	
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
			move_uploaded_file ($foto["tmp_name"],".img/".$nomefoto);
		} else {
			echo "GRAVADO COM SUCESSO!!";
		}
		
		//4 --->> Fechar conexão com o banco:
		$con->close();
		
		}
}




if (isset($_GET['del'])) {
$con->query("DELETE FROM produtos WHERE idproduto=".$_GET['del']);

header('location:form.php');
}

if (isset($_GET['edit'])) {
$sql=$con->query("SELECT * FROM produtos WHERE idproduto=".$_GET['edit']);
$row=$sql->fetch_array();



}

if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $nome=$_POST['nome'];
    $descricao=$_POST['descricao'];
    $foto=$_FILES['imagem'];
    $preco=$_POST['preco'];

    $ext = explode(".", $foto["name"]); // [foto][crisantemo][jpg]
		$ext = array_reverse($ext); // [jpg][crisantemo][foto]
		$ext = $ext[0];
		
		
			
		 if ($foto["size"] > 1024*1000) {
			echo "Tamanho excedido!";
		} else {
		
		
	
		
		$nomefoto = date("YmdHis").rand(0000,9999).".".$ext;
		// montar a instrução para gravar no banco:
		$sql = $con->query("UPDATE produtos SET  nome_produto='".$nome."' 
        ,imagem_produto='".$nomefoto."' 
        ,descricao_produto='".$descricao."'
        ,preco_produto='".$preco."' WHERE idproduto='".$id."'");

        header('location:form.php');

		
		// 3 ----------->> Gravar no banco:
		
		
	
		
		//4 --->> Fechar conexão com o banco:
		$con->close();
		
		}
   
}
 


 ?>