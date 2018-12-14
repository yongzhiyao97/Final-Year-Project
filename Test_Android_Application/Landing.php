    
    <?php 
    
        include 'Include/base.php';

        $title = "Landing";

        include 'Include/head.php';

        if($_user) {
            REDIRECT("Index.php");
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

            <section>

                <div class="full-screen" id="landing-box">

                    <div>

                        <h1><img src="Image/google-map.png" id="application-logo" />&nbsp;Test Application</h1>

                        <br>

                        <button class="button-line" @click="signIn" v-if="already_login == false">Sign In with <i class="fa fa-facebook-official" id="facebook-button"></i></button>
                        
                        <div v-else>

                            <button class="button-line" @click="proceed" >Continue As <img :src="facebook_user.photoURL" alt="Facebook Image"/></button>

                            <small id="small-text-box">{{ facebook_user.email ? facebook_user.email:null }}.<a id="not-you-link" @click="signOut">Not you?</a></small>

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

             const storageReference = firebase.storage().ref();

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
                    
                    already_login: false,

                    facebook_user: {}

                    // student_facebook_uid: null,
                    // student_facebook_information: {}
                },
                methods: {
                    load() {
                        firebase.auth().onAuthStateChanged(function(user) {
                            if (user) {
                                vm.already_login = true;
                                vm.facebook_user = user;

                                let student_facebook_uid = db.ref.child(user.uid);

                                let student_facebook_information = student_facebook_uid.child("Facebook").set({
                                    Email: user.email,
                                    Photo_URL: user.photoURL + "?type=large",
                                    Display_Name: user.displayName,
                                    Phone_Number: user.phoneNumber || null
                                });
                                
                            } else {
                                console.log("Current user is undefined !");
                            }
                        });

                        setTimeout(() => {
                            this.loaded = true;
                        }, 1000);
                    },
                    signIn() {
                        SignIn_Facebook();
                    },
                    proceed() {
                        // db.ref.on("child_added", snap => {
                        //     if(snap.key == this.facebook_user.uid) {
                        //         this.student_facebook_uid = snap.key || null;
                        //         this.student_facebook_information = snap.val() || {};
                        //     }
                        // });

                        $.post("authorization.php", { facebook_user: JSON.stringify(this.facebook_user) }, function() {
                            location = "Index.php";
                        });
                    },
                    signOut() {
                        SignOut_Facebook();
                    }
                },
                created() {
                    this.load();
                }
            });
        </script>

        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    appId: '2127927797270612',
                    autoLogAppEvents : true,
                    xfbml: true,
                    version: 'v3.2'
                });
            };

            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            const facebook_provider = new firebase.auth.FacebookAuthProvider();

            function SignIn_Facebook() {
                firebase.auth().setPersistence(firebase.auth.Auth.Persistence.LOCAL).then(function() {
                    return firebase.auth().signInWithRedirect(facebook_provider);
                })
                .catch(function(error) {
                    // Handle Errors here.
                    var errorCode = error.code;
                    var errorMessage = error.message;
                });
            }

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
        </script>
        <!-- End Custom JS -->

    </footer>
    <!-- END FOOTER -->

    <?php

        include 'Include/foot.php'
    
    ?>