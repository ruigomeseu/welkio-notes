<?php namespace Notes\Github;

interface GithubInterface {

    public function setToken($token);
    public function getUser();
    public function getRepositories();

    public function getIssues($owner, $repository);

}