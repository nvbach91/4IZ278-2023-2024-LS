<?php
$loggedIn = !empty($_COOKIE['email']);
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        
        <a class="brand " href="./main.php">DReality</a>
        <div class="space-nav"></div>

        <div class="navbar-content collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </li>
                  <li class="nav-item">
                    <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                        <input type="hidden" name="theme" value="theme">
                        <?php if (empty($_SESSION['theme']) || $_SESSION['theme'] == 'light') : ?>
                            <button id="primary-button">Switch to dark theme</button>
                        <?php elseif ($_SESSION['theme'] == 'dark') : ?>
                            <button id="primary-button">Switch to light theme</button>
                        <?php endif; ?>
                    </form>
		</li>
		<?php if(!$loggedIn): ?>
		<li class="nav-item">
                    <a class="nav-link" href="./register.php">Registrovat se</a>
		</li>
		<?php endif; ?>
		<?php if($loggedIn):?>
		<li class="nav-item">
                        <a class="nav-link" href="./logout.php">Odhlásit se</a>
		</li>
		<?php endif; ?>
                <?php if (!$loggedIn) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./login.php">Přihlásit se</a>
		    </li>
                <?php endif; ?>
                
            </ul>

        </div>
    </div>
</nav>
