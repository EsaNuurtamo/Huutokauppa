<?php
class Tarjous extends BaseModel{
    public $id,$maara,$aika,$tuote,$asiakas;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
}

