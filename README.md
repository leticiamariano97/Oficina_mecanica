## Funcionalidades
- Login com validação de credenciais, senha verificada por password_verify, regeneração do ID da sessão e expiração por inatividade em 30 minutos.
- Painel com identificação do usuário e links de navegação.
- Clientes: cadastrar, listar, pesquisar por nome/telefone/e-mail, editar e excluir (o banco impede exclusão se houver veículo relacionado).
- Veículos: cadastrar com associação obrigatória a um cliente e listar os dados relacionados.

## O que deve ser implementado
- Funcionários: cadastrar, listar, pesquisar por nome/telefone/e-mail, editar e excluir.
- Ordens de serviço: cadastrar, listar por data de abertura decrescente, exibir dados do cliente e veículo e atualizar a data de abertura.

## Orientações: 
-Para desenvolver as funcionalidades dos funcionários pegue como exemplo os códigos dos clientes (não tem chave estrangeira).
-Para desenvolver as funcionalidades das ordens de serviço pegue como exemplo os códigos dos veículos (possui chave estrangeira).

## OBS:
Lembre-se de conferir se desenvolveu todas as partes do sistema: Models, Views e Controllers.
Lembrando que o index está pronto verifique a rotas se estão corretas.

## Instalação
-Faça o download do projeto base 
-Salve na pasta htdocs no seu computador
-Abra o XAMP e de start no Apache e no MYSQL
-Abra o navegador e digite https:localhost:8090/phpmyadmin e crie um novo banco de dados
-OBS: Verifique qual porta seu Apache está usando 
-Copie o SQL que está na pasta database do projeto clique em SQL no phpmyadmin e execute
-Com o banco pronto já pode testar a aplicação então abra o navegador
-Digite https:localhost:8090/nomedoprojeto
-para login existe três usuários de testes pode logar com o: Usuário: admin@oficina.com Senha:Ofinica@123
-Boa sorte agora falta desenvolver as funcionalidades faltantes no sistema 

## Diagrama Entidade Relacionameto:
-Para a entrega precisa também enviar o diagrama entidade relacionamento (DER)
-3 requisitos funcionais 3 não funcionais e 1 regra de negócio.   "# Oficina_mecanica" 
