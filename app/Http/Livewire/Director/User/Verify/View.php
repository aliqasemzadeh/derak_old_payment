<?php

namespace App\Http\Livewire\Admin\User\Verify;

use App\Models\Inquiry;
use App\Models\Token;
use App\Models\User;
use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class View extends Component
{
    use LivewireAlert;
    public $status = 'inquiry';
    public $verify;
    public $note;

    public function inquiry()
    {
        $token = Token::where('name', 'jibimo')->orderBy('id', 'DESC')->first();
        $options = json_decode($token->options, true);
        $headers = array(
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$options['access_token'],
        );
        $client = new \GuzzleHttp\Client();

        $request_body = [
            'national_code' => $this->verify->id_number,
            'birth_date' => $this->verify->birth_at,
            'first_name' => $this->verify->first_name,
            'last_name' => $this->verify->last_name,
        ];

        $inquiry = new Inquiry();
        $inquiry->user_id = $this->verify->user_id;
        $inquiry->method = 'national-code-inquiry';
        $inquiry->request = json_encode($request_body, true);
        $inquiry->save();

        try {
            $response = $client->request('POST','https://jibimo.com/v2/national-code-inquiry', array(
                    'headers' => $headers,
                    'json' => $request_body,
                )
            );

            $data = json_decode($response->getBody()->getContents(), true);

            $inquiry->data = json_encode($data, true);
            $inquiry->save();


            if($data['matching']['status'] == 'match') {
                $user = User::findOrFail($this->verify->user_id);
                $user->first_name = $data['owner']['firstName'];
                $user->last_name = $data['owner']['lastName'];
                $user->id_number = $this->verify->id_number;
                $user->verified_at = Carbon::now()->format('Y-m-d H:i:s');
                $user->user_verify_id = $this->verify->id;
                $user->save();
            }
            $this->status = $data['matching']['status'];

        }
        catch (\GuzzleHttp\Exception\BadResponseException $e) {
            // handle exception or api errors.
            Log::info($e->getResponse()->getBody()->__toString());
        }
    }

    public function mount(UserVerify $verify)
    {
        $this->verify = $verify;

        $this->first_name = $verify->first_name;
        $this->last_name = $verify->last_name;
        $this->id_number = $verify->id_number;
        $this->birth_at = $verify->birth_at;
        $this->phone = $verify->phone;
        $this->country = $verify->country;
        $this->region = $verify->region;
        $this->city = $verify->city;
        $this->zipcode = $verify->zipcode;
        $this->address = $verify->address;
        $this->random_string = $verify->random_string;
    }

    public function verify()
    {
        $user = User::findOrFail($this->verify->user_id);

        $user->first_name = $this->verify->first_name;
        $user->last_name = $this->verify->last_name;
        $user->id_number = $this->verify->id_number;
        $user->verified_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->user_verify_id = $this->verify->id;
        $user->save();

        $this->verify->status = 'accept';
        $this->verify->save();

        activity()->log('Verify User:'. $this->verify->user_id);

        $this->emitTo(\App\Http\Livewire\Admin\User\Verify\Index::getName(), 'updateList');
        $this->emit('hideModal');
        $this->alert('success', __('bap.accepted'));
    }


    public function reject()
    {
        $this->verify->status = 'reject';
        $this->verify->note = $this->note;
        $this->verify->save();

        activity()->log('Reject User:'. $this->verify->user_id);

        $this->emitTo(\App\Http\Livewire\Admin\User\Verify\Index::getName(), 'updateList');
        $this->emit('hideModal');
        $this->alert('success', __('bap.rejected'));
    }

    public function render()
    {
        return view('livewire.admin.user.verify.view');
    }
}
