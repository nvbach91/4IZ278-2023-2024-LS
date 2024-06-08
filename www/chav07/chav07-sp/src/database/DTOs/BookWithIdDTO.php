<?php 
class BookWithIdDTO{
    public int $id;
    public string $authorName;
    public string $title;
    public string $description;
    public float $price;
    public int $stock;
    public ?string $isbn13;
    public ?string $isbn10;
    public ?string $image_url;


    public function __construct(
        int $id,
        string $authorName,
        string $title,
        string $description,
        float $price,
        int $stock,
        ?string $isbn13,
        ?string $isbn10,
        ?string $image_url
        )
    {
        $this->id = $id;
        $this->authorName = $authorName;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
        $this->isbn13 = $isbn13;
        $this->isbn10 = $isbn10;
        $this->image_url = $image_url;
    }
}

?>