<?php namespace Notes\Github;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class Github implements GithubInterface
{

    protected $apiUrl;
    protected $token;
    protected $guzzle;

    function __construct(Client $guzzle)
    {
        $this->guzzle = $guzzle;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getUser()
    {
        $request = $this->guzzle->createRequest('GET', '/user');

        $this->getUserToken();

        $request->setHeader('Authorization', 'token ' . $this->token);

        $result = $this->guzzle->send($request);

        return $result->json();
    }

    public function getRepositories()
    {
        $request = $this->guzzle->createRequest('GET', '/user/repos');

        $this->getUserToken();

        $request->setHeader('Authorization', 'token ' . $this->token);

        $result = $this->guzzle->send($request);

        return $result->json();
    }

    public function getIssues($owner, $repository)
    {
        $request = $this->guzzle->createRequest('GET', "/repos/{$owner}/{$repository}/issues");

        $this->getUserToken();

        $request->setHeader('Authorization', 'token ' . $this->token);

        $result = $this->guzzle->send($request);

        return $result->json();
    }

    protected function getUserToken()
    {
        if ($this->token == null) {
            if (Auth::user()) {
                $this->token = Auth::user()->token;
            }
        }
    }
}