<!-- HTML for static distribution bundle build -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>API Documentation}</title>

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400|Crimson+Text' rel='stylesheet' type='text/css'>
    <!-- Normalize -->
    <link type="text/css" href="/css/normalize.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="/libs/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Source+Code+Pro:300,600|Titillium+Web:400,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/swagger/swagger-ui.css" >
    <link rel="icon" type="image/png" href="../favicon.ico">

    <style>
        .swagger-ui .info .title small pre {
            background: transparent;
            border: 0;
            color: white;
            padding: 0;
        }
        body{
            overflow-x: hidden;
        }
        .swagger-ui .model-box, .opblock-section-header, .swagger-ui .responses-inner {
              overflow-x: scroll;
        }
    </style>
</head>

<body>
    <div class="container">
        <div id="swagger-ui"></div>
    </div>

    <script src="/swagger/swagger-ui-bundle.js"> </script>
    <script src="/swagger/swagger-ui-standalone-preset.js"> </script>
    <script>
        window.onload = function() {
            // Build a system
            const ui = SwaggerUIBundle({
                url: "/swagger/swagger.json",
                dom_id: '#swagger-ui',
                deepLinking: true,
                presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                ],
        plugins: [
          SwaggerUIBundle.plugins.DownloadUrl
        ],
    //    layout: "StandaloneLayout"
            })

            window.ui = ui
        }
    </script>
</body>
</html>
