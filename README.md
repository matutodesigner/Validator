# Validator
Uma class de validação simples e eficaz. feito para pequenos sistemas que precisem de uma validação simples e rápida.

####Iniciar a classe
Para iniciar a classe de validação adicione a seguinte linha

`
    $validate = new \Validator\Validator();
    `


####Validar Campos Input
A validação de input é bem simples de ser implementada.

    
     $name = 'Matuto';
     $validate->val('Nome', $name, 'required|minLeng:4|maxLeng:40');
 
     if(!$validate->isValid()){
        echo $validate->getErrorMessage();
     }else{
        echo 'informações válidas'
     }
         `

Segue a lista de termos que podem ser validados.
* required
* minLeng
* maxLeng
* email
* url