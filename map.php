
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Примеры YMapsML. Добавление на карту результата http-геокодера.</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
    <script type="text/javascript">
        window.onload = function () {
            ymaps.ready(function () {
                // Создание экземпляра карты
                var map = new ymaps.Map('map', {
                    center: [55.76, 37.64],
                    zoom: 10
                });
                window.myMap = map;
              // Загрузка YMapsML-файла
                ymaps.geoXml.load("http://geocode-maps.yandex.ru/1.x/?geocode=Атфих-Эль-Хильф-Миньшат-Сулейман-Кафр-Халава&key=ANpUFEkBAAAAf7jmJwMAHGZHrcKNDsbEqEVjEUtCmufxQMwAAAAAAAAAAAAvVrubVT4btztbduoIgTLAeFILaQ==")
                     .then(function (res) {
                         res.geoObjects.each(function (item) {
                             var bounds = item.properties.get("boundedBy");
                             // Добавление геообъекта на карту
                             myMap.geoObjects.add(item);
                             // Изменение области показа карты
                             myMap.setBounds(bounds);
                         });
                     },
                     function (error) {   // Вызывается в случае неудачной загрузки YMapsML-файла
                         alert("При загрузке YMapsML-файла произошла ошибка: " + error);
                     });

            });
        }
    </script>
</head>

<body>
    <div id="map" style="width:580px;height:300px"></div>
</body>

</html>
