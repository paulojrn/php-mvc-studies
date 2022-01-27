<?php include __DIR__ . "/../inicio-html.php" ?>

<form action="/realiza-login" method="POST">
    <div class="form-group">
        <label for="email"></label>
        <input  type="email"
                id="email" 
                name="email"
                class="form-group">
    </div>
    <div class="form-group">
        <label for="senha"></label>
        <input  type="password"
                id="senha" 
                name="senha"
                class="form-group">
    </div>
    <button class="btn btn-primary">
        Entrar
    </button>
</form>

<?php include __DIR__ . "/../fim-html.php" ?>