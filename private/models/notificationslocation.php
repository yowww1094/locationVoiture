<?php

class Notificationslocations extends Model{

    protected $allowedColumns = [
        'id_location',
        'type_notification',
        'description',
        'date_notification',
        'state',
    ];

    protected $beforeInsert = [];

}