<?php

class Notificationsvoitures extends Model{

    protected $allowedColumns = [
        'matricule',
        'type_notification',
        'description',
        'date_notification',
        'state',
    ];

    protected $beforeInsert = [];

}