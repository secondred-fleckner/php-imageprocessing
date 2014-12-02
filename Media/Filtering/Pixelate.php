<?php

    namespace lib\Media\Filtering;
    
    class Pixelate
        extends \lib\Media\Filtering\AbstractImageFilter
        implements \lib\Interfaces\InterfaceImageFilter
    {          
        
        /**
         * Pixelate::__construct()
         * 
         * @param mixed $args   (0=Pixelgröße (default=5), 1=AntializeOn (default=true) )
         * @return void
         */
        public function __construct( $args = array() )
        {   
            #$intPixelSize=5, $bAntiAliazed=true        
            $this->filterName = 'Pixelate';
            $this->args = $args;
            
            $this->setPixelSize( (is_array($args) && count($args) > 0 ? intval($args[0]) : 5) );     
            $this->setAntialiaze( (is_array($args) && count($args) > 1 && !$args[1] ? false : true) );
        }
        
        public function setPixelSize($intPixelSize=0.0)
        {
            $this->args[0] = intval($intPixelSize);
        }
        
        public function setAntialiaze($bAntiAliazed)
        {
            $this->args[1] = $bAntiAliazed;
        }
        
        public function getPixelSize()
        {
            return $this->args[0]; 
        }
        
        public function isAntialiazed()
        {
            return $this->args[1]; 
        }
        
        public function applyFilter()
        {        
            imagefilter($this->canvas, IMG_FILTER_PIXELATE, $this->getPixelSize(), $this->isAntialiazed());
        }
    }