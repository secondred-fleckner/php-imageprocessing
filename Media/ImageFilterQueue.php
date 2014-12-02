<?php

    namespace lib\Media;
    
    class ImageFilterQueue
        extends \lib\Media\Filtering\AbstractImageFilter
    {              
        protected $arrQueue;    
        
        const BLENDINGMODE_NORMAL       = 0;
        const BLENDINGMODE_DARKEN       = 1;
        const BLENDINGMODE_MULTIPLY     = 2;
        const BLENDINGMODE_COLORBURN    = 3;
        const BLENDINGMODE_LINIARBURN   = 4;
        const BLENDINGMODE_LIGHTEN      = 5;
        const BLENDINGMODE_SCREEN       = 6;
        const BLENDINGMODE_COLORDODGE   = 7;
        const BLENDINGMODE_LINEARDODGE  = 8;
        const BLENDINGMODE_OVERLAY      = 9;
        const BLENDINGMODE_SOFTLIGHT    = 10;
        const BLENDINGMODE_HARDLIGTHT   = 11;
        const BLENDINGMODE_VIVIDLIGHT   = 12;
        const BLENDINGMODE_LINEARLIGHT  = 13;
        const BLENDINGMODE_PINLIGHT     = 14;
        const BLENDINGMODE_DIFFERENCE   = 15;
        const BLENDINGMODE_EXCLUSION    = 16;
        const BLENDINGMODE_HUE          = 17;
        const BLENDINGMODE_SATURATION   = 18;
        const BLENDINGMODE_COLOR        = 19;
        const BLENDINGMODE_LUMINOSITY   = 19;
        ##### http://www.northlite.net/ps/blend.htm
            
        public function __construct($resImageResource='')
        {   
            if ($resImageResource)
                $this->getImageResource($resImageResource);
                
            $this->arrQueue = array();
            $this->setupFilters();   
        }
        
        public function addFilter(\lib\Interfaces\InterfaceImageFilter $objFilter)
        {
            array_push($this->arrQueue, $objFilter);
        }
        
        public function addBlending($resImageResource, $strBlendingMode = \lib\Media\ImageFilterQueue::BLENDINGMODE_NORMAL, $floatOpacity=0.5)
        {
            // TODO: hier kann man eine BildResource hinzufügen und den Blending Mode spezifizieren, sowei die opacity
            switch ($strBlendingMode)
            {
                case \lib\Media\ImageFilterQueue::BLENDINGMODE_NORMAL:
                default:                
                    break;
                
            }
        }
        
        protected function setupFilters() {
            $this->arrQueue = array();
        }
        
        protected function applyFilter()    
        {        
            // läuft die queue durch
            foreach ($this->arrQueue as $objFilter)
            {
                $this->getImageResource( $objFilter->apply($this->canvas) );
            }
        }
    }