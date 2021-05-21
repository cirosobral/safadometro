<?php
/*
  Define o fuso horário, algo que em geral já está definido no arquivo php.ini.
*/
date_default_timezone_set('America/Bahia');

/*
  Registra um auto-loader (carregador automático), que serve para buscar e
  incluir automaticamente os arquivos que contém definições de classes.

  Para esse projeto, com apenas uma classe, teria o mesmo efeito carregar apenas
  a definição da classe Safadometro. No entanto, usar o auto-loader é uma boa
  prática.
*/
spl_autoload_register(function ($model) {
   require_once "./model/$model.php";
});

/*
 Exemplo: Quando o .htaccess está funcionando, se for digitada no navegador
          a URL "localhost/resultado/1/2/3", o mod_rewrite indica o servidor a
          transformar essa URL em localhost/index.php?url=resultado/1/2/3.

          Assim, o PHP irá receber em $_GET['url'] o valor "resultado/1/2/3".

          Então, a função abaixo "explode", separa as partes desse string, toda
          vez que encontra uma barra ('/'). Desse modo, o array resultante na
          variável $url é:
          [resultado,
          1,
          2,
          3]
*/
$url = explode('/', $_GET['url']);

/* Verifica o conteúdo da posição 0 no array $url */
switch ($url[0]) {
  /* Caso o conteúdo seja 'resultado' */
  case 'resultado':
    /* Cria um novo objeto da classe Safadometro, que é o model que encapsula as
    funcionalidades do nosso projeto, passando para o tempo para o construtor */
    $sm = new Safadometro($_POST['nascimento']);

    /* Extrai o resultado dos cálculos feitos pelo modelo */
    $anjo = $sm->anjo;
    $vagabundo = $sm->vagabundo;

    /* Inclui a view do resultado para ser exibida ao usuário */
    include("./view/resultado.html");
    break;

  /* Caso o conteúdo NÃO seja 'resultado'*/
  default:
    /* Inclui a view do index, para exibir o formulário para o usuário */
    include("./view/formulario.html");
}
