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

class Gamuza_Itaushopline_Block_Adminhtml_Transactions_Edit_Tab_Form
extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$data = Mage::registry("itaushopline_data")->getData();

		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset("itaushopline_form", array("legend"=>Mage::helper("itaushopline")->__("Item Information")));

		$config = Mage::getConfig ();
		$fieldset->addType ('expiration', $config->getBlockClassName ('utils/adminhtml_system_config_form_field_expiration'));
		$fieldset->addType ('price', $config->getBlockClassName ('utils/adminhtml_system_config_form_field_price'));

		$fieldset->addField("order_id", "label", array(
		"label" => Mage::helper("itaushopline")->__("Order ID"),
		"class" => "required-entry",
		"required" => true,
		"name" => "order_id",
		"disabled" => true,
		));

		$order_increment_id = Mage::getModel ('sales/order')->load ($data ['order_id'])->getIncrementId ();

		$fieldset->addField("order_increment_id", "label", array(
		"label" => Mage::helper("itaushopline")->__("Order Increment ID"),
		"class" => "required-entry",
		"required" => true,
		"disabled" => true,
		"after_element_html" => $order_increment_id,
		));

		$fieldset->addField("number", "label", array(
		"label" => Mage::helper("itaushopline")->__("Number"),
		"class" => "required-entry",
		"required" => true,
		"name" => "number",
		"disabled" => true,
		));

		$fieldset->addField("expiration", "expiration", array(
		"label" => Mage::helper("itaushopline")->__("Expiration"),
		"class" => "required-entry",
		"required" => true,
		"name" => "expiration",
		"disabled" => true,
		));

		$fieldset->addField("amount", "price", array(
		"label" => Mage::helper("itaushopline")->__("Amount"),
		"class" => "required-entry",
		"required" => true,
		"name" => "amount",
		"disabled" => true,
		));

	    $form->setValues($data);
		
		return parent::_prepareForm();
	}
}
