<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Список заказов</title>
		<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="./css/app.css">
    </head>
    <body>
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
            </div>
        @endif
        <div class="flex-center position-ref full-height">
            <div class="content">
                <h1>
                    Заказы
                </h1>
                <table class="table">
                    @foreach($orders as $order)
                        <tr>
                            <td><a href="./orders/{{ $order->id }}/edit" title="Редактировать">{{ $order->id }}</a></td>
                            <td>{{ $order->partner->name }}</td>
                            <td>{{ $order->getOrderPrice() }}</td>
                            <td>{{ $order->getOrderContents() }}</td>
                            <td>{{ $orderStatuses[$order->status] }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </body>
</html>
