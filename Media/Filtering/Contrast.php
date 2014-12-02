<?php

    namespace lib\Media\Filtering;
    
    class Contrast
        extends \lib\Media\Filtering\AbstractImageFilter
        implements \lib\Interfaces\InterfaceImageFilter
    {          
        
        /**
         * Contrast::__construct()
         * 
         * @param mixed $args   [0=kontrastwert (default=1)]
         * @return void
         */
        public function __construct( $args = array() )
        {       
            $this->filterName = 'Contrast';
            $this->args = $args;
            
            $this->setContrast( (is_array($args) && count($args) > 0 ? floatval($args[0]) : 1.0) );                
        }
        
        public function setContrast($floatContrast=0.0)
        {
            $this->args = array(floatval($floatContrast));
        }
        
        public function getContrast()
        {
            $floatContrast = $this->args[0];
            if ($floatContrast < -1)
                $floatContrast = -1;
            if ($floatContrast > 1)
                $floatContrast = 1;
                
            return -round($floatContrast*255,0);   
        }
        
        public function applyFilter()
        {        
            imagefilter($this->canvas, IMG_FILTER_CONTRAST, $this->getContrast());
        }
    }