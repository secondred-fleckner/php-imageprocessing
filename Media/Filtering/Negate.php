<?php
    
    namespace lib\Media\Filtering;
    
    class Negate
        extends \lib\Media\Filtering\AbstractImageFilter
        implements \lib\Interfaces\InterfaceImageFilter
    {          
        
        /**
         * Negate::__construct()
         * 
         * @param mixed $args   (no Params)
         * @return void
         */
        public function __construct( $args = array() )
        {               
            $this->filterName = 'Negate';   
            $this->args = $args; 
        }
        
        public function applyFilter()
        {
            imagefilter($this->canvas, IMG_FILTER_NEGATE);
        }
    }