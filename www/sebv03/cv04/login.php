<?php
include 'includes/head.php';
require 'functions.php';
if(isset($_GET['email'])){
    $email = $_GET['email'];
}
if(!empty($_POST)){
    if(isset($_POST['email']) && isset($_POST['password']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if(authenticate($email, $password)){
            echo "User logged in :)";
        }
        else{
            echo "Invalid email or password";
        }
        
    }else
    {
        echo "Please enter email and password";
    }
}
?>
<form class="space-y-4", method="POST", action="<?php echo($_SERVER['PHP_SELF']); ?>">
     <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="text" id="email" name="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : "" ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div>
            <button type="submit" class="mt-3 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">Login</button>
        </div>
</form>


<?php
include 'includes/foot.php';
?>