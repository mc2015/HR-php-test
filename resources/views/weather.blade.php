<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Погода в Брянске</title>
		<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="./css/app.css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <h1>
                    Погода в Брянске
                </h1>
                <div>
                    @if ($temp and $pressure)
					    Температура: <?php echo $temp; ?> °C
                        <br>
                        Давление: <?php echo $pressure; ?> мм рт. ст.
                    @else
                        Сервис недоступен
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
