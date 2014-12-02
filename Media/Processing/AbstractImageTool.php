<?php

    namespace lib\Media\Processing;
    
    abstract class AbstractImageTool
        implements \lib\Interfaces\InterfaceImageTool
    {
        protected $args = array();
        protected $canvas;    
        protected $toolname;
        
        // ausnahmeregelung: fuer die dynamische erzeugung ist ein konstruktor mit nur einem Paramarray als Parameter guenstig, daher sollte stets beides angeboten werden:
        abstract public function __construct($arrParams);
            
        protected function getImageResource($resImageResource)
        {
            if (is_resource($resImageResource)) {
                $this->canvas = $resImageResource;
            }
            else if (is_file($resImageResource) || strpos($resImageResource, 'http') === 0) {
                $this->canvas = @imagecreatefromjpeg($resImageResource);
            }
            else
            {            
                $this->canvas = @imagecreatefromstring($resImageResource);    
            }
        }
        
        public function getName()
        {
            return ($this->toolname ? $this->toolname : 'Odd ImageTool');
        }
    
        public function getArgs()
        {
            return $this -> args;
        }
           
        public function apply($resImageResource='')
        {
            if ($resImageResource || !$this->canvas)
                $this->getImageResource($resImageResource);
            
            $this->applyCrop();                              
            
            if ( IMAGE_PROCESSING_METHOD == 'string')
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