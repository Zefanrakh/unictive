<?php

namespace App\Services\Api;

use App\Models\Hobby;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    public function createUser(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        $this->insertHobbies($user, $data);

        $token = JWTAuth::fromUser($user);

        return [
            'message' => 'User created successfully',
            'access_token' => $token,
            'user' => $user
        ];
    }

    public function updateUserWithHobbies(User $user, array $data)
    {
        $user->fill([
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'password' => isset($data['password']) ? Hash::make($data['password']) : $user->password
        ]);
        if ($user->isDirty('name')) {
            if (User::where('email', $user->email)->where('id', '<>', $user->id)->exists()) {
                throw new \Exception('The email has already been taken by another user.');
            }
        }

        $user->save();
        $this->insertHobbies($user, $data);

        return $user->load('hobbies');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return ['message' => 'User deleted successfully'];
    }

    public function insertHobbies(User $user, array $data)
    {
        if (isset($data['hobbies'])) {
            $user->hobbies()->delete();
            foreach ($data['hobbies'] as $hobbyName) {
                if (!empty($hobbyName)) {
                    Hobby::create([
                        'name' => $hobbyName,
                        'user_id' => $user->id,
                    ]);
                }
            }
        }
    }
}
