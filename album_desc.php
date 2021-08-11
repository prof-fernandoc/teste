<?php
if ( isset( $_GET['p'] ) ) $param = strtolower($_GET['p'] ); 

if ( in_array( $param, ['maxakali', 'apukare', 'vales', 'projeto', 'pedagoga', 'cinta'] ) ) {
$diretorio_atual = getcwd();
$arqCfg = $param . '_cfg.json';
$dados = json_decode(file_get_contents( $diretorio_atual . DIRECTORY_SEPARATOR . 'dados' . DIRECTORY_SEPARATOR . $arqCfg ), true);

//Testa se o arquivo JSON ($arqCfg) está com erro.
//echo '<pre>';
//echo print_r( $dados , 1);
//echo '</pre>';
//die('Erro no arquivo JSON');

$rotulo = "";
$descricao = "";
$versao = "";
if (isset($dados[$param]['label'])) $rotulo = $dados[$param]['label'];
if (isset($dados[$param]['value'])) $descricao = $dados[$param]['value'];
if (isset($dados[$param]['version'])) $versao = $dados[$param]['version'];

echo '<h4>' . $rotulo . '</h4>';
echo '<div>' . $descricao . '</div>';
echo '<br><div style="text-align:right"> postado em: ' . $versao . '</div>';

}
?>