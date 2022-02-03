<?php
define('RAIZ_SERVER', $_SERVER['DOCUMENT_ROOT']); //.DIRECTORY_SEPARATOR);
$path_class = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'atende' . DIRECTORY_SEPARATOR . 'class';
set_include_path(get_include_path() . PATH_SEPARATOR . $path_class);
require_once(RAIZ_SERVER . "/atende/login/" . "abspmc" . "/conexao.class.php"); //Definição do objeto de conexão
require_once("_page_index.class.php"); //Adiciona a classe _page_index
echo "<br/>Diretorio de classe:" . $path_class;
echo "<br/>Conexao do banco...:" . RAIZ_SERVER . "/atende/login/" . "abspmc" . "/conexao.class.php";

$page = new _page_index();

print_r($page->getCSS());
print_r($page->getJS());
print_r($page->getPHP());
print_r($page->getPHParg());
print_r($page->getPages());
print_r($page->getCSSpage(1));
print_r($page->getJSpage(1));
print_r($page->getPHPpage(1));
