<?php

    namespace lib\Media\Filtering;
    
    class MeanRemoval
        extends \lib\Media\Filtering\AbstractImageFilter
        implements \lib\Interfaces\InterfaceImageFilter
    {          
        
        /**
         * MeanRemoval::__construct()
         * 
         * @param mixed $args   (no Params)
         * @return void
         */
        public function __construct( $args = array() )
        {       
            $this->filterName = 'MeanRemoval';     
            $this->args = $args; 
        }
        
        public function applyFilter()
        {        
            imagefilter($this->canvas, IMG_FILTER_MEAN_REMOVAL);
        }
    }