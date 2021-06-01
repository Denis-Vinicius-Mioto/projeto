# Percebi um comportamento errado dos botões de navegação quando testei em diversos navegadores
# Copie e cole as linhas abaixo SUBSTITUINDO a função botoes no arquivo toolskit.php
function botoes($acao,$bloco)
{ # esta função monta a barra de botões
  # Os dois parâmetros desta função são a letra indicando a operação (ICAEL) e o número do bloco do PA que está executando a função.
  # Os valores dos parâmentros e os botões que devem ser montados e exibidos são os seguintes:
  # I1 |       Incluir        | Limpar |        | Início |
  # I2 |                      |        |        | Início | 
  # C1 |      Consultar       | Limpar |        | Início |
  # C2 |                      |        | Voltar | Início |
  # A1 |       Alterar        | Limpar |        | Início |
  # A2 |  Confirmar Alterar   | Limpar | Voltar | Início |
  # A3 |                      |        |        | Início | 
  # E1 |   Excluir            | Limpar |        | Início |
  # E2 |  Confirmar Exclusão  |        |        | Início |
  # E3 |                      |        |        | Início | 
  # L1 | Gerar Relatório      |        |        | Início |
  # L2 | Gerar para Impressão |        | Voltar | Início |
  # L3 |      Imprimir        |
  $op=$acao.$bloco;
  # printf("$op-");
  $inicio=($op!="L2" and $op!="L3")?"<button type='button' onclick='history.go(-".$bloco.")'>Início</button>":"";
  $limpar=($op=="C1" or $op=="I1" or $op=="A1") ? "<button type='reset'>Limpar</button>" : "";
  $voltar=($op=="C2" or $op=="E2" or $op=="A2") ? "<button type='button' onclick='history.go(-1)'>Voltar</button>" : "";
  $operar=($op=="C1")?"Consultar":(($op=="E1")?"Excluir":(($op=="E2")?"Confirmar Exclusão":(($op=="A1")?"Alterar":(($op=="A2")?"Confirmar Alteração":(($op=="I1")?"Incluir":(($op=="L1")?"GerarRelatório":(($op=="L2")?"Gerar P/Impressão":(($op=="L3")?"Imprimir":""))))))));
  $operacao=($operar!="")?("<button type='submit'>".$operar."</button>"):"";
  $botao=$operacao.$limpar.$voltar.$inicio;
  printf("$botao");
}