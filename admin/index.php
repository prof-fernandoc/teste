<?php
include 'tools.php';
if(isset($_POST["submit"])){
    $maskdesc = '@desc_';
    $cfgp = "../config.json";
    //var_dump($_POST);
    $config = loadJSON($cfgp);
    //var_dump($config);
    foreach ($_POST as $key => $value) {
      if(!empty($config[$key]) && property_exists($config[$key],"value")){
        if($config[$key]->type=='strlist'){
          //echo "JCL ".$key. " ". count($config[$key]->value). " " . $_POST[$key];
          $items = array();
          for ($c=1; $c <= count($config[$key]->value); $c++) {
              $items[] = $_POST[$key.$c];
          }/**/
          $config[$key]->value=$items;
        }else if($key != 'submit' && $key != 'inputCount' && substr($key, 0, 6) != $maskdesc){
          $config[$key]->value=$value;
          /*$mev = "";
          foreach ($config as $cfg ) {
              if($cfg->name == $key){
                {
                    $mev = $cfg->value;
                    $cfg->value=$value;
                    break;
                }
              }
          }
          if($value != $mev){
            //echo "<p>".$key.": ".$mev."=".$value."</p>";
          }/**/
        }
      }
    }
  
    foreach ($_FILES as $key => $value) {
      //if($key != 'submit' && $key != 'inputCount' && substr($key, 0, 6) != '@desc_'){
      //echo "FILE: ".$key.": ";
      //var_dump($value);//tmp_name, size
        $fmev = "";
        foreach ($config as $cfg ) {
          if($cfg->type=='file' || $cfg->type=='image'){
            if($cfg->name == $key){
              $fmev = $cfg->value;
              move_uploaded_file( $value['tmp_name'], $fmev );
              $newDesc = $_POST[$maskdesc.$key];
              if($cfg->description != $newDesc){
                  $cfg->description = $newDesc;
              }
              if(!empty($value['type']) && $cfg->mime != $value['type']){
                  $cfg->mime = $value['type'];
              }              
              if(!empty($value['size']) && $cfg->size != $value['size']){
                  $cfg->size = $value['size'];
              }              
              /*foreach ($config as $cfgdesc ) {//atualiza o campo correspondente para descrição da imagem
                if($cfgdesc->name == $maskdesc.$key){
                  $cfgdesc->value=$value;
                }
              }/**/
              break;
            }/**/
          }
        }
        //if($value != $mev)
          //echo "<p>".$key.": ".$fmev."=".$value."</p>";
      //}
    }   
    $fp = fopen($cfgp, 'w');
    fwrite($fp, json_encode($config));
    fclose($fp);       
    /*$fp = fopen('../main.json', 'w');
    fwrite($fp, json_encode(array("site"=>$main)));
    fclose($fp);    
    $inputCount = ($_POST["inputCount"]);
    $inputs=array();
    for($i = 1; $i <= $inputCount; $i++){
        $f = $_FILES["img".$i];
        $img = "home".$i.".jpg";
        $target_Path = "../images/".$img;
        $photos[]=array("title"=>$_POST["desc".$i], "url"=>"./images/".$img);
        if(!empty($f["name"] && file_exists($f['tmp_name']))){
            move_uploaded_file( $f['tmp_name'], $target_Path );
        }
    }
    $fp = fopen('../home.json', 'w');
    fwrite($fp, json_encode(array("photos"=>$photos)));
    fclose($fp);/**/
}

?>
<!DOCTYPE html>
<html lang="en">
<!--
Copyright (C) 2019 Abdiel Batista dos Santos, Jeancarlo Campos Leão, Rosa Jaqueline de Souza Cardoso
e George Rodrigues Vaz: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or any later version.
Please cite as: Please cite as: Santos, A. B., Leão, J. C. & Cardoso, R. J. S. (2019). ‘LightWeight: um mini gerenciador de conteúdo para sites da Web’. Instituto Federal do Norte de Minas Gerais - Campus Araçuaí. Available online: https://gitlab.com/jclsoftware/JLightWeight
-->
<head>
  <title>Configurações</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  <style type="text/css">
    img {
      padding-top: 50px;
    }
  </style>
 </head>
<body ng-app="formApp" ng-controller="formCtrl">
<div class="container mt-3">
  <h2>Atualizar parâmetros de configuração</h2>
  <p>Para atualizar uma configuração específica, insira um novo valor para o campo correspondente a seguir:</p>
  <form action="index.php" method="post" enctype="multipart/form-data">
    <h3>Geral</h3>
    <input type="hidden" id="inputCount" name="inputCount" value="{{cfg.length}}">
    <div class="form-group" ng-repeat="p in cfg" ng-if="p.type=='text'">
      <fieldset class="border p-2">
       <label class="custom-label" for="input{{$index + 1}}" title="{{p.description}}" lang="pt-BR">{{p.label}}</label>
       <input type="{{p.type}}" class="form-control" id="input{{$index + 1}}" title="{{p.description}}" name="{{p.name}}" value="{{p.value}}" size="{{max(2*p.value.length, 10)}}" placeholder="{{p.placeholder}}">       
     </fieldset>
    </div>
    <div class="form-group" ng-repeat="p in cfg" ng-if="p.type=='email'">
      <fieldset class="border p-2">
       <label class="custom-label" for="email{{$index + 1}}" title="{{p.description}}" lang="pt-BR">{{p.label}}</label>
       <input type="{{p.type}}" class="form-control" id="email{{$index + 1}}" title="{{p.description}}" name="{{p.name}}" value="{{p.value}}" size="{{max(2*p.value.length, 10)}}" placeholder="{{p.placeholder}}">       
     </fieldset>
    </div>    
    <div class="form-group" ng-repeat="p in cfg" ng-if="p.type=='html'">
      <fieldset class="border p-2">
       <label class="custom-label" for="input{{$index + 1}}" title="{{p.description}}" lang="pt-BR">{{p.label}}</label>
       <textarea type="{{p.type}}"  id="input{{$index + 1}}" title="{{p.description}}" name="{{p.name}}" class="form-control"  placeholder="{{p.placeholder}}">{{p.value}}</textarea> 
     </fieldset>
    </div>
    <div class="form-group" ng-repeat="p in cfg" ng-if="p.type=='strlist'">
      <fieldset class="border p-2">
       <label class="custom-label" for="list{{$index + 1}}" title="{{p.description}}" lang="pt-BR">{{p.label}}</label>
       <input type="hidden" name="{{p.name}}" value="{{p.value.length}}">
       <input type="text" class="form-control" id="list{{$index + 1}}" title="{{p.description}}" name="{{p.name}}{{$index + 1}}" size="{{max(2*q.value.length, 10)}}" placeholder="{{p.placeholder}}" ng-repeat="q in p.value" value="{{q}}">
     </fieldset>
    </div>    
    <fieldset class="border p-2" ng-repeat="p in cfg" ng-if="p.type=='image' || p.type=='file'">
    <legend>Arquivo {{$index + 1}} - {{p.name}}:</legend>
    <div class="form-group custom-file mb-3" >
          <img id="previewimg{{$index + 1}}" src="{{p.value}}?t={{rand}}" style="height:250px" title="{{p.description}}" alt="{{p.placeholder}}" ng-if="p.type=='image'">
          <label class="custom-file-label" for="img{{$index + 1}}">Clique aqui para substituir {{p.type=='image'?'a imagem':'o arquivo'}}</label>
          <input type="file" class="custom-file-input" id="img{{$index + 1}}" name="{{p.name}}" ng-if="p.type=='file'">
          <input type="file" class="custom-file-input" id="img{{$index + 1}}" name="{{p.name}}" accept="image/*" ng-if="p.type=='image'">
          <label class="custom-label" for="imgdesc{{$index + 1}}">Descrição para {{p.type=='image'?'a imagem':'o arquivo'}} <span id="filePropertiesimg{{$index + 1}}">(tamanho: {{p.size}} bytes, tipo: {{p.mime}}):</span></label>   
          <input type="text" class="form-control" id="imgdesc{{$index + 1}}" name="@desc_{{p.name}}" value="{{p.description}}">
    </div>
    </fieldset>
    <div class="checkbox" ng-repeat="p in cfg" ng-if="p.type=='checkbox'">
      <label>
        <input type="hidden" name="{{p.name}}" value="off">
        <input type="checkbox" name="{{p.name}}" ng-if="p.value == 'on'" checked="true"> 
        <input type="checkbox" name="{{p.name}}" ng-if="p.value == 'off'">
        {{p.label}}
      </label>
    </div>
    <div class="mt-3">
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </div>
  </form>
  <div class="copyright">
    &copy; JLightWeight 2019. All rights reserved.
  </div>
</div>
<script>
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
<script>
var app = angular.module('formApp', []);
app.controller('formCtrl', function($scope, $http) {
  $scope.rand = Math.random();
  $http.get("../config.json?t=" + $scope.rand).then(function(response) {
      $scope.cfg = response.data;      
      $(function() {
         $("input:file").change(function (e){
           f = e.originalEvent.target.files[0];
           var fileName = $(this).val();
           $("#fileProperties" + $(this).attr('id')).html("Upload from: " + fileName + ", tamanho: " + f.size + " bytes, tipo: " + f.type);
         });
      });
  });
});
</script>
</body>
</html>