<?php
/*
 * Gamuza Itau ShopLine - Itau ShopLine for Magento platform.
 * Copyright (C) 2016 Gamuza Technologies (http://www.gamuza.com.br/)
 * Author: Eneias Ramos de Melo <eneias@gamuza.com.br>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Library General Public
 * License as published by the Free Software Foundation; either
 * version 2 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Library General Public License for more details.
 *
 * You should have received a copy of the GNU Library General Public
 * License along with this library; if not, write to the
 * Free Software Foundation, Inc., 51 Franklin St, Fifth Floor,
 * Boston, MA  02110-1301, USA.
 */

/*
 * See the AUTHORS file for a list of people on the Gamuza Team.
 * See the ChangeLog files for a list of changes.
 * These files are distributed with Gamuza_Itaushopline at https://github.com/gamuzabrasil/.
 */

class Varien_Data_Form_Element_Shoplinebutton
extends Varien_Data_Form_Element_Button
// extends Varien_Data_Form_Element_Abstract
{

public function __construct($attributes=array()) 
{
    parent::__construct($attributes);
    $this->setType('submit');
}

public function getLabelHtml($idSuffix = '')
{
    if (!is_null($this->getLabel())) {
        $html = '<label class="a-center" for="'.$this->getHtmlId() . $idSuffix . '">' . $this->_escape($this->getLabel())
              . ( $this->getRequired() ? ' <span class="required">*</span>' : '' ) . '</label>' . "<br/>";
    } else {
        $html = '';
    }
    return $html;
}

public function getElementHtml()
{
    $imageUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . 'gamuza/itaushopline/' . $this->getImage ();

    $html = '<button id="'.$this->getHtmlId().'" name="'.$this->getName()
        . ' value="'.$this->getEscapedValue().'" '.$this->serialize($this->getHtmlAttributes(array('type'=>'submit'))).'>'
        . ' <img src="' . $imageUrl . '" alt="' . $this->getLabel() . '" />'
        . ' </button>' . '<br/>';
    $html.= $this->getAfterElementHtml();

    return $html;
}

}

