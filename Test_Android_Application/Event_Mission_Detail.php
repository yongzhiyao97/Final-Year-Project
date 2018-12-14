    
    <?php 
    
        include 'Include/base.php';

        AUTHENTICATION();

        $title = "Event Detail";

        $back_redirect = "Index";

        $event_mission_id = GET('event_mission_id');

        if($event_mission_id == null) {
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

                <div id="event-detail-box">

                    <div class="row">

                        <div class="card col-md-12">
                            
                            <div class="card-body" id="event-box">
                                
                                <div class="table-responsive">
                                    
                                    <table id="event-display-tablePreview" class="table table-borderless table-striped table-hover">
                                        
                                        <thead>
                                            
                                            <tr>
                                                
                                                <th>Mission</th>
                                                            
                                            </tr>
                                                        
                                        </thead>
                                        
                                        <tbody>
                                            
                                            <tr v-for="mission in missions">
                                                
                                                <td>
                                                    
                                                Complete the {{ mission.Requirement }} {{ mission.Name }} at {{ changeLocationName(mission.Location) }} in {{ mission.Date }} between {{ changeTimeFormat(mission.Start_Time) }} and {{ changeTimeFormat(mission.End_Time) }} [{{ mission.Point }} point(s)]
                                                    
                                                        <div id="mission-button" v-show="equalDate(mission.Date, mission.Start_Time, mission.End_Time) == true">
                                                            
                                                            <button class="btn btn-pink btn-circle waves-effect" @click="action(Object.entries(event_mission.Mission).filter(v => v[1].Mission_ID == mission.Mission_ID)[0][0])"><i class="fa fa-arrow-right"></i></button>
                                                            
                                                        </div>


                                                </td>
                                            
                                            </tr>
                                        
                                        </tbody>
                                    
                                    </table>
                                    
                                </div>

                            </div>
                    
                        </div>

                    </div>

                </div>

            </section>

            <!-- <div id="toast">

                <div id="alert-icon-box"><i class="fa fa-warning"></i></div>

                <div id="alert-box">
                    Error !
                </div>

            </div> -->

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
        <script src="Script/datatables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="Script/jquery.qrcode.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.6.3/jquery.timeago.min.js"></script>

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
                    
                    facebook_user: JSON.parse(<?= json_encode($_user); ?>),
                    
                    missions: [],
                    all_location: [],

                    event_mission_id: <?= json_encode($event_mission_id) ?>,
                    event_mission: {},
                },
                methods: {
                    load() {
                        db.ref_main_1.on("child_added", snap => {
                            if(snap.key == "Event") {
                                this.event_mission = snap.val()[this.event_mission_id] || {};
                                let mission_id = [];

                                if(this.event_mission) {
                                    let mission = Object.values(this.event_mission.Mission);
                                    
                                    mission.forEach(function(a) { 
                                        if(a.Completed_Student) {  
                                            Object.values(a.Completed_Student).forEach(function(b) {
                                                if(b == vm.facebook_user.uid) {
                                                    Object.entries(vm.event_mission.Mission).filter(v => v[1].Mission_ID == a.Mission_ID)[0][0];
                                                    mission_id .push(Object.entries(vm.event_mission.Mission).filter(v => v[1].Mission_ID == a.Mission_ID)[0][0]);
                                                }
                                            });
                                        }
                                    });

                                    mission_id.forEach(function(a) {
                                        delete vm.event_mission.Mission[a];
                                    });

                                    mission = Object.values(this.event_mission.Mission);

                                    mission.forEach(function(a) { 
                                        vm.missions.push(
                                            { Name: a.Name, Requirement: a.Requirement, Date: a.Date, Start_Time: a.Start_Time,  End_Time: a.End_Time, Location: a.Location, Point: a.Point, Mission_ID: a.Mission_ID }
                                        )
                                    });

                                }
                            }
                        });

                        setTimeout(() => {
                            this.loaded = true;
                        }, 1000);
                    },
                    signOut() {
                        SignOut_Facebook();
                    },
                    location_load() {
                        db.ref_sub_1.on("child_added", snap => {
                            this.all_location.push(
                                { text: snap.key, value: snap.val().Encoded_Path }
                            );
                        });
                    },
                    changeLocationName(location_value) {
                        let location_text = null;

                        for(let i = 0; i < this.all_location.length; i++) {
                            if(location_value == this.all_location[i].value) {
                                location_text = this.all_location[i].text;
                            }
                        }

                        return location_text;
                    },
                    changeDateTimeFormat(datetime){
                        return dtConvert(datetime);
                    },
                    changeTimeFormat(time) {
                        return tConvert(time);
                    },
                    equalDate(date, start_time, end_time) {
                        return equalDate(date, start_time, end_time)
                    },
                    action(id) {
                        location = `Snap_Photo.php?event_mission_id=${this.event_mission_id}&mission_id=${id}`;
                    }
                },
                created() {
                    this.load();
                    this.location_load();
                },
                updated() {
                    let missions = Object.values(this.missions);

                    if(missions.length > 0) {
                        data_table('event-display-tablePreview');
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

            function dtConvert(datetime) {
                let date_part = datetime.split('/');
                let new_date = new Date(`${date_part[1]}/${date_part[0]}/${date_part[2]}`);

                let date = new_date.getDate() > 9 ? (new_date.getDate()):("0" + new_date.getDate());
                let month = (new_date.getMonth() + 1) > 9 ? (new_date.getMonth() + 1):("0" + (new_date.getMonth() + 1)); 
                let year = new_date.getFullYear();

                let temporary_hour = new_date.getHours();
                let minute = new_date.getMinutes() > 9 ? (new_date.getMinutes()):("0" + new_date.getMinutes());
                let second = new_date.getSeconds() > 9 ? (new_date.getSeconds()):("0" + new_date.getSeconds());
                let meridian = temporary_hour < 12 ? 'AM' : 'PM';

                temporary_hour = temporary_hour % 12;
                temporary_hour = temporary_hour ? temporary_hour : 12;

                let hour = temporary_hour > 9 ? (temporary_hour):("0" + temporary_hour);

                return `${date}/${month}/${year} ${hour}:${minute}${meridian}`;
            }

            function equalDate(date, start_time, end_time) {

                let today = new Date();

                let date_part = date.split('/');

                let start_date = new Date(`${date_part[1]}/${date_part[0]}/${date_part[2]} ${start_time}`);
                let end_date = new Date(`${date_part[1]}/${date_part[0]}/${date_part[2]} ${end_time}`);

                if(start_date == today && today <= end_date) {
                    return true;
                }
                else {
                    return false;
                }
            }
            
            function tConvert(time) {
                time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

                if (time.length > 1) {
                    time = time.slice (1); 
                    time[5] = +time[0] < 12 ? 'AM' : 'PM';
                    time[0] = +time[0] % 12 || 12;
                }
                return time.join ('');
            }
        </script>

        <script>
            function data_table(table_id) {
                $('#'+table_id).DataTable({
                    "pageLength": 3,
                    "pagingType": "numbers"
                });

                $('.dataTables_length').addClass('bs-select');
            }
        </script>

        <script>
            // function launch_toast() {

            //     var x = document.getElementById("toast");

            //     x.className = "show";

            //     setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
                
            // }
        </script>
        <!-- End Custom JS -->

    </footer>
    <!-- END FOOTER -->

    <?php

        include 'Include/foot.php'
    
    ?>