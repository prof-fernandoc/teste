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

  $img = '';
  if (isset($dados[$param]['img_destaque'])) {
	$img_destaque = 'dados' . '/' . $param . '_img/' . $dados[$param]['img_destaque'];
	$descricao = '';
	if (isset($dados[$param]['img_destaque_alt'])) $descricao = $dados[$param]['img_destaque'];
	$img = '<img src="' . $img_destaque . '" alt="' . $descricao . '" />';
	echo $img;
  }
}
?>