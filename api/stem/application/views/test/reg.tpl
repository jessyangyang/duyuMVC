<!DOYTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8"/>
        <title>{$title}</title>
    </head>
    <body>
        <form action="/api/test/reg" method="POST">
            <label for="email">email</label>
            <input type="text" name="email"/><br/>
            <label for="username">username</label>
            <input type="text" name="username"/><br/>
            <label for="password">password</label>
            <input type="password" name="password"/><br/>
            <label for="avatar">avatar</label>
            <input type="file" name="avatar"/></br>
            <input type="submit" value="commit"/>
            <input type="hidden" name="state" value="reg"/>
        </form>
        <h2>{$message}</h2>
    </body>
</html>