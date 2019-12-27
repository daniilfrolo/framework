<?php
/**
 * Created by PhpStorm.
 * User: daniu
 * Date: 15.12.2019
 * Time: 18:27
 */

namespace Framework\Container;

use Framework\Helper\ArrayHelper;
use ReflectionClass;


class Container
{

    private $definitions = [];
    private $results = [];


    /**
     * @param string $id
     * @return mixed
     * @throws \ReflectionException
     * Получить что либо из контейнера либо создать новый экземпляр незаписанного в контейнере класса
     */
    public function get(string $id)
    {

        if ($result = self::_inResults($id)) return self::_callAndUpdate($result,$id);

        if ($result = self::_inDefinitions($id))
        {
            self::_inResult($result,$id);
            return self::_callAndUpdate($result,$id);
        }

        if ($result = self::_getIfNotExist($id))
        {
            self::_inResult($result,$id);
            return self::_callAndUpdate($result,$id);
        }

        throw new ServiceNotFoundException('Unknown Class "' . $id . '"');

    }

    /**
     * @param array $array
     * Первичное полное заполнение зависимостей
     */
    public function fill(array $array): void
    {
        $this->definitions = $array;
    }


    /**
     * @param $id
     * @param $value
     * Создать зависимость либо конфигурацию в результатах, без записи в контейнер
     */
    public function setTemp($id, $value): void
    {
        if (array_key_exists($id,$this->results))
        {
            unset($this->results[$id]);
        }

        $this->results[$id] = $value;
    }

    /**
     * @param $id
     * @return mixed
     * Получить значение конфигурации проекта
     */
    public function getConfig($id)
    {
        if ($result = ArrayHelper::searchinarray($this->definitions['Config'],$id)) {
            self::_inResult($result,$id);
            return self::_callAndUpdate($result,$id);
        }

        throw new ServiceNotFoundException('Unknown Config "' . $id . '"');
    }

    /**
     * @param string $id
     * @return mixed
     * Получить Middleware из контейнера
     */
    public function getMiddleware(string $id)
    {
        if ($result = ArrayHelper::searchinarray($this->definitions['Dependencies']["Middlewares"],$id)) {
            self::_inResult($result,$id);
            return self::_callAndUpdate($result,$id);
        }
        throw new ServiceNotFoundException('Unknown Middleware "' . $id . '"');
    }

    public function getService(string $id)
    {
        if ($result = ArrayHelper::searchinarray($this->definitions['Dependencies']["Services"],$id)) {
            self::_inResult($result,$id);
            return self::_callAndUpdate($result,$id);
        }
        throw new ServiceNotFoundException('Unknown Service "' . $id . '"');
    }

    /**
     * @param $id
     * @param $value
     * Добавить Middleware в Container
     */
    public function setMiddleware($id, $value) :void
    {
        self::_setDependence("Middlewares",$id,$value);
    }

    /**
     * @param $id
     * @param $value
     * Добавить Middleware в Container
     */
    public function setService($id, $value): void
    {
        self::_setDependence("Services",$id,$value);
    }

    /**
     * @param string $searth
     * @return mixed
     * Поиск ключа по всему Container
     */
    private function _inDefinitions(string $searth)
    {
        if ($result = ArrayHelper::searchinarray($this->definitions,$searth)) return $result;
    }

    /**
     * @param string $searth
     * @return mixed
     * Поиск ключа в результатах вызова
     */
    private function _inResults(string $searth)
    {
        if (array_key_exists($searth,$this->results))
        {
            return $this->results[$searth];
        }
    }


    /**
     * @param $call
     * @param string $id
     * @return mixed
     * Вызвать содержимое контейнера и записать его в результаты
     */
    private function _callAndUpdate($call, string $id)
    {
        self::_inResult($call,$id);
        return $this->results[$id];
    }

    /**
     * @param $call
     * @param $id
     * Записать вызов в результаты вызовов
     */
    private function _inResult($call, $id)
    {
        if ($call instanceof \Closure){
            $this->results[$id] = $call($this);
        }else{
            $this->results[$id] = $call;
        }
    }

    /**
     * @param string $type
     * @param string $id
     * @param $value
     * Добавить новую зависимость в контейнер
     */
    private function _setDependence(string $type, string $id, $value):void
    {
        if (array_key_exists($id,$this->results))
        {
            unset($this->results[$id]);
        }

        $this->definitions["Dependencies"][$type][$id] = $value;
    }


    /**
     * @param string $id
     * @return object
     * @throws \ReflectionException
     * Создать новый объект класса, которого нет в Container
     */
    private function _getIfNotExist(string $id)
    {
            if (class_exists($id)) {
                $reflection = new ReflectionClass($id);
                $arguments = [];
                $constructor = $reflection->getConstructor();
                if (($constructor !== null)) {
                    foreach ($constructor->getParameters() as $parameter) {
                        if ($paramClass = $parameter->getClass()) {
                            $arguments[] = $this->get($paramClass->getName());
                        } elseif ($parameter->isArray()) {
                            $arguments[] = [];
                        } else {
                            if (!$parameter->isDefaultValueAvailable()) {
                                throw new ServiceNotFoundException("Unable to resolve '" . $parameter->getName() . "' in service " . $id);
                            }
                            $arguments[] = $parameter->getDefaultValue();
                        }

                    }
                }
                return $reflection->newInstanceArgs($arguments);
            }
    }

    public function insetTemp(string $id)
    {
        unset($this->results[$id]);
    }

}