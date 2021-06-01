<?php

require_once("../bancodedados.php");
require_once("./funcoes.php");

$cordefundo="#ADD8E6";
iniciapagina($cordefundo,"Telefones","Consultar");

$bloco=( !ISSET($_REQUEST['bloco']) ) ? 1 : $_REQUEST['bloco'] ;
switch (TRUE)
{
  case($bloco==1):
  {
    picklist("C",1);
    break;
  }
  case($bloco==2):
  { 
    mostralinha($_REQUEST['primare'],'C',$bloco);
    break;
  }
}

?>
