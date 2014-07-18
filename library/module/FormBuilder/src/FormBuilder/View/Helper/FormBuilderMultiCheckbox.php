<?php
namespace FormBuilder\View\Helper;

use Zend\Form\ElementInterface;
use Zend\View\Helper\AbstractHelper;

class FormBuilderMultiCheckbox extends AbstractHelper
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
        print 'FormBuilderMultiCheckbox : ' . $element->getName() . ' : ' . $class . ' : ' . $elementType .  '<br>';
        print '<br><br>';
        return $content;
    }
}
