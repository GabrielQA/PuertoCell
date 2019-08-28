<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Http\Requests;
use Paypal;
use App\User;
use Illuminate\Support\Facades\Auth;
 
class PaypalController extends Controller
{
    private $_apiContext;
 
    public function __construct()
    {
    	 $this->_apiContext = PayPal::ApiContext(
            config('services.paypal.client_id'),
            config('services.paypal.secret'));
 
    	//Aquí guarde una configuración para mis credenciales de Sandbox
        /*$this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));*/
 
        //Config live
        $this->_apiContext->setConfig(array(
            'mode' => 'live',
            'service.EndPoint' => 'https://api.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));
    }
 
    public function getCheckout(Request $request)
	{
        $user         = Auth::user(); 
        $id_user      = $user->id;
        $id_purchased_item    = $request->input('id_purchased_item'); //producto que me estan comprando
        $invoice      = $id_user.'-'.$id_purchased_item.'-'.$this->random(5);//generación de invoice aleatorio
        $descripcion  = $request->input('description');
        $quantity     = $request->input('quantity');//cantidad de productos adquiridos
        $total_amount = $request->input('amount');
        $currency     = $request->input('currency_code');//tipo de moneda
 
	    $payer = PayPal::Payer();
	    $payer->setPaymentMethod('paypal');
 
	    $item1 = PayPal::item();
        $item1->setName($descripcion)
                ->setDescription($descripcion)
                ->setCurrency($currency)
                ->setQuantity(1)
                ->setPrice($total_amount);
 
        $itemList = PayPal::itemList();
        $itemList->setItems(array($item1));
 
 
        // ### Cantidad
        // Especificando la cantidad del pago
        // Se pueden añadir detalles adicionales como 
        // shipping, tax.
        // Todo estó para que en paypal aparezca desglosado
        // como si de un carrito de compra se tratará
        $amount = PayPal::amount();
        $amount->setCurrency($currency)
            ->setTotal($total_amount);
 
        // ### Transacción
        // Para quién es el pago y quién lo está pagando. 
        $transaction = PayPal::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Descripción")
            ->setInvoiceNumber($invoice);
 
        // ### urls de redirección
        // Rutas a las que será redirigido el comprador después de un pago 
        // aprobado / cancelación
 
        $redirectUrls = PayPal:: RedirectUrls();
	    $redirectUrls->setReturnUrl(route('getDone'));
	    $redirectUrls->setCancelUrl(route('getCancel'));
 
        // ### Pago
        // Creamos el pago, para establecer la venta
 
        $payment = PayPal::Payment();
	    $payment->setIntent('sale');
	    $payment->setPayer($payer);
	    $payment->setRedirectUrls($redirectUrls);
	    $payment->setTransactions(array($transaction));
 
	    $response = $payment->create($this->_apiContext);
	    $redirectUrl = $response->links[1]->href;
	    
	    return redirect()->to( $redirectUrl );
 
	}
 
	public function getDone(Request $request)
	{
        $id               = $request->get('paymentId');
        $token            = $request->get('token');
        $payer_id         = $request->get('PayerID');
        $payment          = PayPal::getById($id, $this->_apiContext);
        $paymentExecution = PayPal::PaymentExecution();
 
        $paymentExecution->setPayerId($payer_id);
        $executePayment = $payment->execute($paymentExecution, $this->_apiContext);
 
	    return view("payments.payment-done");
	}
 
 
	public function getCancel()
	{
	   return view("payment-cancel", compact("executePayment"));
	}
 
      /*generación del invoice para paypal */
      public function random($qtd){
 
       $caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 
       $cantidad_de_caracteres = strlen($caracteres); 
       $cantidad_de_caracteres--; 
 
       $num_random = NULL; 
       for($x=1;$x<=$qtd;$x++){ 
        $posicion = rand(0,$cantidad_de_caracteres); 
        $num_random .= substr($caracteres,$posicion,1); 
       } 
 
      return $num_random; 
     } 
}