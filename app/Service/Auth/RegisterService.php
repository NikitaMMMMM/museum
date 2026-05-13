<?php

namespace App\Service\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterService
{
    public function registerUser(array $data): User
    {
        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'slug' => $this->generateUniqueSlug($data['name']),
            'role' => 'visitor',
            'last_login' => now()->toDate(),
            'avatar_url' => $data['avatar_url'] ?? null,
        ];
        
        $user = User::create($userData);

        return  $user;
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