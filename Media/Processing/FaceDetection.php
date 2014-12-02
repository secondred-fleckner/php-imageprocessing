<?php

    namespace lib\Media\Processing;
    
    class FaceDetection
    {
        public static function apply($resImageResource)
        {
            $objFaceDetector = new \lib\Media\Processing\FaceDetector();
            $objFaceDetector->face_detect($resImageResource);
            
            return $objFaceDetector->getFace();        
        } 
    }