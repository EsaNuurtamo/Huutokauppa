<?php

  class BaseModel{
    
    protected $validator;
    public $validations;
    public $admin;
    public function __construct($attributes = null){
        
        foreach($attributes as $attribute => $value){
            if(property_exists($this, $attribute)){
              $this->{$attribute} = $value;
            }
        
        }
        
    }
    
    
    public function validate($params){
        $validator=new Valitron\Validator($params);
        Kint::dump($this->validations);
        $validator->rules($this->validations);
        $this->validator=$validator;
        return $validator->validate();
    }
    
    public function errors(){
        return $this->validator->errors();
    }

    

  }
