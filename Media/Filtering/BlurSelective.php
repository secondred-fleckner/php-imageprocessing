<?php

    namespace lib\Media\Filtering;
    
    class BlurSelective
        extends \lib\Media\Filtering\AbstractImageFilter
        implements \lib\Interfaces\InterfaceImageFilter
    {          
        
        /**
         * BlurSelective::__construct()
         * 
         * @param mixed $args (keine Parameter notwendig)
         * @return void
         */
        public function __construct($args = array())
        {            
            $this->filterName = 'BlurSelective';
            $this->args = $args;
        }
        
        public function applyFilter()
        {        
            imagefilter($this->canvas, IMG_FILTER_SELECTIVE_BLUR);
        }
    }