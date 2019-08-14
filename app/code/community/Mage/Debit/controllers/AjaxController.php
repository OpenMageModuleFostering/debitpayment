<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @package    Mage_Debit
 * @copyright  Copyright (c) 2010 Phoenix Medien GmbH & Co. KG (http://www.phoenix-medien.de)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Mage_Debit_AjaxController extends Mage_Core_Controller_Front_Action
{
    public function checkblzAction()
    {
        $result = array();
        if ($bank = Mage::helper('debit')->getBankByBlz($this->getRequest()->getPost('blz'))) {
            $result['found'] = 1;
            $result['bank'] = $bank;
        } else {
            $result['found'] = 0;
            $result['bank'] = $this->__('Bank not found');
        }
        $this->getResponse()->setBody(Zend_Json::encode($result));
    }
}