<?php
namespace Thatsup;

use Thatsup\Exceptions\InvalidKeyException;

class Thatsup
{	
	const VERSION = 'b1.0';

	const DEFAULT_API_VERSION = 'v1.0';

	const DEFAULT_API_URL = 'https://api.thatsup.se';

	public function __construct($config = []) {
		if(is_string($config)) {
			$config = [ 'key' => $config ];
		}
		$this->config = array_merge(
			[
				'key' => null,
				'version' => static::DEFAULT_API_VERSION,
				'url' => static::DEFAULT_API_URL,
				'language' => null
			],
			$config
		);

		if(!$this->config['key']) {
			throw new InvalidKeyException();
		}

		$this->httpClient = new HttpClient($this->config);
	}

	public static function config(array $config = []) {
		return new self($config);
	}

	public function get(string $endpoint, array $query = [])
	{
		return $this->httpClient->get($endpoint, $query);
	}

	public function post(string $endpoint, $data = [])
	{
		return $this->httpClient->post($endpoint, $data);
	}

	public function put(string $endpoint, $data = [])
	{
		return $this->httpClient->put($endpoint, $data);
	}

	public function patch(string $endpoint, $data = [])
	{
		return $this->httpClient->patch($endpoint, $data);
	}

}