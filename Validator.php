<?php


namespace Validator;


class Validator
{

    private $values = array();
    private $valid = true;
    private $errorMessage;

    /**
     * @param string $title
     * @param string $value
     * @param string $terms exemple: requerid|maxLeng:20|minLeng:6
     */
    public function val($title, $value, $terms)
    {

        self::setValues([
            'title' => $title,
            'value' => $value,
            'terms' => $terms
        ]);

    }

    /**
     * @return bool
     */
    public function isValid()
    {
        self::validate();
        return $this->valid;

    }

    private function validate()
    {

        if(count($this->values) == 0)
            return false;

        foreach($this->values as $value){

            self::termsValidate($value);

        }

    }

    /**
     * @param array $value
     */
    private function termsValidate($value)
    {

        $terms = explode('|',$value['terms']);

        foreach ($terms as $term):

            $term = explode(':',$term);

            switch (trim($term[0])){

                case 'required':
                    $this->required($value['title'], $value['value']);
                    break;
                case 'maxLeng':
                    $this->maxLeng($value['title'],$value['value'], $term[1]);
                    break;
                case 'minLeng':
                    $this->minLeng($value['title'],$value['value'], $term[1]);
                    break;
                case 'email':
                    $this->email($value['value']);
                    break;
                case 'url':
                    $this->url($value['value']);
                    break;
            }


        endforeach;

    }

    private function email($email)
    {
        $check = filter_var($email, FILTER_VALIDATE_EMAIL);

        if(!$check){
            self::invalid("E-mail inválido!");
        }

    }

    private function url($email)
    {
        $check = filter_var($email, FILTER_VALIDATE_URL);

        if(!$check){
            self::invalid("URL inválida!");
        }

    }

    private function maxLeng($name,$value, $limit)
    {
        if(strlen(trim($value)) > $limit){
            self::invalid("O campo {$name} deve ser preenchido.");
        }
    }

    private function minLeng($name,$value, $limit)
    {
        if(strlen(trim($value)) < $limit){
            self::invalid("O campo {$name} deve ser preenchido.");
        }
    }

    private function required($name,$value)
    {

        if(trim($value) == ''){
            self::invalid("O campo {$name} deve ser preenchido.");
        }

    }

    /**
     * @param $msg
     */
    private function invalid($msg){
        self::setErrorMessage($msg);
        $this->valid = false;
    }

    /**
     * @param mixed $values
     */
    private function setValues($values)
    {
        $this->values[] = $values;
    }

    /**
     * @param mixed $error
     */
    private function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }


}