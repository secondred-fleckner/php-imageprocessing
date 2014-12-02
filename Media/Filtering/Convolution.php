<?php

    namespace lib\Media\Filtering;
    
    class Convolution
        extends \lib\Media\Filtering\AbstractImageFilter
        implements \lib\Interfaces\InterfaceImageFilter
    {
        protected $matrix;
        protected $divisor = 1;
        protected $offset = 0;  
        protected $canvas;  
        
        public function computeDiv() 
        {
            $this->divisor = array_sum ($this->matrix[0]) + array_sum ($this->matrix[1]) + array_sum ($this->matrix[2]);
        }
        
        public function applyFilter() {
            imageconvolution($this->canvas, $this->matrix, $this->divisor, $this->offset);        
        }
        
        public function setMatrix()
        {
            $matrix = func_get_args();
            if (count($matrix) == 9)
            {
                $this->matrix = array(  
                                        array($matrix[0], $matrix[1], $matrix[2]),
                                        array($matrix[3], $matrix[4], $matrix[5]),
                                        array($matrix[6], $matrix[7], $matrix[8])
                                     );                                 
            }
            else if (count($matrix) == 3)
            {
                $this->matrix = array(  
                                        array($matrix[2], $matrix[1], $matrix[2]),
                                        array($matrix[1], $matrix[0], $matrix[1]),
                                        array($matrix[2], $matrix[1], $matrix[2])
                                     );                                 
            }
            else if (count($matrix) == 2)
            {
                $this->matrix = array(  
                                        array($matrix[1], $matrix[1], $matrix[1]),
                                        array($matrix[1], $matrix[0], $matrix[1]),
                                        array($matrix[1], $matrix[1], $matrix[1])
                                     );                                 
            }
            else if (count($matrix) == 1)
            {
                $this->matrix = array(  
                                        array($matrix[0], $matrix[0], $matrix[0]),
                                        array($matrix[0], $matrix[0], $matrix[0]),
                                        array($matrix[0], $matrix[0], $matrix[0])
                                     );                                 
            }
            else
            {
                $this->matrix = array(  
                                        array(0,0,0),
                                        array(0,0,0),
                                        array(0,0,0)
                                     );                                 
            }
        }
    }