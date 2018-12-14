    
    <?php 
    
        include 'Include/base.php';

        AUTHENTICATION();

        $title = "Admin";

        include 'Include/head.php';

        REDIRECT('Admin_Display_Mission.php');

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
            
                    <h1><a class="navbar-brand font-bold" href="<?= $title ?>.php"><img src="Image/google-map.png" style="width: 20px" alt="Logo Image">&nbsp;Application</a></h1>
            
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
                    image_url: null
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
                    }
                }, 
                created() {
                    this.load();
                    // this.isValid();
                }
            });
        </script>
        <!-- End Custom JS -->

    </footer>
    <!-- END FOOTER -->

     <?php 
    
        include 'Include/foot.php';

    ?>