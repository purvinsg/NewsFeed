<?php declare(strict_types=1);

namespace App\Models;

class User
{

    private string $email;
    private ?string $password;
    private ?string $name;
    private ?int $id;

    public function __construct(
        string $email,
        ?string $password = null,
        string $name = null,
        ?int    $id = null

    )
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
}