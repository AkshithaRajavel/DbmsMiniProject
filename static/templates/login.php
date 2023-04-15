<body class="m-2 p-2 m-lg-3">
    <div class="container-fluid position-sticky top-0 text-center bg-white mb-3 d-none d-lg-grid">
        <div class="row">
        <div class="col-10 "><h1>GET RAVENED</h1></div>
        <button type="button" class="btn col"><a href="/signup">SIGNUP</a></button>
        </div>
        </div>
    <div id="login">
        <form action="/api/login" method="post">
        <h1>LOGIN</h1>
        <div class="container">
        <div class="row">
        <label class="col">EMAIL:</label>
        <input class="col" type="text" name="email" required></div>
        <div class="row">
        <label class="col">PASSWORD:</label>
        <input class="col" type="password" name="password" required></div>
        <button type="submit" class=btn>Login</button>
        </div>
        <h3 class="error">
        <?php echo $error; ?>
        </h3>
        </form>
    </div>
</body>