<?php
// Session helpers + a tiny JSON "user store" (no database needed for this activity).
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('USERS_FILE', __DIR__ . '/../data/users.json');

function load_users(): array
{
    if (!file_exists(USERS_FILE)) {
        // Seed a demo account so the login page can be tested right away.
        $seed = ['gabbb' => [
            'email'    => 'gabbb@example.com',
            'phone'    => '09171234567',
            'password' => password_hash('Jurassic1', PASSWORD_DEFAULT),
        ]];
        file_put_contents(USERS_FILE, json_encode($seed, JSON_PRETTY_PRINT));
        return $seed;
    }
    return json_decode(file_get_contents(USERS_FILE), true) ?: [];
}

function save_users(array $users): void
{
    file_put_contents(USERS_FILE, json_encode($users, JSON_PRETTY_PRINT));
}

function require_login(): void
{
    if (empty($_SESSION['user'])) {
        header('Location: login.php');
        exit;
    }
}
