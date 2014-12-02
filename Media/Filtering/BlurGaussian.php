<?php

    namespace lib\Media\Filtering;
    
    class BlurGaussian
        extends \lib\Media\Filtering\Convolution
    {    
        //protected $sigma;
        protected $multiplikator;
        
        
        /**
         * BlurGaussian::__construct()
         * 
         * @param mixed $args   [0=multiplikator (default:1)]
         * @return void
         */
        public function __construct($args = array())
        {
            $this->filterName = 'BlurGaussian';
            $this->args = $args;
                    
            //$this->setSigma($sigma);
            $this->multiplikator = (is_array($args) && count($args) > 0 ? floatval($args[0]) : 1);
            $this->calculateMatrix();
        }
        
        /*public function setSigma($floatSigma)
        {
            $this->sigma = $floatSigma;        
        }*/
        
        public function apply($resImageResource='')
        {        
            $this->computeDiv();
            for ($n=0;$n<$this->multiplikator;$n++)
            {
                $resImageResource = parent::apply($resImageResource);
            }
            return $resImageResource;
        }
        
        protected function calculateMatrix()
        {
            /*for ($x=0; $x<3; $x++)
            {
                for ($y=0; $y<3; $y++)
                {
                    $this->matrix[$y][$x] = (1 / (2*M_PI*pow($this->sigma,2))) * exp(-( (pow($x,2)+pow($y,2)) / (2*pow($this->sigma,2)) ));
                }
            } */
            
            $this->setMatrix(4.0,2.0,1.0);
        }
    }