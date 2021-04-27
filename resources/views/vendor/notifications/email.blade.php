<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
        <style>
            .mail-body {
                background: #f7f7f7;
                height: 100%;
                margin: 0;
                width: 100%;
                font-family: Helvetica, Arial, sans-serif;
                line-height: 160%;
            }
            .mail-wrapper {
                display: flex;
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #F7F7F7;
            }
            .mail-content {
                margin: auto;
                width: 552px;
                border: 1px solid #b1b1b1;
                background: white;
                border-radius: 5px;
            }
            .mail-logo {
                width: 120px;
                height: auto;
                margin-top: 50px;
            }
            .header-box {
                margin: 40px;
                padding: 20px;
                border: none;
                border-radius: 5px;
            }
            .header-text {
                font-family: Arial, Gadget, sans-serif;
                font-size: 21px;
                color: white;
                text-align: center;
                line-height: 125%;
                font-weight: bold;
                margin: 0;
            }
            .body-title {
                font-family: Arial, Gadget, sans-serif;
                font-size: 20px;
                font-weight: bold;
                text-align: center;
                margin: 40px;
                margin-bottom: 20px;
            }
            .body-text {
                font-family: Arial, Gadget, sans-serif;
                font-weight: 400;
                font-size: 16px;
                color: #1A1A1A;
                text-align: center;
                word-wrap: break-word;
                margin: 20px;
                line-height: 150%;
            }
            .body-button {
                border: none;
                color: white;
                padding: 10px 25px;
                text-decoration: none;
                font-size: 12px;
                cursor: pointer;
                border-radius: 5px;
                display: inline-block;
                font-weight: 700;
                letter-spacing: 1.2px;
            }
            .footer-box {
                border-radius: 5px;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
                color:#707070;
                background: #F3F3F3;
                text-align: center;
                line-height: 1em;
                padding: 20px;
                margin: 40px; 
                margin-bottom: 50px;
            }
            .footer-text {
                font-size: 12px;
                margin: 0;
                line-height: 16px;
            }
            .centerize {
                text-align: center;
            }
            .primary-color {
                color: #2ead74;
            }
            .primary-background {
                background: #2ead74;
            }
        </style>
    </head>

    <body class="mail-body">
        <div class="mail-wrapper">
            <div class="mail-content centerize">

                <div class="centerize">
                    <img class="mail-logo" src="{{ $outroLines[0] }}">
                </div>

                <div class="header-box primary-background centerize">
                    <p class="header-text">Recuperação de senha</p>
                </div>

                <div class="body-box">
                    <h1 class="body-title">Olá, <span class="primary-color">{{ $greeting }}</span>!</h1>
                    <p class="body-text">Você está recebendo este e-mail porque recebemos um pedido de redefinição de senha para sua conta. Clique no botão abaixo para prosseguir com essa ação:</p>
                    <a class="body-button primary-background centerize" href="{{ $actionUrl }}">REDEFINIR</a>
                    <p class="body-text">Se você não solicitou uma redefinição da senha, ignore este e-mail.</p>
                </div> 

                <div class="footer-box">
                    <p class="footer-text centerize">
                        Se você tiver problemas para clicar no botão acima, copie e cole a URL seguinte em seu navegador: {{ $actionUrl }}
                    </p>
                </div>

            </div>
        </div>
    </body>
</html>