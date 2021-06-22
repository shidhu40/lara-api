<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChannelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'channel_name' => ['required','unique:channels'],
            'program_id' => ['required', 'numeric'],
			'epg_date' => ['required', 'date_format:Y-m-d'],
            'epg_start_time' => ['required', 'date_format:Y-m-d H:i:s'],
			'epg_end_time' => ['required', 'date_format:Y-m-d H:i:s']
        ];
    }
}
