Core do sistema siga com slim framework


criando uma modal
Função java script
```
var $btn_modal_ajax = $(".btn-moldal-ajax");
     $btn_modal_ajax.click(function (evt) {
        var $this = $(this);
        $.ajax({
            url: $this.attr('href'),
            //data: $('form[name="ajaxForm"]').serialize(),
            success: function (data) {
                $(data).modal({
                    backdrop:false
                }).on('shown.bs.modal', function (e) {
                       
                }).on('hidden.bs.modal', function (e) {
                   
                   //remove a modal quando fecha o modal
                    e.target.remove();
                });

            }
        })
        return false;
    });
```
No arquivo Route criar uma rota 
```
 $this->get("/modal", sprintf("%s:modal", Controllers\AdminController::class))->setName('modal');
 ```
 
No controller crie uma rota

```
public function modal(Resq $request, Resp $response , $arsg=[])
	{
         $this->view->setTerminal(false);
         return $this->view->render($response, sprintf("%s/%s/modal", $this->TemplatePath, $this->template), [
                'data' => ""
        ]);
	}
```

Criar a views modal
```
<div class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-body">  
          
                  Exemplo Modal
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Adicionar produto</button>
            </div>
           
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

```
Botão para abrir a modal
```
 <a href="<?= $this->route->pathFor('modal'); ?>" class="btn btn-danger btn-block btn-flat btn-moldal-ajax"><i class="fa fa-reply-all"></i> Modal</a>
  
```
