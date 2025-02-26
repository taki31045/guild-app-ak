<?php 
 
namespace App\Services; 
 
use PayPal\Auth\OAuthTokenCredential; 
use PayPal\Rest\ApiContext; 
use PayPal\Api\Payment; 
use PayPal\Api\PaymentExecution; 
use PayPal\Api\Amount; 
use PayPal\Api\Transaction; 
use PayPal\Api\Payer; 
use PayPal\Api\Item; 
use PayPal\Api\ItemList; 
use PayPal\Api\RedirectUrls; 
use PayPal\Api\Details; 
use PayPal\Api\Payment as PayPalPayment; 
 
class PayPalService 
{ 
    private $apiContext; 
 
    public function __construct() 
    { 
        // Initialize PayPal API context with credentials 
        $this->apiContext = new ApiContext( 
            new OAuthTokenCredential( 
                env('PAYPAL_CLIENT_ID'),  // Your PayPal client ID 
                env('PAYPAL_SECRET')      // Your PayPal secret 
            ) 
        ); 
 
        // Optional: Set configuration for PayPal (mode: 'sandbox' or 'live') 
        $this->apiContext->setConfig([ 
            'mode' => env('PAYPAL_MODE', 'sandbox') // 'sandbox' for testing, 'live' for production 
        ]); 
    } 
 
    /** 
     * Example function to get all payments. 
     * 
     * @param int $page Page number for pagination 
     * @param int $pageSize Number of records per page 
     * @return mixed List of payments or null 
     */ 
  public function getPayments($page = 1, $pageSize = 10) 
{ 
  

    try { 
        // Fetch payments from PayPal API 
        $paymentsList = Payment::all( 
            ['count' => $pageSize, 'start_index' => ($page - 1) * $pageSize], 
            $this->apiContext 
        ); 
        
        // デバッグ用
        // dd($paymentsList); 
        // getPayments() が配列を返すかチェック
        $payments = $paymentsList->getPayments();
        dd(gettype($payments), $payments);
        
        if (!is_array($payments)) {
            return []; // 配列でない場合は空の配列を返す
        }

        return $payments;
    } catch (\Exception $e) { 
        // Log error or handle accordingly 
        return null; 
    } 
}

 
    /** 
     * Example function to create a PayPal payment. 
     * 
     * @param $amount The amount to be paid 
     * @return \PayPal\Api\Payment|null 
     */ 
    public function createPayment($amount) 
    { 
        try { 
            // Set payer information 
            $payer = new Payer(); 
            $payer->setPaymentMethod("paypal"); 
 
            // Set transaction amount 
            $transactionAmount = new Amount(); 
            $transactionAmount->setTotal($amount) 
                              ->setCurrency('USD');  // Set the currency (e.g., USD) 

            // Set transaction details 
            $transaction = new Transaction(); 
            $transaction->setAmount($transactionAmount) 
                        ->setDescription("Payment description"); 
 
            // Create payment object 
            $payment = new PayPalPayment(); 
            $payment->setIntent("sale") 
                    ->setPayer($payer) 
                    ->setTransactions([$transaction]); 
 
            // Set redirect URLs 
            $redirectUrls = new RedirectUrls(); 
            $redirectUrls->setReturnUrl(url('/paypal/return'))
              // Redirect after payment approval 
                         ->setCancelUrl(url('/paypal/cancel'));
                           // Redirect if payment is cancelled 
 
            $payment->setRedirectUrls($redirectUrls); 

            


            // Create the payment using PayPal API 
            $payment->create($this->apiContext);
 
            return $payment; 
        } catch (\Exception $e) { 
            // Log error or handle accordingly 
            return null; 
        } 
    } 
} 