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

class Gamuza_Itaushopline_Adminhtml_TransactionsController
extends Mage_Adminhtml_Controller_Action
{
	protected function _initAction()
	{
		$this->loadLayout()->_setActiveMenu("itaushopline/transactions")->_addBreadcrumb(Mage::helper("adminhtml")->__("Itau ShopLine Transactions Manager"),Mage::helper("adminhtml")->__("Itau ShopLine Transactions Manager"));

		return $this;
	}

	public function indexAction() 
	{
		$this->_initAction();
		$this->renderLayout();
	}

	public function viewAction()
	{
		$brandsId = $this->getRequest()->getParam("id");
		$brandsModel = Mage::getModel("itaushopline/transactions")->load($brandsId);
		if ($brandsModel->getId() || $brandsId == 0) {
			Mage::register("itaushopline_data", $brandsModel);
			$this->loadLayout();
			$this->_setActiveMenu("itaushopline/transactions");
			$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Itau ShopLine Transactions Manager"), Mage::helper("adminhtml")->__("Itau ShopLine Transactions Manager"));
			$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Itau ShopLine Transactions Description"), Mage::helper("adminhtml")->__("Itau ShopLine Transactions Description"));
			$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
			$this->_addContent($this->getLayout()->createBlock("itaushopline/adminhtml_transactions_edit"))->_addLeft($this->getLayout()->createBlock("itaushopline/adminhtml_transactions_edit_tabs"));
			$this->renderLayout();
		} 
		else
		{
			Mage::getSingleton("adminhtml/session")->addError(Mage::helper("itaushopline")->__("Item does not exist."));

			$this->_redirect("*/*/");
		}
	}
}
