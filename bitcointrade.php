<?php

	class bitcoinTrade{

        protected $apiKey = null;
        protected $curl = null;
    
		public function __construct(){
            $arguments = func_get_args();	
            $this->curl = curl_init();
            $this->apiKey = $arguments[0];
        }
        
        public function initCurl($url = '', $fields = array(), $method = "GET"){

            $fields = json_encode($fields);
            
            curl_setopt_array($this->curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_POSTFIELDS => $fields,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_HTTPHEADER => array(
                    "Authorization: ApiToken ".$this->apiKey,
                    "Content-Type: application/json"
                )
            ));

            $response = curl_exec($this->curl);
            $err = curl_error($this->curl);

            curl_close($this->curl);
            
            if ($err) {
                return "cURL Error #:" . $err;
            } else {
                $response = json_decode($response);
                return $response;
            }            
        }

        public function ticker ($currency = 'BTC'){
            
            $url = "https://api.bitcointrade.com.br/v1/public/".$currency."/ticker";
            return $this->initCurl($url);

        }

        public function orders ($currency = 'BTC'){

            $url = "https://api.bitcointrade.com.br/v1/public/".$currency."/orders";
            return $this->initCurl($url);

        }

        public function trades ($currency = 'BTC', $hours = 1, $page_size = 100, $current_page = 1){
            
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

            $url = "https://api.bitcointrade.com.br/v1/public/".$currency."/trades?start_time=".$start_time."&end_time=".$end_time."&page_size=".$page_size."&current_page=".$current_page;
            return $this->initCurl($url);

        }

        public function orderbook($currency = 'BTC'){

            $url = "https://api.bitcointrade.com.br/v1/market?currency=".$currency;
            return $this->initCurl($url);

        }
        
        public function summary($currency = 'BTC'){

            $url = "https://api.bitcointrade.com.br/v1/market/summary?currency=".$currency;
            return $this->initCurl($url);

        }

        public function userOrders($currency = "BTC", $status = "executed_completely",  $hours = 24, $type = "buy", $page_size = 100, $current_page = 1){

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

            $url = "https://api.bitcointrade.com.br/v1/market/user_orders/list?status=".$status."&start_date=".$start_time."&end_date=".$end_time."&currency=".$currency."&type=".$type."&page_size=".$page_size."&current_page=".$current_page;
            return $this->initCurl($url);

        }

        public function cancelOrder ($orderId = ''){

            $fields = array(
                "id"   => $orderId
            );

            $url = "https://api.bitcointrade.com.br/v1/market/user_orders/";
            $method = "DELETE";

            return $this->initCurl($url, $fields, $method);

        }

        public function estimatedPrice($currency = "BTC", $amount = 0, $type ="buy" ){

            $url = "https://api.bitcointrade.com.br/v1/market/estimated_price?amount=".$amount."&currency=".$currency."&type=".$type;
            return $this->initCurl($url);

        }

        public function balance (){

            $url = "https://api.bitcointrade.com.br/v1/wallets/balance";
            return $this->initCurl($url);

        }

        public function createOrder($currency = "BTC", $amount = 0, $type ="buy", $subtype="limited", $unitPrice = 0){

            $fields = array(
                "currency"   => $currency,
                "amount"     => $amount,
                "type"       => $type,
                "subtype"    => $subtype,
                "unitPrice"  => $unitPrice,
            );

            $url = "https://api.bitcointrade.com.br/v1/market/create_order";
            $method = 'POST';

            return $this->initCurl($url, $fields, $method);

        }

    }
?>