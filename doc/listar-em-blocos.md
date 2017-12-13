<b>ESTE EXEMPLO FOI BASEADO NA TABELA DE CIDADES</b>
<p>
No controller da api de seu modulo use as opcções <br>

```
   $this->view->setTemplatePathCuston(sprintf("%s/%s/lista", $this->TemplatePath, $this->template));
                      
```
você pode alterar o nome do arquivo que vem como padrão lista<br>
também descomente alinha <br>

```
return $this->TableModel->render($this->route,'newDataTableJson');
```
e mantenha comentado alinha <br>

```
return $this->TableModel->render($this->route);
```
no arquivo de listagem voce pode montar seu bloco html ex: <br>

```
<?php extract($d);?>
     <div class="col-md-4">
     <!-- Widget: user widget style 1 -->
     <div class="box box-widget widget-user-2">
       <!-- Add the bg color to the header using any of the bg-* classes -->
       <div class="widget-user-header bg-yellow">
         <div class="widget-user-image">
           <?=$cover?>
         </div>
         <!-- /.widget-user-image -->
         <h3 class="widget-user-username"><?=$title?></h3>
         <h5 class="widget-user-desc">Lead Developer</h5>
       </div>
       <div class="box-footer no-padding">
         <ul class="nav nav-stacked">
             <li><a href="#">Estato <span class="pull-right badge bg-blue"><?=$uf?></span></a></li>
             <li><a href="#">Ibge <span class="pull-right badge bg-aqua"><?=$ibge?></span></a></li>
             <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
             <li><a href="#">Status <span class="pull-right"><?=$status?></span></a></li>
             <li><label style="width: 100%;padding:  0 18px;cursor: pointer;">Ativar/Desativar/Excluir <span class="pull-right"><?=$id?></span></label> </li>
         </ul>
       </div>
     </div>
     <!-- /.widget-user -->
     </div>
   ```
   E muito IMPORTANTE não equecer de dar um<br>
   
   ```
   <?php extract($d);?>
   ```