<?php declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;

class Article
{
    private int $authorId;
    private string $title;
    private string $content;
    private ?string $imageUrl;
    private ?User $author = null;
    private string $date;
    private ?int $id;

    public function __construct(
        int     $authorId,
        string  $title,
        string  $content,
        ?string $imageUrl,
        ?string  $date = null,
        ?int    $id = null

    )
    {
        $this->authorId = $authorId;
        $this->title = $title;
        $this->content = $content;
        $this->imageUrl = $imageUrl;
        $this->date = $date ?? Carbon::now()->toDateTimeString();
        $this->id = $id;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function setAuthor(User $author)
    {
        $this->author = $author;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function update(array $attributes): void
    {
        foreach ($attributes as $attribute => $value) {
            $this->{$attribute} = $value;
        }
    }

}