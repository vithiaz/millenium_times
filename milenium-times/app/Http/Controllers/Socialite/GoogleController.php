<?php

namespace App\Http\Controllers\Socialite;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Laravel\Socialite\Facades\Socialite;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class GoogleController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function callback() {
        try {
            $user = Socialite::driver('google')->user();
            $find_user = User::where('google_id', '=', $user->id)->first();
        
            if ($find_user) {
                Auth::login($find_user);
            } else {
                $new_user = new User;

                $generator_rules = [
                    'table' => 'users',
                    'length' => '10',
                    'prefix' => date('ymd'),
                ];
                $id = IdGenerator::generate($generator_rules);

                $new_user->id = $id;
                $new_user->google_id = $user['id'];
                $new_user->email = $user['email'];
                
                if (array_key_exists('given_name', $user->user)) {
                    $new_user->first_name = $user->user['given_name'];

                    if (array_key_exists('family_name', $user->user)) {
                        $new_user->last_name = $user->user['family_name'];
                    }

                } else {
                    $new_user->first_name = $user->name;
                }

                $new_user->save();
                Auth::login($new_user);
            }

            return redirect(request()->header('Referer'));

        } catch (\Throwable $th) {
            return abort(403);
        }
    }


}
