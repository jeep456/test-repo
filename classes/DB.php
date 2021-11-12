<?php

class DB
{
    public $con = '';

    public function __construct()
    {
        $dbh = new PDO('mysql:host=localhost;dbname=test', 'jeeno', '5432');
        $this->con = $dbh;
    }

    public function query($sql)
    {
        $quer = $this->con->query($sql);

        return $quer ;
    }

    public function insert($sql,$data)
    {
        $ins = $this->con->prepare($sql);
        $this->con->beginTransaction();
        $ins->execute($data);
        $this->con->commit();
    }

    public function update($sql,$data)
    {
        $this->con->prepare($sql)->execute($data);
    }

    public function delete($sql,$id)
    {
        $del = $this->con->prepare($sql);
        $del->execute([$id]);
    }

    public function autoCompleteDB()
    {
        $arrs = [
            ["Смирнов Семён Петрович","+79601453256","ВТБ"],
            ["Агафонов Николай Михайлович","77756567","Русский Стандарт"],
            ["Мартынов Алексей Павлович","235624524554","Вознесение"],
            ["Аганесяв Вазген Харитонович","145134346","Сбербанк"],
            ["Саморина Татьяна Виторовна","699058795880","Альфа Банк"],
            ["Алексеев Дмитрий Львович","57857858798","Клавида"],
            ["Петухов Николай Иванович","6786767","Ставрида"],
            ["Франко Милон Аполинарьевич","568538356","Петрокомерц"],
            ["Дарьева Ольга Милайловная","2472467457","Воскресенье"],
            ["Самойлов Спиридон Федотович","2562467","Хоум кредит"],
            ["Цепков Семён Валерьевич","5326467","Спасение"],
            ["Цапко Василий Петрович","3256245254","Рохгострах"],
            ["Перец Михаил Петрович","3423562536","Евростандарт"],
            ["Антовнова Дарья Николаевна","23466236457","Дарья"],
            ["Фурина Мария Виктровна","54546","Московский Банк"],
            ["Яцоло Валерия Степановна","42345234","Три поросёнка"],
        ];

        //$this->insert("INSERT INTO phones (fullname,phone,bankof) VALUES (?,?,?)");
        $sql = "INSERT INTO phones (fullname,phone,bankof) VALUES (?,?,?)";
        $ins = $this->con->prepare($sql);
        $this->con->beginTransaction();

        foreach ($arrs as $arr){
            $ins->execute($arr);
        }


        //$ins->execute($data);
        $this->con->commit();
    }

}
