# BitcoinTrade API (PHP)
Descrição: Classe para API da exchange brasileira Bitcoin Trade em PHP.

Autor: Miguel Medeiros - [www.miguelmedeiros.com.br](https://www.miguelmedeiros.com.br)<br />
Exchange: [Bitcoin Trade](https://www.bitcointrade.com.br/)<br />
Documentação da API: [Bitcoin Trade](https://apidocs.bitcointrade.com.br/)

Gostou? Então me pague um café!<br/>
BTC Wallet: 1FkPLxYn7L2PQDgVawUhx8WpyrnNWhPWYN

---

## Como utilizar
Para ter acesso aos métodos da classe você deve ter a API em mão e seguir o seguinte código:
```php
// importar classe
require ("bitcointrade.php");

// Cria instancia da classe Bitcoin Trade
$apiKey = ''; // colocar a sua API nessa variável
$exchange = new bitcoinTrade($apiKey);

// variáveis para parametrização gerais
$currency = 'BTC';
$hours = 1;
$page_size = 100;
$current_page = 1;   
```
## Métodos
### Get Ticker
```php
$ticker = $exchange->ticker($currency);
var_dump($ticker->data);
```

### Get Orders
```php
$orders = $exchange->orders($currency);
var_dump($orders->data);
```

### Get Trades
```php
$trades = $exchange->trades($currency, $hours, $page_size, $current_page);
var_dump($trades->data);
```

### Get Orderbook
```php
$orderbook = $exchange->orderbook($currency);
var_dump($orderbook->data);
```

### Get Summary
```php
$summary = $exchange->summary($currency);
var_dump($summary->data);
```

### Create Order
#### Buy
```php
$amount = 0.001; // Quantidade da moeda - (FLOAT)
$type ="buy"; // Tipo da ordem - buy / sell (STRING)
$subtype = "limited"; // Subtipo da ordem - limited / market (STRING)
$unitPrice = 10000; // Preço de unidade da moeda - (FLOAT)
$buyOrder = $exchange->createOrder($currency, $amount, $type, $subtype, $unitPrice);
var_dump($buyOrder);
```

#### Sell
```php
$amount = 0.001; // Quantidade da moeda - (FLOAT)
$type ="sell"; // Tipo da ordem - buy / sell (STRING)
$subtype="limited"; // Subtipo da ordem - limited / market (STRING)
$unitPrice = 30000; // Preço de unidade da moeda - (FLOAT)
$sellOrder = $exchange->createOrder($currency, $amount, $type, $subtype, $unitPrice);
var_dump($sellOrder);
```

### Cancel Order
```php
$orderId = 'U2FsdGVkX1+qrxVqoDbSYh9wCvhhrP63SMy01Sn27Ag=';
$cancelOrder = $exchange->cancelOrder($orderId);
var_dump($cancelOrder);
```

### Get User Orders
```php
$status = 'waiting'; // Status da ordem - executed_completely / executed_partially / waiting / canceled (STRING)
$hours = 24;
$type = "sell"; // Tipo da ordem - buy / sell (STRING)
$userOrders = $exchange->userOrders($currency, $status, $hours, $type, $page_size, $current_page);
var_dump($userOrders->data);
```

### Estimated Price
```php
$amount = 100;
$type ="buy";
$estimatedPrice = $exchange->estimatedPrice($currency, $amount, $type);
var_dump($estimatedPrice->data);
```

### Get Balance
```php
$balance = $exchange->balance();
var_dump($balance->data);
```