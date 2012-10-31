<!DOYTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8"/>
        <title>{$title}</title>
    </head>
    <body>
        <h1>login</h1>
        <form action="/api/test/login" method="POST">
            <label for="email">email</label>
            <input type="text" name="email"/><br/>
            <label for="password">password</label>
            <input type="password" name="password"/><br/>
            <input type="submit" value="commit"/>
            <input type="hidden" name="state" value="login"/>
        </form>
    </body>
</html>