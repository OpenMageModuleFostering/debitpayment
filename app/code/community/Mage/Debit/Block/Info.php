<?php

/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @package    Mage_Debit
 * @copyright  Copyright (c) 2009 ITABS GbR - Rouven Alexander Rieker
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Mage_Debit_Block_Info extends Mage_Payment_Block_Info
{

    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('debit/info.phtml');
    }
    
    public function toPdf()
    {
        $this->setTemplate('debit/debit.phtml');
        return $this->toHtml();
    }

}
