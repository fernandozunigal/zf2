<?php
namespace FormBuilder\View\Helper;
 
use Zend\Form\View\Helper\AbstractHelper;
use Zend\Form\Fieldset;
use Zend\Form\FormInterface;

class FormBuilder extends AbstractHelper
{
    protected $validTagAttributes = array(
        'accept-charset' => true,
        'action'         => true,
        'autocomplete'   => true,
        'enctype'        => true,
        'method'         => true,
        'name'           => true,
        'novalidate'     => true,
        'target'         => true,
    );

    public function __invoke(FormInterface $form = null)
    {
        if (!$form) {
            return $this;
        }

        return $this->render($form);
    }

    public function render(FormInterface $form)
    {
        if (method_exists($form, 'prepare')) {
            $form->prepare();
        }

        $formContent = '<div class="formContent clearfix">';

        foreach ($form as $element) {
            switch (true) {
                case ($element instanceof Fieldset):
                    $elementType = substr(strrchr(get_parent_class($element), "\\"), 1);
                    $elementHelper = 'FormBuilder' . $elementType;
                    if($elementType != 'ButtonsGroup'){
                        $formContent .= $this->getView()->$elementHelper($element);
                    }
                    break;
                default:
                    $formContent .= $this->getView()->formRow($element);
                    break;
            }
        }
        
        $formContent .= '</div>';
        
        return $this->openTag($form) . $formContent . $this->closeTag($form);
    }

    public function openTag(FormInterface $form = null)
    {
        $attributes = array(
            'action' => '',
            'method' => 'get',
        );

        if ($form instanceof FormInterface) {
            $formAttributes = $form->getAttributes();
            if (!array_key_exists('id', $formAttributes) && array_key_exists('name', $formAttributes)) {
                $formAttributes['id'] = $formAttributes['name'];
            }
            $attributes = array_merge($attributes, $formAttributes);
        }

        $tag = sprintf('<form %s>', $this->createAttributesString($attributes));
        
        $formHeader = $tag . $this->title($form) . $this->buttons($form, 'top') . $this->messages('Warning Message', 'warning');
        
        return $formHeader;
    }

    public function closeTag(FormInterface $form = null)
    {
        $closeTag = '</form>';
        $formFooter = $this->buttons($form, 'bottom') . $closeTag;
        return $formFooter;
    }
    
    private function title(FormInterface $form = null){
        if ($form instanceof FormInterface) {
            if($form->getLabel() != '' || $form->getLabel() !== null){
                $title = $this->getView()->escapeHtml($this->getView()->translate($form->getLabel()));
            } else {
                $title = $this->getView()->escapeHtml($this->getView()->translate('Form Title'));
            }
        } else {
            $title = $this->getView()->escapeHtml($this->getView()->translate('Form Title'));
        }
        return '<h1>' . $title . '</h1>';
    }
    
    private function buttons(FormInterface $form, $position){
        foreach ($form as $element) {
            if(substr(strrchr(get_parent_class($element), "\\"), 1) == 'ButtonsGroup'){
                return $this->getView()->FormBuilderButtonsGroup($element, $position);
                break;
            }
        }
    }
    
    private function messages($message, $messageType){
        $messages =  '<ul class="message ' . $messageType . ' no-margin">';
        $messages .= '<li>' . $this->getView()->escapeHtml($this->getView()->translate($message)) . '</li>';
        $messages .= '<li class="close-bt"></li>';
        $messages .= '</ul>';
        return $messages;
    }
}