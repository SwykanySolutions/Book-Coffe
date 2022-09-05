<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta
    name="description"
    content="Tekkadan api documentation"
  />
  <title>Tekkadan Api | Documentation</title>
  <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@4.5.0/swagger-ui.css" />
  <link rel="stylesheet" type="text/css" href="{{asset('doc/swagger-ui.css')}}">
</head>
<body>
<div id="swagger-ui"></div>
<script src="https://unpkg.com/swagger-ui-dist@4.5.0/swagger-ui-bundle.js" crossorigin></script>
<script>
  window.onload = () => {
    window.ui = SwaggerUIBundle({
      url: "{{asset('doc/openapi.yml')}}",
      dom_id: '#swagger-ui',
    });
  };
</script>
</body>
</html>