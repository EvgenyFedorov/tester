<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Test</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="css/bootstrapthememin.css"/>
    <link rel="stylesheet" href="css/bootstraptheme.css"/>
    <link rel="stylesheet" href="css/bootstrapmin.css"/>

    <script type="text/javascript" src="js/API_RT.js"></script>
    <script type="text/javascript" src="js/action.js"></script>
</head>
<body>
<div class="row" style="margin: 20px;">
    <div class="col-xs-6">
        <div class="input-group">
            <input type="text" class="form-control" id="url">
            <span class="input-group-btn">
          <button class="btn btn-success" type="button">Проверить</button>
        </span>
        </div>
    </div>
</div>

<div class="row" id="response_result" style="display: none; margin: 20px 20px 20px 40px;">
    <div class="row">
        <div class="col-md-3">Заголовок страницы:</div>
        <div class="col-md-2">Внутрненних ссылок:</div>
        <div class="col-md-2">Внешних ссылок:</div>
        <div class="col-md-2">Ссылок всего:</div>
    </div>
    <div class="row">
        <div class="col-md-3 title_result"></div>
        <div class="col-md-2 countint_result"></div>
        <div class="col-md-2 countext_result"></div>
        <div class="col-md-2 countall_result"></div>
    </div><br>
    <!--div class="btn btn-success">Сохранить в Excel</div-->
</div>

</body>
</html>
