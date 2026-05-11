<?php

namespace App\Service\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\NewAccessToken;

class RegisterService
{
    public function registerUser(array $data): array
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'slug' => $this->generateUniqueSlug($data['name']),
            'role' => 'visitor',
        ];

        $user = User::create($userData);

        $tokenName = 'mobile-app-' . now()->timestamp;
        $token = $user->createToken($tokenName);

        return [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
    }

    private function generateUniqueSlug(string $name): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (User::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }
}