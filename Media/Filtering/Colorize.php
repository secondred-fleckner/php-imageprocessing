<?php
    
    namespace lib\Media\Filtering;
    
    class Colorize
        extends \lib\Media\Filtering\AbstractImageFilter
        implements \lib\Interfaces\InterfaceImageFilter
    {          
        
        /**
         * Colorize::__construct()
         * 
         * @param mixed $arrRGB     [0=rotwert, 1=gruenwert, 2=blauwert  -255 (no default)]
         * @return void
         */
        public function __construct($arrRGB)
        {       
            $this->filterName = 'Colorize';
            $this->args = $arrRGB; 
            
            $this->setColor($arrRGB[0],$arrRGB[1],$arrRGB[2]);       
        }
        
        public function setColor($red, $green, $blue)
        {
            $this->args[0] = intval($red);
            $this->args[1] = intval($green);
            $this->args[2] = intval($blue);
            
            foreach ($this->args as $k => $c)
            {
                if ($c < -255)
                    $this->args[$k] = -255;
                if ($c > 255)
                    $this->args[$k] = 255;
            }
        }
        
        public function applyFilter()
        {        
            imagefilter($this->canvas, IMG_FILTER_COLORIZE, $this->args[0], $this->args[1], $this->args[2]);
        }
    }