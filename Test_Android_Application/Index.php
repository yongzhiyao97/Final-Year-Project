    
    <?php 
    
        include 'Include/base.php';

        AUTHENTICATION();

        $title = "Index";

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

            <section>

                <div id="tab-box">

                    <input id="tab1" type="radio" name="tabs" checked>
                    <label for="tab1" id="tab1">Mission</label>

                    <!-- <input id="tab2" type="radio" name="tabs">
                    <label for="tab2" id="tab2">Dribbble</label> -->

                    <input id="tab2" type="radio" name="tabs">
                    <label for="tab2" id="tab2">Stack Overflow</label>

                    <input id="tab3" type="radio" name="tabs">
                    <label for="tab3" id="tab3">Student Information</label>

                    <input id="tab4" type="radio" name="tabs">
                    <label for="tab4" id="tab4">Student Information</label>

                    <section id="content1">

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link active" id="pills-general-tab" data-toggle="pill" href="#pills-general" role="tab" aria-controls="pills-general" aria-selected="true">General <span class="badge badge-info">{{ ((Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == "DAILY").length)+(Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == "RANDOM" && compareDate(v.RandomDateTime) == true).length)) }}</span></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="pills-event-tab" data-toggle="pill" href="#pills-event" role="tab" aria-controls="pills-event" aria-selected="false">Event <span class="badge badge-info">{{ Object.values(all_event_mission).filter(v => compareDate(v.To_Date) == true).length }}</span></a>
                            </li>

                        </ul>

                        <div class="tab-content" id="pills-tabContent">

                            <div class="tab-pane fade show active" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">

                                <ul class="nav nav-pills" id="myTab" role="tablist">
                                        
                                    <li class="nav-item">
                                
                                        <a class="nav-link active" id="pills-general-daily-tab" data-toggle="tab" href="#pills-general-daily" role="tab" aria-controls="pills-general-daily" aria-selected="true">Daily <span class="badge badge-dark">{{ Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == "DAILY").length }}</span></a>
                        
                                    </li>
                            
                                    <li class="nav-item">

                                        <a class="nav-link" id="pills-general-random-tab" data-toggle="tab" href="#pills-general-random" role="tab" aria-controls="pills-general-random" aria-selected="false">Random <span class="badge badge-dark">{{ Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == "RANDOM" && compareDate(v.RandomDateTime) == true).length }}</span></a>

                                    </li>
                                        
                                </ul>

                                <div class="tab-content" id="myTabContent">

                                    <div class="tab-pane fade show active" id="pills-general-daily" role="tabpanel" aria-labelledby="pills-general-daily-tab">

                                        <div class="container" id="general-information-wrapper">

                                            <div class="row">

                                                <div class="col col-md-12" id="general-information-box">

                                                    <div class="table-responsive">

                                                        <table id="general-daily-tablePreview" class="table table-borderless table-striped table-hover">

                                                            <thead>

                                                                <tr>

                                                                    <th>Mission</th>
    
                                                                </tr>

                                                            </thead>

                                                            <tbody>

                                                                <tr v-for="general_mission in Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == 'DAILY')">

                                                                    <td>

                                                                        Complete the {{ general_mission.Name }} at {{ changeLocationName(general_mission.Location) }} [{{ general_mission.Point }} point(s)]

                                                                        <div id="mission-button">

                                                                            <button class="btn btn-pink btn-circle waves-effect" @click="redirect_Snap_Photo(Object.entries(all_general_mission).filter(v => v[1].Mission_ID == general_mission.Mission_ID)[0][0])"><i class="fa fa-arrow-right"></i></button>

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

                                    <div class="tab-pane fade" id="pills-general-random" role="tabpanel" aria-labelledby="pills-general-random-tab">

                                        <div class="container" id="general-information-wrapper">

                                            <div class="row">

                                                <div class="col col-md-12" id="general-information-box">

                                                    <div class="table-responsive">

                                                        <table id="general-random-tablePreview" class="table table-borderless table-striped table-hover">

                                                            <thead>

                                                                <tr>

                                                                    <th>Mission</th>
    
                                                                </tr>

                                                            </thead>

                                                            <tbody>

                                                                <tr v-for="general_mission in Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == 'RANDOM' && compareDate(v.RandomDateTime) == true)">

                                                                    <td>

                                                                        Complete the {{ general_mission.Name }} at {{ changeLocationName(general_mission.Location) }} start from {{ changeDateTimeFormat(general_mission.RandomDateTime) }} to end of the day[{{ general_mission.Point }} point(s)]

                                                                        <div id="mission-button" v-show="equalDate(general_mission.RandomDateTime) == true">

                                                                            <button class="btn btn-pink btn-circle waves-effect" @click="redirect_Snap_Photo(Object.entries(all_general_mission).filter(v => v[1].Mission_ID == general_mission.Mission_ID)[0][0])"><i class="fa fa-arrow-right"></i></button>

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

                                </div>

                            </div>

                            <div class="tab-pane fade" id="pills-event" role="tabpanel" aria-labelledby="pills-event-tab">

                                <div class="container" id="event-information-wrapper">
                                    
                                    <div class="row">
                                        
                                        <div class="col">

                                            <div class="table-responsive">
                                                
                                                <table id="event-tablePreview" class="table table-borderless table-striped table-hover">
                                                    
                                                    <thead>
                                                        
                                                        <tr>
                                                            
                                                            <th>Event Name</th>
                                                            
                                                        </tr>
                                                        
                                                    </thead>
                                                    
                                                    <tbody>

                                                        <tr v-for="event_mission in Object.values(all_event_mission).filter(v => compareDate(v.To_Date) == true)">

                                                            <td>

                                                                {{ event_mission.Name }} [{{ event_mission.From_Date }} - {{ event_mission.To_Date }}]

                                                                <div id="mission-button" v-show="equalDateRange(event_mission.From_Date, event_mission.To_Date) == true">

                                                                    <button class="btn btn-pink btn-circle waves-effect" @click="redirectEventDetail(Object.entries(all_event_mission).filter(v => v[1].Event_ID == event_mission.Event_ID)[0][0])"><i class="fa fa-arrow-right"></i></button>

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

                        </div>

                    </section>

                    <!-- <section id="content2">
                        
                        
                        <button v-show="get_location_button_visibility" @click="getLocation" type="button" class="btn btn-info">Check My Location</button>

                        <p v-show="current_latitude != null && current_longitude != null">Latitude: {{ current_latitude | number(3) }} || Longitude: {{ current_longitude | number(3) }}</p>

                    </section> -->

                    <section id="content2">

                        <div class="list-group" v-if="Object.values(student_friend) <= 0">

                            <div class="list-group-item list-group-item-action flex-column align-items-start">

                                <div class="d-flex w-100 justify-content-between">

                                    <h6 class="mb-2 h6">No Friend</h6>

                                </div>

                            </div>

                        </div>

                        <div class="list-group" v-else>

                            <div class="list-group-item list-group-item-action flex-column align-items-start" v-for="(friend, index) in Object.values(student_friend)">

                                <div class="d-flex w-100 justify-content-between">

                                    <h6 class="mb-2 h6">

                                        <img id="friend_image" :src="changePhotoURL(friend.Facebook_UID)" class="img-fluid" />&nbsp;{{  changeDisplayName(friend.Facebook_UID) }}

                                    </h6>

                                    <small>

                                        <time class="timeago" :datetime="changeDateTime(friend.Add_Friend_DateTime)"></time>

                                    </small>

                                </div>

                                <div class="container" id="button-wrapper">

                                    <div class="row">

                                        <div class="col-12" id="friend-button-box">
                                            
                                            <button type="button" class="btn btn-outline-danger waves-effect" @click="removeFriend(friend.Facebook_UID, Object.entries(student_friend)[index][0])">Delete</button>
                                        
                                        </div>


                                    </div>

                                </div>
    
                            </div>

                        </div>
                        
                    </section>

                    <section id="content3">

                        <div class="list-group" v-show="Object.values(student_facebook_friend_request_information).length <= 0">

                            <div class="list-group-item list-group-item-action flex-column align-items-start">

                                <div class="d-flex w-100 justify-content-between">

                                    <h6 class="mb-2 h6">No Friend Request</h6>

                                </div>

                            </div>

                        </div>

                        <div class="list-group" v-show="Object.values(student_facebook_friend_request_information).length > 0">

                            <div class="list-group-item list-group-item-action flex-column align-items-start" v-for="(request, index) in Object.values(student_facebook_friend_request_information)">

                                <div class="d-flex w-100 justify-content-between">

                                    <h6 class="mb-2 h6"><img id="friend_image" :src="changePhotoURL(request.Facebook_UID)" class="img-fluid" />&nbsp;{{ changeDisplayName(request.Facebook_UID) }}</h6>

                                    <small>

                                        <time class="timeago" :datetime="changeDateTime(request.Request_DateTime)"></time>

                                    </small>

                                </div>

                                <div class="container" id="button-wrapper">

                                    <div class="row">

                                        <div class="col-6">
                                            
                                            <button type="button" class="btn btn-outline-primary waves-effect" @click="addFriend(request.Facebook_UID, Object.entries(student_facebook_friend_request_information)[index][0])">Add</button>
                                        
                                        </div>

                                        <div class="col-6">
                                            
                                            <button type="button" class="btn btn-outline-danger waves-effect" @click="removeFriendRequest(Object.entries(student_facebook_friend_request_information)[index][0])">Delete</button>
                                        
                                        </div>


                                    </div>

                                </div>
    
                            </div>

                        </div>
                        
                    </section>

                    <section id="content4">

                        <div class="container">

                            <div class="row">

	                            <div class="col-lg-4">
	                                <div class="our-team-main">
	
	                                    <div class="team-front">

                                            <img :src="(facebook_user.photoURL + '?type=large')" class="img-fluid" />
                                            
                                            <h3>{{ facebook_user.displayName }}</h3>

                                            <h4 v-show="student_point != null">Score: {{ student_point }}</h4>
                                            
                                            <div id="qrcode"></div>
	                                        
	                                    </div>
	
	                                    <div class="team-back">

                                            <div id="button-box">

                                                <a href="#" role="button" class="btn btn-pink" @click="signOut"><i class="fa fa-sign-in"></i>&nbsp;Sign Out</a>

                                            </div>

	                                    </div>
	
	                                </div>
	                            </div>
                            
                            </div>

                        </div>

                    </section>

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
                    qr_code_loaded: false,
                    
                    facebook_user: JSON.parse(<?= json_encode($_user); ?>),

                    student_point: null,

                    student_facebook_friend_request_information: {},
                    student_friend: {},

                    get_location_button_visibility: false,

                    current_latitude: null,
                    current_longitude: null,

                    all_location: [],

                    all_general_mission: {},
                    all_event_mission: {},

                    completed_event_mission_student: {},
                    completed_general_mission_student: {},
                },
                methods: {
                    load() {
                        db.ref.on("child_added", snap => {
                            if(snap.key == this.facebook_user.uid) {
                                let request = snap.val()['Request'] || {};
                                this.student_facebook_friend_request_information = request['Friend'] || {};

                                this.student_friend = snap.val()['Friend'] || {};

                                let score = snap.val()['Score'] || {};
                                this.student_point = snap.val()['Score'].Point || null;
                            }
                        });

                        db.ref_main_1.on("child_added", snap => {
                            if(snap.key == "Event") {
                                this.all_event_mission = snap.val() || {};
                            }
                            else if(snap.key == "General") {
                                this.all_general_mission = snap.val() || {};
                                let mission_id = [];

                                Object.values(this.all_general_mission).forEach(function(a){
                                    if(a.Completed_Student) {  
                                        Object.values(a.Completed_Student).forEach(function(b) {
                                            if(b == vm.facebook_user.uid) {
                                                mission_id.push(Object.entries(vm.all_general_mission).filter(v => v[1].Mission_ID == a.Mission_ID)[0][0]);
                                            }
                                        });
                                    }
                                });

                                mission_id.forEach(function(a) {
                                    delete vm.all_general_mission[a];
                                });
                            }
                        });

                        if (!navigator.geolocation) {
                            this.get_location_button_visibility = false;
                            alert("Sorry, the Geolocation API isn't supported in Your browser.");
                        } 
                        else {
                            this.get_location_button_visibility = true;
                        }

                        setTimeout(() => {
                            this.loaded = true;
                        }, 1000);
                    },
                    location_load() {
                        db.ref_sub_1.on("child_added", snap => {
                            this.all_location.push(
                                { text: snap.key, value: snap.val().Encoded_Path }
                            );
                        });
                    },
                    signOut() {
                        SignOut_Facebook();
                    },
                    changeDisplayName(facebook_uid) {
                        return changetoDisplayName(facebook_uid);
                    },
                    changePhotoURL(facebook_uid) {
                        return changetoPhotoURL(facebook_uid);
                    },
                    changeDateTime(datetime) {
                        return dtConvert(datetime)
                    },
                    addFriend(facebook_uid, object_key) {
                        let current = new Date(); 
                        let date = current.getDate() > 9 ? (current.getDate()):("0" + current.getDate());
                        let month = (current.getMonth() + 1) > 9 ? (current.getMonth() + 1):("0" + (current.getMonth() + 1)); 
                        let year = current.getFullYear();

                        let hour = current.getHours() > 9 ? (current.getHours()):("0" + current.getHours());
                        let minute = current.getMinutes() > 9 ? (current.getMinutes()):("0" + current.getMinutes());
                        let second = current.getSeconds() > 9 ? (current.getSeconds()):("0" + current.getSeconds());

                        db.ref.child(this.facebook_user.uid).child("Friend").push({
                            Facebook_UID: facebook_uid,
                            Add_Friend_DateTime: `${date}/${month}/${year} ${hour}:${minute}:${second}`
                        });
                        
                        db.ref.child(facebook_uid).child("Friend").push({
                            Facebook_UID: this.facebook_user.uid,
                            Add_Friend_DateTime: `${date}/${month}/${year} ${hour}:${minute}:${second}`
                        });

                        vm.$delete(this.student_facebook_friend_request_information, object_key);
                        db.ref.child(this.facebook_user.uid).child("Request").child("Friend").child(object_key).remove();

                        db.ref.on("child_added", snap => {
                            if(snap.key == this.facebook_user.uid) {
                                this.student_friend = snap.val()['Friend'] || {};
                            }
                        });
                    },
                    removeFriendRequest(object_key) {
                        vm.$delete(this.student_facebook_friend_request_information, object_key);
                        db.ref.child(this.facebook_user.uid).child("Request").child("Friend").child(object_key).remove();
                    },
                    removeFriend(facebook_uid, object_key) {
                        vm.$delete(this.student_friend, object_key);
                        db.ref.child(this.facebook_user.uid).child("Friend").child(object_key).remove();

                        let friend_push_id = null;

                        let friend = {};

                        db.ref.on("child_added", snap => {
                            if(snap.key == facebook_uid) {
                                friend = snap.val()['Friend'] || {};
                            }
                        });

                        let search = Object.values(friend);

                        search.forEach(function (a) {
                            if(a.Facebook_UID == vm.facebook_user.uid) {
                                friend_push_id = Object.keys(friend)
                            }
                        });

                        friend_push_id.forEach(function(a) {
                            db.ref.child(facebook_uid).child("Friend").child(a).remove();
                        });

                        db.ref.on("child_added", snap => {
                            if(snap.key == this.facebook_user.uid) {
                                this.student_friend = snap.val()['Friend'] || {};
                            }
                        });
                    },
                    getLocation() {
                        get_location();
                    },
                    compareDate(date) {
                        return compareDate(date);
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
                    changeDateTimeFormat(datetime) {
                        return dtConvert_v2(datetime);
                    },
                    changeTimeFormat(time) {
                        return tConvert(time);
                    },
                    redirect_Snap_Photo(id) {
                        location = `Snap_Photo.php?general_mission_id=${id}`;
                    },
                    redirectEventDetail(id) {
                        location = `Event_Mission_Detail.php?event_mission_id=${id}`
                    },
                    equalDate(datetime) {
                        return equalDate(datetime);
                    },
                    equalDateRange(start_datetime, end_datetime) {
                        return equalDateRange(start_datetime, end_datetime)
                    }
                },
                created() {
                    this.load();
                    this.location_load();
                },
                watch: {
                    student_friend: {
                        deep: true,
                        handler(val, oldVal) {
                        }
                    }
                },
                updated() {
                    if(!this.qr_code_loaded) {
                        qrCode();
                    }
                    
                    timeAgo();

                    let general = Object.values(this.all_general_mission);

                    if(general.filter(v => v.DateTimeMode.toUpperCase() == 'DAILY').length > 0) {
                        data_table('general-daily-tablePreview');
                    }

                    if(general.filter(v => v.DateTimeMode.toUpperCase() == 'RANDOM' && compareDate(v.RandomDateTime) == true).length > 0) {
                        data_table('general-random-tablePreview');
                    }

                    let event = Object.values(this.all_event_mission);

                    if(event.filter(v => this.compareDate(v.To_Date) == true).length > 0) {
                        data_table('event-tablePreview');
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

            function changetoDisplayName(facebook_uid) {
                let display_name = null;

                db.ref.on("child_added", snap => {
                    if(snap.key == facebook_uid) {
                        let facebook = snap.val()['Facebook'] || {};
                        display_name = facebook.Display_Name;
                    }
                });

                return display_name;
            }

            function changetoPhotoURL(facebook_uid) {
                let photoURL = null;

                db.ref.on("child_added", snap => {
                    if(snap.key == facebook_uid) {
                        let facebook = snap.val()['Facebook'] || {};
                        photoURL = facebook.Photo_URL;
                    }
                });

                return photoURL;
            }

            function dtConvert(datetime) {
                let date_part = datetime.split('/');
                let new_date = new Date(`${date_part[1]}/${date_part[0]}/${date_part[2]}`);

                return new_date;
            }

            function compareDate(datetime) {

                let today = new Date();

                let date_part = datetime.split('/');

                let new_date = new Date(`${date_part[1]}/${date_part[0]}/${date_part[2]}`);

                if(new_date >= today) {
                    return true;
                }
                else {
                    return false;
                }
            }

            function equalDate(datetime) {

                let today = new Date();

                let date_part = datetime.split('/');

                let new_date = new Date(`${date_part[1]}/${date_part[0]}/${date_part[2]}`);

                let start_date = new_date;

                let end_date = new_date.setHours(23,59,59,999);

                if(start_date == today && today <= end_date) {
                    return true;
                }
                else {
                    return false;
                }
            }

            function equalDateRange(start_datetime, end_datetime) {

                let today = new Date();

                let start_date_part = start_datetime.split('/');
                let new_start_date = new Date(`${start_date_part[1]}/${start_date_part[0]}/${start_date_part[2]}`);

                let end_date_part = end_datetime.split('/');
                let new_end_date = new Date(`${end_date_part[1]}/${end_date_part[0]}/${end_date_part[2]}`);

                if(new_start_date == today && today <= new_end_date) {
                    return true;
                }
                else {
                    return false;
                }
            }

            function dtConvert_v2(datetime) {
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
                    "pageLength": 2,
                    "pagingType": "numbers"
                });

                $('.dataTables_length').addClass('bs-select');
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

            var color = randomize()[0];

            var requestPath = window.location.origin + "/Friend_Request.php?friend_id=" + vm.facebook_user.uid; // 94RUvkwy6vRjqw1YQnKBy2sZbQH2

            function qrCode() {
                $('#qrcode').qrcode({
                    render: "canvas",
                    text: requestPath,
                    width: 200,
                    height: 200,
                    ecLevel: 'H',
                    size: 200,
                    background: "#FFFFFF",
                    foreground: color,
                    src: vm.facebook_user.photoURL,
                    imgWidth: 50,
                    imgHeight: 50
                });

                vm.qr_code_loaded = true;
            }
        </script>

        <script>
            function timeAgo(datetime) {
                $('time.timeago').timeago();
            }
        </script>

        <script>
            function get_location() {
                if(vm.get_location_button_visibility) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        // Get the coordinates of the current possition.
                        vm.current_latitude = position.coords.latitude;
                        vm.current_longitude = position.coords.longitude;
                    });
                }
            }
        </script>
        <!-- End Custom JS -->

    </footer>
    <!-- END FOOTER -->

    <?php

        include 'Include/foot.php'
    
    ?>