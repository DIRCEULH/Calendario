<?php
    include 'conexao.php';
    ini_set('display_errors','on');
   
    if(!empty($_GET['data']) ){
    $data = implode("-",array_reverse(explode("/",$_GET['data'])));
   
    }else{

        $data ='';
    }

    $eventos = $pdo->prepare( 'SELECT *FROM  eventos where data = :data ');
    $eventos->bindValue(':data',  $data);
    $eventos->execute();
    $dados = $eventos->fetchAll(PDO::FETCH_ASSOC);
 
        
?>
<!DOCTYPE HTML>
<html lang="pt-BR">
    <head>
        <meta charset=UTF-8>
        <title>Calendário de eventos</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" />
    </head>

    <body style="font-family: verdana;">
    <div class="calendario">
    <fieldset>
        <legend>Eventos</legend>
    <table class="table table-bordered" >
						<thead>
							<tr>
								<th>ID</th><th>Titulo</th><th>Data</th><th>Mensagem</th></th>
							</tr>
						</thead>
						<tbody>
						<?php
						foreach ($dados as $d){	
							echo '<tr><td>'.$d['id'].'</td><td>'.$d['titulo'].'</td><td>'.date('d/m/Y', strtotime($d['data'] )).'</td><td>'.$d['mensagem'].'</td></tr>';
						}
						?>
						</tbody>
					</table> 
                    </fieldset>
                    <a class="button" href="index.php" title=""><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a><br></br>
    </div>
    
</body>
</html>