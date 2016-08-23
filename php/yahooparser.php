<?php

echo "yahooparser by jimps\n";

for($i=0;$i<=10;$i++){
	$yp = new YahooParser;
	$yp->set_query('filetype:php inurl:id=');
	$yp->set_page($i);
	$yp->get_results();
	$yp->print_results();
}

class YahooParser {
	
	var $url = 'http://se.search.yahoo.com/search?p=%s&b=%d&toggle=1&cop=mss&ei=UTF-8&fr=yfp-t-731';
	
	protected	$query,
				$page = 1,
				$curl_handler,
				$results;

	var $urls = array();
	
	function set_query($query = NULL){
	
		if(isset($query[0])){
			$this->query = $query;
			return TRUE;
		}
		
		return FALSE;
		
	}
	
	function get_url(){
		return sprintf($this->url, urlencode($this->query), $this->get_page());
		
	}
	
	function set_page($page = NULL){
		
		if( ! isset($page) OR ! is_numeric($page)){
			return FALSE;
		}
		
		if($page > 0){
			$this->page = $page;
		}
		
	}
	
	function get_page(){
		
		if($this->page == 1){
			return 1;
		}
		
		return ((($this->page - 1) * 10) + 1);
	}
	
	function get_results(){
		
		if( ! isset($this->query[1])){
			exit('No query' . PHP_EOL);
		}
		
		
		if( ! function_exists('curl_init')){
			exit('cURL is required' . PHP_EOL);
		}
		
		$this->curl_handler = curl_init();
		
		curl_setopt($this->curl_handler, CURLOPT_URL, $this->get_url());
		curl_setopt($this->curl_handler, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($this->curl_handler, CURLOPT_SSL_VERIFYPEER, FALSE ); 
		curl_setopt($this->curl_handler, CURLOPT_SSL_VERIFYHOST, FALSE);  
		curl_setopt($this->curl_handler, CURLOPT_HTTPHEADER, array(
			'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.9) Firefox/2.0.0.9',
			'Connection: Close'
		));		
		
		$this->results = curl_exec($this->curl_handler);
		curl_close($this->curl_handler);
		
		preg_match_all('/<a class="yschttl spt" href="(.*?)"(.*?)>/', $this->results, $matches);
		
		
		foreach($matches[1] as $yahoo_url){
			$this->urls[] = urldecode(end(preg_split('/\*\*/', $yahoo_url)));
		}
		
	}
	
	function print_results(){
		if(is_array($this->urls) && count($this->urls) > 0){
			foreach($this->urls as $url){
				echo $url . PHP_EOL;
			}
		}
	}
	
}
