    
    <?php 
    
        include 'Include/base.php';

        AUTHENTICATION();

        $title = "Friend Request";

        $back_redirect = "Index";

        $friend_id = GET('friend_id');

        if($friend_id == null) {
            REDIRECT('Index.php');
        }

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
            
                    <a class="navbar-brand font-bold" href="<?= $back_redirect ?>.php"><i class="fa fa-arrow-left"></i></a>

                    <span id="page-title"><?= $title ?></span>

                </nav>
    
            </header>
            <!-- End Header -->

            <section>

                <div id="friend-request-box">

                    <div class="row">

                        <div class="card col-md-12">
                            
                            <div class="card-body" id="request-box">
                                
                                <div class="container mt-40" id="result-box">
            
                                    <div class="row mt-30">

                                        <div class="col-md-4 col-sm-6">

                                            <div class="box16">

                                                <img :src="student_facebook_information.Photo_URL" alt="student_facebook_information.Display_Name" />

                                                <div class="box-content">

                                                    <h3 class="title">{{ student_facebook_information.Display_Name }}</h3>

                                                    <span class="post">{{ student_facebook_information.Email }}</span>

                                                    <span class="post" v-if="student_facebook_information.Phone_Number != null">{{ student_facebook_information.Phone_Number || null }}</span>

                                                    <ul class="social">

                                                        <li>

                                                            <a v-if="!clicked && !isFriend" @click="sendRequest">
                                                                <i class="fa fa-paper-plane"></i>
                                                            </a>

                                                            <span v-else-if="clicked && !isFriend" class="badge badge-pill badge-primary">Request Sent</span>

                                                            <span v-else class="badge badge-pill badge-primary">Friend</span>

                                                        </li>

                                                    </ul>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            
                            </div>
                    
                        </div>

                    </div>

                </div>

            </section>

            <div id="toast">

                <div id="send-icon-box"><i class="fa fa-paper-plane"></i></div>

                <div id="request-send-result-box">
                    Friend Request Send !
                </div>

            </div>

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
                    
                    facebook_user: JSON.parse(<?= json_encode($_user); ?>),

                    friend_id: <?=  json_encode($friend_id); ?>,

                    student_facebook_uid: null,
                    student_facebook_information: {},
                    student_facebook_friend_request_information: {},
                    student_friend: {},

                    clicked: false,
                    isFriend: false
                },
                methods: {
                    load() {
                        db.ref.on("child_added", snap => {
                            if(snap.key == this.friend_id && this.facebook_user.uid != this.friend_id) {
                                this.student_facebook_uid = snap.key || null;
                                this.student_facebook_information = snap.val()['Facebook'] || {};
                                    
                                let request = snap.val()['Request'] || {};
                                this.student_facebook_friend_request_information = request['Friend'] || {};

                                this.student_friend = snap.val()['Friend'] || {};
                            }
                            else {
                                location = "Index.php"
                            }
                        });

                        setTimeout(() => {
                            this.loaded = true;
                        }, 1000);
                    },
                    signOut() {
                        SignOut_Facebook();
                    },
                    sendRequest() {
                        let current = new Date(); 
                        let date = current.getDate() > 9 ? (current.getDate()):("0" + current.getDate());
                        let month = (current.getMonth() + 1) > 9 ? (current.getMonth() + 1):("0" + (current.getMonth() + 1)); 
                        let year = current.getFullYear();

                        let hour = current.getHours() > 9 ? (current.getHours()):("0" + current.getHours());
                        let minute = current.getMinutes() > 9 ? (current.getMinutes()):("0" + current.getMinutes());
                        let second = current.getSeconds() > 9 ? (current.getSeconds()):("0" + current.getSeconds());

                        let student_facebook_uid = db.ref.child(this.student_facebook_uid);

                        let student_facebook_request = student_facebook_uid.child("Request");

                        let student_facebook_friend_request = student_facebook_request.child("Friend").push({
                            Facebook_UID: this.facebook_user.uid,
                            Request_DateTime: `${date}/${month}/${year} ${hour}:${minute}:${second}`
                        });

                        launch_toast();

                        setTimeout(() => {
                            location = "Index.php"
                        }, 7000);
                    }
                },
                created() {
                    this.load();
                },
                updated() {
                    friend_request_sent();
                    friend_list();
                }
            });

            function SignOut_Facebook() {
                firebase.auth().signOut()
                .then(function() {
                    $.post("logout.php", function() {
                        location = "Landing.php";
                    });
                    console.log('Signout successful!')
                }, function(error) {
                    console.log('Signout failed')
                });
            }

            function friend_request_sent() {
                let friend = Object.values(vm.student_facebook_friend_request_information);

                friend.forEach(function(a) { 
                    if(a.Facebook_UID == vm.facebook_user.uid) {
                            vm.clicked = true;
                    }

                });
            }

            function friend_list() {
                let search = Object.values(vm.student_friend);

                search.forEach(function (a) {
                    if(a.Facebook_UID == vm.friend_id) {
                        vm.isFriend = true;
                    }
                }); 
            }
        </script>

        <script>
            function launch_toast() {

                var x = document.getElementById("toast");

                x.className = "show";

                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
                
            }
        </script>
        <!-- End Custom JS -->

    </footer>
    <!-- END FOOTER -->

    <?php

        include 'Include/foot.php'
    
    ?>