<div class="row">
    <div class="center-block col-md-6" style="float: none; margin-top: 40px;">
        <div class="jumbotron" style="text-align: center">
            <p>
                <img src="img/logo.png" alt="logo" height="190px" />
            </p>
            <h3>Авторизация</h3>
            <form method="post" action="admintools/authorizate/">
                <p><input type="text" name="login" maxlength="20" /></p>
                <p><input type="password" name="password" maxlength="20" /></p>
                <p><button class="btn btn-primary btn-lg" type="submit">Войти</button></p>
            </form>

            {if isset($data.denied) && $data.denied}
                <p class="message text-danger">Неверный логин или пароль.</p>
            {/if}
        </div>
    </div>
</div>