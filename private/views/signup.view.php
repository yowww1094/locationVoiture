<?php $this->view('includes/header'); ?>

    <div class="container-fluid">
        
        <form method="post">
            <div class="p-4 mx-auto shadow rounded bg-white" style="margin-top: 50px; width:100%; max-width:400px">
                <h2 class="text-center text-dark">LOGO</h2>
                <img src="<?=ASSETS?>/images/logo.png" alt="LOGO" class="d-block mx-auto rounded-circle" style="width: 180px;">
                <br>
                <h3 class="text-center text-dark">Ajouter un utilisateur</h3>
                <hr>
                
                <?php if(count($errors) > 0): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Error!</strong>
                    <?php foreach($errors as $error): ?>
                        <br><?=$error?>
                    <?php endforeach; ?>
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif;?>
                
                <div class="mb-3">
                    <input value="<?=get_var('firstname')?>" type="text" class="form-control text-dark" name="firstname" placeholder="Prenom" autofocus>
                </div>

                <div class="mb-3">
                    <input value="<?=get_var('lastname')?>" type="text" class="form-control text-dark" name="lastname" placeholder="Nom">
                </div>

                <div class="mb-3">
                    <input value="<?=get_var('email')?>" type="email" class="form-control text-dark" name="email" placeholder="E-mail" >
                </div>

                <div class="mb-3">
                    <select class="form-select text-dark" name="gender">
                        <option <?=get_select('gender', '')?> value="">--Sélectionnez le sexe--</option>
                        <option <?=get_select('gender', 'male')?> value="male">Mâle</option>
                        <option <?=get_select('gender', 'female')?> value="female">Femelle</option>
                    </select>
                </div>

                <div class="mb-3">
                    <select class="form-select text-dark" name="rank">
                        <option <?=get_select('rank', '')?> value="">--Sélectionnez un rang--</option>
                        <option <?=get_select('rank', 'agent')?> value="agent">Agent</option>
                        <option <?=get_select('rank', 'admin')?> value="admin">Responsable</option>
                    </select>
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control text-dark" name="password" placeholder="Password">
                </div>

                <div class="mb-3">
                    <input type="password" class="form-control text-dark" name="password2" placeholder="Repeter Password">
                </div>
                <br>
                <a href="<?=ROOT?>">
                    <button type="button" class="btn btn-danger">Cancel</button>
                </a>
                
                <button type="submit" class="btn btn-primary float-end">Ajouter</button>
            </div>        
        </form>

    </div>

<?php $this->view('includes/footer'); ?>