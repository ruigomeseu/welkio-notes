<?php namespace Notes\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Notes\Commands\LoginUser;
use Notes\Github\GithubInterface;

class UsersController extends Controller {

    use DispatchesCommands;

    private $github;

    function __construct(GithubInterface $github)
    {
        $this->github = $github;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->dispatch(
            new LoginUser($request->get('token'), $this->github)
        );

        return redirect('/');
    }

    public function repositories()
    {
        $repos = $this->github->getRepositories();

        return view('github.repositories', [
            'repositories' => $repos
        ]);
    }

    public function issues($owner, $repository)
    {
        $issues = $this->github->getIssues($owner, $repository);

        return view('github.issues', [
            'issues' => $issues
        ]);
    }
}