<?php
class Kentec_Garagesale_Block_Adminhtml_Garagesale_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract{
     
    public function render(Varien_Object $row)
    {
        $html = '<img ';
        $html .= 'id="' . $this->getColumn()->getId() . '" ';
        $html .= 'src="/magento18/media/garagesale/' . $row->getData($this->getColumn()->getIndex()) . '"';
        $html .= 'width=50px height=50px ';
        $html .= 'class="grid-image ' . $this->getColumn()->getInlineCss() . '"/>';

        return $html;
    }
}