<?php
namespace App\Services;

use App\Repositories\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\AuthenticationException;
use App\Exceptions\RegistrationException;

class AuthService implements AuthServiceInterface
{
    protected $authRepo;

    public function __construct(AuthRepositoryInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function register(array $data)
    {
        try {
            return $this->authRepo->createUser([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id'  => 2,
            ]);
        } catch (\Throwable $e) {
            throw new RegistrationException('Đăng ký thất bại.');
        }
    }

    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            throw new AuthenticationException('Email hoặc mật khẩu không đúng.');
        }

        request()->session()->regenerate();
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
