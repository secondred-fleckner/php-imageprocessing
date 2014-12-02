<?php
    
    namespace lib\Media\Processing;
    
    class BestFit
        extends \lib\Media\Processing\AbstractImageTool
    {
        protected $width;
        protected $height;
        
        protected $boolFill;
        protected $arrFillColor;
        
        /**
         * BestFit::__construct()
         * skaliert das Bild so, dass es in eine gewuenschte Groesse passt. Es behaelt dabei seine urspruengliche Propertionen bei
         * gibt man eine Fuellfarbe im 2. Parameter als 3 oder 4-Felder array an, wird die gewuenschte groesse ausgespuckt mit entsprechend zentrierten bild und der spezifizierten Hintergrundfarbe
         * @param array $arrSize        [0=width (default=100), 1=height (default=100), 2=red, 3=green, 4=blue, 5=alpha] maximale groesse des Bildes
         *                              Alternativ koennen hier auch die Farbwerte hinten angehangen werden
         * @param array $arrFillColor   default=null, [0=rot(0-255), 1=gruen(0-255), 2=blau(0-255), 3=opacity(0.0-1.0)]
         * 
         * @return void
         */
        public function __construct($arrSize = array(100,100), $arrFillColor = null)
        {        
            $this->toolname = 'BestFit';
            
            $this->width            = intval($arrSize[0]);
            $this->height           = intval($arrSize[1]);
            
            // ausnahmeregelung: fuer die dynamische erzeugung ist ein konstruktor mit nur einem Paramarray als Parameter guenstig, daher sollte stets beides angeboten werden:
            if (count($arrSize) >= 5 && !is_array($arrFillColor)) 
            {
                $arrFillColor = array(intval($arrSize[2]), intval($arrSize[3]), intval($arrSize[4]));
                if (count($arrSize) > 5)
                {
                    $arrFillColor[3] = floatval($arrSize[5]);
                }
            }
            
            $this->boolFill         = (is_array($arrFillColor) && count($arrFillColor) >= 3);        
            $this->arrFillColor     = $arrFillColor; 
            
            if ($this->boolFill)
                $this->args = array_merge($arrSize, $arrFillColor);
            else
                $this->args = $arrSize;       
        }
        
        public function applyCrop()
        {
            $origin_w = imagesx($this->canvas);
            $origin_h = imagesy($this->canvas);
            $origin_ratio = $origin_w / $origin_h;
            
            $offset_x = 0;
            $offset_y = 0;
                            
            $ratio = $this->width / $this->height;
            $scale = 1;
            
            if ($origin_ratio < $ratio )
            {   // hochformatig
                $this->width = $this->height * $origin_ratio;
                
            }
            else
            {   // querformatig
                $this->height = $this->width / $origin_ratio;
            }
               
            if ($this->boolFill)
            {
                if ($ratio > $origin_ratio)
                {   // original ist zu breit, vertical verschieben
                    $offset_y = round(($this->args[1] - $this->height) / 2, 0);
                }
                else
                {   // original ist zu hoch, horizontal verschieben
                    $offset_x = round(($this->args[0] - $this->width) / 2, 0);            
                }                        
                $im = imagecreatetruecolor($this->args[0], $this->args[1]);
                
                if (count($this->arrFillColor) == 4)
                {
                    $resFillColor = imagecolorallocate($im, intval($this->arrFillColor[0]), intval($this->arrFillColor[1]), intval($this->arrFillColor[2]) );
                    imagefill($im, 0, 0, $resFillColor);
                }
                else
                {
                    $resFillColor = imagecolorallocatealpha($im, intval($this->arrFillColor[0]), intval($this->arrFillColor[1]), intval($this->arrFillColor[2]), (127 - floatval($this->arrFillColor[3])*127) );
                    imagefill($im, 0, 0, $resFillColor);
                    imagesavealpha($im, true);
                    imagealphablending($im, true);                    
                }                
            }
            else
            {
                $im = imagecreatetruecolor($this->width, $this->height);
            }   
                 
            // Kommt irgendwie mist bei raus (in seltenen Faellen):
             imagecopyresampled($im, $this->canvas, $offset_x, $offset_y, 0, 0, $this->width, $this->height, $origin_w, $origin_h);
            #  imagecopyresized($im, $this->canvas, $offset_x, $offset_y, 0, 0, $this->width, $this->height, $origin_w, $origin_h);
                                    
            $this->canvas = $im;   
        } 
    }