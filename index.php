<?php
    include 'conexao.php';

    include 'calendario.php';

    $info = array(
        'tabela' => 'eventos',
        'data' => 'data',
        'titulo' => 'titulo',
        'mensagem' => 'mensagem'
    );
?>
<!DOCTYPE HTML>
<html lang="pt-BR">
    <head>
        <meta charset=UTF-8>
        <title>Calendário de eventos</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.min.css" rel="stylesheet" />
    </head>

    <body>
    <div class="calendario">
     <?php 
         $eventos = montaEventos($info);
         montaCalendario($eventos);
     ?>
     <div class="legends">
         <span class="legenda"><span class="red"></span> Hoje</span>
         <span class="legenda"><span class="blue"></span> Eventos</span>
         <span class="legenda"><span class="white"></span> Dias</span>  
     </div>
    </div>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
    </body>
</html>