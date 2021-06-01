<?php

require_once("../bancodedados.php");
require_once("./funcoes.php");
$cordefundo="#ADD8E6";
iniciapagina($cordefundo,"Telefones","Excluir");
$bloco=( !ISSET($_REQUEST['bloco']) ) ? 1 : $_REQUEST['bloco'] ;
switch (TRUE)
{
  case ( $bloco==1 ):
  {
    picklist("E",1);
    break;
  }
  case ( $bloco==2 ):
  { 
    printf("  <form action='./excluirtel.php' method='POST'>\n");
    printf("  <input type='hidden' name='bloco' value='3'>\n");
    printf("  <input type='hidden' name='primare' value='$_REQUEST[primare]'>\n");
    
    mostralinha($_REQUEST['primare'],"E",$bloco);
    printf("</form>");
    break;
  }
  case ( $bloco==3 ):
  { 
    printf("Tratando a transação.<br>");
    
    $cmdsql="DELETE FROM telefones WHERE telefones.primare='$_REQUEST[primare]'";
    $tentativa=TRUE;
    while ( $tentativa )
    { 
      mysqli_query($nulink,"START TRANSACTION");
      $execcmd=mysqli_query($nulink, $cmdsql);
      if ( mysqli_errno($nulink)==0 )
      { 
        mysqli_query($nulink,"COMMIT");
        $mensagem="Comando de Exclusão de telefones $_REQUEST[primare], foi executado com sucesso!";
        $tentativa=FALSE;
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
    botoes("E",$bloco);
    break;
  }
}

?>






