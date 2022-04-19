<?php $this->view('includes/header'); ?>
            
        
        <div class="container">
            <h1>Home page!</h1>
        </div>

        <?php

            //echo $data[0]->name;

            echo '<pre>';
            print_r($data);

        ?>

<?php $this->view('includes/footer'); ?>
