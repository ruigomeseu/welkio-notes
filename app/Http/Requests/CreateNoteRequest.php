<?php namespace Notes\Http\Requests;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Support\Facades\Auth;
use Notes\Commands\LoginUser;

class CreateNoteRequest extends Request {

    use DispatchesCommands;

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        $this->dispatch(
            new LoginUser(\Request::get('token'))
        );

        return Auth::check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'message' => 'required',
		];
	}

}
