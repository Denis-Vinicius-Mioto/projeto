<?php

function picklist($ac,$bl)
{ 
  $PRG=($ac=='C') ? "consultar.php" : (($ac=='E') ? "excluirtel.php" : "alterar.php");
  global $nulink;
  
  $execcmd=mysqli_query($nulink, "SELECT primare, nome  FROM telefones");
  
  
  printf("  <form action='./$PRG' method='POST'>\n");
  printf("  <input type='hidden' name='bloco' value='2'>\n");
  printf("  <input type='hidden' name='salto' value='2'>\n");
  printf("  <table>\n");
  printf("  <tr><td>Escolha o telefone:</td><td><select name='primare'>\n");
  
  while ( $reg=mysqli_fetch_array($execcmd) )
  {
    printf("<option value='$reg[primare]'>$reg[nome]</option>\n");

  }
  printf("</select>");
  botoes($ac,$bl);
  printf("</td></tr>");
  printf("  </table>\n");
  printf("  </form>\n");
}
function mostralinha($CP,$acao,$bloco)
{ 
  global $nulink;
  $reg=mysqli_fetch_array(mysqli_query($nulink, "SELECT * from telefones WHERE primare='$CP'"));
  
  printf("  <table border=1 style='border-collapse: collapse;'>\n");
  printf("  <tr><td>Codigo:</td>     <td>$reg[primare]</td></tr>\n");
  printf("  <tr><td>Nome:</td>       <td>$reg[nome]</td></tr>\n");
  printf("  <tr><td>Numero:</td>        <td>$reg[numero]</td></tr>\n");
  printf("  <tr><td>Endereço:</td>   <td>$reg[endereco]</td></tr>\n");
 
  printf("  <tr><td>&nbsp;</td>   <td>");botoes($acao,$bloco);printf("</td></tr>\n");
  printf("  </table>\n");
}
?>
