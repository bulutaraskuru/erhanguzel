<?php

namespace App\Http\Controllers\Site\User\Cart;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\UserAddress;
use Auth;
use Iyzipay\Model\Address;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\CheckoutFormInitialize;
use Iyzipay\Model\Currency;
use Iyzipay\Model\Locale;
use Iyzipay\Model\PaymentGroup;
use Iyzipay\Request\CreateCheckoutFormInitializeRequest;

class indexController extends Controller
{
    public function payment()
    {

        $cart = \Cart::content();
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user_address = UserAddress::where('user_id', $user_id)->where('is_invoice', 1)->first();
        $options = new \Iyzipay\Options();
        $options->setApiKey('sandbox-5u7rayYQAIg71ZfbGertuY6CnpOwqDpL');
        $options->setSecretKey('sandbox-c5hTeKn6pdbiHGXsCINLWjCeA8bhudck');
        $options->setBaseUrl('https://sandbox-api.iyzipay.com');

        //        $request = new CreateCheckoutFormInitializeRequest();
        //        $request->setLocale(Locale::TR);
        //        $request->setConversationId(1);
        //        $request->setPrice('1');
        //        $request->setPaidPrice('1.2');
        //        $request->setCurrency(Currency::TL);
        //        $request->setBasketId(1);
        //        $request->setPaymentGroup(PaymentGroup::PRODUCT);
        //        $request->setCallbackUrl(route('site.order_detail', [
        //            'user_id' => $user_id,
        //            'order_id' => 1,
        //        ]));
        //
        //        $request->setEnabledInstallments([2, 3, 6, 9]);
        //
        //        $buyer = new Buyer();
        //        $buyer->setId(1);
        //        $buyer->setName($user->name);
        //        $buyer->setSurname($user->name);
        //        $buyer->setGsmNumber($user->phone);
        //        $buyer->setEmail($user->email);
        //        $buyer->setIdentityNumber('59443305036');
        //        $buyer->setLastLoginDate(date('Y-m-d H:i:s'));
        //        $buyer->setRegistrationDate(date('Y-m-d H:i:s'));
        //        $buyer->setRegistrationAddress($user_address->addres);
        //        $buyer->setIp($_SERVER['REMOTE_ADDR']);
        //        $buyer->setCity($user_address->province);
        //        $buyer->setCountry('Turkey');
        //        $buyer->setZipCode('34742');
        //        $request->setBuyer($buyer);
        //
        //        $shippingAddress = new Address();
        //        $shippingAddress->setContactName($user_address->orderFullName);
        //        $shippingAddress->setCity($user_address->orderProvince.'/'.$user_address->orderDistrict);
        //        $shippingAddress->setCountry('Turkey');
        //        $shippingAddress->setAddress("$user_address->address");
        //        $shippingAddress->setZipCode('34742');
        //        $request->setShippingAddress($shippingAddress);
        //
        //        $billingAddress = new Address();
        //        $billingAddress->setContactName($user_address->name);
        //        $billingAddress->setCity($user_address->province);
        //        $billingAddress->setCountry('Turkey');
        //        $billingAddress->setAddress($user_address->address);
        //        $billingAddress->setZipCode('34742');
        //        $request->setBillingAddress($billingAddress);
        //
        //        $basketItems = [];
        //        $firstBasketItem = new \Iyzipay\Model\BasketItem();
        //        $firstBasketItem->setId('BI101');
        //        $firstBasketItem->setName('Binocular');
        //        $firstBasketItem->setCategory1('Collectibles');
        //        $firstBasketItem->setCategory2('Accessories');
        //        $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
        //        $firstBasketItem->setPrice('1.2');
        //        $basketItems[0] = $firstBasketItem;
        //        $request->setBasketItems($basketItems);
        //
        //        $basketItems = [];
        //        $firstBasketItem = new \Iyzipay\Model\BasketItem();
        //        $firstBasketItem->setId(1);
        //        $firstBasketItem->setName('Video Eğitim');
        //        $firstBasketItem->setCategory1('İçerik');
        //        $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
        //        $firstBasketItem->setPrice('1');
        //        $basketItems[0] = $firstBasketItem;
        //        $request->setBasketItems($basketItems);
        //
        //        $checkoutFormInitialize = CheckoutFormInitialize::create($request, $options);
        //        $paymentinput = $checkoutFormInitialize->getCheckoutFormContent();

        $request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setConversationId('123456789');
        $request->setPrice('1');
        $request->setPaidPrice('1.2');
        $request->setCurrency(\Iyzipay\Model\Currency::TL);
        $request->setBasketId('B67832');
        $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
        $request->setCallbackUrl('https://www.merchant.com/callback');
        $request->setEnabledInstallments([2, 3, 6, 9]);

        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId('BY789');
        $buyer->setName('John');
        $buyer->setSurname('Doe');
        $buyer->setGsmNumber('+905350000000');
        $buyer->setEmail('email@email.com');
        $buyer->setIdentityNumber('74300864791');
        $buyer->setLastLoginDate('2015-10-05 12:43:35');
        $buyer->setRegistrationDate('2013-04-21 15:12:09');
        $buyer->setRegistrationAddress('Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1');
        $buyer->setIp('85.34.78.112');
        $buyer->setCity('Istanbul');
        $buyer->setCountry('Turkey');
        $buyer->setZipCode('34732');

        $request->setBuyer($buyer);
        $shippingAddress = new \Iyzipay\Model\Address();
        $shippingAddress->setContactName('Jane Doe');
        $shippingAddress->setCity('Istanbul');
        $shippingAddress->setCountry('Turkey');
        $shippingAddress->setAddress('Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1');
        $shippingAddress->setZipCode('34742');
        $request->setShippingAddress($shippingAddress);

        $billingAddress = new \Iyzipay\Model\Address();
        $billingAddress->setContactName('Jane Doe');
        $billingAddress->setCity('Istanbul');
        $billingAddress->setCountry('Turkey');
        $billingAddress->setAddress('Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1');
        $billingAddress->setZipCode('34742');
        $request->setBillingAddress($billingAddress);

        $basketItems = [];
        $firstBasketItem = new \Iyzipay\Model\BasketItem();
        $firstBasketItem->setId('BI101');
        $firstBasketItem->setName('Binocular');
        $firstBasketItem->setCategory1('Collectibles');
        $firstBasketItem->setCategory2('Accessories');
        $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
        $firstBasketItem->setPrice('0.3');
        $basketItems[0] = $firstBasketItem;

        $secondBasketItem = new \Iyzipay\Model\BasketItem();
        $secondBasketItem->setId('BI102');
        $secondBasketItem->setName('Game code');
        $secondBasketItem->setCategory1('Game');
        $secondBasketItem->setCategory2('Online Game Items');
        $secondBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
        $secondBasketItem->setPrice('0.5');

        $basketItems[1] = $secondBasketItem;
        $thirdBasketItem = new \Iyzipay\Model\BasketItem();
        $thirdBasketItem->setId('BI103');
        $thirdBasketItem->setName('Usb');
        $thirdBasketItem->setCategory1('Electronics');
        $thirdBasketItem->setCategory2('Usb / Cable');
        $thirdBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
        $thirdBasketItem->setPrice('0.2');
        $basketItems[2] = $thirdBasketItem;
        $request->setBasketItems($basketItems);

        $checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($request, $options)->getCheckoutFormContent();

        return view('site.user.payment', [
            'cart' => $cart,
            'paymentinput' => $checkoutFormInitialize,
        ]);
    }

    //        $control_order = Order::where('user_id', $user_id)->where('is_active', 0)->count();
    //        if ($control_order != 0) {
    //            $order = Order::create([
    //                'user_id' => $user_id,
    //                'is_active' => 0,
    //                'price' => \Cart::total(),
    //                'tax' => \Cart::tax(),
    //                'subtotal' => \Cart::subtotal(),
    //            ]);
    //
    //            foreach ($cart  as $item) {
    //                $create = OrderDetail::create([
    //
    //                ]);
    //            }
    //        } else {
    //            $order = Order::where('user_id', $user_id)->where('is_active', 0)->first();
    //        }

}
