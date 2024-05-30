<?php

require_once 'db.php';

class BooksDB extends DatabaseEshop
{
  public function findRelated($author, $genre, $world, $publisher, $order, $new_release, $limit, $offset)
  {
    $query = "SELECT * FROM book WHERE 1=1";
    $params = [];

    if ($author && is_string($author)) {
      $query .= " AND author LIKE :author";
      $params[':author'] = "%$author%";
    } elseif (is_array($author)) {
      $authorPlaceholders = [];
      foreach ($author as $index => $author_name) {
        $authorPlaceholder = ":author{$index}";
        $authorPlaceholders[] = $authorPlaceholder;
        $params[$authorPlaceholder] = $author_name;
      }
      $query .= " AND author IN (" . implode(", ", $authorPlaceholders) . ")";
    }
    if ($genre && is_string($genre) or is_numeric($genre)) {
      $query .= " AND genre_id = :genre";
      $params[':genre'] = $genre;
    } elseif (is_array($genre)) {
      $genrePlaceholders = [];
      foreach ($genre as $index => $genre_id) {
        $genrePlaceholder = ":genre{$index}";
        $genrePlaceholders[] = $genrePlaceholder;
        $params[$genrePlaceholder] = $genre_id;
      }
      $query .= " OR genre_id IN (" . implode(", ", $genrePlaceholders) . ")";
    }

    if ($world && is_string($world) or is_numeric($world)) {
      $query .= " AND world_id = :world";
      $params[':world'] = $world;
    } elseif (is_array($world)) {
      $worldPlaceholders = [];
      foreach ($world as $index => $world_id) {
        $worldPlaceholder = ":world{$index}";
        $worldPlaceholders[] = $worldPlaceholder;
        $params[$worldPlaceholder] = $world_id;
      }
      $query .= " OR world_id IN (" . implode(", ", $worldPlaceholders) . ")";
    }
    if ($publisher && is_string($publisher) or is_numeric($publisher)) {
      $query .= " AND publisher_id = :publisher";
      $params[':publisher'] = $publisher;
    } elseif (is_array($publisher)) {
      $publisherPlaceholders = [];
      foreach ($publisher as $index => $publisher_id) {
        $publisherPlaceholder = ":publisher{$index}";
        $publisherPlaceholders[] = $publisherPlaceholder;
        $params[$publisherPlaceholder] = $publisher_id;
      }
      $query .= " OR publisher_id IN (" . implode(", ", $publisherPlaceholders) . ")";
    }
    if ($new_release) {
      $query .= " AND publish_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH) AND publish_date <= NOW()";
    }
    if ($order) {
      if ($order == 'not_published') {
        $query .= " AND publish_date > NOW()";
      } else {
        $validOrders = [
          'date_asc' => 'publish_date ASC',
          'date_desc' => 'publish_date DESC',
          'price_asc' => '(price - (price * discount / 100)) ASC',
          'price_desc' => '(price - (price * discount / 100)) DESC',
          'name_asc' => 'name ASC',
          'rating_order' => 'rating DESC',
        ];
        if (array_key_exists($order, $validOrders)) {
          $query .= " ORDER BY " . $validOrders[$order];
        } else {
          $query .= " ORDER BY publish_date ASC";
        }
      }
    }
    $query .= " LIMIT " . intval($limit);
    $query .= " OFFSET " . intval($offset);

    return $this->runQuery($query, $params);
  }
  public function findById($id)
  {
    $query = "SELECT * FROM book WHERE id IN (:id);";
    return $this->runQuery($query, [
      ':id' => $id
    ]);
  }
  public function delete($id)
  {
    $query = "DELETE FROM book WHERE id = :id";
    return $this->runExecute($query, [':id' => $id]);
  }
  public function countRelated($author, $genre, $world, $publisher, $new_release, $order)
  {
    $query = "SELECT COUNT(*) FROM book WHERE 1=1";
    $params = [];

    if ($author && is_string($author) or is_numeric($author)) {
      $query .= " AND author LIKE :author";
      $params[':author'] = "%$author%";
    } elseif (is_array($author)) {
      $authorPlaceholders = [];
      foreach ($author as $index => $author_name) {
        $authorPlaceholder = ":author{$index}";
        $authorPlaceholders[] = $authorPlaceholder;
        $params[$authorPlaceholder] = $author_name;
      }
      $query .= " AND author IN (" . implode(", ", $authorPlaceholders) . ")";
    }
    if ($genre && is_string($genre) or is_numeric($genre)) {
      $query .= " AND genre_id = :genre";
      $params[':genre'] = $genre;
    } elseif (is_array($genre)) {
      $genrePlaceholders = [];
      foreach ($genre as $index => $genre_id) {
        $genrePlaceholder = ":genre{$index}";
        $genrePlaceholders[] = $genrePlaceholder;
        $params[$genrePlaceholder] = $genre_id;
      }
      $query .= " AND genre_id IN (" . implode(", ", $genrePlaceholders) . ")";
    }

    if ($world && is_string($world) or is_numeric($world)) {
      $query .= " AND world_id = :world";
      $params[':world'] = $world;
    } elseif (is_array($world)) {
      $worldPlaceholders = [];
      foreach ($world as $index => $world_id) {
        $worldPlaceholder = ":world{$index}";
        $worldPlaceholders[] = $worldPlaceholder;
        $params[$worldPlaceholder] = $world_id;
      }
      $query .= " AND world_id IN (" . implode(", ", $worldPlaceholders) . ")";
    }
    if ($publisher && is_string($publisher) or is_numeric($publisher)) {
      $query .= " AND publisher_id = :publisher";
      $params[':publisher'] = $publisher;
    } elseif (is_array($publisher)) {
      $publisherPlaceholders = [];
      foreach ($publisher as $index => $publisher_id) {
        $publisherPlaceholder = ":publisher{$index}";
        $publisherPlaceholders[] = $publisherPlaceholder;
        $params[$publisherPlaceholder] = $publisher_id;
      }
      $query .= " AND publisher_id IN (" . implode(", ", $publisherPlaceholders) . ")";
    }
    if ($new_release) {
      $query .= " AND publish_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH) AND publish_date <= NOW()";
    }
    if (!empty($order) && $order == "not_published") {
      $query .= " AND publish_date > NOW()";
    }
    return $this->runCount($query, $params);
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
  public function createBook($name, $author, $price, $discount, $units, $publish_date, $language, $image, $description, $pages, $rating, $publisher_id, $genre_id, $world_id)
  {
    $query = "INSERT INTO book (name, author, price, discount, units, publish_date, language, image, description, pages, rating, publisher_id, genre_id, world_id, last_update) VALUES (:name, :author, :price, :discount, :units, :publish_date, :language, :image, :description, :pages, :rating, :publisher_id, :genre_id, :world_id, '0000-00-00 00:00:00')";
    return $this->runExecute(
      $query,
      [
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
    $query = "UPDATE book SET last_update = :timestampp WHERE id = :id";
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
  public function findUserById($id)
  {
    $query = "SELECT * FROM user WHERE id = :id";
    return $this->runQuery(
      $query,
      [
        ':id' => $id
      ]
    );
  }
  public function createUser($username, $email, $password, $token)
  {
    $query = "INSERT INTO user (username, email, password, token) VALUES (:username, :email, :password, :token)";
    return $this->runExecute(
      $query,
      [
        ':username' => $username,
        ':email' => $email,
        ':password' => $password,
        ':token' => $token,
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
  public function updateUser($email_old, $email_new, $username, $password)
  {
    $query = "UPDATE user SET";
    $params = [];

    $setClauses = [];
    if ($email_new) {
      $setClauses[] = " email = :email_new";
      $params[':email_new'] = $email_new;
    }
    if ($username) {
      $setClauses[] = " username = :username";
      $params[':username'] = $username;
    }
    if ($password) {
      $setClauses[] = " password = :password";
      $params[':password'] = $password;
    }

    $query .= implode(",", $setClauses);

    $query .= " WHERE email = :email_old";
    $params[':email_old'] = $email_old;

    return $this->runExecute($query, $params);
  }
}

class OrdersDB extends DatabaseEshop
{
  public function create($user_id, $timestamp, $overall_price, $state)
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
  public function findLatest()
  {
    $query = "SELECT * FROM orders ORDER BY timestamp DESC LIMIT 1";
    return $this->runQuery($query, []);
  }
  public function findForUser($user_id, $offset, $limit)
  {
    $query = "SELECT * FROM orders WHERE user_id = :user_id ORDER BY timestamp DESC";
    $query .= " LIMIT " . intval($limit);
    $query .= " OFFSET " . intval($offset);
    return $this->runQuery(
      $query,
      [
        ':user_id' => $user_id
      ]
    );
  }
  public function findAll($offset, $limit)
  {
    $query = "SELECT * FROM orders ORDER BY timestamp DESC";
    $query .= " LIMIT " . intval($limit);
    $query .= " OFFSET " . intval($offset);
    return $this->runQuery($query, []);
  }
  public function countForUser($user_id)
  {
    $query = "SELECT COUNT(*) FROM orders WHERE user_id = :user_id";
    return $this->runCount(
      $query,
      [
        ':user_id' => $user_id
      ]
    );
  }
  public function countAll()
  {
    $query = "SELECT COUNT(*) FROM orders";
    return $this->runCount($query, []);
  }
}

class BookOrdersDB extends DatabaseEshop
{
  public function create($order_id, $book_id, $units, $price)
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
  public function findAll($order_id)
  {
    $query = "SELECT * FROM book_order WHERE order_id = :order_id";
    return $this->runQuery(
      $query,
      [
        ':order_id' => $order_id
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

  public function create($user_id, $book_id)
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

  public function delete($user_id, $book_id)
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

  public function deleteBook($book_id)
  {
    $query = "DELETE FROM wishlist WHERE book_id = :book_id";
    return $this->runExecute(
      $query,
      [
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

  public function findById($id)
  {
    $query = "SELECT * FROM genre WHERE id = :id;";
    return $this->runQuery($query, [':id' => $id]);
  }

  public function create($name, $description, $image)
  {
    $query = "INSERT INTO genre (name, description, image, last_update) VALUES (:name, :description, :image, '0000-00-00 00:00:00')";
    return $this->runExecute(
      $query,
      [
        ':name' => $name,
        ':description' => $description,
        ':image' => $image,
      ]
    );
  }

  public function update($id, $name, $description, $image)
  {
    $query = "UPDATE genre SET name = :name, description = :description, image = :image WHERE id = :id";
    return $this->runExecute(
      $query,
      [
        ':id' => $id,
        ':name' => $name,
        ':description' => $description,
        ':image' => $image,
      ]
    );
  }

  public function updateTimestamp($id, $timestamp)
  {
    $query = "UPDATE genre SET last_update = :timestamp WHERE id = :id";
    return $this->runExecute(
      $query,
      [
        ':id' => $id,
        ':timestamp' => $timestamp,
      ]
    );
  }
}

class PublishersDB extends DatabaseEshop
{
  public function findAll()
  {
    $query = "SELECT * FROM publisher;";
    return $this->runQuery($query, []);
  }

  public function findById($id)
  {
    $query = "SELECT * FROM publisher WHERE id = :id;";
    return $this->runQuery($query, [':id' => $id]);
  }

  public function create($name, $description, $image)
  {
    $query = "INSERT INTO publisher (name, description, image, last_update) VALUES (:name, :description, :image, '0000-00-00 00:00:00')";
    return $this->runExecute(
      $query,
      [
        ':name' => $name,
        ':description' => $description,
        ':image' => $image,
      ]
    );
  }

  public function update($id, $name, $description, $image)
  {
    $query = "UPDATE publisher SET name = :name, description = :description, image = :image WHERE id = :id";
    return $this->runExecute(
      $query,
      [
        ':id' => $id,
        ':name' => $name,
        ':description' => $description,
        ':image' => $image,
      ]
    );
  }

  public function updateTimestamp($id, $timestamp)
  {
    $query = "UPDATE publisher SET last_update = :timestamp WHERE id = :id";
    return $this->runExecute(
      $query,
      [
        ':id' => $id,
        ':timestamp' => $timestamp,
      ]
    );
  }
}

class WorldsDB extends DatabaseEshop
{
  public function findAll()
  {
    $query = "SELECT * FROM world;";
    return $this->runQuery($query, []);
  }

  public function findById($id)
  {
    $query = "SELECT * FROM world WHERE id = :id;";
    return $this->runQuery($query, [':id' => $id]);
  }

  public function create($name, $description, $image)
  {
    $query = "INSERT INTO world (name, description, image, last_update) VALUES (:name, :description, :image, '0000-00-00 00:00:00')";
    return $this->runExecute(
      $query,
      [
        ':name' => $name,
        ':description' => $description,
        ':image' => $image,
      ]
    );
  }

  public function update($id, $name, $description, $image)
  {
    $query = "UPDATE world SET name = :name, description = :description, image = :image WHERE id = :id";
    return $this->runExecute(
      $query,
      [
        ':id' => $id,
        ':name' => $name,
        ':description' => $description,
        ':image' => $image,
      ]
    );
  }

  public function updateTimestamp($id, $timestamp)
  {
    $query = "UPDATE world SET last_update = :timestamp WHERE id = :id";
    return $this->runExecute(
      $query,
      [
        ':id' => $id,
        ':timestamp' => $timestamp,
      ]
    );
  }
}
