<?php

    namespace lib\Media\Filtering;

    class Grayscale
        extends \lib\Media\Filtering\AbstractImageFilter
        implements \lib\Interfaces\InterfaceImageFilter
    {          
        
        /**
         * Grayscale::__construct()
         * 
         * @param mixed $args   (Keine Params)
         * @return void
         */
        public function __construct( $args = array() )
        {               
            $this->filterName = 'Grayscale';
            $this->args = $args;
        }
        
        public function applyFilter()
        {
            imagefilter($this->canvas, IMG_FILTER_GRAYSCALE);
        }
    }