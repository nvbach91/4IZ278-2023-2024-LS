<?php include '../includes/head.php' ?>
<title>Přihlášení</title>
</head>

<body>
    <main>
        <div class="container">
            <div class="row justify-content-center vh-100 align-items-center">
                <div class="col-12 col-md-8 col-lg-6 rounded-2 p-2">
                    <form action="login.php" method="post">
                        <h2 class=" mb-3">Vítej zpátky!</h2>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control focus-ring focus-ring-success" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control focus-ring focus-ring-success" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Heslo</label>
                        </div>
                        <button type="submit" class="btn btn-success">Přihlásit se</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

</body>

</html>