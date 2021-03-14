<?php

namespace models;

use models\Couriers;

class Scheme extends GeneralModel
{

    public $region;
    public $courier;
    public $date_departure;
    public $date_arrival;

    public function tableName(): string
    {
        return 'scheme';
    }

    public function getAll()
    {
        return $this->query('SELECT * FROM ' . $this->tableName() . ' ORDER BY id DESC')->all();
    }


    public function load($param)
    {
        try {
            foreach ($param as $item) {
                $this->{$item->name} = $item->value;
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function save()
    {
        $this->date_departure = strtotime(date('d.m.Y', strtotime($this->date_departure)));
        $this->date_arrival = strtotime(date('d.m.Y', strtotime($this->date_arrival)));

        $courier = (new Couriers())->getCoruier(intval($this->courier));
        $sql = "SELECT * FROM " . $this->tableName() . " WHERE courier_name = :courier_name AND 
        (departure_date BETWEEN :departure_date AND :date_arrival OR arrival_date BETWEEN :departure_date AND :date_arrival)";

        $this->res = $this->conn->prepare($sql);
        $this->res->bindValue(":courier_name",  $courier['full_name'], $this->bindType('string'));
        $this->res->bindValue(":departure_date", $this->date_departure, $this->bindType('int'));
        $this->res->bindValue(":date_arrival", $this->date_arrival, $this->bindType('int'));
        $this->res->execute();
        $res = $this->one();

        if ($res) {
            return [
                'error' => true,
                'message' => 'Курьер занят. Выберите другую дату'
            ];
        }

        $query = "INSERT INTO " . $this->tableName() . " SET region=:region, departure_date=:departure_date,
        courier_name=:courier_name, arrival_date=:arrival_date";

        $stmt = $this->conn->prepare($query);


        $stmt->bindValue(":region", $this->region, $this->bindType('string'));
        $stmt->bindValue(":departure_date", $this->date_departure, $this->bindType('int'));
        $stmt->bindValue(":courier_name", $courier['full_name'], $this->bindType('string'));
        $stmt->bindValue(":arrival_date", $this->date_arrival, $this->bindType('int'));

        if ($stmt->execute()) {
            return [
                'success' => true,
                'message' => 'Курьер добавлен'
            ];;
        }
        return [
            'error' => true,
            'message' => 'Ошибка записи'
        ];
    }
}
