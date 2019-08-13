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

        foreach ($terms as $term){

            $term = explode(':',$term);

            if($term[0] == 'required')
                $this->required($value['title'], $value['value']);

            if($term[0] == 'maxLeng')
                $this->maxLeng($value['title'],$value['value'], $term[1]);

            if($term[0] == 'minLeng')
                $this->minLeng($value['title'],$value['value'], $term[1]);

        }

    }

    private function maxLeng($name,$value, $limit)
    {
        if(strlen(trim($value)) > $limit){
            self::setErrorMessage("O campo {$name} é maior q o permitido.");
            $this->valid = false;
        }
    }

    private function minLeng($name,$value, $limit)
    {
        if(strlen(trim($value)) < $limit){
            self::setErrorMessage("O campo {$name} é menor q o permitido.");
            $this->valid = false;
        }
    }

    private function required($name,$value)
    {

        if(trim($value) == ''){
            self::setErrorMessage("O campo {$name} deve ser preenchido.");
            $this->valid = false;
        }

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