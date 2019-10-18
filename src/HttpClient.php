<?php
namespace Thatsup;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class HttpClient
{
	protected $config;

	public function __construct($config = [])
	{
		$this->config = $config;

		$clientConfig = [
			'base_uri' => $this->getBaseUri()
		];

        $clientConfig[RequestOptions::HEADERS] = array_merge(
        	[
	            'User-Agent' => 'thatsup/php/'.Thatsup::VERSION,
	            'Content-Type' => 'application/json',
	            'x-api-version' => $this->config['version'],
	            'x-api-key' => $this->config['key'],
	            'Accept-Language' => $this->config['language']
	        ],
	        $config[RequestOptions::HEADERS]?? []
		);

		$this->client = new Client(
			array_merge(
				[
					'base_uri' => $this->getBaseUri(),
				],
				$clientConfig
			)
		);
	}

	protected function getBaseUri($config = [])
	{
		return rtrim($this->config['url'],'/') . '/' . trim($this->config['version'],'/') . '/';
	}
	
	public function get(string $path, array $query = [], array $options = [])
	{
		return $this->request(
			'GET',
			$path,
			$options + [
				RequestOptions::QUERY => $query
			]
		);
	}

	public function post(string $path, $data = [], array $options = [])
	{
		return $this->request(
			'POST',
			$path,
			$options + [
				RequestOptions::JSON => $data
			]
		);
	}

	public function put(string $path, $data = [], array $options = [])
	{
		return $this->request(
			'PUT',
			$path,
			$options + [
				RequestOptions::JSON => $data
			]
		);
	}

	public function patch(string $path, $data = [], array $options = [])
	{
		return $this->request(
			'PATCH',
			$path,
			$options + [
				RequestOptions::JSON => $data
			]
		);
	}

	public function head(string $path, $data = [], array $options = [])
	{
		return $this->request(
			'HEAD',
			$path,
			$options + [
				RequestOptions::JSON => $data
			]
		);
	}

	public function options(string $path, $data = [], array $options = [])
	{
		return $this->request(
			'OPTIONS',
			$path,
			$options + [
				RequestOptions::JSON => $data
			]
		);
	}

	public function request(string $method, string $path, array $options = [])
	{
		return new Response($this->client->request(
			$method,
			ltrim($path,'/'),
			$options
		));
	}

}