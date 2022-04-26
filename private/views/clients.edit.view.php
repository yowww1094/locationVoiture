<?php $this->view('includes/header'); ?>
<?php $this->view('includes/side-bar'); ?>
<?php $this->view('includes/nav-bar'); ?>

        
    <div class="content">

        <form method="POST">
            <div class="row">
                <div class="col-md-8">
                
                    <div class="card">
                        
                        <?php if(count($errors) > 0): ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Error!</strong>
                                <?php foreach($errors as $error): ?>
                                    <br><?=$error?>
                                <?php endforeach; ?>
                                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif;?>

                        <div class="card-header">
                            <h5 class="title">Informations du client:</h5>
                        </div>

                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-5 pl-md-1">
                                    <div class="form-group">
                                        <label >CIN</label>
                                        <input type="text" class="form-control text-white" value="<?=$rows->cin?>" name="cin" autofocus>
                                    </div>
                                </div>
                                <div class="col-md-3 px-md-1">
                                    <div class="form-group">
                                        <label>Prenom</label>
                                        <input type="text" class="form-control text-white" value="<?=$rows->prenom?>" name="prenom">
                                    </div>
                                </div>
                                <div class="col-md-4 px-md-1">
                                    <div class="form-group">
                                        <label>Nom</label>
                                        <input type="text" class="form-control text-white" value="<?=$rows->nom?>" name="nom">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 px-md-1">
                                    <label>CIN</label>
                                    <input type="file" class="form-control text-white" name="cin_img">
                                </div>
                                <div class="col-md-6  px-md-1">
                                    <label>Permis</label>
                                    <input  type="file" class="form-control text-white" name="permis_img">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6 px-md-1">
                                    <label>Numero de telephone</label>
                                    <input type="text" class="form-control text-white" value="<?=$rows->client_phone?>" name="dernier_km">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-fill btn-primary float-right">Enregistrer</button>
                                <a href="<?=ROOT?>/clients/">
                                    <button type="button" class="btn btn-fill btn-danger">Retour</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        
    </div>

    <?php echo '<pre>'; print_r($rows);?>


<?php $this->view('includes/footer'); ?>
