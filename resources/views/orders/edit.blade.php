<!DOCTYPE html>
<html lang="ru">
    <head>
       <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Редактирование заказа</title>
		<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../../css/app.css">
    </head>
<body>
    <div class="container">

    <h1>Редактирование заказа №{{ $order->id }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="post" action="{{ route('orders.update', $order->id) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}        

        <div class="form-group">
            <label for="client_email">email клиента</label>
            <input type="text" class="form-control" name="client_email" value={{ $order->client_email }} />
        </div>

        <div class="form-group">
            <label for="partner_id">Партнер</label>
            <select class="form-control" name="partner_id">
                @foreach ($partners as $partner)
                    <option value="{{$partner->id}}"
                        @if ($partner->id == $order->partner->id)
                            selected="selected"
                        @endif
                    >{{$partner->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="product_list">Продукты</label>
            @if (count($orderProductListArray) > 0)
                <ul>
                @foreach ($orderProductListArray as $product) 
                    <li>{{ $product['name'] }}: <b>{{ $product['quantity'] }}</b></li>
                @endforeach
                </ul>
            @else
                —
            @endif
        </div>

        <div class="form-group">
            <label for="order_status">Статус заказа</label>
            <select class="form-control" name="order_status">
                @foreach ($orderStatuses as $orderStatusCode => $orderStatusName)
                    <option value="{{$orderStatusCode}}"
                        @if ($orderStatusCode == $order->status)
                            selected="selected"
                        @endif
                    >{{$orderStatusName}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="product_list">Стоимость заказа</label><br>
            {{ $order->getOrderPrice() }}
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>

    </form>

    </div>
</body>
</html>

