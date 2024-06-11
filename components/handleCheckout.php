

      <?php
      if (!empty($_POST)) {

        $street = htmlspecialchars(trim($_POST['street']));
        $city = htmlspecialchars(trim($_POST['city']));
        $postcode = htmlspecialchars(trim($_POST['postcode']));
        $mobile = htmlspecialchars(trim($_POST['mobile']));
      
        
        $errors = [];
        
        if (empty($city)) {
            array_push($errors, 'Vložte validní název města!');
        }
        
        if (!preg_match('/^\p{L}[\p{L}\p{N}\/ ]*\p{N}$/u', $street)) {
            array_push($errors, 'Zadejte validní název ulice!');
        }
          
        if (!preg_match('/^[\p{L}]*$/u', $city)) {
            array_push($errors, 'Zadejte validní název města!');
        }
      
        if (!preg_match('/^[\d\s]+$/', $postcode)) {
          array_push($errors, 'Zadejte validní PSČ!');
      }
      
        if (!preg_match('/^[0-9]{3}\s[0-9]{3}\s[0-9]{3}$/', $mobile)) {
            array_push($errors, 'Zadejte validní telefonní číslo s mezerami!');
        }
      
      
        
   
            if (count($errors) == 0) {
              $currentDateTime = new DateTime();  
              $currentDateTimeString = $currentDateTime->format('Y-m-d H:i:s');
      
              $data= array (
                    'user_id' => $_SESSION['user_id'],
                    'order_date' => $currentDateTimeString,
                    'status' => 'vyřizování',
                    'total_price' => $sum
              );


                $ordersDB->create($data);

              foreach($products as $product) {
              $data2 = array (
                  'order_id' => $ordersDB->findLast($_SESSION['user_id']),
                  'product_id' => $product['product_id'],
                  'quantity' => $_SESSION['cart'][$product['product_id']],
                  'unit_price' => $product['price']
              );

              $orderItemsDB->create($data2);
              }

              unset($_SESSION['cart']);

              $email->sendEmail('Potvrzení objednávky', file_get_contents('mail-template.php'));

              
            
                echo "<div class='registration-success' style='text-align: center;'>";
                echo "<p>Vaše objednávka byla úspěšně dokočena!</p>";
                echo "<a href='../main/index.php'>Přejít na hlavní stránku.</a>";
                echo "</div>"; 
            } 

            var_dump($data2);
      
        }









    ?>