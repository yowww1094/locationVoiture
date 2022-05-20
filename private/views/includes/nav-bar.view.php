<?php

$dateNow = date("Y-m-d");

$notificationsVoiture = new Voiture_notification();
$notificationsLocation = new Location_notification();

$notification_voiture = $notificationsVoiture->get_voiture_notif_count();
$notification_location = $notificationsLocation->get_location_notif_count();

$notification_count = $notification_voiture + $notification_location;

$voitureQuery = 'select * from voiture_notifications where state = :state && date_notification = :dateNow order by date_notification DESC';
$locationQuery = 'select * from location_notifications where state = :state && date_notification = :dateNow order by date_notification DESC';

$rows['notificationsVoiture'] = $notificationsVoiture->query($voitureQuery, ['state' => '1', 'dateNow' => $dateNow]);
$rows['notificationsLocation'] = $notificationsLocation->query($locationQuery, ['state' => '1', 'dateNow' => $dateNow]);
?>   
    <div class="main-panel">

        <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <div class="navbar-toggle d-inline">
                        <button type="button" class="navbar-toggler">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                        </button>
                    </div>
                    <p class="navbar-brand"></p>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                    <span class="navbar-toggler-bar navbar-kebab"></span>
                </button>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto">
                        <li class="dropdown nav-item" style="position: relative;">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

                                <?php if($notification_count > 0): ?>
                                    <span class="badge badge-pill bg-danger text-white" style="position: absolute; top: 0px; right: 0px">
                                        <?=$notification_count?>
                                    </span> 
                                <?php endif; ?>

                                <i class="fa fa-bell"></i>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right dropdown-navbar" style="min-width: 300px;">

                                <?php if(is_array($rows) && $rows): ?>
                                    <?php if($rows['notificationsVoiture'] && $rows['notificationsLocation']): ?>
                                        <?php if($rows['notificationsVoiture']): ?>

                                            <?php foreach(array_slice($rows['notificationsVoiture'], 0, 2) as $row): ?>

                                                <li class="nav-item">
                                                    <p class="dropdown-item text-dark">
                                                        <b><?=strtoupper($row->type_notification)?> VOITURE -</b>
                                                        <br>
                                                        Matricule: <?=$row->matricule?> - Date: <?=$row->next_date?>
                                                    </p>
                                                </li>
                                                <li class="dropdown-divider"></li>

                                            <?php endforeach; ?>
                                        
                                        <?php endif; ?>
                                        <?php if($rows['notificationsLocation']): ?>
                                            <?php foreach(array_slice($rows['notificationsLocation'], 0, 2) as $row): ?>

                                                <li class="nav-item">
                                                    <p class="dropdown-item  text-dark">
                                                        <b><?=strtoupper($row->type_notification)?> -</b>
                                                        <br>
                                                        Client: <?=$row->location->client->prenom?> <?=$row->location->client->prenom?> - 
                                                        Voiture: <?=strtoupper($row->location->voiture->matricule)?>
                                                    </p>
                                                </li>
                                                <li class="dropdown-divider"></li>

                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php else:?>
                                        <p class="text-dark text-center">Pas de notifications a ce momment</p>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <li class="nav-link"><a href="<?=ROOT?>/notifications/" class="nav-item dropdown-item text-center">Voir tous!</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?=ROOT?>/logout" class="nav-link" title="LOGOUT"><i class="fa-solid fa-power-off"></i></a>
                        </li>

                        <?php if($_SESSION['USER']->rank == 'admin'): ?>

                            <li class="nav-item">
                                <a href="<?=ROOT?>/signup" class="nav-link" title="ADD NEW USER"><i class="fa-solid fa-person-walking-arrow-right"></i></i></a>
                            </li>

                        <?php endif; ?>

                        <li class="separator d-lg-none"></li>
                    </ul>
                </div>
            </div>
        </nav>
