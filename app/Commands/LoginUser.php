<?php namespace Notes\Commands;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Notes\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;
use Notes\Github\GithubInterface;
use Notes\User;

class LoginUser extends Command implements SelfHandling {

    protected $token;
    protected $github;

    /**
     * Create a new command instance.
     *
     * @param $token
     * @param GithubInterface $github
     */
	public function __construct($token, GithubInterface $github)
	{
		$this->token = $token;
        $this->github = $github;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
        try {
            $user = User::whereToken($this->token)->firstOrFail();
        } catch(ModelNotFoundException $exception)
        {
            $user = $this->signUp();
        }

        Auth::loginUsingId($user->id);

	}

    protected function signUp()
    {
        $this->github->setToken($this->token);
        $githubUser = $this->github->getUser('3a96ff34e7d185a16ffa816693cb8e22567cf324');

        $user = new User;
        $user->username = $githubUser['login'];
        $user->name = $githubUser['name'];
        $user->token = $this->token;
        $user->avatar = $githubUser['avatar_url'];
        $user->save();

        return $user;
    }

}
