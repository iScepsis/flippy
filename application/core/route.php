<?php
class Route
{
    static $controller_name;   //Сюда запишется имя контроллера
    static $action_name;       //Сюда запишется имя модели
    static $params = array();
    static $routes;            //Здесь будет полное содержимое адресной строки в виде массива, что бы можно было вытянуть любой параметр

    static function start()
    {
        // контроллер и действие по умолчанию
        $controller_name = 'Main';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        //Убираем localhost в версии для разработки
        if($routes[0] === 'localhost' || empty($routes[0])){
           array_splice($routes, 0, 1);
            self::$routes = $routes;
        }

        // получаем имя контроллера
        if ( !empty($routes[1]) )
        {
            $controller_name = $routes[1];
            self::$controller_name = strtolower($controller_name);
        }

        // получаем имя экшена
        if ( !empty($routes[2]) )
        {
            $action_name = $routes[2];
            self::$action_name = strtolower($action_name);
        }

        //Получаем параметры
        if ( !empty($routes[3])) {
            $j=1;
            //Если элементов в адресной строке четное кол-во, заполняем массив с параметрами в виде ассоциативного массива
            if (count($routes) % 2 == 0) {
                for ($i = 3; $i < count($routes); $i++) {
                    self::$params[$j] = $routes[$i];
                    $j++;
                }
            //Если не четное - одномерным
            } else {
                for ($i = 3; $i < count($routes); $i += 2) {
                    self::$params[$routes[$i]] = $routes[$i+1];
                    $j++;
                }
            }
        }

        // добавляем префиксы
        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;

        // подцепляем файл с классом модели (файла модели может и не быть)

        $model_file = strtolower($model_name).'.php';
        $model_path = "application/models/".$model_file;
        if(file_exists($model_path))
        {
            include "application/models/".$model_file;
        }

        // подцепляем файл с классом контроллера
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = "application/controllers/".$controller_file;
        if(file_exists($controller_path))
        {
            include "application/controllers/".$controller_file;
        }
        else
        {
            /*
            правильно было бы кинуть здесь исключение,
            но для упрощения сразу сделаем редирект на страницу 404
            */
            Route::ErrorPage404();
        }

        // создаем контроллер
        $controller = new $controller_name;
        $action = $action_name;

        if(method_exists($controller, $action))
        {
            // вызываем действие контроллера
            $controller->$action();
        }
        else
        {
            // здесь также разумнее было бы кинуть исключение
            Route::ErrorPage404();
        }

    }

    static function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        if ($_SERVER['HTTP_HOST'] == "localhost") {
            $host .= 'flippy/';
        }
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}