<?php
	// **********************************************
    // Exemplo de uso Exchange www.BitcoinTrade.com.br
    // **********************************************
  
    // importar classe
    require ("blinktrade.php");

    // Cria instancia da classe Bitcoin Trade
    $apiKey = '';
    $exchange = new bitcoinTrade($apiKey);
    
    // variáveis para parametrização
    $currency = 'BTC';
    $hours = 1;
    $page_size = 100;
    $current_page = 1;   

    // get ticker
    //$ticker = $exchange->ticker($currency);
    //var_dump($ticker->data);

    // get orders
    //$orders = $exchange->orders($currency);
    //var_dump($orders->data);

    // get trades
    //$trades = $exchange->trades($currency, $hours, $page_size, $current_page);
    //var_dump($trades->data);

    // get orderbook
    //$orderbook = $exchange->orderbook($currency);
    //var_dump($orderbook->data);

    // get summary
    //$summary = $exchange->summary($currency);
    //var_dump($summary->data);

    
    // create order
    // buy
    $amount = 0.001; // Quantidade da moeda - (FLOAT)
    $type ="buy"; // Tipo da ordem - buy / sell (STRING)
    $subtype = "limited"; // Subtipo da ordem - limited / market (STRING)
    $unitPrice = 10000; // Preço de unidade da moeda - (FLOAT)
    //$buyOrder = $exchange->createOrder($currency, $amount, $type, $subtype, $unitPrice);
    //var_dump($buyOrder);

    // sell
    $amount = 0.001; // Quantidade da moeda - (FLOAT)
    $type ="sell"; // Tipo da ordem - buy / sell (STRING)
    $subtype="limited"; // Subtipo da ordem - limited / market (STRING)
    $unitPrice = 30000; // Preço de unidade da moeda - (FLOAT)
    //$sellOrder = $exchange->createOrder($currency, $amount, $type, $subtype, $unitPrice);
    //var_dump($sellOrder);

    // cancel order
    $orderId = 'U2FsdGVkX1+qrxVqoDbSYh9wCvhhrP63SMy01Sn27Ag=';
    //$cancelOrder = $exchange->cancelOrder($orderId);
    //var_dump($cancelOrder);

    // get user orders
    $status = 'waiting'; // Status da ordem - executed_completely / executed_partially / waiting / canceled (STRING)
    $hours = 24;
    $type = "sell"; // Tipo da ordem - buy / sell (STRING)
    //$userOrders = $exchange->userOrders($currency, $status, $hours, $type, $page_size, $current_page);
    //var_dump($userOrders->data);

    // estimated price
    $amount = 100;
    $type ="buy";
    //$estimatedPrice = $exchange->estimatedPrice($currency, $amount, $type);
    //var_dump($estimatedPrice->data);

    // balance
    //$balance = $exchange->balance();
    //var_dump($balance->data);

?>