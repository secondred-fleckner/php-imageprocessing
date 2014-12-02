<?php

    namespace lib\Media\Filtering;
    
    class Sharpen
        extends \lib\Media\Filtering\Convolution
    {       
        protected $strength;
        
        
        /**
         * Sharpen::__construct()
         * 
         * @param mixed $args   [0=schaerfegrad (default=3)]
         * @return void
         */
        public function __construct( $args = array() )
        {    
            $this->filterName = 'Sharpen';
            $this->args = $args;
        
            $this->strength = (is_array($args) && count($args) > 0 ? floatval($args[0]) : 3.0);        
        }
        
        public function apply($resImageResource='')
        {
            $this->setMatrix(9+(9/$this->strength),-1+(1/$this->strength));
            $this->computeDiv();
            $resImageResource = parent::apply($resImageResource);
            
            $this->setMatrix(5+(5/$this->strength),-1+(1/$this->strength),0);
            $this->computeDiv();
            #$this->divisor = 8;
            return parent::apply($resImageResource);
        }
    }