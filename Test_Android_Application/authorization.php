    
    <?php 
    
        include 'Include/base.php';

        if(IS_POST()) {
            $user = POST("facebook_user");

            LOGIN($user);
        }
    ?>