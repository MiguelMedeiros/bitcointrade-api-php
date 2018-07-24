<?php
  
	class bitcoinTrade{

		protected $apiKey = null;
        protected $curl = null;
    
		public function __construct(){
            $arguments = func_get_args();	
            $this->curl = curl_init();
            $this->apiKey = $arguments[0];
        }
        
        public function ticker ($currency = 'BTC'){
		
            $this->curl = curl_init();

            curl_setopt_array($this->curl, array(
                CURLOPT_URL => "https://api.bitcointrade.com.br/v1/public/".$currency."/ticker",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
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

        public function orders ($currency = 'BTC'){

            $this->curl = curl_init();

            curl_setopt_array($this->curl, array(
                CURLOPT_URL => "https://api.bitcointrade.com.br/v1/public/".$currency."/orders",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
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

            $this->curl = curl_init();

            curl_setopt_array($this->curl, array(
                CURLOPT_URL => "https://api.bitcointrade.com.br/v1/public/".$currency."/trades?start_time=".$start_time."&end_time=".$end_time."&page_size=".$page_size."&current_page=".$current_page,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
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

        public function orderbook($currency = 'BTC'){

            $this->curl = curl_init();

            curl_setopt_array($this->curl, array(
                CURLOPT_URL => "https://api.bitcointrade.com.br/v1/market?currency=".$currency,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
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
        
        public function summary($currency = 'BTC'){

            $this->curl = curl_init();

            curl_setopt_array($this->curl, array(
                CURLOPT_URL => "https://api.bitcointrade.com.br/v1/market/summary?currency=".$currency,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
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

            $this->curl = curl_init();

            curl_setopt_array($this->curl, array(
                CURLOPT_URL => "https://api.bitcointrade.com.br/v1/market/user_orders/list?status=".$status."&start_date=".$start_time."&end_date=".$end_time."&currency=".$currency."&type=".$type."&page_size=".$page_size."&current_page=".$current_page,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
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

        public function cancelOrder ($orderId = ''){

            $this->curl = curl_init();

            curl_setopt_array($this->curl, array(
                CURLOPT_URL => "https://api.bitcointrade.com.br/v1/market/user_orders/",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "DELETE",
                CURLOPT_POSTFIELDS => "{\n  \"id\": \"".$orderId."\"\n}",
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

        public function estimatedPrice($currency = "BTC", $amount = 0, $type ="buy" ){

            $this->curl = curl_init();

            curl_setopt_array($this->curl, array(
                CURLOPT_URL => "https://api.bitcointrade.com.br/v1/market/estimated_price?amount=".$amount."&currency=".$currency."&type=".$type,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
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

        public function balance (){

            $this->curl = curl_init();

            curl_setopt_array($this->curl, array(
                CURLOPT_URL => "https://api.bitcointrade.com.br/v1/wallets/balance",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
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

        public function createOrder($currency = "BTC", $amount = 0, $type ="buy", $subtype="limited", $unitPrice = 0){

            $this->curl = curl_init();

            curl_setopt_array($this->curl, array(
                CURLOPT_URL => "https://api.bitcointrade.com.br/v1/market/create_order",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\n  \"currency\":\"".$currency."\",\n  \"amount\": ".$amount.",\n  \"type\": \"".$type."\",\n  \"subtype\": \"".$subtype."\",\n  \"unit_price\": ".$unitPrice."\n}",
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

    }
?>