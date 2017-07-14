<?php
/*
 * Gamuza Itau ShopLine - Itau ShopLine for Magento platform.
 * Copyright (C) 2013 Gamuza Technologies (http://www.gamuza.com.br/)
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
 * These files are distributed with Gamuza_Itaushopline at http://code.google.com/p/gamuzaopen/.
 */

class Gamuza_Itaushopline_Block_Standard_Info
extends Mage_Payment_Block_Info
{
    protected function _construct ()
    {
       $this->setTemplate ('gamuza/itaushopline/standard/info.phtml');
    }

    public function getCcTypeName()
    {
        $types = Mage::getSingleton('itaushopline/config')->getCcTypes();
        $ccType = $this->getInfo()->getCcType();
        if (isset($types[$ccType])) {
            return $types[$ccType];
        }
        return (empty($ccType)) ? Mage::helper('itaushopline')->__('N/A') : $ccType;
    }

    protected function _prepareSpecificInformation($transport = null)
    {
        if (null !== $this->_paymentSpecificInformation) {
            return $this->_paymentSpecificInformation;
        }
        $transport = parent::_prepareSpecificInformation($transport);
        $data = array();
        if ($ccType = $this->getCcTypeName()) {
            $data[Mage::helper('itaushopline')->__('Type')] = Mage::helper ('itaushopline')->__($ccType);
        }
        return $transport->setData(array_merge($data, $transport->getData()));
    }

    public function getOrder()
    {
        return Mage::registry('current_order');
    }
    
    public function getInvoice()
    {
        return Mage::registry('current_invoice');
    }

    public function getShipment()
    {
        return Mage::registry('current_shipment');
    }

    protected function _getStoreConfig ($field)
    {
		return Mage::getStoreConfig ("payment/itaushopline_settings/{$field}");
    }
    
    public function getSubmitTransactionInformation ()
    {
		$order = $this->getOrder();
		if (!empty ($order)) $order_id = $order->getId ();
		else $order_id = $this->getInfo ()->getLastTransId ();
	
	if(empty($order_id)) return; // Checkout Progress?
	
        $collection = Mage::getModel ('itaushopline/transactions')->getCollection();
        $collection->getSelect()->where ("order_id = {$order_id}");
        
        $data = $collection->getFirstItem()->toArray ();
        
        $submit_form = new Varien_Data_Form ();
        $fieldset = $submit_form->addFieldset ('fieldset', array ('legend' => null));
        $fieldset->addField ('submit_dc', 'hidden', array(
            'name' => 'DC',
            'value' => $data ['submit_dc'],
        ));

        $fieldset->addField ('shoplinebutton', 'shoplinebutton', array(
            'label' => Mage::helper ('itaushopline')->__('Submit this transaction'),
            'value' => Mage::helper ('itaushopline')->__('Submit'),
            'image' => Mage::getStoreConfig ('payment/itaushopline_settings/button_image'),
            'class' => 'shoplinebutton',
            'name'  => 'shoplinebutton'
        ));
        
        return $submit_form->toHtml();
    }

    public function getQueryTransactionInformation ()
    {
		$order = $this->getOrder ();
		if (empty ($order)) return;
	
		$order_id = $order->getId ();
	
        $collection = Mage::getModel ('itaushopline/transactions')->getCollection();
        $collection->getSelect()->where ("order_id = {$order_id}");
        
        $data = $collection->getFirstItem()->toArray ();
        
        $query_form = new Varien_Data_Form ();
        $fieldset = $query_form->addFieldset ('fieldset', array ('legend' => null));
        $fieldset->addField ('query_dc', 'hidden', array(
            'name' => 'DC',
            'value' => $data ['query_dc'],
        ));
        $fieldset->addField ('submit', 'submit', array(
            'label' => Mage::helper ('itaushopline')->__('Query this transaction'),
            'value' => Mage::helper ('itaushopline')->__('Query'),
        ));
        
        return $query_form->toHtml();
    }
}
