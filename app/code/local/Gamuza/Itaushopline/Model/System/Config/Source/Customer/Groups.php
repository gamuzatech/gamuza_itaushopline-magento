<?php

class Gamuza_Itaushopline_Model_System_Config_Source_Customer_Groups
{

public function toOptionArray ()
{
    return Mage::getModel ('customer/group')->getCollection ()->toOptionArray ();
}

}

