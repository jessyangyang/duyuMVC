<!DOYTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8"/>
        <title>{$title}</title>
    </head>
    <body>
        <h1>addClient</h1>
        <form action="/api/test/addClient" method="POST">
            <label for="title">title :</label>
            <input type="text" name="title"/><br/>
            <label for="summary">summary : </label>
            <input type="password" name="summary"/><br/>
            <label for="redirect_url">redirect_url :</label>
            <input type="password" name="redirect_url"/><br/>
            <input type="submit" value="commit"/>
            <input type="hidden" name="state" value="login"/>
        </form>
    </body>
</html>