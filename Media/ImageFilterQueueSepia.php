<?php

    namespace lib\Media;
    
    class ImageFilterQueueSepia
        extends \lib\Media\ImageFilterQueue
    {       
        public function setupFilters()
        {               
            $this->addFilter(new \lib\Media\Filtering\Sharpen());  
            $this->addFilter(new \lib\Media\Filtering\Contrast(array(0.075)));              
            $this->addFilter(new \lib\Media\Filtering\Grayscale());        
            $this->addFilter(new \lib\Media\Filtering\Colorize(array(40, 20, -10)));        
        }
    }