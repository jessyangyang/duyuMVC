<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8"/>
        <title>{$title}</title>
    </head>
    <body>
        <h1>AddComment</h1>
        <form action="/api/test/addComment" method="POST">
            <label for="id">id :</label>
            <input type="text" name="uid" value="{$user.id}"/><br/>
            <label for="email">email :</label>
            <input type="text" name="email" value="{$user.email}"/><br/>
            <label for="bid">bookid :</label>
            <input type="text" name="bid"/><br/>
            <label for="content">content : </label>
            <input type="text" name="content"/><br/>
            <label for="parent">parent :</label>
            <input type="text" name="parent" value='0'/><br/>
            <input type="submit" value="commit"/>
            <input type="hidden" name="state" value="comment"/>
        </form>
        <h3>{$message}</h3>
    </body>
</html>