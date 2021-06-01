<?php

require_once("../bancodedados.php");
require_once("./funcoes.php");

$cordefundo="#ADD8E6";
iniciapagina($cordefundo,"TELEFONES","Incluir");

$bloco=( !ISSET($_REQUEST['bloco']) ) ? 1 : $_REQUEST['bloco'] ;
switch (TRUE)
{
  case($bloco==1):
  { 
    printf("<form action='incluir.php' method='POST'>\n");
    printf("<input type='hidden' name='bloco' value=2>\n");
    printf("<table border=1 style='border-collapse: collapse;'>\n");
    printf("<tr><td>Nome</td><td><input type='text' name='nome' size='40' maxlength='200' placeholder='Digite Nome'></td></tr>");
	printf("<tr><td>Numero</td><td><input type='text' name='numero' size='40' maxlength='200' placeholder='Digite Numero'></td></tr>");
	printf("<tr><td>Endereço</td><td><input type='text' name='endereco' size='40' maxlength='200' placeholder='Digite Endereço'></td></tr>");
    
	printf("<tr><td>&nbsp;</td><td>");botoes("I",$bloco);printf("</td></tr>\n");
    printf("</table>\n");
    printf("</form>\n");
    break;
  }
  case($bloco==2):
  { 
    printf("Tratando a transação.<br>");
   
    $tentativa=TRUE;
    while ( $tentativa )
    { 
      mysqli_query($nulink,"START TRANSACTION");
      
      $ultimacp=mysqli_fetch_array(mysqli_query($nulink,"SELECT MAX(primare) AS CpMAX FROM telefones"));
      $CP=$ultimacp['CpMAX']+1;
      $cmdsql="INSERT INTO telefones (primare,nome,numero,endereco)
                      VALUES ('$CP','$_REQUEST[nome]','$_REQUEST[numero]','$_REQUEST[endereco]')";
      $execcmd=mysqli_query($nulink, $cmdsql);
      if ( mysqli_errno($nulink)==0 )
      { 
        mysqli_query($nulink,"COMMIT");
        $mensagem="Comando de Inclusão do telefone $CP, foi executado com sucesso!";
        $tentativa=FALSE;
        mostralinha($CP,"I",$bloco);
      }
      else
      {
        if ( mysqli_errno($nulink)==1213 )
        { 
          $tentativa=TRUE;
        }
        else
        { 
          $tentativa=FALSE;
          $mensagem=mysqli_errno($nulink)." - ".mysqli_error($nulink);
        }
        mysqli_query($nulink,"ROLLBACK");
      }
    }
    printf("$mensagem<br>\n");
    break;
  }
}

?>
