<?php
	include('conexao.php');	
	
	if(isset($_FILES['arquivo'])) {
		$arquivo = $_FILES['arquivo'];
		
		if($arquivo['error']) die ("Falha ao enviar arquivo");
		
		if($arquivo['size'] > 2097152) die ("Erro, arquivo muito grande! Max. 2MB");
		
		$pasta = "arquivos/";
		$nomeDoArquivo = $arquivo['name'];
		$novoNomeDoArquivo = uniqid();
		$extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));
		
		if($extensao != "jpg" && $extensao != "png") die ("Tipo de arquivo não aceito!");
		
		$path = $pasta . $novoNomeDoArquivo . "." . $extensao;
		
		$deu_certo = move_uploaded_file($arquivo["tmp_name"], $path);
		if($deu_certo) {
			$mysqli->query("INSERT INTO arquivos (nome, path) VALUES ('$nomeDoArquivo', '$path')") or die ($mysqli->error);
			echo "<p>Arquivo enviado com sucesso! Para acessa-lo,<a href='arquivos/$novoNomeDoArquivo.$extensao' target=\"_blank\">clique aqui</a></p>";
		}
		else
			echo "<p>Falha ao enviar arquivo!</p>";
		
	}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=devide-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>File Upload PHP</title>
</head>
<body>
	<div class="container">
		<h2>Upload de Arquivos em PHP</h2>
		<form enctype="multipart/form-data" method="post">
			<p><label for="">Selecione o Arquivo</label>
			<input type="file" name="arquivo"></p><br>
			<button type="submit">Enviar Arquivo</button>
		</form><br>
		<a href="https://github.com/jancordeiro" class="git" target="_blank"><i class="fa-brands fa-github"></i></a>
</body>
</html>