<?php
namespace Thatsup;

use Psr\Http\Message\ResponseInterface;

class Response
{	
	protected $response;

	public function __construct(ResponseInterface $response)
	{
		$this->response = $response;
	}

	public function body()
	{
		return json_decode($this->response->getBody()->getContents());
	}

	public function data()
	{
		return $this->body()->data;
	}

	public function headers()
	{
		return $this->response->getHeaders();
	}

	public function code()
	{
		return $this->response->getStatusCode();
	}

	public function reason()
	{
		return $this->response->getReasonPhrase();
	}

	public function __call($method, $params)
	{
		return \call_user_func_array([$this->response, $method], $params);
	}

	public function __get($key)
	{
		return $this->response->{$key};
	}
}