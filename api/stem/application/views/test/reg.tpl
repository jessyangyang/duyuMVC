<!DOYTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8"/>
        <title>{{$title}}</title>
    </head>
    <body>
        <form action="/api/test/reg" method="POST">
            <label for="email">email</label>
            <input type="text" name="email"/><br/>
            <label for="username">username</label>
            <input type="text" name="username"/><br/>
            <label for="password">password</label>
            <input type="password" name="password"/><br/>
            <input type="submit" value="commit"/>
        </form>
        <h2>{{$message}}</h2>
    </body>
</html>