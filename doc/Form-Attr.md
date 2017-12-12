Attributes em tempo de execução<br>
para alterar um attribute d um campo<br>
```
  <?= $this->partials('form/input', ['field' => $form->get('email')->setAttribute('readonly',true)]) ?>
                      
```
ou
```
<?= $this->partials('form/input', ['field' => $form->get('email')->setAttributes(['readonly'=>true])]) ?>
  ```