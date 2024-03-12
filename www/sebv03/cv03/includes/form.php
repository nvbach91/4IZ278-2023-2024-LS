<form class="space-y-4" method="POST", action="<?php $_SERVER['PHP_SELF'] ?>">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : "" ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        
        <div>
            <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>
            <select id="sex" name="sex" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option>Male</option>
                <option>Female</option>
            </select>
        </div>
        
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="text" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : "" ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" id="phone" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : "" ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        
        <div>
            <label for="profilePictureUrl" class="block text-sm font-medium text-gray-700">Profile Picture URL</label>
            <?php
            echo($validProfilePictureUrl ? "<img src='$profilePictureUrl' alt='Profile Picture' class='w-10 h-10'>" : "");
             ?>
            <input type="text" id="profilePictureUrl" name="profilePictureUrl" value="<?php echo isset($_POST['profilePictureUrl']) ? $_POST['profilePictureUrl'] : "" ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        
        <div>
            <label for="deckName" class="block text-sm font-medium text-gray-700">Deck Name</label>
            <input type="text" id="deckName" name="deckName" value="<?php echo isset($_POST['deckName']) ? $_POST['deckName'] : "" ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        
        <div>
            <label for="numberOfCardsInDeck" class="block text-sm font-medium text-gray-700">Number of Cards in Deck</label>
            <input type="text" id="numberOfCardsInDeck" name="numberOfCardsInDeck" value="<?php echo isset($_POST['numberOfCardsInDeck']) ? $_POST['numberOfCardsInDeck'] : "" ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        
        <div>
            <button type="submit" class="mt-3 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Submit</button>
        </div>
</form>
