<?php
//aqui eu nao deixo a pessoa acessar o arquivo diretamente
if (basename($_SERVER['PHP_SELF']) == 'Init.php'){ die(''); }
// http://br.php.net/manual/pt_BR/ref.info.php#ini.magic-quotes-runtime
/*Se magic_quotes_runtime  estiver ativado, a maioria das funчѕes que retornarem dados de qualquer fonte externa incluindo banco de dados e arquivos de texto terуo as aspas escapadas com uma barra invertida. Se magic_quotes_sybase  tambщm estiver em on, uma aspa simples щ escapada com uma aspa simples ao invщs de uma barra invertida.*/
if(get_magic_quotes_runtime()){
        set_magic_quotes_runtime(0);
}
/*remove os efeitos das magic_quote diferente do runtime ele escapa dados vindos de formularios, GPC (Get/Post/Cookie), isso nao pode ser auterado via php.ini, por isso consertamos aqui, no PHP6 nao teremos mais magic_quotes*/
function remove_mq(&$var) {
        return is_array($var) ? array_map('remove_mq', $var) : stripslashes($var);
}
//verifico se esta em on e execulto a funчуo acima
if (get_magic_quotes_gpc()) {
        $_GET   = array_map('remove_mq', $_GET);
        $_POST   = array_map('remove_mq', $_POST);
        $_COOKIE = array_map('remove_mq', $_COOKIE);
}
/*defino para mostrar todos os erros e desfaчo o efeito do register_globals, outra parte insegura que nao existira mais no PHP6*/
if (function_exists('ini_get')) {
        if(!ini_get('display_errors')){
                ini_set('display_errors', 1);
        }
        if(ini_get('magic_quotes_sybase')){
                ini_set('magic_quotes_sybase', 0);
        }
        if (ini_get('register_globals')) {
                foreach($GLOBALS as $s_variable_name => $m_variable_value) {
                        if (!in_array($s_variable_name, array('GLOBALS', 'argv', 'argc', '_FILES', '_COOKIE', '_POST', '_GET', '_SERVER', '_ENV', '_SESSION', 's_variable_name', 'm_variable_value'))){
                                unset($GLOBALS[$s_variable_name]);
                        }
                }
                unset($GLOBALS['s_variable_name']);
                unset($GLOBALS['m_variable_value']);
        }
}
error_reporting(E_ALL);
//crio umas constantes para podermos usar no sistema
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('BASEPATH', getcwd()."/");
//pego o conteudo do include_path e ainda incluo mais paths, muito util para o sistema
set_include_path('.' . PATH_SEPARATOR . BASEPATH . 'includes'
        . PATH_SEPARATOR . BASEPATH . 'classes'
        . PATH_SEPARATOR . get_include_path());
// se formos usar classes elas nao precisaram ser incluidas nos scripts sѓ estanciadas.
function __autoload($classe){
        require_once $classe.".php";
}
//adiciono o arquivo de configuraчуo
#if (file_exists(BASEPATH . 'Inc/Config.php')){
        #require_once BASEPATH . 'Inc/Config.php';
#} else {
        #die('Erro: Arquivo config.php nao localizado');
#}
//http://br.php.net/manual/pt_BR/function.clearstatcache.php
extract($_POST);
extract($_GET);
clearstatcache();
?>