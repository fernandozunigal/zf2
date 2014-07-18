<?php
namespace FormBuilder\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\Fieldset;
use Zend\View\Helper\AbstractHelper;

class FormBuilderSubTab extends AbstractHelper
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
        $elements = $element->getIterator();
        foreach ($elements as $elementOrFieldset) {
            $class = substr(strrchr(get_parent_class($elementOrFieldset), "\\"), 1);
            switch (true) {
                case ($elementOrFieldset instanceof Fieldset):
                    $content .= $this->getView()->FormCollection($elementOrFieldset);
                    break;
                case ($class == 'Element'):
                    $elementType = 'form' . $elementOrFieldset->getAttribute('type');
                    $content .= $this->getView()->$elementType($elementOrFieldset);
                    break;
                default:
                    $elementType = 'FormBuilder' . str_replace(' ', '', ucwords(str_replace('_', ' ', $elementOrFieldset->getAttribute('type'))));
                    $content .= $this->getView()->$elementType($elementOrFieldset);
                    break;
            }
        }
        print '<br><br>';
        return $content;
    }
}
