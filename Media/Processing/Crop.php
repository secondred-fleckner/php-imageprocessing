<?php

    namespace lib\Media\Processing;

    class Crop
        extends \lib\Media\Processing\AbstractImageTool
    {
        protected $width;
        protected $height;
        protected $x;
        protected $y;
        
        /**
         * Crop::__construct()
         * schneidet hart einen Bereich aus einem Bild heraus (ClipCrop)
         * @param mixed $arrClip    [0=x1,1=y1,2=x2,3=y2]
         * @return void
         */
        public function __construct($args = array(0,0,0,0))
        {
            $this->args = $args;
            $this->toolname = 'Crop';
            
            $this->setClip(array(array($args[0],$args[1]),array($args[2],$args[3])));
        }
        
        public function setClip($arrClip)
        {
            $this->x = min(array(intval($arrClip[0][0]), intval($arrClip[1][0])));
            $this->y = min(array(intval($arrClip[0][1]), intval($arrClip[1][1])));
            
            $this->width = abs($arrClip[0][0] - $arrClip[1][0]);
            $this->height = abs($arrClip[0][1] - $arrClip[1][1]);
        }
        
        public function applyCrop()
        {        
            $im = imagecreatetruecolor($this->width, $this->height);        
            imagecopyresampled($im, $this->canvas, 0, 0, $this->x, $this->y, $this->width, $this->height, $this->width, $this->height);
            $this->canvas = $im;   
        } 
    }