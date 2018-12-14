    
    <?php 
    
        include 'Include/base.php';

        $title = "Index";

        include 'Include/head.php';

        if($_email) {
            REDIRECT("Admin.php");
        }
        
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
        
                <nav class="mb-4 navbar navbar-expand-lg navbar-dark cyan fixed-top scrolling-navbar">
            
                    <h1><a class="navbar-brand font-bold" href="<?= $title ?>.php"><img src="Image/google-map.png" style="width: 20px" alt="Logo Image">&nbsp;Application</a></h1>
            
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                
                        <span class="navbar-toggler-icon"></span>
            
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                
                        <ul class="navbar-nav ml-auto">
                    
                            <li class="nav-item active">
                                
                                <a href="#" role="button" class="btn btn-pink" data-toggle="modal" data-target="#modalLoginForm"><i class="fa fa-sign-in"></i>&nbsp;Staff Sign In</a>
                            
                            </li>
                
                        </ul>
            
                    </div>

                </nav>
    
            </header>
            <!-- End Header -->

            <!-- Modal Login Box -->
            <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        
                <div class="modal-dialog modal-dialog-centered" role="document">
        
                    <div class="modal-content">
            
                        <form id="sign-in-form" @submit.prevent="submit">
            
                            <div class="modal-header text-center">

                                <h4 class="modal-title w-100 font-weight-bold">Staff Sign In</h4>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                    <span aria-hidden="true">&times;</span>

                                </button>

                            </div>
            
                            <div class="modal-body mx-3">

                            <!--
                                Example Email: example@tarc.edu.my
                                Example Password: 123456789
                            -->

                                <div class="md-form mb-5">

                                    <i class="fa fa-envelope prefix grey-text"></i>

                                    <input type="email" id="defaultForm-email" class="form-control" v-model.trim="email" v-focus required pattern="\S[a-z]+@[tarc|taruc]{4,5}.[edu]{3}.[my]{2}">

                                    <label for="defaultForm-email">Your Email</label>

                                </div>

                                <div class="md-form mb-4">

                                    <i class="fa fa-lock prefix grey-text"></i>

                                    <input type="password" id="defaultForm-pass" class="form-control" v-model.trim="password" maxlength="20" required pattern="\S[A-Za-z0-9]{5,}">

                                    <label for="defaultForm-pass">Your Password</label>

                                </div>

                            </div>

                            <div class="modal-footer d-flex justify-content-center">

                                <button class="btn btn-pink">Login</button>

                            </div>
            
                        </form>

                    </div>

                </div>

            </div>
            
            <section>

            <div id="chart-result-box">

                    <div class="row">

                        <div class="card col-md-12">
                            
                            <div class="card-body" id="chart-box">
                        
                                <div class="row">

                                    <div class="col-xs-6 col-md-offset-3">

                                        <div class="col-md-12">

                                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>

                                        </div>

                                    </div>

                                </div>

                            </div>
                    
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
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>

        <!-- Start Custom JS -->
        <script>
            // Firebase & Vue
            var config = {
                apiKey: "AIzaSyCDgNFr3DThr0IyKtSgtj89VERo9sF5f0Y",
                authDomain: "testapplication-c7954.firebaseapp.com",
                databaseURL: "https://testapplication-c7954.firebaseio.com",
                projectId: "testapplication-c7954",
                storageBucket: "testapplication-c7954.appspot.com",
                messagingSenderId: "950751598166"
            };
            
            firebase.initializeApp(config);

            const db = {
                ref: firebase.database().ref("Student"),
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
                    loaded: false,
                    
                    email: null,
                    password: null,

                    highest_five_student_data: []
                },
                methods: {
                    load() {
                        db.ref.orderByChild("Score/Point").limitToLast(5).
                        on("child_added", snap => {
                            if(snap.val() != {}) {
                                this.highest_five_student_data.push({ label: snap.val()['Facebook'].Display_Name, y: snap.val()['Score'].Point });
                            }
                        });

                        setTimeout(() => {
                            this.loaded = true;
                        }, 1000);
                    },
                    submit() {
                        firebase.auth().signInWithEmailAndPassword(this.email, this.password)
                        .then(function() {
                            $.post("authorization.php", { email: vm.email }, function() {
                                location = "Admin.php";
                            });
                            vm.email = null;
                            vm.password = null;
                        })
                        .catch(function(error) {
                            $('#modalLoginForm').modal('hide');
                            vm.email = null;
                            vm.password = null;
                            $('label,i').removeClass("active");
                            switch(error.code) {
                                case 'auth/wrong-password':
                                case 'auth/invalid-email':
                                    alert("Email and password do not match. Please try again !");
                                    break;

                                case 'auth/user-disabled':
                                case 'auth/user-not-found':
                                    alert("Unauthorized staff !");
                                    break;
                            }
                        });
                    }
                },
                created() {
                    this.load();
                },
                watch: {
                    highest_five_student_data: function (value) {
                        load_chart(value);
                    },
                }
            });
        </script>

        <script>
            function load_chart(value) { 

                console.log(value);

                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "light1", // "light2", "dark1", "dark2"
	                animationEnabled: true, // change to true		
	                title:{
	                    text: "Student"
	                },
	                data: [{
		                // Change type to "bar", "area", "spline", "pie",etc.
		                type: "bar",
		                dataPoints: value}
	                ]
                });
                chart.render();
            }
        </script>
        <!-- End Custom JS -->

    </footer>
    <!-- END FOOTER -->

    <?php

        include 'Include/foot.php'
    
    ?>