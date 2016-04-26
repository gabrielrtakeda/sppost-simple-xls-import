<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }

            .logo {
                margin-bottom: 20px;
            }

            a {
                color: #666;
                padding-left: 10px;
                text-decoration: none;
            }

            a:before {
                content: '>> ';
                font-weight: bold;
            }

            a:hover {
                color: #FF7400;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <img class="logo" src="http://www.celcentro.com/Clkj_Images/npic/excel.png" width="70%">
                <div class="title">Excel Importer</div>
                <h1><a href="/excel/import/produtos.xlsx">Import "produtos.xlsx"</a></h1>
            </div>
        </div>
    </body>
</html>
