<?php //

/*
 * ***********************************************************************
 Copyright [2014] [PagSeguro Internet Ltda.]

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
 * ***********************************************************************
 */

require_once "../PagSeguroLibrary/PagSeguroLibrary.php";

/**
 * Class with a main method to illustrate the usage of the domain class PagSeguroPaymentRequest
 */
class GetInstallments
{

    public static function main()
    {
        try {
                
            /**
             * @todo
             * #### Credentials #####
             * Replace the parameters below with your credentials (e-mail and token)
             * You can also get your credentials from a config file. See an example:
             * $credentials = PagSeguroConfig::getAccountCredentials();
             */
             $credentials = new PagSeguroAccountCredentials("vendedor@lojamodelo.com.br",
                "E231B2C9BCC8474DA2E260B6C8CF60D3");
            
            $session = "97e12ffaaad04452b9e2b5e9efefd3ee";
            $cardBrand = "visa";

            try {
            $installments = PagSeguroInstallmentService::getInstallments($credentials,
                    $session,
                    "5000.00",
                    $cardBrand);
            } catch (Exception $e) {
                die($e->getMessage());
            }

            self::printInstallment($installments);


        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    } 

    public static function printInstallment($installments)
    {

        if ($installments) {
            echo utf8_decode("<h2>Installments</h2>");

            foreach ($installments as $installment) {
                echo "<p> <strong> brand: </strong> ". $installment->getCardBrand()."<br> ";
                echo "<strong> quantity: </strong> ". $installment->getQuantity()."<br> ";
                echo "<strong> installmentAmount: </strong> ". $installment->getInstallmentAmount()."<br> ";
                echo "<strong> totalAmount: </strong> ". $installment->getTotalAmount()."<br> ";
                echo "<strong> interestFree: </strong> ". $installment->getInterestFree()."</p> ";
               
            }
        }
      echo "<pre>";
    }
}

GetInstallments::main();
