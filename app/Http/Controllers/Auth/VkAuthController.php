<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class VkAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('vkontakte')->scopes(['email'])->redirect();
    }

    public function callback(): RedirectResponse
    {
        $vkUser = Socialite::driver('vkontakte')->user();

        $email = $vkUser->getEmail();
        $name = $vkUser->getName() ?: ($vkUser->user['first_name'] ?? '') . ' ' . ($vkUser->user['last_name'] ?? '');
        $vkId = (string) $vkUser->getId();

        $user = User::query()
            ->when($email, fn ($q) => $q->orWhere('email', $email))
            ->orWhere('vk_id', $vkId)
            ->first();

        if (! $user) {
            $user = User::create([
                'name' => trim($name) ?: 'VK User',
                'email' => $email,
                'password' => Hash::make(str()->random(32)),
                'vk_id' => $vkId,
            ]);
        } else {
            if (! $user->vk_id) {
                $user->vk_id = $vkId;
                $user->save();
            }
        }

        Auth::login($user, remember: true);

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
