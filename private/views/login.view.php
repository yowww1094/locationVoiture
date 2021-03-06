<?php $this->view('includes/header'); ?>
    <div class="container-fluid">

        <div class="p-4 mx-auto shadow rounded  bg-white" style="margin-top: 50px; width:100%; max-width:350px">

            <h2 class="text-center text-dark font-weight-bold">LOGO</h2>
            <img src="<?=ASSETS?>/images/car-alt.png" alt="LOGO" class="d-block mx-auto rounded-circle" style="width: 180px;">
            <br>
            <h3 class="text-center text-dark">Login</h3>
            <hr>

            <?php if(count($errors) > 0): ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Error!</strong>
                    <?php foreach($errors as $error): ?>
                        <br><?=$error?>
                    <?php endforeach; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif;?>

            <form method="POST">
                <div class="mb-3"> 
                    <label for="exampleInputEmail1" class="form-label text-dark">Email address</label>
                    <input type="email" class="form-control text-dark" name="email" placeholder="E-mail" autofocus>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label text-dark">Password</label>
                    <input type="password" class="form-control text-dark" name="password" placeholder="Password">
                </div>
                <br>
                <button type="submit" class="btn btn-primary text-dark">Login</button>
            </form>

        </div>        
        
    </div>

<?php $this->view('includes/footer'); ?>
