<?php
namespace FormBuilder\View\Helper;

use Zend\Form\ElementInterface;
use Zend\View\Helper\AbstractHelper;

class FormBuilderRadio extends AbstractHelper
{
    public function __invoke(ElementInterface $element)
    {
        if (!$element) {
            return $this;
        }
        return $this->render($element);
    }

    public function render(ElementInterface $element)
    {
        $content = '';
        $class = substr(strrchr(get_parent_class($element), "\\"), 1);
        $elementType = $element->getAttribute('type');
        print 'FormBuilderRadio : ' . $element->getName() . ' : ' . $class . ' : ' . $elementType .  '<br>';
        print '<br><br>';
        return $content;
    }
}
