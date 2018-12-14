    
    <?php 
    
        include 'Include/base.php';

        if(IS_POST()) {
            $email = POST("email");

            LOGIN($email);
        }
    ?>