<?php
namespace Table\View\Helper;
 
use Zend\View\Helper\AbstractHelper;

class StringToId extends AbstractHelper {

    public function __invoke($string) {
        $string = str_replace(" ", "-", mb_strtolower($string, 'UTF-8'));
        $string = str_replace(array('á', 'à', 'â', 'ã', 'ª', 'ä'), 'a', $string);
        $string = str_replace(array('Á', 'À', 'Â', 'Ã', 'Ä'), 'A', $string);
        $string = str_replace(array('Í', 'Ì', 'Î', 'Ï'), 'I', $string);
        $string = str_replace(array('í', 'ì', 'î', 'ï'), 'i', $string);
        $string = str_replace(array('é', 'è', 'ê', 'ë'), 'e', $string);
        $string = str_replace(array('É', 'È', 'Ê', 'Ë'), 'E', $string);
        $string = str_replace(array('ó', 'ò', 'ô', 'õ', 'ö', 'º'), 'o', $string);
        $string = str_replace(array('Ó', 'Ò', 'Ô', 'Õ', 'Ö'), 'O', $string);
        $string = str_replace(array('ú', 'ù', 'û', 'ü'), 'u', $string);
        $string = str_replace(array('Ú', 'Ù', 'Û', 'Ü'), 'U', $string);
        $string = str_replace(array('[', '^', '´', '`', '¨', '~', ']'), '', $string);
        $string = str_replace('ç', 'c', $string);
        $string = str_replace('Ç', 'C', $string);
        $string = str_replace('ñ', 'n', $string);
        $string = str_replace('Ñ', 'N', $string);
        $string = str_replace('Ý', 'Y', $string);
        $string = str_replace('ý', 'y', $string);
        return $string;
    }

}