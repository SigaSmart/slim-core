Core do sistema siga com slim framework


criando uma modal

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
``
 $this->get("/modal", sprintf("%s:modal", Controllers\AdminController::class))->setName('modal');
 ``
 
No controller crie uma rota
