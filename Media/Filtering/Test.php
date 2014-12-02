<?php

    namespace lib\Media\Filtering;
    
    class ImageFilterQueue
    {           
        protected $arrFilterQueue;    
        
        public function __construct()
        {       
            $this->arrFilterQueue = array();
        }
        
        public function apply($resImageResource)
        {                       
            if (is_resource($resImageResource)) {
                $this->canvas = $resImageResource;
            }
            else if (is_file($resImageResource) || strpos($resImageResource, 'http') !== false) {
                $this->canvas = imagecreatefromjpeg($resImageResource);
            }
            else
            {
                $this->canvas = imagecreatefromstring($resImageResource);    
            }
            
            foreach ($this->arrFilterQueue as $arrFilter)
            {
                
            }
                    
            imageconvolution($this->canvas, $this->matrix, $this->divisor, $this->offset);
            
            ob_start();
            imagejpeg($this->canvas, NULL, 100);        
            $contents = ob_get_contents();        
            ob_end_clean();
            
            return $contents;
        }
    }