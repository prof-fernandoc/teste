<?php

if ( isset( $_GET['p'] ) ) $param = strtolower($_GET['p'] ); 

if ( in_array( $param, ['maxakali', 'apukare', 'vales', 'projeto', 'pedagoga', 'cinta'] ) ) {

$diretorio_atual = getcwd();
$arqCfg = $param . '_cfg.json';
$dadosImg = json_decode(file_get_contents( $diretorio_atual . DIRECTORY_SEPARATOR . 'dados' . DIRECTORY_SEPARATOR . $arqCfg ), true);

//Testa se o arquivo JSON ($arqCfg) está com erro.
//echo '<pre>';
//echo print_r( $dadosImg , 1);
//echo '</pre>';
//die('Erro no arquivo JSON');

//pega lista de todas imagens no album.
$album = $param . '_img';
$dir = new DirectoryIterator( $diretorio_atual . DIRECTORY_SEPARATOR . 'dados' . DIRECTORY_SEPARATOR . $album );
$cont = 0;
foreach($dir as $arquivo) {
  if  ( $arquivo->isFile() ) {
    $nomeArq = $arquivo->getFilename();
	$enderecoArq = 'dados/' . $album . '/' . $nomeArq;
	
	$rotulo = "";
	$descricao = "";
	if (isset($dadosImg[$nomeArq]['label'])) $rotulo = $dadosImg[$nomeArq]['label'];
	if (isset($dadosImg[$nomeArq]['description'])) $descricao = $dadosImg[$nomeArq]['description'];
?>

    <div class="4u">
      <div class="image fit">
	    <?php if (!empty($rotulo) || !empty($descricao)) { ?>
		  <div style="position:absolute; background-color: white; width:100%; opacity: 0.75; padding: 2px">
            <h1><?php echo $rotulo; ?></h1>
            <span><?php echo $descricao; ?></span>
		  </div>
		<?php } ?>
		
		<div>
        <a href="<?php echo $enderecoArq; ?>">
		   <img class="homeblock" src="<?php echo $enderecoArq; ?>" alt="<?php echo $descricao; ?>" />
		</a>
		</div>
		
      </div>
    </div>

<?php
    $cont++;
  }
 }
}
?>