<?php
namespace FormBuilder\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\Fieldset;
use Zend\View\Helper\AbstractHelper;

class FormBuilderTabsGroup extends AbstractHelper
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
        $tabs =  '<div class="col200pxL-left">';
        $tabs .= '<ul class="side-tabs js-tabs same-height">';
        $elementTabs = $element->getIterator();
        $tabs .= $this->tabs($elementTabs);
        $tabs .= '</ul>';
        $tabs .= '</div>';
        $tabs .= '<div class="col200pxL-right">';
        $tabs .= $this->tabsContent($elementTabs);
        $tabs .= '</div>';
        $this->processTabs();
        return $tabs;
    }
    
    public function tabs($elementTabs)
    {
        $tabs = '';
        $elementCounter = 0;
        foreach ($elementTabs as $tab) {
            $label = $this->getView()->escapeHtml($this->getView()->translate($tab->getLabel()));
            $id = $this->getView()->StringToId($tab->getName());
            ($elementCounter == 0)? $classCurrent = ' class="current"' : $classCurrent = '';
            $tabs .= '<li' . $classCurrent . '><a title="' . $label . '" href="javascript:void(0);" data-sidetab="tab-' . $id . '">' . $label . '</a></li>';
            $elementCounter++;
        }
        return $tabs;
    }
    
    public function tabsContent($elementTabs)
    {
        $tabsContent = '';
        $elementCounter = 0;
        foreach ($elementTabs as $tab) {
            $id = $this->getView()->StringToId($tab->getName());
            $classCurrent = ($elementCounter == 0)?  '' : ' no-display';
            $tabsContent .= '<div class="side-tabs-content' . $classCurrent . '" id="tab-' . $id . '" style="min-height: 100px;">';
            switch (true) {
                case ($tab instanceof Fieldset):
                    $elementType = substr(strrchr(get_parent_class($tab), "\\"), 1);
                    $elementHelper = 'FormBuilder' . $elementType;
                    $tabsContent .= $this->getView()->$elementHelper($tab);
                    break;
                default:
                    $tabsContent .= $this->getView()->formRow($tab);
                    break;
            }
            $tabsContent .= '</div>';
            $elementCounter++;
        }
        return $tabsContent;
    }
    
    public function processTabs()
    {
        $script =  "$(document).ready(function(){" . PHP_EOL;
        $script .= "$('.side-tabs').on('click', 'a', function(event){" . PHP_EOL;
        $script .= "$('.side-tabs-content').css('display', 'none');" . PHP_EOL;
        $script .= "$('.side-tabs-content#' + $(event.currentTarget).data('sidetab')).css('display', 'block');" . PHP_EOL;
        $script .= "$('.side-tabs > li').removeClass('current');" . PHP_EOL;
        $script .= "$(event.currentTarget).parent().addClass('current');" . PHP_EOL;
        $script .= "});" . PHP_EOL;
        $script .= "});" . PHP_EOL;
        $this->getView()->inlineScript()->appendScript($script, 'text/javascript', array('noescape' => true));
        return;
    }
}
