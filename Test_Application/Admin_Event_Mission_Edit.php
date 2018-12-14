
    <?php 
    
        include 'Include/base.php';

        AUTHENTICATION();

        $title = "Admin Edit Event-Based Mission";

        $home_title = "Admin";

        $event_mission_id = GET('event_mission_id');

        if($event_mission_id == null) {
            REDIRECT('Admin_Display_Mission.php');
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
                                
                                <div class="stepwizard col-md-offset-3" id="mission-step">
                                    
                                    <div class="stepwizard-row setup-panel">
                                        
                                        <div class="stepwizard-step">
                                            
                                            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                            
                                            <p>Step 1</p>
                                        
                                        </div>

                                        <div class="stepwizard-step">

                                            <a :href="event_mission.Name && event_mission.From_Date && event_mission.To_Date ? '#step-2':'#'" type="button" class="btn btn-default btn-circle" :style="{ cursor:  event_mission.Name && event_mission.From_Date && event_mission.To_Date ? 'pointer':'not-allowed' }" @click="changeDate">2</a>

                                            <p>Step 2</p>

                                        </div>

                                    </div>

                                </div>
                        
                                <form id="set-mission-form" @submit.prevent="submit">

                                    <!--
                                        Example Event Name: Home Coming
                                        Example From Date: 16/03/2019 [dd/mm/yyyy]
                                        Example To Date: 17/03/2019 [dd/mm/yyyy]
                                    -->
                            
                                    <div class="row setup-content" id="step-1">
                            
                                        <div class="col-xs-6 col-md-offset-3">

                                            <div class="col-md-12">

                                                <h3>Step 1</h3>

                                                <div class="row" id="event-name-input">

                                                    <div class="col-md-12">
                                                
                                                        <div class="md-form mt-0">
                                            
                                                            <input type="text" class="form-control" v-model.trim="event_mission.Name" maxlength="50" v-focus required pattern="[A-Za-z0-9 ]+" placeholder="Event Name" @change="event_mission.Name = event_mission.Name.toUpperCase()">

                                                        </div>
                                    
                                                    </div>
                                            
                                                    <div class="col">
                                                
                                                        <div class="md-form mt-0">
                                                    
                                                            <input type="text" id="from" class="form-control" v-model.trim="event_mission.From_Date" required placeholder="From Date">
                                                            
                                                        </div>
                                            
                                                    </div>
                                            
                                                    <div class="col">
                                                
                                                        <div class="md-form mt-0">
                                                    
                                                            <input type="text" id="to" class="form-control" v-model.trim="event_mission.To_Date" required placeholder="To Date">

                                                        </div>
                                            
                                                    </div>
                                        
                                                </div>
                                    
                                                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" v-show="event_mission.Name && event_mission.From_Date && event_mission.To_Date" @click="changeDate">Next</button>

                                            </div>
                            
                                        </div>

                                    </div>


                                    <!--
                                        Example Mission Name: Photo With Anyone
                                        Example Requirement: 1
                                        Example Date: 16/03/2019 
                                        Example Start Time: 12:00AM 
                                        Example End Time: 01:00AM
                                        Example Location: Canteen 2
                                        Example Point: 5
                                    -->

                                    <div class="row setup-content example-1" id="step-2">

                                        <div class="col-xs-6 col-md-offset-3">

                                            <div class="col-md-12">

                                                <h3>Step 2</h3>

                                                <div id="map" class="z-depth-1"></div>

                                                <div class="alert alert-info" role="alert">
                                                    You can select the location in the table and it will show the area of the location selected for displaying purpose.
                                                </div>

                                                <div class="row">
                                            
                                                    <div class="col">
                                                
                                                        <div class="md-form mt-0">

                                                            <div class="row justify-content-end" id="add-mission-box">
                                                            
                                                                <div class="col-2">

                                                                    <button type="button" class="btn btn-outline-info waves-effect rounded" @click="addMission">Add Mission</button>

                                                                </div>
                                                            
                                                            </div>

                                                            <table id="event-tablePreview" class="table table-hover table-bordered">

                                                                <thead>

                                                                    <tr>

                                                                        <th>No</th>
                                                                        <th>Mission</th>
                                                                        <th>Requirement</th>
                                                                        <th>Date</th>
                                                                        <th>Start Time</th>
                                                                        <th>End Time</th>
                                                                        <th>Location</th>
                                                                        <th>Point</th>
                                                                        
                                                                    </tr>

                                                                </thead>
    
                                                                <tbody>

                                                                    <tr v-for = "(mission, index) in Object.values(missions)">

                                                                        <th scope="row">{{ index + 1 }}</th>

                                                                        <td>

                                                                            <select class="custom-select my-1" v-model.trim="mission.Name">
                                                    
                                                                                <option v-for="name in mission_name" :value="name.value">{{ name.text }}</option>
            
                                                                            </select>

                                                                        </td>

                                                                        <td>

                                                                            <input type="number" class="form-control" v-model.number="mission.Requirement" required pattern="[0-9]{1}" placeholder="Requirement" min="1" max="5" step="1">

                                                                        </td>

                                                                        <td>

                                                                            <select class="custom-select my-1" v-model.trim="mission.Date">
                                                    
                                                                                <option v-for="date in date_range" :value="date.value">{{ date.text }}</option>
            
                                                                            </select>

                                                                        </td>

                                                                        <td>

                                                                            <input type="time" class="form-control" v-model.trim="mission.Start_Time" required placeholder="Start Time"
                                                                            @input="validateTime(mission.Start_Time, mission.End_Time)">
                                                                            
                                                                        </td>

                                                                        <td>

                                                                            <input type="time" class="form-control" v-model.trim="mission.End_Time" required placeholder="End Time" @input="validateTime(mission.Start_Time, mission.End_Time)">

                                                                        </td>

                                                                        <td>

                                                                            <select @change="showPolygon()" onchange="changeBackground(this)" class="custom-select my-1" v-model.trim="mission.Location">
                                                    
                                                                                <option v-for="location in all_location" :value="location.value" :style="{ backgroundColor: location.background_color, color: location.color }">{{ location.text }}</option>

                                                                            </select>

                                                                        </td>

                                                                         <td>

                                                                            <input type="number" class="form-control" v-model.number="mission.Point" required pattern="[0-9]{1}" placeholder="Point" min="5" max="10" step="1">

                                                                        </td>

                                                                        <td>

                                                                            <button type="button" class="btn btn-outline-danger waves-effect rounded" @click="remove(index)">Remove Mission</button>

                                                                        </td>

                                                                    </tr>

                                                                </tbody>
                                                            
                                                            </table>

                                                        </div>
                                            
                                                    </div>
                                            
                                                </div>

                                                <button class="btn btn-primary prevBtn btn-lg pull-left" type="button">Previous</button>
                                                <button class="btn btn-success btn-lg pull-right">Save</button>

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

                    missions: [],
                    event_name: null,
                    from_date: null,
                    to_date: null,
                    mission_name: [
                        { text: 'Please Select A Mission', value: '' },
                        { text: 'Snap Photo with new Friend', value: 'Snap Photo with new Friend' },
                    ],
                    date_range: [],
                    all_location: [],

                    event_mission_id: <?= json_encode($event_mission_id) ?>,
                    event_mission: {}
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

                        db.ref_main_1.on("child_added", snap => {
                            if(snap.key == "Event") {
                                this.event_mission = snap.val()[this.event_mission_id] || {};

                                if(this.event_mission) {
                                    let mission = Object.values(this.event_mission.Mission);

                                    mission.forEach(function(a) { 
                                        vm.missions.push(
                                            { Name: a.Name, Requirement: a.Requirement, Date: a.Date, Start_Time: a.Start_Time,  End_Time: a.End_Time, Location: a.Location, Point: a.Point }
                                        ) 
                                    });
                                }
                            }
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
                    changeDate() {
                        var first_date = $("#from").datepicker('getDate') ;
                        first_date.setDate(first_date.getDate() || null);
                        var last_date = $("#to").datepicker('getDate');
                        last_date.setDate(last_date.getDate() || null);

                        vm.date_range = [];

                        vm.date_range.push({ text: 'Please Select Date', value: '' });

                        for (var d = first_date; d <= last_date; d.setDate(d.getDate() + 1)) {

                            let date = new Date(d).getDate() > 9 ? (new Date(d).getDate()):("0" + new Date(d).getDate());
                            let month = (new Date(d).getMonth() + 1) > 9 ? (new Date(d).getMonth() + 1):("0" + (new Date(d).getMonth() + 1));
                            let year = new Date(d).getFullYear();
                    
                            vm.date_range.push({ text: `${date}/${month}/${year}`, value: `${date}/${month}/${year}` });
                        }
                    },
                    addMission(){
                        if(this.missions.length < 5) {
                            this.missions.push(
                                { Name: '', Requirement: 1, Date: '', Start_Time: null,  End_Time: null, Location: '', Point: 5 }
                            );
                        }
                        else {
                            alert("Event Missions Cannot More Than 5 !");
                        }
                    },
                    remove(i) {
                        if (this.missions.length > 2) {
                            this.missions.splice(i, 1);
                        }
                        else {
                            alert("Event Missions Must At Least 2 !");
                        }
                    },
                    // capitalizeEachWord(word) {
                    //     return word.replace(/\w\S*/g, function(txt){
                    //         return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
                    //     });
                    // },
                    showPolygon() {
                        let color = null;

                        for(let i = 0; i < this.missions.length; i++) {
                            color = findColor(this.missions[i].Location);

                            if(this.missions[i].Location != "") {
                                addPolygon(this.missions[i].Location, color); // Follow the selected value real-time
                            }
                        }
                    },
                    validateTime(startTime = null, endTime = null) {

                        if(startTime && endTime) {
                            let timefrom = new Date();
                            let timeto = new Date();

                            let temporary_timefrom = startTime.split(":"); 
                            let temporary_timeto = endTime.split(":");

                            timefrom.setHours((parseInt(temporary_timefrom[0]) - 1 + 24) % 24);
                            timefrom.setMinutes(parseInt(temporary_timefrom[1]));

                            timeto.setHours((parseInt(temporary_timeto[0]) - 1 + 24) % 24);
                            timeto.setMinutes(parseInt(temporary_timeto[1]));

                            if (timeto < timefrom) {
                                alert("Start Time must not bigger than End Time !");   
                            }
                        }
                    },
                    submit() {
                        let current = new Date(); 
                        let date = current.getDate() > 9 ? (current.getDate()):("0" + current.getDate());
                        let month = (current.getMonth() + 1) > 9 ? (current.getMonth() + 1):("0" + (current.getMonth() + 1)); 
                        let year = current.getFullYear();

                        let hour = current.getHours() > 9 ? (current.getHours()):("0" + current.getHours());
                        let minute = current.getMinutes() > 9 ? (current.getMinutes()):("0" + current.getMinutes());
                        let second = current.getSeconds() > 9 ? (current.getSeconds()):("0" + current.getSeconds());

                        let event = db.ref_main_1.child("Event").push({
                            Name: this.event_mission.Name.toUpperCase(),
                            From_Date: this.event_mission.From_Date,
                            To_Date: this.event_mission.To_Date,
                            Created_Date: `${date}/${month}/${year} ${hour}:${minute}:${second}`,
                            Created_Admin: this.staff_id,
                            Event_ID: generate_part(4).toUpperCase()
                        });

                        vm.missions.forEach(function(mission) {
                            let task = event.child("Mission").push({
                                Name: mission.Name,
                                Requirement: mission.Requirement,
                                Date: mission.Date,
                                Start_Time: mission.Start_Time,
                                End_Time: mission.End_Time,
                                Location: mission.Location,
                                Point: mission.Point,
                                Mission_ID: generate_part(0).toUpperCase()
                            });
                        });

                        db.ref_main_1.child("Event").child(this.event_mission_id).remove();

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

            function generate_part(number) {
                let part = generate_uuid().split('-');

                return part[number];
            }
        </script>
       
        <script>
            $(document).ready(function () {
                var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn'),
                allPrevBtn = $('.prevBtn');

                allWells.hide();

                navListItems.click(function (e) {
                    e.preventDefault();

                    var $target = $($(this).attr('href')),

                    $item = $(this);
                
                    if (!$item.hasClass('disabled')) {
                    
                    navListItems.removeClass('btn-primary').addClass('btn-default');

                     $item.addClass('btn-primary');

                     allWells.hide();
                     
                     $target.show();
                     
                     $target.find('input:eq(0)').focus();
                    
                    }
                });
                
                allPrevBtn.click(function(){
                    
                    var curStep = $(this).closest(".setup-content"),

                    curStepBtn = curStep.attr("id"),

                    prevStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().prev().children("a");

                    prevStepWizard.removeAttr('disabled').trigger('click');
                });
                
                allNextBtn.click(function(){
                    
                    var curStep = $(this).closest(".setup-content"),
                    
                    curStepBtn = curStep.attr("id"),
                    
                    nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                    
                    curInputs = curStep.find("input[type='text'],input[type='url']"),
                    
                    isValid = true;
                    
                    $(".form-group").removeClass("has-error");
                    
                    for(let i = 0; i < curInputs.length; i++){
                        
                        if (!curInputs[i].validity.valid){
                            isValid = false;

                            $(curInputs[i]).closest(".form-group").addClass("has-error");
                        }
                    }
                    
                    if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
                });
                
                $('div.setup-panel div a.btn-primary').trigger('click');
            });
        </script>

        <script>
            $(function() {
                let dateFormat = "dd/mm/yy";

                $.datepicker.setDefaults({
                    minDate: new Date()
                });
                
                from = $("#from")
                        .datepicker({
                            changeMonth: true,
                            numberOfMonths: 1,
                            dateFormat,
                            onSelect(date) {
                                vm.from_date = date
                            },
                            onClose() {
                                let date = $(this).datepicker('getDate') ? $(this).datepicker('getDate'):null;
                                date.setDate(date.getDate() + 1);
                                to.datepicker("option", "minDate", date || new Date());
                            }
                        });

                to = $("#to")
                    .datepicker({
                        changeMonth: true,
                        numberOfMonths: 1,
                        dateFormat,
                        onSelect(date) {
                            vm.to_date = date
                        },
                        onClose() {
                            let date = $(this).datepicker('getDate') ? $(this).datepicker('getDate'):null;
                            date.setDate(date.getDate() - 1);
                            from.datepicker( "option", "maxDate", date || new Date());
                        }
                    });

            });
        </script>
        <!-- End Custom JS -->

    </footer>
    <!-- END FOOTER -->

    <?php 
    
        include 'Include/foot.php';

    ?>