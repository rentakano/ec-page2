<?php

// 他のライブラリを読み込み
require_once('init.php');

// APIキー登録
$stripe = array(
  "secret_key"      => "sk_********************",
  "publishable_key" => "pk_********************"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);

// Checkput.jsからPOSTされたトークンとメールアドレスを代入
$token  = $_POST['stripeToken'];
$email  = $_POST['stripeEmail'];

// 決済額を設定
$price  = '決済金額';

// 顧客を作成
$customer = \Stripe\Customer::create(array(
    'email' => $email,
    'source'  => $token
));

// チャージを作成
$charge = \Stripe\Charge::create(array(
    'description'  => $product,
    'customer' => $customer->id,
    'amount'   => $price,
    'currency' => 'jpy'
));

// 処理が完了したら完了ページへリダイレクト
header('Location: https://www.juxtaposition.jp/image-upload-utility/thanks.html');

?>