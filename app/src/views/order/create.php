<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/resources/css/lib/bootstrap.min.css">
</head>
<body>
<div class="wrap">
    <div class="container">
        <h1 class="text-center">Заполните заявку и мы подберем вам курьера!</h1>
        <div class="col-md-8 col-md-offset-3">
            <form action="/" method="post">
                <div class="col-md-12">
                    <div class="col-md-7 form-group">
                        <label for="from">Откуда доставить</label>
                        <input type="text" class="form-control" name="orders[from]" id="from"
                               maxlength="100"
                               minlength="5"
                               required
                               value="{{orders.from}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-7 form-group">
                        <label for="destination">Куда доставить</label>
                        <input class="form-control" type="text" name="orders[destination]" id="destination"
                               maxlength="100"
                               minlength="5"
                               required
                               value="{{orders.destination}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-7 form-group">
                        <label for="delivery_date">Дата</label>
                        <input class="form-control" type="datetime-local" name="orders[delivery_date]"
                               id="delivery_date"
                               required
                               value="{{orders.delivery_date}}">
                        <small>пример: 11-25-2019 14:00</small>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-7 form-group">
                        <label for="name">Ваше имя</label>
                        <input type="text" class="form-control" name="orders[name]" id="name"
                               minlength="2"
                               maxlength="30"
                               required
                               value="{{orders.name}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-7 form-group">
                        <label for="phone">Ваш телефон</label>
                        <input type="tel" class="form-control tel" name="orders[phone]" id="phone"
                               required
                               value="{{orders.phone}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-12 form-group">
                        <select style="min-height: 100px;" class="custom-select col-md-6" name="add_services[]" multiple>
                            <option selected >Без дополнительных услуг</option>
                            {% for service in addServicesData %}
                            <option value="{{service.id}}">{{service.label}}</option>
                            {% endfor %}
                        </select>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="geo_coordinates[longitude]" id="longitude"
                       value="56.84845">
                <input type="hidden" class="form-control" name="geo_coordinates[latitude]" id="latitude"
                       value="35.15484">

                <hr>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">Отправить</button>
                </div>

            </form>
            <div class="col-md-12 messages" style="margin-top: 20px">
                {% if errors.status == 'success' %}
                <div class="alert alert-success">
                    {{errors.messages}}
                </div>

                {% elseif errors.status == 'error' %}
                <div class="alert alert-danger">
                    {% for msg in errors.messages %}
                    <p>{{msg}}</p>
                    {% endfor %}
                </div>
                {% else %}
                {% endif %}
            </div>
        </div>

    </div>

</div>

<script src="/resources/js/lib/input_mask.min.js"></script>

</body>
</html>
