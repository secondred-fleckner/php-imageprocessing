<?php

    namespace lib\Media\Processing;
    
    class FaceCrop
        extends \lib\Media\Processing\AbstractImageTool
    {
        
        /**
         * FaceCrop::__construct()
         * 
         * @param mixed $args   (no Params)
         * @return void
         */
        public function __construct( $args = array() )  
        {
            $this->args = $args;
            $this->toolname = 'FaceCrop';    
        }
        
        public function applyCrop()
        {
            $objFaceDetector = new \lib\Media\Processing\FaceDetector();
            $objFaceDetector->face_detect($this->canvas);        
            $this->canvas = $objFaceDetector->getFaceImageSource(2.0, true);        
        } 
    }