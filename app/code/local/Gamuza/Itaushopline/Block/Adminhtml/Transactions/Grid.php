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

class Gamuza_Itaushopline_Block_Adminhtml_Transactions_Grid
extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();

		$this->setId("itaushopline_transactions_grid");
		$this->setDefaultSort("id");
		$this->setDefaultDir("ASC");
		$this->setSaveParametersInSession(true);
	}

	protected function _prepareCollection()
	{
		$collection = Mage::getModel("itaushopline/transactions")->getCollection();
		$collection->getSelect()->join (array('table_sales_order' => 'sales_flat_order'),
			                                  'main_table.order_id = table_sales_order.entity_id',
			                                    array('increment_id'));
		$this->setCollection($collection);

		return parent::_prepareCollection();
	}

	protected function _prepareColumns()
	{
		$this->addColumn("id", array(
		"header" => Mage::helper("itaushopline")->__("ID"),
		"align" =>"right",
		"width" => "50px",
		"index" => "id",
		));
		$this->addColumn("order_id", array(
		"header" => Mage::helper("itaushopline")->__("Order ID"),
		"align" =>"left",
		"width" => "50px",
		"index" => "order_id",
		));
		$this->addColumn("order_increment_id", array(
		"header" => Mage::helper("itaushopline")->__("Order Increment ID"),
		"align" =>"left",
		"index" => "increment_id",
		));
		$this->addColumn("number", array(
		"header" => Mage::helper("itaushopline")->__("Number"),
		"align" =>"left",
		"index" => "number",
		));
		$this->addColumn("expiration", array(
		"header" => Mage::helper("itaushopline")->__("Expiration"),
		"align" => "right",
		"index" => "expiration",
		"type" => "date",
		"renderer" => "utils/adminhtml_widget_grid_column_renderer_expiration",
		));
		$this->addColumn("amount", array(
		"header" => Mage::helper("itaushopline")->__("Amount"),
		"align" =>"right",
		"index" => "amount",
		"type" => "currency",
		"currency" => "base_currency_code",
		"renderer" => "utils/adminhtml_widget_grid_column_renderer_price"
		));

		return parent::_prepareColumns();
	}

	public function getRowUrl($row)
	{
	   return $this->getUrl("*/*/view", array("id" => $row->getId()));
	}
}
