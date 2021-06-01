# projeto

Abra o Heidisql e crie uma base de dados com o nome agenda e uma tabela com nome telefones;
Execute o codigo create :

CREATE TABLE `telefones` (
	`primare` INT(5) NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(15) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
	`numero` VARCHAR(15) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
	`endereco` VARCHAR(30) NOT NULL DEFAULT '0' COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`primare`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB
;

Para abrir o projeto  abra C: > xamp >htdocs > e cole o projeto dentro de "htdocs" com os arquivos que estão fora  da pasta projeto os quais são bancodedados, estilo e funcao-botoes.

Obs: você precisa ter o xampp com mysql e apache startados para utilizar o banco de dados e abrir o projeto. 

Para abrir o projeto no navegador, abra seu navegador e digite localhost/projeto.




















