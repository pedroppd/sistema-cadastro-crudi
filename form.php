<?php


include_once('conexao.php');
include('crudCadastro.php');
?>
<html>
<head>
    <meta charset="utf-8">
	<title>LISTA DE PRODUTOS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Krona+One" rel="stylesheet">
</head>
<body>


<form method="post" enctype="multipart/form-data" action="crudCadastro.php" >

<div class="row">
  <div class="col-lg-4"></div>
    <div class="col-lg-4">
     <div class="form-group">
      <label for="id"><b>ID:</b></label>
      <input type="number" name="id" id="id" class="form-control" value="<?php if(isset($_GET['edit'])) echo $row['idproduto']; ?>"><br><br>
     </div> 
    </div>


</div>


<div class="row">
 <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <div class="form-group">
     <label for="nome"><b>NOME:</b></label>
       <input type="text" name="nome" id="nome" class="form-control" value="<?php if(isset($_GET['edit'])) echo $row['nome_produto'];  ?>"><br><br>
   </div>    
    </div>
</div>

<div class="row">
 <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <div class="form-group">
     <label for="descricao"><b>DESCRIÇÃO:</b></label>
       <input type="text" name="descricao" class="form-control" id="descricao" value="<?php if(isset($_GET['edit'])) echo $row['descricao_produto']; ?>"><br><br>
    </div>
  </div>  
</div>

<div class="row">
  <div class="col-lg-4"></div>
   <div class="col-lg-4">
      <div class="form-group">
        <label for="preco"><b>PREÇO:</b></label>
        <input type="number" name="preco" id="preco" class="form-control" value="<?php if(isset($_GET['edit'])) echo $row['preco_produto']; ?>"><br><br>
    </div>    
      </div>
</div>

<div class="row">
 <div class="col-lg-4"></div>
  <div class="col-lg-4">
    <div class="form-group">
      <label for="imagem"><b>IMAGEM:</b></label>
    <input type="file" name="imagem" id="imagem" class="form-control" value="<?php if(isset($_GET['edit'])) echo $row['imagem_produtos']; ?>"><br><br>
  </div>  
</div>
</div>

<div class="row">
  <div class="col-lg-4"></div>
     <div class="col-lg-4">
        <?php 
        if(isset($_GET['edit'])){
        ?>
        <button type="submit" name="update" class="btn btn-primary">Atualizar</button>

        <a href="form.php" class="btn btn-danger"><b>Cancelar</b></a>

        <?php
        }else{
         ?>
         <button type="submit" name="save" class="btn btn-success">Salvar</button>

         <a href="index.php" class="btn btn-primary">Voltar</a>

         <?php 
         }
          ?>
   </div>       
 </div>  
  </form>
  <br><br><br>



<?php 

echo'<table border="1px" class="table table-striped text-center">';
echo '<thead>';
echo'<tr>';
echo'<th>ID</th>';
echo'<th>NOME</th>';
echo'<th>DESCRIÇÃO</th>';
echo'<th>PREÇO</th>';
echo'<th>IMAGEM</th>';
echo'<th>EXCLUIR</th>';
echo '<th>EDITAR</th>';
echo'</tr>';
echo '</thead>';
$sql=$con->query("SELECT * FROM produtos");

if(isset($sql)){  
  while($dados=$sql->fetch_array()){
    $id=$dados['idproduto'];
    $nome=$dados['nome_produto'];
    $descricao=$dados['descricao_produto'];
    $preco=$dados['preco_produto'];
    $imagem=$dados['imagem_produto'];
     echo "<tbody>"; 
      echo"<tr>";
      
      echo "<td>".$id."</td>";
      echo "<td>".$nome."</td>";
      echo "<td>".$descricao."</td>";
      echo "<td>".$preco."</td>";
      echo "<td>".$imagem."</td>";

 ?>
      <td><a href="crudCadastro.php?del=<?php echo $id ?>" onclick='return confirm("tem certeza que deseja excluir esse produto ?");' class="btn btn-danger">Excluir</a></td>
      <td><a href="form.php?edit=<?php echo $id ?>" class="btn btn-primary">Editar</a></td>
      

     
<?php
 echo "</tr>";
 echo "</tbody>"; 
  }
echo'</table>';
} 
?>

</body>
</html>