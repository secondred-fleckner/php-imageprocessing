<?php
    
    namespace lib\Media\Filtering;
    
    class Smooth
        extends \lib\Media\Filtering\AbstractImageFilter
        implements \lib\Interfaces\InterfaceImageFilter
    {          
        
        /**
         * Smooth::__construct()
         * 
         * @param mixed $args   [0=smoothness (default=1)]
         * @return void
         */
        public function __construct( $args = array() )
        {       
            $this->filterName = 'Smooth';
            $this->args = $args;
            
            $this->setSmoothiness((is_array($args) && count($args) > 0 ? floatval($args[0]) : 1.0));                
        }
        
        public function setSmoothiness($floatSmoothiness=0.0)
        {
            $this->args = array(floatval($floatSmoothiness));
        }
        
        public function getSmoothiness()
        {
            $floatSmoothiness = $this->args[0];
            if ($floatSmoothiness < -1)
                $floatSmoothiness = -1;
            if ($floatSmoothiness > 1)
                $floatSmoothiness = 1;
                
            return round($floatSmoothiness*8,0);   
        }
        
        public function applyFilter()
        {        
            imagefilter($this->canvas, IMG_FILTER_SMOOTH, $this->getSmoothiness());
        }
    }