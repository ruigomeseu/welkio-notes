<?php namespace Notes\Http\Requests;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Notes\Commands\LoginUser;
use Notes\Note;

class UpdateNoteRequest extends Request {

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

        if(\Auth::check())
        {
            $noteId = $this->route('note');

            return Note::where('id', $noteId)
                ->where('user_id', \Auth::user()->id)->exists();
        }

        return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'message' => 'required'
		];
	}

}
