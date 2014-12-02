<?php

    namespace lib\Media\Filtering;
    
    class Brightness
        extends \lib\Media\Filtering\AbstractImageFilter
        implements \lib\Interfaces\InterfaceImageFilter
    {          
        
        /**
         * Brightness::__construct()
         * 
         * @param mixed $args   [0=Helligkeit default= 1.0]
         * @return void
         */
        public function __construct($args = array())
        {       
            $this->filterName = 'Brightness';
            $this->args = $args;
            
            $this->setBrightness( (is_array($args) && count($args) > 0 ? floatval($args[0]) : 1.0) );               
        }
        
        public function setBrightness($floatBrightness=0.0)
        {
            $this->args = array(floatval($floatBrightness));
        }
        
        public function darker() {
            $this->args[0] -= 0.1; 
        }
        public function brighter() {
            $this->args[0] += 0.1; 
        }
        
        public function getBrightness()
        {
            $floatBrightness = $this->args[0];
            if ($floatBrightness < -1)
                $floatBrightness = -1;
            if ($floatBrightness > 1)
                $floatBrightness = 1;
                
            return round($floatBrightness*255,0);   
        }
        
        public function applyFilter()
        {        
            imagefilter($this->canvas, IMG_FILTER_BRIGHTNESS, $this->getBrightness());
        }
    }