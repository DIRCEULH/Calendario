<?php
    include 'conexao.php';

    ini_set('display_errors','on');

    date_default_timezone_set('America/Sao_Paulo');

    if(!empty($_GET['data']) )
    {
    $data = $_GET['data'];
    }
    else
    {
        $data ='';
    }

    if(!empty($_GET['titulo']))
    {
    $titulo = $_GET['titulo'];
    }
     else
    {  
        $titulo  = '';
    }
    if(!empty($_GET['mensagem']))
    {
    $mensagem = $_GET['mensagem'];
    }
    else
    {     
     $mensagem  = '';
    }
 
// validar as variaveis do post se estão vazias ou não e ensirir dados no banco
     if ( !empty($_POST))
     {
            $titulo = $_POST['titulo'];

            $mensagem = $_POST['mensagem'];

            $data = implode("-",array_reverse(explode("/",$_POST['data'])));

            $error = '';

            $ok='';

            $e='';

            if (empty($titulo))
            {
                $error .= 'O titulo não pode estar vazio.';
            }
            if (empty($mensagem))
            {
                $error .= 'O mensagem não pode estar vazio.';
            }
            if (empty($data))
            {
                $error .= 'O data não pode estar vazio.';
            }
           
            try {
                # se $error não estiver vazia,
                # gera exceção e não executa insert
                if (!empty($error)){

                    throw new Exception($e);

                }
        
            $eventos = $pdo->prepare( "INSERT INTO eventos (titulo, data, mensagem) VALUES(:titulo,:data,:mensagem )");

            $eventos->bindValue(':titulo',  $titulo);

            $eventos->bindValue(':data',  $data );

            $eventos->bindValue(':mensagem',  $mensagem);

            $eventos->execute();
    
        } catch (PDOException $err)
        {
            # entra aqui se houver exceção PDO
            $error .= $err->getMessage();
        }
         catch (Exception $e)
        {
            # entra aqui se houver exceção geral
            $error .= $e->getMessage();
        } 
        finally
        {
            if ($eventos || empty($error))
            {
              
            header('location:index.php');
            }
            else 
            {
               echo '<br><center><div><font color="red"> Campos Obrigatorios !</font></div></center>';
            }
        }
    } 
        
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
 <form action="eventos.php" method="post">
      <fieldset>
        <legend>Eventos</legend>
        <label>Titulo:</label><br><input class="" type="text" name = "titulo" value="<?php echo   $titulo ?>" ><br>
        <label>Data:</label><br><input class="" type="text" maxlength="10" name="data" value="<?php echo   $data ?>" onkeypress="mascaraData( this, event )"><br>
        <label>Mensagem:</label><br><textarea class="" name = "mensagem" cols="50" rows="6" ><?php echo   $mensagem ?></textarea><br>
        <button class="button" type="submit" value="Enviar"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar</button>
        <a class="button" href="index.php" title=""><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a><br></br>  
      </fieldset>
    </form>
    </div>
    

<script type="text/javascript" >
function mascaraData( campo, e )
{
	var kC = (document.all) ? event.keyCode : e.keyCode;
    
	var data = campo.value;
	
	if( kC!=8 && kC!=46 )
	{
		if( data.length==2 )
		{
			campo.value = data += '/';
		}
		else if( data.length==5 )
		{
			campo.value = data += '/';
		}
        else if( data.length=9 )
		{
			campo.value =data;
		}
		else
			campo.value = data;
	}
}

</script>
</body>
</html>