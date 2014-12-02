<?php

    namespace lib\Media\Filtering;
    
    class Emboss
        extends \lib\Media\Filtering\Convolution
    {           
        /**
         * Emboss::__construct()
         * 
         * @param mixed $args   (Keine Params)
         * @return void
         */
        public function __construct($args = array())
        {
            $this->filterName = 'Emboss';
            $this->args = $args;
        }
        
        public function apply($resImageResource='')
        {                       
            $this->matrix[0] = array(1,1,-1);
            $this->matrix[1] = array(1,3,-1);
            $this->matrix[2] = array(1,-1,-1);
                    
            #$this->offset = 127;
            $this->computeDiv();
            return parent::apply($resImageResource);
        }
    }