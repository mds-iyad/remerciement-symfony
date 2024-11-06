<?php
namespace App\Security;

use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CredentialsInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class PlainTextCredentials implements CredentialsInterface
{
    private string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function validateCredentials(PasswordAuthenticatedUserInterface $user): void
    {
        // Direct comparison without hashing
        if ($user->getPassword() !== $this->password) {
            throw new BadCredentialsException('Invalid credentials.');
        }
    }

    public function isResolved(): bool
    {
        return true;
    }
}
