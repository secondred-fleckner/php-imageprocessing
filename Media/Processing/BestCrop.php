<?php
    
    namespace lib\Media\Processing;
    
    class BestCrop
        extends \lib\Media\Processing\AbstractImageTool
    {
        protected $width;
        protected $height;
        
        /**
         * BestCrop::__construct()
         * Schneidet ein Stueck aus dem Bild aus, welches zentral positioniert ist und die maximalst moegliche groesse hat
         * @param mixed $arrSize    [0=width (default=100), 1=height (default=100)]
         * @return void
         */
        public function __construct($arrSize = array(100,100))
        {
            $this->args = $arrSize;
            $this->toolname = 'BestCrop';
            
            $this->width = intval($arrSize[0]);
            $this->height = intval($arrSize[1]);        
        }
        
        public function applyCrop()
        {
            $origin_w = imagesx($this->canvas);
            $origin_h = imagesy($this->canvas);
            $origin_ratio = $origin_w / $origin_h;
            
            $offset_x = 0;
            $offset_y = 0;
            
            if ($this->width > 0 && (!$this->height || $this->height <= 0))
            {   // falls nur breite angegeben ist (hoehe wird anhand der ausgangsration berechnet)
                $this->height = $this->width / $origin_ratio; 
            }
            else if ($this->height > 0 && (!$this->width || $this->width <= 0))
            {   // falls nur hohe angegeben ist (breite wird an hand der ausgangsratio berechnet)
                $this->width = $this->height * $origin_ratio;
            }
            
            $ratio = $this->width / $this->height;
            $scale = 1;
            
            if ($ratio < $origin_ratio)
            {   // original ist zu breit, hoehe angleichen > horizontal verschieben
                $scale = $origin_h / $this->height;
                $offset_x = round(($origin_w - $this->width*$scale) / 2, 0); 
            }
            else
            {   // original ist zu hoch, breite angleichen > horizontal verschieben
                $scale = $origin_w / $this->width;
                $offset_y = round(($origin_h - $this->height*$scale) / 2, 0);
            }
            
            $im = imagecreatetruecolor($this->width, $this->height);        
            imagecopyresampled($im, $this->canvas, 0, 0, $offset_x, $offset_y, $this->width, $this->height, $this->width*$scale, $this->height*$scale);
            
            
            $this->canvas = $im;   
        } 
    }