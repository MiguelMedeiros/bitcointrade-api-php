<?php

class BitcoinTrade
{
    protected $apiKey = null;

    public function __construct()
    {
      $arguments = func_get_args();
      $this->apiKey = $arguments[0];
    }

    public function ticker($currency = 'BTC')
    {
      $apiURL = "https://api.bitcointrade.com.br/v1/public/{$currency}/ticker";
      
      return $this->initCurl($apiURL);
    }

    public function orders($currency = 'BTC')
    {
      $apiURL = "https://api.bitcointrade.com.br/v1/public/{$currency}/orders";
      
      return $this->initCurl($apiURL);
    }

    public function trades(
      $currency = 'BTC',
      $hours = 1,
      $page_size = 100,
      $current_page = 1
    ) {
      $timeZone = new DateTimeZone('Brazil/East');

      $start_time = new DateTime('now');
      $start_time->format(DateTime::ATOM);
      $start_time->setTimezone($timeZone);
      $start_time->modify('-'.$hours.' hour');
      $start_time = date_format($start_time, DateTime::ATOM);

      $end_time = new DateTime('now');
      $end_time->format(DateTime::ATOM);
      $end_time->setTimezone($timeZone);
      $end_time = date_format($end_time, DateTime::ATOM);

      $apiURL = "https://api.bitcointrade.com.br/v1/public/{$currency}/trades?start_time={$start_time}&end_time={$end_time}&page_size={$page_size}&current_page={$current_page}";

      return $this->initCurl($apiURL);
    }

    public function orderbook($currency = 'BTC')
    {
      $apiURL = "https://api.bitcointrade.com.br/v1/market?currency={$currency}";

      return $this->initCurl($apiURL);
    }

    public function summary($currency = 'BTC')
    {
      $apiURL = "https://api.bitcointrade.com.br/v1/market/summary?currency={$currency}";

      return $this->initCurl($apiURL);
    }

    public function userOrders(
      $currency = "BTC",
      $status = "executed_completely",
      $hours = 24,
      $type = "buy",
      $page_size = 100,
      $current_page = 1
    ) {
      $timeZone = new DateTimeZone('Brazil/East');

      $start_time = new DateTime('now');
      $start_time->format(DateTime::ATOM);
      $start_time->setTimezone($timeZone);
      $start_time->modify('-'.$hours.' hour');
      $start_time = date_format($start_time, DateTime::ATOM);

      $end_time = new DateTime('now');
      $end_time->format(DateTime::ATOM);
      $end_time->setTimezone($timeZone);
      $end_time = date_format($end_time, DateTime::ATOM);

      $apiURL = "https://api.bitcointrade.com.br/v1/market/user_orders/list?status={$status}&start_date={$start_time}&end_date={$end_time}&currency={$currency}&type={$type}&page_size={$page_size}&current_page={$current_page}";

      return $this->initCurl($apiURL);
    }

    public function cancelOrder($id = '')
    {
      $fields = compact('id');

      return $this->initCurl($apiURL, $fields, 'DELETE');
    }

    public function estimatedPrice($currency = "BTC", $amount = 0, $type ="buy")
    {
      $apiURL = "https://api.bitcointrade.com.br/v1/market/estimated_price?amount={$amount}&currency={$currency}&type={$type}";

      return $this->initCurl($apiURL);
    }

    public function balance()
    {
      $apiURL = 'https://api.bitcointrade.com.br/v1/wallets/balance';

      return $this->initCurl($apiURL);
    }

    public function createOrder(
      $currency = "BTC",
      $amount = 0,
      $type ="buy",
      $subtype="limited",
      $unitPrice = 0
    ) {
      $fields = compact('currency', 'amount', 'type', 'subtype', 'unitPrice');

      $apiURL = 'https://api.bitcointrade.com.br/v1/market/create_order';

      return $this->initCurl($apiURL, $fields, 'POST');
    }

    private function initCurl($url = '', $fields = [], $method = 'GET')
    {
      $curl = curl_init();

      $fields = json_encode($fields);

      $header = [
        "Authorization: ApiToken {$this->apiKey}",
        'Content-Type: application/json'
      ];

      $options = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_POSTFIELDS => $fields,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => $header
      ];

      curl_setopt_array($curl, $options);

      $response = curl_exec($curl);
      
      $err = curl_error($curl);

      curl_close($curl);

      return $err
        ? "cURL Error #: {$err}"
        : json_decode($response);
    }
}
