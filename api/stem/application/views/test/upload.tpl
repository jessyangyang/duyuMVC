<!DOYTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8"/>
        <title>{$title}</title>
    </head>
    <body>
        <h1>upload</h1>
        <form action="/api/test/upload" method="POST" enctype="multipart/form-data">
            <label for="file">image</label><br/>
            <input type="file" name="file" id="file"/><br/>
            <input type="text" name="type" id="type"/><br/>
            <input type="submit" value="commit"/>
            <input type="hidden" name="state" value="upload"/>
        </form>
    </body>
</html>