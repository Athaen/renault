<?php 
    if(isset($_SESSION["flash"])){
        foreach($_SESSION["flash"] as $key => $value){
            ?>
            <div class="alert alert-<?php echo $key; ?> alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?php echo $value; ?>
            </div>
            <?php
            unset($_SESSION["flash"][$key]);
        }
    }
?>