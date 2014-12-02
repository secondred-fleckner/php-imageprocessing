<?php

    namespace lib\Media\Filtering;
    
    abstract class AbstractImageFilter
    {             
        protected $args = array();
        protected $canvas;  
        protected $filterName;  
            
        protected function getImageResource($resImageResource)
        {
            if (is_resource($resImageResource)) {
                $this->canvas = $resImageResource;
            }
            else if (is_file($resImageResource) || strpos($resImageResource, 'http') !== false) {
                $this->canvas = @imagecreatefromjpeg($resImageResource);
            }
            else
            {
                $this->canvas = @imagecreatefromstring($resImageResource);    
            }        
            return $this->canvas;
        }
        
        public function getName()
        {
            return ($this->filterName ? $this->filterName : 'Odd ImageFilter');
        }
    
        public function getArgs()
        {
            return $this -> args;
        }
           
        public function apply($resImageResource='')
        {
            if ($resImageResource || !$this->canvas)
                $this->getImageResource($resImageResource);
            
            $this->applyFilter();                              
            
            if ( IMAGE_PROCESSING_METHOD == 'string' )
            {
                ob_start();
                imagejpeg($this->canvas, NULL, 100);        
                $contents = ob_get_contents();        
                ob_end_clean();    
                
                imagedestroy($this->canvas);            
                return $contents;
            }
            else
            {
                return $this->canvas;    
            }
        }
    }