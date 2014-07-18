<?php
namespace FormBuilder\View\Helper;

use Zend\Form\ElementInterface;
use Zend\View\Helper\AbstractHelper;

class FormBuilderButtonsGroup extends AbstractHelper
{
    public function __invoke(ElementInterface $element, $position)
    {
        if (!$element) {
            return $this;
        }

        return $this->render($element, $position);
    }

    public function render(ElementInterface $element, $position)
    {
        $buttonsGroup = '<div class="block-controls ' . $position . '">';
        foreach ($element->getIterator() as $button) {
            if ($button instanceof ElementInterface) {
                switch ($button->getAttribute('type')) {
                    case 'submit':
                        $buttonsGroup .= $this->getView()->formSubmit($button);
                        break;
                    default:
                        $elementAttributes = $button->getAttributes();
                        if(isset($elementAttributes['subType']) && strtolower($elementAttributes['subType']) == 'reset'){
                            $buttonsGroup .= $this->getView()->formReset($button);
                        } else {
                            $buttonsGroup .= $this->getView()->formButton($button);
                        }
                        break;
                }
            }
            $buttonsGroup .= PHP_EOL;
        }
        $buttonsGroup .= '</div>';
        return $buttonsGroup;
    }
}
