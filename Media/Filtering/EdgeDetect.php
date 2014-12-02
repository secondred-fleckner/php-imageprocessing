<?php
    
    namespace lib\Media\Filtering;
    
    class EdgeDetect
        extends \lib\Media\Filtering\AbstractImageFilter
        implements \lib\interfaces\InterfaceImageFilter
    {          
        
        /**
         * EdgeDetect::__construct()
         * 
         * @param mixed $args (keine Parameter notwendig)
         * @return void
         */
        public function __construct($args = array())
        {           
            $this->filterName = 'EdgeDetect';
            $this->args = $args;
        }
        
        public function applyFilter()
        {        
            imagefilter($this->canvas, IMG_FILTER_EDGEDETECT);
        }
    }