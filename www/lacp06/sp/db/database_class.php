<?php

require_once 'db.php';

class BooksDB extends DatabaseEshop
{
  public function findAll()
  {
    $query = "SELECT * FROM book;";
    return $this->runQuery($query, []);
  }
  public function findById($id)
  {
    $query = "SELECT * FROM book WHERE id IN (:id);";
    return $this->runQuery($query, [
      ':id' => $id
    ]);
  }
  public function countAll()
  {
    $query = "SELECT COUNT(*) FROM book;";
    return $this->runCount($query, []);
  }
  public function findBooksPage($nBooksPerPage, $offset)
  {
    $query = "SELECT * FROM book ORDER BY id DESC LIMIT :nBooksPerPage OFFSET :offset";
    $statement = $this->pdo->prepare($query);
    $statement->bindParam(':nBooksPerPage', $nBooksPerPage, PDO::PARAM_INT);
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
  public function updateBook($id, $name, $author, $price, $discount, $units, $publish_date, $language, $image, $description, $pages, $rating, $publisher_id, $genre_id, $world_id)
  {
    $query = "UPDATE book SET name = :name, author = :author, price = :price, discount = :discount, 
    units = :units, publish_date = :publish_date, language = :language, image = :image, 
    description = :description, pages = :pages, rating = :rating, 
    publisher_id = :publisher_id, genre_id = :genre_id, world_id = :world_id  WHERE id = :id";
    return $this->runExecute(
      $query,
      [
        ':id' => $id,
        ':name' => $name,
        ':author' => $author,
        ':price' => $price,
        ':discount' => $discount,
        ':units' => $units,
        ':publish_date' => $publish_date,
        ':language' => $language,
        ':image' => $image,
        ':description' => $description,
        ':pages' => $pages,
        ':rating' => $rating,
        ':publisher_id' => $publisher_id,
        ':genre_id' => $genre_id,
        ':world_id' => $world_id,
      ]
    );
  }
  public function updateTimestamp($id, $timestamp)
  {
    $query = "UPDATE book SET last_edit = :timestampp WHERE id = :id";
    return $this->runExecute(
      $query,
      [
        ':id' => $id,
        ':timestampp' => $timestamp,
      ]
    );
  }
}

class UsersDB extends DatabaseEshop
{
  public function findUsers($email)
  {
    $query = "SELECT * FROM user WHERE email != :email";
    return $this->runQuery(
      $query,
      [
        ':email' => $email
      ]
    );
  }
  public function findUser($email)
  {
    $query = "SELECT * FROM user WHERE email = :email";
    return $this->runQuery(
      $query,
      [
        ':email' => $email
      ]
    );
  }
  public function createUser($email, $password)
  {
    $query = "INSERT INTO user (email, password) VALUES (:email, :password)";
    return $this->runExecute(
      $query,
      [
        ':email' => $email,
        ':password' => $password,
      ]
    );
  }
  public function changePrivileges($email, $privileges)
  {
    $query = "UPDATE user SET privileges = :privileges WHERE email = :email";
    return $this->runExecute(
      $query,
      [
        ':email' => $email,
        ':privileges' => $privileges,
      ]
    );
  }
}

class OrdersDB extends DatabaseEshop
{
  public function createOrder($user_id, $timestamp, $overall_price, $state)
  {
    $query = "INSERT INTO orders (user_id, timestamp, overall_price, state) VALUES (:user_id, :timestamp, :overall_price, :state)";
    return $this->runExecute(
      $query,
      [
        ':user_id' => $user_id,
        ':timestamp' => $timestamp,
        ':overall_price' => $overall_price,
        ':state' => $state,
      ]
    );
  }
}

class BookOrdersDB extends DatabaseEshop
{
  public function createBookOrder($order_id, $book_id, $units, $price)
  {
    $query = "INSERT INTO book_order (order_id, book_id, units, price) VALUES (:order_id, :book_id, :units, :price)";
    return $this->runExecute(
      $query,
      [
        ':order_id' => $order_id,
        ':book_id' => $book_id,
        ':units' => $units,
        ':price' => $price,
      ]
    );
  }
}

class WishListsDB extends DatabaseEshop
{
  public function findAll($user_id)
  {
    $query = "SELECT * FROM wishlist WHERE user_id = :user_id";
    return $this->runQuery(
      $query,
      [
        ':user_id' => $user_id
      ]
    );
  }

  public function createWishlistBook($user_id, $book_id)
  {
    $query = "INSERT INTO wishlist (user_id, book_id) VALUES (:user_id, :book_id)";
    return $this->runExecute(
      $query,
      [
        ':user_id' => $user_id,
        ':book_id' => $book_id,
      ]
    );
  }

  public function deleteWishlistBook($user_id, $book_id)
  {
    $query = "DELETE FROM wishlist WHERE user_id = :user_id AND book_id = :book_id";
    return $this->runExecute(
      $query,
      [
        ':user_id' => $user_id,
        ':book_id' => $book_id,
      ]
    );
  }
}

class GenresDB extends DatabaseEshop
{
  public function findAll()
  {
    $query = "SELECT * FROM genre;";
    return $this->runQuery($query, []);
  }
}

class PublishersDB extends DatabaseEshop
{
  public function findAll()
  {
    $query = "SELECT * FROM publisher;";
    return $this->runQuery($query, []);
  }
}

class WorldsDB extends DatabaseEshop
{
  public function findAll()
  {
    $query = "SELECT * FROM world;";
    return $this->runQuery($query, []);
  }
}
