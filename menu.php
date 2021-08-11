		<nav id="menu" class="dropdown" style="width: 432px">
        	<ul class="links">
        	    <?php foreach($config["menu"]->value as $item){?>
        		<li style="margin-bottom: 10px;">
                    <button type="button" class="collapsible" >
						<?=$item->label?>
					</button>
                    <div class="menu">
                        <div style="display: block;background-color: white; padding-left: 10px;">
         			  <a href="page.php?p=<?=$item->id?>">Galeria</a><br>
        			  <!-- <a href="elements.php">Documentos</a>  -->
        			  </div>
                    </div>
        		</li>
        		<?php } ?>
        		<!-- <a href="page.php?p=researcher"><button type="button" class="collapsible" style= "margin-bottom: 10px;">Pesquisadora</button></a> -->
        		<a href="{{config.externalmedia.value}}" target="_blank"><button type="button" class="collapsible" style= "margin-bottom: 10px;">{{config.externalmedia.label}}</button></a>
        		<br>
        	</ul>
        </nav>