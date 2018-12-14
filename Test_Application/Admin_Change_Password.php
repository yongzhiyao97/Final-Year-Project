    
    <?php 
    
        include 'Include/base.php';

        AUTHENTICATION();

        $title = "Admin Change Password";

        $home_title = "Admin";

        include 'Include/head.php';

    ?>

    <!-- Start Main Content -->
    <main id="app" v-cloak>

        <!-- Animation Loader -->
        <div class="animationload" v-if="!loaded">
            <div class="osahanloading"></div>
        </div>

        <!-- Content -->
        <template v-else>

           <!-- Start Header -->
            <header>
        
                <nav class="mb-4 navbar navbar-expand-lg navbar-dark cyan fixed-top scrolling-navbar lighten-1">
            
                    <h1><a class="navbar-brand font-bold" href="<?= $home_title ?>.php"><img src="Image/google-map.png" style="width: 20px" alt="Logo Image">&nbsp;Application</a></h1>
            
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                
                        <span class="navbar-toggler-icon"></span>
            
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                
                        <!-- <ul class="navbar-nav mr-auto">
                    
                            <li class="nav-item active">
                                
                                <a href="#" class="nav-link waves-effect waves-light">Home<span class="sr-only"></span></a>
                            
                            </li>

                            <li class="nav-item dropdown">
                                
                                <a href="#" class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">DropDown</a>

                                <div class="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-4">
                                
                                    <a class="dropdown-item waves-effect waves-light" href="#">Example</a>

                                </div>
                            
                            </li>
                
                        </ul> -->

                        <ul class="navbar-nav ml-auto nav-flex-icons">
                    

                            <li class="nav-item avatar dropdown">
                        
                                <a href="#" class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img :src="image_url" class="rounded-circle z-depth-0" alt="Avatar Image"></a>

                                <div class="dropdown-menu dropdown-menu-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-4">

                                    <a class="dropdown-item waves-effect waves-light" href="Admin_Profile.php">Staff Profile</a>

                                    <a class="dropdown-item waves-effect waves-light" href="Admin_Change_Password.php">Change Password</a>
                                
                                    <a class="dropdown-item waves-effect waves-light" @click="logout" href="#">Sign Out</a>

                                </div>
            
                            </li>
                            
                        </ul>
            
                    </div>

                </nav>
    
            </header>
            <!-- End Header -->

            <section>

                <div class="container" id="change-password-box">
                    
                    <div class="row">

                        <div class="col-md-12">
                            
                            <form id="change-password-form" @submit.prevent="submit">

                                <div class="row" id="change-password-text-box">

                                    <div class="col" id="change-password-text">Change Password</div>

                                </div>

                                <div class="row">

                                    <div class="col">

                                        <table id="tablePreview" class="table table-borderless">
   
                                            <tbody>

                                                <tr>

                                                    <td id="password-text">Current Password</td>
                                                    <td>

                                                        <div class="md-form input-group mb-3">
                                                            <input type="password" id="current_password" class="form-control" v-model.trim="current_password" maxlength="20" v-focus required pattern="\S[A-Za-z0-9]{5,}" placeholder="New Password">

                                                            <div class="input-group-append">

                                                                <button class="btn btn-md btn-outline-primary m-0 px-3" type="button" id="show_current_password">

                                                                    <span class="fa fa-wifi"></span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </td>
      
                                                </tr>


                                                <tr>

                                                    <td id="password-text">New Password</td>
                                                    <td>

                                                        <div class="md-form input-group mb-3">
                                                            <input type="password" id="new_password" class="form-control" v-model.trim="new_password" maxlength="20" required pattern="\S[A-Za-z0-9]{5,}" placeholder="New Password">

                                                            <div class="input-group-append">

                                                                <button class="btn btn-md btn-outline-primary m-0 px-3" type="button" id="show_new_password">

                                                                    <span class="fa fa-wifi"></span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </td>
      
                                                </tr>

                                                <tr>
      
                                                    <td id="password-text">Confirmed New Password</td>
                                                    <td>

                                                        <input type="password" class="form-control" v-model.trim="confirm_new_password" maxlength="20" required pattern="\S[A-Za-z0-9]{5,}" placeholder="Confirmed New Password">

                                                    </td>
      
                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                                <button class="btn btn-success btn-lg pull-right" id="general-mission-save-button">Update</button>

                            </form>
                            
                        </div>

                    </div>
                    
                </div>

            </section>

        </template>

    </main>
    <!-- End Main Content -->

    <!-- START FOOTER -->
    <footer>

        <!-- SCRIPTS -->
        <!-- Start Firebase Library -->
        <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase-auth.js"></script>
        <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase-database.js"></script>
        <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase-firestore.js"></script>
        <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase-messaging.js"></script>
        <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase-functions.js"></script>
        <script src="https://www.gstatic.com/firebasejs/5.4.1/firebase-storage.js"></script>
        <!-- End Firebase Library -->

        <!-- Start Vue JS Library -->
        <script src="https://unpkg.com/vue/dist/vue.js"></script>
        <script src="Script/custom.js"></script>
        <!-- End Vue JS Library -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/js/mdb.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>

        <!-- Start Custom JS -->
        <script>
            // Firebase & Vue
            const config = {
                apiKey: "AIzaSyCDgNFr3DThr0IyKtSgtj89VERo9sF5f0Y",
                authDomain: "testapplication-c7954.firebaseapp.com",
                databaseURL: "https://testapplication-c7954.firebaseio.com",
                projectId: "testapplication-c7954",
                storageBucket: "testapplication-c7954.appspot.com",
                messagingSenderId: "950751598166"
            };
    
            firebase.initializeApp(config);

            const storageReference = firebase.storage().ref();

            const db = {
                ref: firebase.database().ref("Staff"),
                snap: null,
                
                on(cb) {
                    this.ref.on("value", snap => {
                        this.snap = snap;
                        cb(snap.val());
                    });
                }
            };

            const vm = new Vue({
                el: "#app",
                data: {
                    staff_id: null, 
                    staff_information: {},
                    
                    email: <?= json_encode($_email) ?>,
                    loaded: false,
                    image_url: null,

                    current_password: null,
                    new_password: null,
                    confirm_new_password: null
                },
                methods: {
                    load() {
                        db.ref.orderByChild("Email").equalTo(this.email)
                        .on("child_added", snap => {
                            this.staff_id = snap.key || null;
                            this.staff_information = snap.val() || {};

                            storageReference.child(`Image/${this.staff_id}.jpg`).getDownloadURL().then(function(url) {
                                // This can be downloaded directly:
                                var xhr = new XMLHttpRequest();
                                xhr.responseType = 'blob';
                                xhr.onload = function(event) {
                                    var blob = xhr.response;
                                };
                                xhr.open('GET', url);
                                xhr.send();

                                vm.image_url = url;
                            }).catch(function(error) {
                                switch(error.code) {
                                    case 'storage/object_not_found':
                                        console.log("File doesn't exist !");
                                        break;

                                    case 'storage/unknown':
                                        console.log("Unknown error occured !");
                                        break;
                                }
                            });
                        });

                        this.loaded = true;
                    },
                    isValid() { // Test
                        console.log(this.email);
                    },
                    logout() {
                        firebase.auth().signOut()
                        .then(function() {
                            $.post("logout.php", function() {
                                location = "Index.php";
                            });
                        })
                        .catch( function(error) {
                            console.log(error.code);
                            console.log(error.message);
                        });
                    },
                    submit() {
                        changePassword(this.current_password, this.new_password, this.confirm_new_password);
                    }
                }, 
                created() {
                    this.load();
                    // this.isValid();
                }
            });

            function comparedPassword(new_password, confirm_new_password) {
                return new_password == confirm_new_password;
            }

            function changePassword(current_password, new_password, confirm_new_password) {
                let admin = firebase.auth().currentUser;
                let credential = firebase.auth.EmailAuthProvider.credential(
                    vm.email, 
                    current_password
                );

                console.log(credential);

                if(admin) {
                    if(comparedPassword(new_password, confirm_new_password)) {
                        admin.reauthenticateAndRetrieveDataWithCredential(credential).then(function() {
                            admin.updatePassword(new_password).then(function() {
                                alert("Password Updated");
                                window.location.href = "Admin.php";
                            }).catch(function(error) {
                                switch(error.code) {
                                    case 'auth/requires-recent-login':
                                        alert("Require Recent Login !");
                                        vm.logout();
                                        break;
                                }
                            });
                        }).catch(function(error) {
                            switch(error.code) {
                                case 'auth/user-mismatch':
                                case 'auth/user-not-found':
                                case 'auth/invalid-credential':
                                    alert("Email and password do not match. Please try again !");
                                    vm.logout();
                                    break;

                                case 'auth/invalid-email':
                                case 'auth/wrong-password':
                                    alert("Email and password do not match. Please try again !");
                                    vm.logout();
                                    break;
                            }
                        });
                    }
                }
                else {
                    vm.logout();
                }
            }
        </script>

        <script>
            $("#show_new_password").hover(
                function functionName() {
                    //Change the attribute to text
                    $("#new_password").attr("type", "text");
                },
                function() {
                    //Change the attribute back to password
                    $("#new_password").attr("type", "password");
                }
            );

            $("#show_current_password").hover(
                function functionName() {
                    //Change the attribute to text
                    $("#current_password").attr("type", "text");
                },
                function() {
                    //Change the attribute back to password
                    $("#current_password").attr("type", "password");
                }
            );
        </script>
        <!-- End Custom JS -->

    </footer>
    <!-- END FOOTER -->

    <?php 

        include 'Include/foot.php';

    ?>