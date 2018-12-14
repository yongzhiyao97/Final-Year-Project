
    <?php 
    
        include 'Include/base.php';

        AUTHENTICATION();

        $title = "Admin Create New General-Based Mission";

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

                <div id="set-mission-box">

                    <div class="row">

                        <div class="card col-md-12">
                            
                            <div class="card-body" id="mission-box">
                        
                                <form id="set-mission-form" @submit.prevent="submit">

                                    <!--
                                        Example Mission Name: Photo With Anyone
                                        Example Location: Canteen 2
                                        Example Date Time Mode: Daily
                                        Example Point: 5
                                    -->

                                    <div class="row">

                                        <div class="col-xs-6 col-md-offset-3">

                                            <div class="col-md-12">

                                                <div id="map" class="z-depth-1"></div>

                                                <div class="alert alert-info" role="alert">
                                                    You can select the location in the table and it will show the area of the location selected for displaying purpose.
                                                </div>

                                                <div class="row" id="general-mission-input">

                                                    <div class="col-md-12">
                                                        
                                                        <select class="custom-select my-1" v-model.trim="mission_Name">
                                                    
                                                            <option v-for="name in mission_name" :value="name.value">{{ name.text }}</option>
            
                                                        </select>
                                    
                                                    </div>
                                        
                                                </div>

                                                <div class="row" id="general-mission-input">

                                                    <div class="col-md-4">
                                                        
                                                        <select @change="showPolygon()" onchange="changeBackground(this)" class="custom-select my-1" v-model.trim="mission_Location">
                                                    
                                                            <option v-for="location in all_location" :value="location.value" :style="{ backgroundColor: location.background_color, color: location.color }">{{ location.text }}</option>

                                                        </select>
                                    
                                                    </div>

                                                    <div class="col-md-4">
                                                        
                                                        <select class="custom-select my-1" v-model.trim="mission_DateTimeMode">
                                                    
                                                            <option v-for="mode in Mode_DateTime" :value="mode.value">{{ mode.text }}</option>
            
                                                        </select>
                                    
                                                    </div>

                                                    <div class="col-md-4">
                                                        
                                                        <input type="number" class="form-control" v-model.number="mission_Point" required pattern="[0-9]{1}" placeholder="Point" min="1" max="5" step="1">
                                    
                                                    </div>
                                        
                                                </div>

                                                <button class="btn btn-success btn-lg pull-right" id="general-mission-save-button">Save</button>

                                            </div>

                                        </div>

                                    </div>

                                </form>
                            
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

        <!-- Start Google Map Library -->
        <script src="https://maps.googleapis.com/maps/api/js?libraries=geometry,drawing&key=AIzaSyCYBDh9xc4pgD1ErWX5AwUO4uszqsQbJ8c"></script>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.2/jquery.twbsPagination.min.js"></script>

        <!-- Start Custom JS -->
        <script>
            // Firebase & Vue & Google Map
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

            const gm = google.maps;

            const color_code = [
                "#DC143C", "#B22222", "#FF0000", "#8B0000", // Red
                "#FF4500", "#FFD700", "#FFA500", "#FF8C00", // Orange
                "#FFFF00", // Yellow
                "#32CD32", "#00FF00", "#00FF7F", // Green
                "#00BFFF", "#1E90FF", "#4169E1", "#0000FF", "#191970", "#7B68EE", // Blue
                "#EE82EE", "#FF00FF", "#8A2BE2", "#9400D3", "#4B0082", // Purple
                "#FF69B4", "#FF1493", "#C71585" // Pink
            ];

            const vm = new Vue({
                el: "#app",
                data: {
                    staff_id: null, 
                    staff_information: {},
                        
                    email: <?= json_encode($_email) ?>,
                    loaded: false,
                    image_url: null,

                    mission_Name: '',
                    mission_DateTimeMode: '',
                    mission_Location: '',
                    mission_Point: 1,
                    mission_name: [
                        { text: 'Please Select A Mission', value: '' },
                        { text: 'Snap Photo with new Friend', value: 'Snap Photo with new Friend' },
                    ],
                    Mode_DateTime: [
                        { text: 'Please Select A Date Time Mode', value: '' },
                        { text: 'Daily', value: 'DAILY' },
                        { text: 'Random Date Time', value: 'RANDOM' },
                    ],
                    all_location: []
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
                    location_load() {
                        let used = [], color = null;

                        db.ref_sub_1.on("child_added", snap => {

                            do {
                                color = randomize()[0];
                            } while (used.includes(color));

                            used.push(color);

                            this.all_location.push(
                                { text: snap.key, value: snap.val().Encoded_Path, background_color: color, color: "white" }
                            );

                        });

                        this.all_location.unshift(
                            { text: 'Location', value: '', background_color: "white", color: "black" }
                        );
                    },
                    // capitalizeEachWord(word) {
                    //     return word.replace(/\w\S*/g, function(txt){
                    //         return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                    //     });
                    // },
                    showPolygon() {
                        let color = null;

                        color = findColor(this.mission_Location);

                        addPolygon(this.mission_Location, color);// Follow the selected value real-time
                    },
                    submit() {
                        let current = new Date(); 
                        let date = current.getDate() > 9 ? (current.getDate()):("0" + current.getDate());
                        let month = (current.getMonth() + 1) > 9 ? (current.getMonth() + 1):("0" + (current.getMonth() + 1)); 
                        let year = current.getFullYear();

                        let hour = current.getHours() > 9 ? (current.getHours()):("0" + current.getHours());
                        let minute = current.getMinutes() > 9 ? (current.getMinutes()):("0" + current.getMinutes());
                        let second = current.getSeconds() > 9 ? (current.getSeconds()):("0" + current.getSeconds());

                        let end = new Date(year, 11, 31);

                        let randomDateTime = null;
                        let random_date = null;
                        let random_month = null; 
                        let random_year = null;
                        let random_hour = null;
                        let random_minutes = null;

                        if(this.mission_DateTimeMode.toUpperCase() == 'RANDOM') {
                            randomDateTime = roundTimeQuarterHour(generate_randomDateTime(current, end));

                            random_date = randomDateTime.getDate() > 9 ? (randomDateTime.getDate()):("0" + randomDateTime.getDate());
                            random_month = (randomDateTime.getMonth() + 1) > 9 ? (randomDateTime.getMonth() + 1):("0" + (randomDateTime.getMonth() + 1));
                            random_year = randomDateTime.getFullYear();
                            random_hour = randomDateTime.getHours() > 9 ? (randomDateTime.getHours()):("0" + randomDateTime.getHours());
                            random_minutes = randomDateTime.getMinutes() > 9 ? (randomDateTime.getMinutes()):("0" + randomDateTime.getMinutes());
                        }
                        
                        let general = db.ref_main_1.child("General").push({
                            Name: this.mission_Name,
                            DateTimeMode: this.mission_DateTimeMode.toUpperCase(),
                            RandomDateTime: this.mission_DateTimeMode.toUpperCase() == "RANDOM"? `${random_date}/${random_month}/${random_year} ${random_hour}:${random_minutes}:00`:null,
                            Location: this.mission_Location,
                            Point: this.mission_Point,
                            Created_Date: `${date}/${month}/${year} ${hour}:${minute}:${second}`,
                            Created_Admin: this.staff_id,
                            Mission_ID: generate_part().toUpperCase()
                        });

                        alert("Save");

                        window.location.href = "Admin_Display_Mission.php";
                    }
                }, 
                created() {
                    this.load();
                    this.location_load();
                    // this.isValid();
                }
            });

            const default_location = { lat: 3.216407, lng: 101.731062 };
                
            const map = new gm.Map($("#map")[0], {
                center: default_location,
                zoom: 17,
                disableDefaultUI: true,
                disableDoubleClickZoom: true,
                clickableIcons: false
            });

            const default_polygon = new gm.Polygon({
                map,
                path: gm.geometry.encoding.decodePath("_hsRkb{kRHKPELEVCLGDMJIh@SpBo@nCw@fAWlC_@rBWg@iBw@_BoCyB_AiAu@uAc@cBG]C_@?c@Fk@Ro@Zo@f@a@j@_@v@_A`@y@Rk@Je@q@e@k@i@cFiHQeAMsBKa@Is@K{GEs@SaAi@gAe@}@Q@QBsBz@aAP{IzEq@r@o@v@yA~ChDz@nAF^xCHdAJdB?|@MlAKtC?lABx@HfBBbCHfANfAChB?|@In@A`@@`@FNL^RnARbAPb@f@Zf@Tf@T^VfAbB"),
                fillOpacity: 0.1,
                strokeColor: "#00FFFF",
                fillColor: "#00FFFF", 
            });

            // function tConvert(time) {
            //     time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

            //     if (time.length > 1) {
            //         time = time.slice (1); 
            //         time[5] = +time[0] < 12 ? 'AM' : 'PM';
            //         time[0] = +time[0] % 12 || 12;
            //     }
            //     return time.join ('');
            // }

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

            function addPolygon(location, color) {
                var selected = new gm.Polygon({
                        map,
                        path: gm.geometry.encoding.decodePath(location),
                        fillOpacity: 0.1,
                        strokeColor: color,
                        fillColor: color,
                    });

                return selected;
            }

            function changeBackground(select) {
                selectedOption = select.options[select.selectedIndex];
                
                let color = null;

                for(let i = 0; i < vm.all_location.length; i++) {
                    if(selectedOption.value == vm.all_location[i].value) {
                        color = vm.all_location[i].background_color;
                    }
                }

                select.style.backgroundColor= color;
                select.style.color= "white";
            }

            function findColor(selected_location) {
                let color = null;

                for(let i = 0; i < vm.all_location.length; i++) {
                    if(selected_location == vm.all_location[i].value) {
                        color = vm.all_location[i].background_color;
                    }
                }

                return color;
            }

            function generate_randomDateTime(start, end) {
                return new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime()));
            }

            function roundTimeQuarterHour(time) {
                var timeToReturn = new Date(time);

                timeToReturn.setMilliseconds(Math.round(time.getMilliseconds() / 1000) * 1000);
                timeToReturn.setSeconds(Math.round(timeToReturn.getSeconds() / 60) * 60);
                timeToReturn.setMinutes(Math.round(timeToReturn.getMinutes() / 15) * 15);
                return timeToReturn;
            }

            function generate_uuid() {
                let d = Date.now();

                if (typeof performance !== 'undefined' && typeof performance.now === 'function'){
                    d += performance.now(); //use high-precision timer if available
                }

                return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
                    let r = (d + Math.random() * 16) % 16 | 0;
                    d = Math.floor(d / 16);
                    return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
                });
            }

            function generate_part() {
                let part = generate_uuid().split('-');

                return part[0];
            }
        </script>
        <!-- End Custom JS -->

    </footer>
    <!-- END FOOTER -->

    <?php 
    
        include 'Include/foot.php';

    ?>