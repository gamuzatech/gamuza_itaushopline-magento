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

$installer = $this;
$installer->startSetup();
$sqlBlock = <<<SQLBLOCK
CREATE TABLE {$this->getTable ('gamuza_itaushopline_transactions')} (
    id int(11) unsigned NOT NULL AUTO_INCREMENT,
    order_id int(11) unsigned NOT NULL,
    amount float unsigned NOT NULL,
    number char(11) NOT NULL,
    expiration date NOT NULL,
    submit_dc text NOT NULL,
    query_dc text NOT NULL,
    PRIMARY KEY (id),
    KEY order_id (order_id),
    KEY amount (amount),
    KEY number (number),
    KEY expiration (expiration)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
SQLBLOCK;
$installer->run($sqlBlock);
//demo
//Mage::getModel('core/url_rewrite')->setId(null);
//demo
$installer->endSetup();
