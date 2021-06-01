<?php

require_once("../bancodedados.php");
require_once("./funcoes.php");
$cordefundo="#ADD8E6";
iniciapagina($cordefundo,"Telefones","Alterar");
$bloco=( !ISSET($_REQUEST['bloco']) ) ? 1 : $_REQUEST['bloco'] ;
switch (TRUE)
{
  case ( $bloco==1 ):
  { 
    picklist("A",$bloco);
    break;
  }
  case ( $bloco==2 ):
  { 
    printf("  <form action='./alterar.php' method='POST'>\n");
    printf("  <input type='hidden' name='bloco' value='3'>\n");
    printf("  <input type='hidden' name='primare' value='$_REQUEST[primare]'>\n");
    $regalt=mysqli_fetch_array(mysqli_query($nulink,"SELECT * FROM telefones WHERE telefones.primare='$_REQUEST[primare]'"));
    printf("<table border=1 style='border-collapse: collapse;'>\n");
    printf("<tr><td>Nome</td><td><input type='text' name='nome' value='$regalt[nome]' size='40' maxlength='200' placeholder='Digite Nome'></td></tr>");
	printf("<tr><td>Numero</td><td><input type='text' name='numero' value='$regalt[numero]' size='40' maxlength='200' placeholder='Digite Numero'></td></tr>");
	printf("<tr><td>Endereço</td><td><input type='text' name='endereco' value='$regalt[endereco]' size='40' maxlength='200' placeholder='Digite Endereço'></td></tr>");
	
    printf("<tr><td>&nbsp;</td><td>");botoes("A",$bloco);
    printf("</td></tr>\n");
    printf("</table>\n");
    printf("</form>");
    break;
  }
  case ( $bloco==3 ):
  { 
    printf("Tratando a transação.<br>");
    
    $cmdsql="UPDATE telefones SET nome         ='$_REQUEST[nome]',
                                numero                ='$_REQUEST[numero]',
                                endereco      ='$_REQUEST[endereco]'
                            WHERE telefones.primare='$_REQUEST[primare]'";
    $tentativa=TRUE;
    while ( $tentativa )
    { 
      mysqli_query($nulink,"START TRANSACTION");
      $execcmd=mysqli_query($nulink, $cmdsql);
      if ( mysqli_errno($nulink)==0 )
      { 
        mysqli_query($nulink,"COMMIT");
        $mensagem="Comando de Alteração do telefone $_REQUEST[primare], foi executado com sucesso!";
        $tentativa=FALSE;
        mostralinha($_REQUEST['primare'],"A",$bloco);
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

















