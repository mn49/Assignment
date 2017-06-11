<?php

namespace App\Http\Controllers;

require_once '../vendor/autoload.php';

use Illuminate\Http\Request;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;

use App\Cost;
use App\Post;
use App\User;
use App\Trans;

class PayController extends Controller
{
    public function index($id)
    {
		$itm= Cost::where('post_id', $id)->get();
		$item= $itm->pluck('price')->toArray();
		
		
		$itm_name= Post::find($id);
		$item_name= $itm_name->pluck('title')->toArray();
		
		$item_creator= $itm_name->user->name;
		 
		
		$apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AdxiFd-KKhwjeVQh3m7YfddGQ3hSuVWQomSDwhEBNjdCN-yilC9ZO0O3ldX2DQhJJKsGm9Yf8MvD7gnP',     // ClientID
            'ELZtAP2Webu6WKkge41xksfzLzaiu1Jx3ALeiMwspu-RtwW4U6KtH21XgU3MYVSfnWsNMK5xA94YaVfu'      // ClientSecret
			)
		);
		
		$payer = new Payer();
		$payer->setPaymentMethod("paypal");
		
		$item1 = new Item();
		$item1->setName($item_name[0])
			->setCurrency('USD')
			->setQuantity(1)
			->setSku("842y28ss")
			->setPrice($item[0]);
			//dd($item1);
			
		$itemList = new ItemList();
		$itemList->setItems(array($item1));
		
		$details = new Details();
		$details->setShipping(0)
			->setTax(0)
			->setSubtotal($item[0]);
		
		$amount = new Amount();
		$amount->setCurrency("USD")
			->setTotal($item[0])
			->setDetails($details);
		
		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($itemList)
			->setDescription("Donation to $item_creator")
			->setInvoiceNumber(uniqid());
		
		$baseUrl = "http://localhost:8000/donate/$id";
		$redirectUrls = new RedirectUrls();
		$redirectUrls->setReturnUrl("$baseUrl/ExecutePayment.php?success=true")
			->setCancelUrl("$baseUrl/ExecutePayment.php?success=false");
		
		$payment = new Payment();
		$payment->setIntent("sale")
		->setPayer($payer)
		->setRedirectUrls($redirectUrls)
		->setTransactions(array($transaction));
		
		$payment->create($apiContext);
		
		$approvalUrl = $payment->getApprovalLink();
		
		return redirect($approvalUrl);
	}
	
	public function result($id)
	{
		$apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AdxiFd-KKhwjeVQh3m7YfddGQ3hSuVWQomSDwhEBNjdCN-yilC9ZO0O3ldX2DQhJJKsGm9Yf8MvD7gnP',     // ClientID
            'ELZtAP2Webu6WKkge41xksfzLzaiu1Jx3ALeiMwspu-RtwW4U6KtH21XgU3MYVSfnWsNMK5xA94YaVfu'      // ClientSecret
			)
		);
		
		if (isset($_GET['success']) && $_GET['success'] == 'true') 
		{
			$paymentId = $_GET['paymentId'];
			$payment = Payment::get($paymentId, $apiContext);
			
			$execution = new PaymentExecution();
			$execution->setPayerId($_GET['PayerID']);
			
			$result = $payment->execute($execution, $apiContext);
			$payment = Payment::get($paymentId, $apiContext);
			
			$newId= $payment->id;
			$newState= $payment->state;
			
			$item= Post::find($id);
			$creator= $item->user->id;
			
			$transaction= new Trans;
			$transaction->payment_id = $newId;
			$transaction->state = $newState;
			$transaction->user_id = $creator;
			$transaction->save();
			
			return view('posts.tes', compact('payment'));
		} 
		
	}
}
