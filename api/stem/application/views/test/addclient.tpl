<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8"/>
        <title>{$title}</title>
    </head>
    <body>
        <h1>addClient</h1>
        <form action="/api/test/addclient" method="POST">
            <label for="title">uid :</label>
            <input type="text" name="uid"/><br/>
            <input type="hidden" name="state" value="add"/>
            <input type="submit" value="Yes"/>
        </form>
        <h3>{$message}</h3>

    </body>
</html>