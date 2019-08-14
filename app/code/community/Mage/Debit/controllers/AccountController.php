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
class Mage_Debit_AccountController extends Mage_Core_Controller_Front_Action
{
    /**
     * Retrieve customer session object
     *
     * @return Mage_Customer_Model_Session
     */
    protected function _getSession()
    {
        return Mage::getSingleton('customer/session');
    }

    public function preDispatch()
    {
        parent::preDispatch();

        if (!Mage::getSingleton('customer/session')->authenticate($this)) {
            $this->setFlag('', 'no-dispatch', true);
        }
    }

    public function editAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Debit Account Data'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        $customer = Mage::getSingleton('customer/session')->getCustomer();
        if (!$customer) {
            return;
        }
        $customer->setData('debit_payment_acount_data_update', now());
        $customer->setData('debit_payment_acount_name', $this->getRequest()->getPost('account_name'));
        $customer->setData('debit_payment_acount_number', $this->getRequest()->getPost('account_number'));
        $customer->setData('debit_payment_acount_blz', $this->getRequest()->getPost('account_blz'));
        try {
            $customer->save();
            $this->_getSession()->setCustomer($customer)
                ->addSuccess($this->__('Debit account information was successfully saved'));
            $this->_redirect('customer/account');
            return;
        }
        catch (Mage_Core_Exception $e) {
            $this->_getSession()->setCustomerFormData($this->getRequest()->getPost())
                ->addError($e->getMessage());
        }
        catch (Exception $e) {
            $this->_getSession()->setCustomerFormData($this->getRequest()->getPost())
                ->addException($e, $this->__('Can\'t save customer'));
        }
    }
}