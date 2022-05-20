<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>
        
        <div class="content">

            <script>

                document.addEventListener('DOMContentLoaded', function() {
    
                    var calendarEl = document.getElementById('calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        headerToolbar: {
                            right: 'dayGridMonth,dayGridWeek',
                            center: 'title',
                            left: 'prev,next today'
                        },
                        buttonText: {
                            today:    'Today',
                            month:    'Month',
                            week:     'Week',
                        },
                        themeSystem: 'bootstrap',
                        firstDay: 1,
                        dayHeaderFormat: {
                            weekday: 'long',
                        },
                        events: [
                            <?php if($data && is_array($data)): ?>
                                <?php if($data['notificationsVoiture']): ?>
                                    <?php foreach($data['notificationsVoiture'] as $row): ?>

                                        {title:"<?=strtoupper($row->type_notification)?> - Voiture: <?=$row->matricule?>",start: "<?=$row->next_date?>",end: "<?=$row->next_date?>",url: "<?=ROOT?>/voitures/details/<?=$row->matricule?>",color: "red",},

                                    <?php endforeach;?>
                                <?php endif; ?>

                                <?php if($data['location']): ?>
                                    <?php foreach($data['location'] as $row): ?>

                                        {title:"LOCATION: <?=$row->client->prenom?> <?=$row->client->nom?> - Voiture: <?=$row->voiture->marque?> <?=$row->voiture->model?> | <?=$row->voiture->matricule?>",start: "<?=$row->date_depart?>",end: "<?=$row->date_retour?>",url: "<?=ROOT?>/locations/details/<?=$row->id_location?>",color: "green",},

                                    <?php endforeach;?>
                                <?php endif; ?>
                            <?php endif; ?>
                        ]
                    });
                    calendar.render();
                });

            </script>
            
            <div class="container">
                <div id="calendar"></div>
            </div>


        </div>

        
        

<?php $this->view('includes/footer'); ?>
