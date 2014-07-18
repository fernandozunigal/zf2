<?php
namespace FormBuilder\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\Fieldset;
use Zend\View\Helper\AbstractHelper;

class FormBuilderTab extends AbstractHelper
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
        $subTabs = '';
        $elementSubTabs = $element->getIterator();
        $subTabCounter = $this->subTabsCounter($elementSubTabs);
        $subTabs .= $this->subTabs($elementSubTabs);
        if($subTabCounter > 0) $subTabs .= '</ul>' . '<div class="tabs-content">';
        $subTabs .= $this->subTabsContent($elementSubTabs);
        if($subTabCounter > 0) $subTabs .= '</div>';
        $subTabs .= $this->defaultElements($elementSubTabs);
        if($subTabCounter > 0) $this->processSubTabs();
        return $subTabs;
    }
    
    public function subTabsCounter($elementSubTabs){
        $subTabCounter = 0;
        foreach ($elementSubTabs as $subTab) {
            if(substr(strrchr(get_parent_class($subTab), "\\"), 1) == 'SubTab') $subTabCounter++;
        }
        return $subTabCounter;
    }
    
    public function subTabs($elementSubTabs)
    {
        $subTabs = '';
        $subTabCounter = 0;
        foreach ($elementSubTabs as $subTab) {
            $label = $this->getView()->escapeHtml($this->getView()->translate($subTab->getLabel()));
            $id = $this->getView()->StringToId($subTab->getName());
            if(substr(strrchr(get_parent_class($subTab), "\\"), 1) == 'SubTab'){
                if($subTabCounter == 0){
                    $subTabs .= '<ul class="tabs js-tabs same-height">';
                    $classCurrent = ' class="current"';
                } else {
                    $classCurrent = '';
                }
                $subTabs .= '<li' . $classCurrent . '><a title="' . $label . '" href="javascript:void(0);" data-tab="' . $id . '">' . $label . '</a></li>';
                $subTabCounter++;
            }
        }
        return $subTabs;
    }
    
    public function subTabsContent($elementSubTabs)
    {
        $subTabsContent = '';
        $subTabCounter = 0;
        foreach ($elementSubTabs as $subTab) {
            if(substr(strrchr(get_parent_class($subTab), "\\"), 1) == 'SubTab'){
                $id = $this->getView()->StringToId($subTab->getName());
                $styleDisplay = ($subTabCounter == 0)?  ' display: block;' : ' display: none;';
                $subTabsContent .= '<div class="clearfix" id="' . $id . '" style="min-height: 30px;' . $styleDisplay . '">';
                switch (true) {
                    case ($subTab instanceof Fieldset):
                        $elementType = substr(strrchr(get_parent_class($subTab), "\\"), 1);
                        $elementHelper = 'FormBuilder' . $elementType;
                        $subTabsContent .= $this->getView()->$elementHelper($subTab);
                        break;
                    default:
                        $subTabsContent .= $this->getView()->formRow($subTab);
                        break;
                }
                $subTabsContent .= '</div>';
                $subTabCounter++;
            }
        }
        return $subTabsContent;
    }
    
    public function defaultElements($elementSubTabs)
    {
        $elements = '';
        foreach ($elementSubTabs as $elementDefault) {
            if(substr(strrchr(get_parent_class($elementDefault), "\\"), 1) != 'SubTab'){
                switch (true) {
                    case ($elementDefault instanceof Fieldset):
                        $elements .= $this->getView()->formCollection($elementDefault);
                        break;
                    default:
                        $elements .= $this->getView()->formRow($elementDefault);
                        break;
                }
            }
        }
        return $elements;
    }
    
    public function processSubTabs()
    {
        $script =  "$(document).ready(function(){" . PHP_EOL;
        $script .= "$('.tabs').on('click', 'a', function(event){" . PHP_EOL;
        $script .= "$('.tabs-content > div').css('display', 'none');" . PHP_EOL;
        $script .= "$('.tabs-content > div#' + $(event.currentTarget).data('tab')).css('display', 'block');" . PHP_EOL;
        $script .= "$('.tabs > li').removeClass('current');" . PHP_EOL;
        $script .= "$(event.currentTarget).parent().addClass('current');" . PHP_EOL;
        $script .= "});" . PHP_EOL;
        $script .= "});" . PHP_EOL;
        $this->getView()->inlineScript()->appendScript($script, 'text/javascript', array('noescape' => true));
        return;
    }
}
