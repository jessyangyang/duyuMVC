<html>
  <head>
  <title>Authorize</title>
  <script>
    if (top != self) {
        window.document.write("<div style='background:black; opacity:0.5; filter: alpha (opacity = 50); position: absolute; top:0px; left: 0px;"
        + "width: 9999px; height: 9999px; zindex: 1000001' onClick='top.location.href=window.location.href'></div>");
    }
  </script>
  </head>
  <body>
    <form method="post" action="">
      {foreach $auth_params as $key => $value}
        <input type="hidden" name="{$key|escape:'quotes'}" value="{$value|escape:'quotes'}" />
      {/foreach}
      Do you authorize the app to do its thing?
      <p>
        <input type="submit" name="accept" value="Yep" />
        <input type="submit" name="accept" value="Nope" />
      </p>
    </form>
  </body>
</html>