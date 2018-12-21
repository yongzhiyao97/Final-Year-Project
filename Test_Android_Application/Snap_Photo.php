    
    <?php 
    
        include 'Include/base.php';

        AUTHENTICATION();

        $title = "Snap Photo";

        $back_redirect = "Index";

        $general_mission_id = GET('general_mission_id');

        $event_mission_id = GET('event_mission_id');
        $mission_id = GET('mission_id');

        if($general_mission_id == null && ($event_mission_id == null || $mission_id == null)) {
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

                <div id="snap-photo-box" v-show="(event_mission_id != null && mission_id != null) || general_mission_id != null">

                    <div class="row">

                        <div class="card col-md-12">
                            
                            <div class="card-body" id="snap-box">

                                <div id="map"></div>

                                <video id="video" width="319" height="240" preload autoplay loop muted></video>
                                <canvas id="canvas" width="319" height="240"></canvas>

                                <button v-show="snap_image.length != photo_number" id="snap" class="btn btn-secondary btn-circle btn-lg waves-effect"><i class="fa fa-camera"></i></button>

                                <button v-show="snap_image.length == photo_number" @click="submit" class="btn btn-amber btn-circle btn-lg waves-effect"><i class="fa fa-check"></i></button>

                                <canvas id="photo_canvas" width="640" height="480"></canvas>

                                <div class='photo-stack' v-show ="snap_image.length > 0">

                                    <img :id="'image-'+(index+1)" v-for="(photo,index) in snap_image" :src="photo.src" class="img-fluid" />

                                </div>
    
                            </div>
                    
                        </div>

                    </div>

                </div>

            </section>

            <div id="toast">

                <div id="alert-icon-box"><i class="fa fa-warning"></i></div>

                <div id="alert-box"></div>

            </div>

            <div id="success_toast">

                <div id="save-icon-box"><i class="fa fa-save"></i></div>

                <div id="save-result-box">Saved!</div>

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

        <!-- Start Google Map Library -->
        <script src="https://maps.googleapis.com/maps/api/js?libraries=geometry,drawing&key=AIzaSyA6_FR24eJgBV5H-LPLMleoVG2d5wn0ut4"></script>
        <!-- End Google Map Library -->

        <!-- Start Vue JS Library -->
        <script src="https://unpkg.com/vue/dist/vue.js"></script>
        <script src="Script/custom.js"></script>
        <!-- End Vue JS Library -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.11/js/mdb.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="Script/tracking-min.js"></script>
        <script src="Script/face-min.js"></script>
        <script src="Script/eye-min.js"></script>
        <script src="Script/mouth-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.7.3/dat.gui.min.js"></script>
        <script src="Script/stats.min.js"></script>

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
                ref_sub_1: firebase.database().ref("Location"),
                ref_main_1: firebase.database().ref("Mission"),
                snap: null,
                    
                on(cb) {
                    this.ref.on("value", snap => {
                        this.snap = snap;
                        cb(snap.val());
                    });
                },
                on_sub_1(cb) {
                    this.ref_sub_1.on("value", snap => {
                        this.snap = snap;
                        cb(snap.val());
                    });
                },
                on_main_1(cb) {
                    this.ref_main_1.on("value", snap => {
                        this.snap = snap;
                        cb(snap.val());
                    });
                }
            };

            const vm = new Vue({
                el: "#app",
                data: {
                    loaded: false,
                    snap_loaded: false,
                    
                    facebook_user: JSON.parse(<?= json_encode($_user); ?>),

                    snap_image: [],

                    event_mission_id: <?= json_encode($event_mission_id) ?> || null,
                    mission_id: <?= json_encode($mission_id) ?> || null,

                    general_mission_id: <?= json_encode($general_mission_id) ?> || null,

                    general_mission: {},
                    event_mission: {},

                    photo_number: null,
                    encoded_location: null,

                    current_latitude: null,
                    current_longitude: null,
                    
                    face_detected: []
                },
                methods: {
                    load() {
                        db.ref_main_1.on("child_added", snap => {
                            if(snap.key == "Event") {
                                if(this.event_mission_id != null && this.mission_id != null) {
                                    let all_event_mission = snap.val()[this.event_mission_id] || {};

                                    this.event_mission = all_event_mission.Mission[this.mission_id] || {};

                                    this.encoded_location = this.event_mission.Location;
                                    this.photo_number = this.event_mission.Requirement;

                                }
                            }
                            else if(snap.key == "General") {
                                if(this.general_mission_id != null) {
                                    this.general_mission = snap.val()[this.general_mission_id] || {};

                                    this.encoded_location = this.general_mission.Location;
                                    this.photo_number = 1;
                                }  
                            }
                        });

                        if (!navigator.geolocation) {
                            alert("Sorry, the Geolocation API isn't supported in Your browser.");
                        } 
                        else {
                            navigator.geolocation.getCurrentPosition(function(position) {
                                // Get the coordinates of the current possition.
                                vm.current_latitude = position.coords.latitude;
                                vm.current_longitude = position.coords.longitude;
                            });
                        }
                        
                        setTimeout(() => {
                            this.loaded = true;
                        }, 1000);
                    },
                    signOut() {
                        SignOut_Facebook();
                    },
                    checkLocation(location) {
                        return google_map_check(location);
                    },
                    submit() {
                        if(this.checkLocation(this.encoded_location)) {
                            if(mode(this.face_detected) == true) {
                                let student_facebook_uid = db.ref.child(this.facebook_user.uid);

                                if(this.event_mission_id != null && this.mission_id != null) {
                                    let student_point = student_facebook_uid.child("Score").child("Point");

                                    student_point.transaction(function (currentPoint) { 
                                        return currentPoint + vm.event_mission.Point;
                                    });

                                    db.ref_main_1.child('Event').child(this.event_mission_id).child("Mission").child(this.mission_id).child('Completed_Student').set({
                                        Student_ID: this.facebook_user.uid
                                    });

                                    launch_success_toast();

                                    setTimeout(() => {
                                        location = "Index.php";
                                    }, 7000);
                                }

                                if(this.general_mission_id != null) {
                                    let student_point = student_facebook_uid.child("Score").child("Point");

                                    student_point.transaction(function (currentPoint) { 
                                        return currentPoint + vm.general_mission.Point;
                                    });

                                    db.ref_main_1.child('General').child(this.general_mission_id).child('Completed_Student').set({
                                        Student_ID: this.facebook_user.uid
                                    });

                                    launch_success_toast();

                                    setTimeout(() => {
                                        location = "Index.php";
                                    }, 7000);
                                }
                            }
                            else {
                                document.getElementById("alert-box").innerHTML = "Snap Again! No Face Detected!";
                                launch_toast();
                                setTimeout(() => {
                                    location = location;
                                }, 7000);
                            }
                        }
                        else {
                            document.getElementById("alert-box").innerHTML = "Snap Again! Invalid Location!";
                            launch_toast();
                            setTimeout(() => {
                                location = location;
                            }, 7000);
                        }
                    }
                },
                created() {
                    this.load();
                },
                watch: {
                    current_latitude: function(newValue, oldValue) {
                        return newValue;
                    },
                    current_longitude: function(newValue, oldValue) {
                        return newValue;
                    }
                },
                updated() {
                    if(!this.snap_loaded) {
                        snapPhoto();
                    }

                    if(this.snap_image.length > 0) {
                        for(let a = 0; a < this.snap_image.length; a++) {
                            Image_Detect((a+1));
                        }   
                    }
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

            function mode(array) {
                if(array.length == 0)
                    return null;

                let modeMap = {};
                let maxEl = array[0], maxCount = 1;

                for(let i = 0; i < array.length; i++) {
                    let el = array[i];

                    if(modeMap[el] == null)
                        modeMap[el] = 1;
                    else
                        modeMap[el]++;  

                    if(modeMap[el] > maxCount) {
                        maxEl = el;
                        maxCount = modeMap[el];
                    }
                }
                return maxEl;
            }
        </script>

        <script>
            function launch_toast() {

                var x = document.getElementById("toast");

                x.className = "show";

                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
                
            }

            function launch_success_toast() {

                var x = document.getElementById("success_toast");

                x.className = "show";

                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
                
            }
        </script>

        <script>
            const color_code = [
                "#DC143C", "#B22222", "#FF0000", "#8B0000", // Red
                "#FF4500", "#FFD700", "#FFA500", "#FF8C00", // Orange
                "#FFFF00", // Yellow
                "#32CD32", "#00FF00", "#00FF7F", // Green
                "#00BFFF", "#1E90FF", "#4169E1", "#0000FF", "#191970", "#7B68EE", // Blue
                "#EE82EE", "#FF00FF", "#8A2BE2", "#9400D3", "#4B0082", // Purple
                "#FF69B4", "#FF1493", "#C71585" // Pink
            ];

            function shuffleColor(color) {
                for (let i = 1; i <= 20; i++) {
                    color.sort(() => Math.random() - 0.5);
                }
            }

            function randomize() {
                var color = color_code.slice(0);
                shuffleColor(color);
                return color;
            }

            function snapPhoto() {
                let video = document.getElementById('video');
                let canvas = document.getElementById('canvas');
                let context = canvas.getContext('2d');

                let context_color = randomize()[0];

                let tracker = new tracking.ObjectTracker('face');
                tracker.setInitialScale(4);
                tracker.setStepSize(2);
                tracker.setEdgesDensity(0.1);
                
                tracking.track('#video', tracker, { camera: true });

                tracker.on('track', function(event) {
                    context.clearRect(0, 0, canvas.width, canvas.height);

                    event.data.forEach(function(rect) {
                        context.strokeStyle = context_color;
                        context.strokeRect(rect.x, rect.y, rect.width, rect.height);
                        context.font = '11px Helvetica';
                        context.fillStyle = "#FFFFFF";
                        // context.fillText('x: ' + rect.x + 'px', rect.x + rect.width + 5, rect.y + 11);
                        // context.fillText('y: ' + rect.y + 'px', rect.x + rect.width + 5, rect.y + 22);
                    });
                });

                let gui = new dat.GUI();
                gui.add(tracker, 'edgesDensity', 0.1, 0.5).step(0.01);
                gui.add(tracker, 'initialScale', 1.0, 10.0).step(0.1);
                gui.add(tracker, 'stepSize', 1, 5).step(0.1);

                // Elements for taking the snapshot
                let photo_canvas = document.getElementById('photo_canvas');
                let photo_context = photo_canvas.getContext('2d');

                vm.snap_image = [];

                // Trigger photo take
                document.getElementById("snap").addEventListener("click", function() {
	                photo_context.drawImage(video, 0, 0, 640, 480);

                    if(vm.snap_image.length >= vm.photo_number) {
                        alert(`Snap Image Cannot More Than ${vm.photo_number}`);
                    }
                    else {
                        vm.snap_image.push(convertCanvasToImage(photo_canvas));
                    }
                });

                vm.snap_loaded = true;
            }

            function convertCanvasToImage(canvas) {
	            var image = new Image();
	            image.src = canvas.toDataURL("image/png");
	            return image;
            }
        </script>

        <script>
            function google_map_check(location) {

                let gm = google.maps;
            
                let default_location = { lat: 3.216407, lng: 101.731062 };

                let map = new gm.Map(document.getElementById("map"), {
                    center: default_location,
                    zoom: 17,
                    disableDefaultUI: true,
                    disableDoubleClickZoom: true,
                    clickableIcons: false
                });

                let polygon = new gm.Polygon({
                    map,
                    fillOpacity: 0.1,
                    path: gm.geometry.encoding.decodePath(location)
                });

                let latlng = new gm.LatLng(vm.current_latitude, vm.current_longitude); 

                let inside = gm.geometry.poly.containsLocation(latlng, polygon);
                
                if (inside) {
                    return true;
                }
                else {
                    return false;
                }
            }
        </script>

        <script>
            function Image_Detect(index) {
                var img = document.getElementById('image-'+index);

                var tracker = new tracking.ObjectTracker(['face', 'eye', 'mouth']);
                tracker.setStepSize(1.7);

                tracking.track('#image-'+index, tracker);

                tracker.on('track', function(event) {
                    console.log(event);

                    if(event.data.length > 0) {
                        console.log(true);
                        vm.face_detected.push(true);
                    }
                    else {
                        console.log(false);
                        vm.face_detected.push(false);
                    }

                    event.data.forEach(function(rect) {
                        plot(rect.x, rect.y, rect.width, rect.height);
                    });
                });

                function plot(x, y, w, h) {
                    var rect = document.createElement('div');
                    document.querySelector('.photo-stack').appendChild(rect);
                    rect.classList.add('rect');
                    rect.style.width = w + 'px';
                    rect.style.height = h + 'px';
                    rect.style.left = (img.offsetLeft + x) + 'px';
                    rect.style.top = (img.offsetTop + y) + 'px';
                };
            }
        </script>
        <!-- End Custom JS -->

    </footer>
    <!-- END FOOTER -->

    <?php

        include 'Include/foot.php'
    
    ?>