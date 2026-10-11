<?php
const RX_USERNAME = '/^[A-Za-z][A-Za-z0-9_]{2,19}$/';                    // 3-20 chars, Need na magstart sa letter tas the rest kanya kanya na
const RX_EMAIL    = '/^[A-Za-z0-9._%+\-]+@[A-Za-z0-9\-]+(\.[A-Za-z0-9\-]+)*\.[A-Za-z]{2,}$/';
const RX_PHONE    = '/^(09|\+639)\d{9}$/';                                // PH mobile: 09XXXXXXXXX o kaya +639XXXXXXXXX
const RX_LOGIN_PASSWORD = '/^\S{6,}$/';                                       // login: 6+ chars, walang spaces
const RX_PASSWORD = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';            // dapat 8+ chars, upper, lower, digit

function clean(string $value): string
{
    return trim($value);
}

function validate_username(string $v): ?string
{
    if ($v === '') return 'Please enter a username.';
    if (!preg_match(RX_USERNAME, $v)) return 'Username must be 3-20 characters, start with a letter, and use only letters, numbers or underscores.';
    return null;
}

function validate_email(string $v): ?string
{
    if ($v === '') return 'Please enter your email address.';
    if (!preg_match(RX_EMAIL, $v)) return 'Please enter a valid email address (e.g. name@example.com).';
    return null;
}

function validate_phone(string $v): ?string
{
    if ($v === '') return 'Please enter your phone number.';
    if (!preg_match(RX_PHONE, $v)) return 'Phone number must look like 09123456789 or +639123456789.';
    return null;
}

function validate_password(string $v, string $username = ''): ?string
{
    if ($v === '') return 'Please enter a password.';
    if (!preg_match(RX_PASSWORD, $v)) return 'Password must be at least 8 characters with an uppercase letter, a lowercase letter and a number.';
    if ($username !== '' && stripos($v, $username) !== false) return 'Password must not contain your username.';
    return null;
}

function validate_confirm(string $v, string $password): ?string
{
    if ($v === '') return 'Please re-enter your password.';
    if ($v !== $password) return 'The two passwords that you entered do not match.';
    return null;
}

function field_error(array $errors, string $key): string
{
    $show = isset($errors[$key]) ? ' show' : '';
    $msg  = isset($errors[$key]) ? htmlspecialchars($errors[$key]) : '';
    return '<div class="fb-error' . $show . '"><i class="bi bi-exclamation-circle-fill"></i><span>' . $msg . '</span></div>';
}

function field_class(array $errors, string $key): string
{
    return 'form-control' . (isset($errors[$key]) ? ' is-invalid-fb' : '');
}

function old(string $key): string
{
    return htmlspecialchars($_POST[$key] ?? '', ENT_QUOTES);
}
