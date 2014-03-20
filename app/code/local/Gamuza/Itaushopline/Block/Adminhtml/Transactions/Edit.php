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

class Gamuza_Itaushopline_Block_Adminhtml_Transactions_Edit
extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct()
	{
		parent::__construct();

		$this->_objectId = "id";
		$this->_blockGroup = "itaushopline";
		$this->_controller = "adminhtml_transactions";
		$this->_removeButton ('save');
		$this->_removeButton ('delete');
		$this->_removeButton ('reset');
		
		$this->_addButton("submit", array(
		    "label"     => Mage::helper("itaushopline")->__("Submit"),
		    "onclick"   => "popWin ('" . $this->getSubmitUrl () . "', '','width=700,height=500,resizable=no,scrollbars=no')",
		    "class"     => "go",
		));

		$this->_addButton("query", array(
		    "label"     => Mage::helper("itaushopline")->__("Query"),
		    "onclick"   => "popWin ('" . $this->getQueryUrl () . "', '','width=700,height=500,resizable=no,scrollbars=no')",
		    "class"     => "go",
		));
	}

	public function getHeaderText()
	{
	    return Mage::helper("itaushopline")->__("View Item '%s'", $this->htmlEscape(Mage::registry("itaushopline_data")->getId()));
	}

	private function _getTransaction ()
	{
		$id = $this->getRequest()->getParam ('id');
		
		$collection = Mage::getModel ('itaushopline/transactions')->getCollection();
		$collection->getSelect()->where ("id = {$id}");
		
		return $collection->getFirstItem()->toArray ();
	}

	public function getSubmitDC ()
	{
		$data = $this->_getTransaction ();

		return $data ['submit_dc'];
	}

	public function getQueryDC ()
	{
		$data = $this->_getTransaction ();
		
		return $data ['query_dc'];
	}

	public function getSubmitUrl()
    {
		$submit_url = Mage::getStoreConfig ('payment/itaushopline_settings/submit_url');
        $submit_dc = $this->getSubmitDC ();
            
        return "{$submit_url}?DC={$submit_dc}";
    }

	public function getQueryUrl()
    {
        $query_url = Mage::getStoreConfig ('payment/itaushopline_settings/query_url');
        $query_dc = $this->getQueryDC ();
            
        return "{$query_url}?DC={$query_dc}";
    }
}
