<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Barzahlen\Payment\Observer;

use Magento\Framework\Event\Observer;
use Magento\Payment\Observer\AbstractDataAssignObserver;

class DataAssignObserver extends AbstractDataAssignObserver
{

    /**
     * @param Observer $observer
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(Observer $observer)
    {
        $method = $this->readMethodArgument($observer);

        if ($method->getCode() == 'barzahlen_gateway') {
            $data = $this->readDataArgument($observer);

            $paymentInfo = $method->getInfoInstance();

            if ($data->getDataByKey('transaction_result') !== null) {
                $paymentInfo->setAdditionalInformation(
                    'transaction_result',
                    $data->getDataByKey('transaction_result')
                );
            }
        }
    }
}
