<?php

    namespace lib\Media\Filtering;
    
    class BlurSimple
        extends \lib\Media\Filtering\Convolution
    {   
        protected $multiplikator;
        
        /**
         * BlurSimple::__construct()
         * 
         * @param mixed $args [0=multiplikator (default=1)]
         * @return void
         */
        public function __construct($args = array())
        {    
            $this->filterName = 'BlurSimple';
            $this->args = $args;
            
            $this->multiplikator = (is_array($args) && count($args) > 0 ? floatval($args[0]) : 1);
            $this->calculateMatrix();
        }
                
        public function apply($resImageResource)
        {        
            $this->computeDiv();
            for ($n=0;$n<$this->multiplikator;$n++)
            {
                $resImageResource = parent::apply($resImageResource);
            }
            return $resImageResource;
        }
        
        protected function calculateMatrix()
        {        
            $this->setMatrix(1.0);
        }
    }