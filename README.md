Core do sistema siga com slim framework


Documentação<br><br>
<a href="https://github.com/SigaSmart/slim-core/blob/master/doc/Modal.md">criando uma modal</a>
<p>
<a href="https://github.com/SigaSmart/slim-core/blob/master/doc/Form-Attr.md">Attributos em tempo de execução</a>
<p>
<a href="https://github.com/SigaSmart/slim-core/blob/master/doc/listar-em-blocos.md">Listar dados em blocos</a>


<p>
se e a primeira instalação use db.sql<br>
se for um atualização instale as tabela avulsas se o ainda não fez!

<p>
 
 altera os arquivo dependecias.php<b>
 procure pela função abaixo, deve esta na linha 48 
 <br>
 ``` 
 $container['menu'] = function ($c) {
     //$route = $c->request->getUri()->getPath();
     //return new SIGA\Core\Helper\Menu\Menu($route);
     return new \SIGA\Auth\V1\Helpers\MenuHelper($c->get('adapter'));
 };
 
 ```
 os menus provalvelmente irão sumir acesse seuprojeto/admin/menutheme<br>
 crie um thema com o Nome Admin e com alias admin
 <br>
 depois acesse seuprojeto/admin/menu
 <br>
 crie novamente os menus Selcione para Tema o Admin<br>
 Para o menu principal deixe o campo Grupo vasio, para sub menu selecione o Grupo em que ele vai ficar
 
 atualizar as dependencias no arquivo dependencies.php<br>
 
 ```
 
 // Register component on container
 $container['view'] = function ($container) {
     return new \SIGA\Core\Views($container, sprintf("%s/Modules", __DIR__), [
         'route' => $container->get('router'),
         'form' => $container['form'],
         'menu' => $container['menu'],
         'access' => $container['acl'],//<-- adcione essa linha
         'utils' => $container['utils'],
         'formRow' => $container['formRow'],
         'auth' => $container->auth,
         'cache' => FALSE
             ]
     );
 };

 ```
 e na linha 34 do mesmo colar essa nova dependencia<br>
 
 ```
 $container['acl'] = function ($c){
 	$role = (new \SIGA\Auth\V1\Permission\Roles($c->get('adapter')))->roles();
 	$resources = (new \SIGA\Auth\V1\Permission\Resources($c->get('adapter')))->resources();
 	$privileges = (new \SIGA\Auth\V1\Permission\Privileges($c->get('adapter')))->privileges();
 	$Acl = new \SIGA\Core\Acl($role, $resources, $privileges);
 	$c['access']=$Acl;
 	return $c['access'];
 };
 
 ```
 execute o seguinte comando na pasta raiz do projeto <br>
 
 ```
 
 composer require zendframework/zend-permissions-acl
 
 ```