
    <?php 
    
        include 'Include/base.php';

        AUTHENTICATION();

        $title = "Admin Display Mission";

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

                <div id="manage-display-box">

                    <div class="row">

                        <div id="map" class="z-depth-1 col-md-6 display"></div>

                        <div class="card col-md-6">
                            
                            <div class="card-body" id="display-box">

                                <div class="row justify-content-end">

                                    <div class="col-3">

                                        <button type="button" class="btn btn-outline-info waves-effect rounded" data-toggle="modal" data-target="#modalAddMissionBox">Add New Mission</button>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col">
                                        
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        
                                            <li class="nav-item">
                                            
                                                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General <span class="badge badge-info">{{ ((Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == "DAILY").length)+(Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == "RANDOM" && compareDate(v.RandomDateTime) == true).length)) }}</span></a>
                                    
                                            </li>
                                        
                                            <li class="nav-item">

                                                <a class="nav-link" id="event-tab" data-toggle="tab" href="#event" role="tab" aria-controls="event" aria-selected="false">Event <span class="badge badge-info">{{ Object.values(all_event_mission).filter(v => compareDate(v.To_Date) == true).length }}</span></a>

                                            </li>

                                            <li class="nav-item">

                                                <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">History <span class="badge badge-info">{{ ((Object.values(all_event_mission).filter(v => compareDate(v.To_Date) == false).length)+Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == "RANDOM" && compareDate(v.RandomDateTime) == false).length) }}</span></a>

                                            </li>

                                            <li class="nav-item">

                                                <a class="nav-link" id="filter-tab" data-toggle="tab" href="#filter" role="tab" aria-controls="filter" aria-selected="false">Filter <span class="badge badge-info">{{ ((Object.values(generated_event_mission).length)+((Object.values(generated_general_mission).length))) }}</span></a>

                                            </li>

                                        </ul>
                                    
                                        <div class="tab-content" id="myTabContent">

                                            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">

                                                <ul class="nav nav-pills" id="myTab" role="tablist">
                                        
                                                    <li class="nav-item">
                                            
                                                        <a class="nav-link active" id="general-daily-tab" data-toggle="tab" href="#general-daily" role="tab" aria-controls="general-daily" aria-selected="true">Daily Mission <span class="badge badge-dark">{{ Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == "DAILY").length }}</span></a>
                                    
                                                    </li>
                                        
                                                    <li class="nav-item">

                                                        <a class="nav-link" id="general-random-tab" data-toggle="tab" href="#general-random" role="tab" aria-controls="general-random" aria-selected="false">Random Date Time Mission <span class="badge badge-dark">{{ Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == "RANDOM" && compareDate(v.RandomDateTime) == true).length }}</span></a>

                                                    </li>
                                                    
                                                </ul>

                                                <div class="tab-content" id="myTabContent">

                                                    <div class="tab-pane fade show active" id="general-daily" role="tabpanel" aria-labelledby="general-daily-tab">

                                                        <div class="container" id="general-information-wrapper">

                                                            <div class="row page" v-for="(general_mission, page_number) in Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == 'DAILY')" :id="'general-daily-page-'+(page_number+1)">

                                                                <div class="col col-md-12" id="general-information-box">

                                                                    <table id="display-tablePreview" class="table table-hover table-bordered">

                                                                        <thead>

                                                                            <tr>
                                                                                <th>Mission</th>
                                                                                <th>Location</th>
                                                                                <th>Point</th>
                                                                        
                                                                            </tr>

                                                                        </thead>
    
                                                                        <tbody>

                                                                            <tr>

                                                                                <td>{{ general_mission.Name }}</td>

                                                                                <td :style="{ color: changeLocationTextColor(general_mission.Location) }">{{ changeLocationName(general_mission.Location) }}</td>

                                                                                <td>{{ general_mission.Point }}</td>

                                                                                <td>
                                                                                    <button type="button" class="btn btn-outline-default waves-effect rounded" id="general-selection-button" @click="general_select_action(Object.entries(all_general_mission).filter(v => v[1].Mission_ID == general_mission.Mission_ID)[0][0])" data-toggle="modal" data-target="#modalGeneralActionBox">Select Action</button>
                                                                                </td>

                                                                            </tr>

                                                                        </tbody>
                                                            
                                                                    </table>

                                                                </div>

                                                            </div>

                                                             <ul id="general-daily-information-pagination" v-show="Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == 'DAILY').length > 0"></ul>

                                                        </div>

                                                    </div>

                                                    <div class="tab-pane fade" id="general-random" role="tabpanel" aria-labelledby="general-random-tab">

                                                        <div class="container" id="general-information-wrapper">

                                                            <div class="row page" v-for="(general_mission, page_number) in Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == 'RANDOM' && compareDate(v.RandomDateTime) == true)" :id="'general-random-page-'+(page_number+1)">

                                                                <div class="col col-md-12" id="general-information-box">

                                                                    <table id="display-tablePreview" class="table table-hover table-bordered">

                                                                        <thead>

                                                                            <tr>
                                                                                <th>Mission</th>
                                                                                <th>Location</th>
                                                                                <th>Date Time</th>
                                                                                <th>Point</th>
                                                                        
                                                                            </tr>

                                                                        </thead>
    
                                                                        <tbody>

                                                                            <tr>

                                                                                <td>{{ general_mission.Name }}</td>

                                                                                <td :style="{ color: changeLocationTextColor(general_mission.Location) }">{{ changeLocationName(general_mission.Location) }}</td>

                                                                                <td>{{ changeDateTimeFormat(general_mission.RandomDateTime) }}</td>

                                                                                <td>{{ general_mission.Point }}</td>

                                                                                <td>

                                                                                    <button type="button" class="btn btn-outline-default waves-effect rounded" id="general-selection-button" @click="general_select_action(Object.entries(all_general_mission).filter(v => v[1].Mission_ID == general_mission.Mission_ID)[0][0])"  data-toggle="modal" data-target="#modalGeneralActionBox">Select Action</button>

                                                                                </td>

                                                                            </tr>

                                                                        </tbody>
                                                            
                                                                    </table>

                                                                </div>

                                                            </div>

                                                            <ul id="general-random-information-pagination" v-show="Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == 'RANDOM' && compareDate(v.RandomDateTime) == true).length > 0"></ul>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="tab-pane fade" id="event" role="tabpanel" aria-labelledby="event-tab">

                                                <div class="container" id="event-information-wrapper">

                                                    <div class="row page" v-for="(event_mission, page_number) in Object.values(all_event_mission).filter(v => compareDate(v.To_Date) == true)" :id="'event-page-'+(page_number+1)">

                                                        <div class="col col-md-12" id="event-information-box">
                                                            Event Name: {{ event_mission.Name }}

                                                            <!-- Object.entries(all_event_mission).filter(a => Object.values(a).filter(b => b.To_Date == event_mission.To_Date)[0])[0])[0] -->

                                                            <!-- Object.entries(all_event_mission).filter(v => v[1].Name == event_mission.Name)[0][0] -->

                                                            <button type="button" class="btn btn-sm btn-outline-default waves-effect rounded" id="event-selection-button" @click="event_select_action(Object.entries(all_event_mission).filter(v => v[1].Event_ID == event_mission.Event_ID)[0][0])" data-toggle="modal" data-target="#modalEventActionBox">Select Action</button>

                                                            <div class="row" id="event-date-information-box">
                                                                
                                                                <div class="col-md-3">From Date: {{ event_mission.From_Date }}</div>
                                                                <div class="col-md-3">To Date: {{ event_mission.To_Date }}</div>

                                                            </div>

                                                        </div>

                                                        <div class="col">

                                                            <table id="display-tablePreview" class="table table-hover table-bordered">

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
                                                                        <th>Status</th>
                                                                        
                                                                    </tr>

                                                                </thead>
    
                                                                <tbody>

                                                                    <tr v-for = "(mission, index) in Object.values(event_mission.Mission)">

                                                                        <th scope="row">{{ index + 1 }}</th>

                                                                        <td>{{ mission.Name }}</td>
                                                                            
                                                                        <td>{{ mission.Requirement }}</td>

                                                                        <td>{{ mission.Date }}</td>

                                                                        <td>{{ changeTimeFormat(mission.Start_Time) }}</td>

                                                                        <td>{{ changeTimeFormat(mission.End_Time) }}</td>

                                                                        <td :style="{ color: changeLocationTextColor(mission.Location) }">{{ changeLocationName(mission.Location) }}</td>

                                                                        <td>{{ mission.Point }}</td>

                                                                        <td>

                                                                            {{ compareDate(mission.Date+' '+mission.End_Time) == true? "Active":"Finished" }}

                                                                        </td>

                                                                    </tr>

                                                                </tbody>
                                                            
                                                            </table>

                                                        </div>

                                                    </div>

                                                    <ul id="current-event-information-pagination" v-show="Object.values(all_event_mission).filter(v => compareDate(v.To_Date) == true).length > 0"></ul>

                                                </div>

                                            </div>

                                            <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">

                                                <ul class="nav nav-pills" id="myTab" role="tablist">
                                        
                                                    <li class="nav-item">
                                            
                                                        <a class="nav-link active" id="history-general-tab" data-toggle="tab" href="#history-general" role="tab" aria-controls="history-general" aria-selected="true">General <span class="badge badge-dark">{{ Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == "RANDOM" && compareDate(v.RandomDateTime) == false).length }}</span></a>
                                    
                                                    </li>
                                        
                                                    <li class="nav-item">

                                                        <a class="nav-link" id="history-event-tab" data-toggle="tab" href="#history-event" role="tab" aria-controls="history-event" aria-selected="false">Event <span class="badge badge-dark">{{ Object.values(all_event_mission).filter(v => compareDate(v.To_Date) == false).length }}</span></a>

                                                    </li>
                                                    
                                                </ul>

                                                <div class="tab-content" id="myTabContent">

                                                    <div class="tab-pane fade show active" id="history-general" role="tabpanel" aria-labelledby="history-general-tab">

                                                        <div class="container" id="general-information-wrapper">

                                                            <div class="row" v-for="(general_mission, page_number) in Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == 'RANDOM' && compareDate(v.RandomDateTime) == false)" :id="'history-general-page-'+(page_number+1)">

                                                                <div class="col col-md-12" id="general-information-box">

                                                                    <table id="display-tablePreview" class="table table-hover table-bordered">

                                                                        <thead>

                                                                            <tr>
                                                                                <th>Mission</th>
                                                                                <th>Location</th>
                                                                                <th>Date Time</th>
                                                                                <th>Point</th>
                                                                        
                                                                            </tr>

                                                                        </thead>
    
                                                                        <tbody>

                                                                            <tr>

                                                                                <td>{{ general_mission.Name }}</td>

                                                                                <td :style="{ color: changeLocationTextColor(general_mission.Location) }">{{ changeLocationName(general_mission.Location) }}</td>

                                                                                <td>{{ changeDateTimeFormat(general_mission.RandomDateTime) }}</td>

                                                                                <td>{{ general_mission.Point }}</td>

                                                                            </tr>

                                                                        </tbody>
                                                            
                                                                    </table>

                                                                </div>

                                                            </div>

                                                            <ul id="old-general-information-pagination" v-show="Object.values(all_general_mission).filter(v => v.DateTimeMode.toUpperCase() == 'RANDOM' && compareDate(v.RandomDateTime) == false).length > 0"></ul>

                                                        </div>

                                                    </div>

                                                    <div class="tab-pane fade" id="history-event" role="tabpanel" aria-labelledby="history-event-tab">

                                                        <div class="container" id="event-information-wrapper">

                                                            <div class="row page" v-for="(event_mission, page_number) in Object.values(all_event_mission).filter(v => compareDate(v.To_Date) == false)" :id="'history-event-page-'+(page_number+1)">

                                                                <div class="col col-md-12" id="event-information-box">
                                                                Event Name: {{ event_mission.Name }}

                                                                    <div class="row" id="event-date-information-box">
                                                                
                                                                        <div class="col-md-3">From Date: {{ event_mission.From_Date }}</div>
                                                                        <div class="col-md-3">To Date: {{ event_mission.To_Date }}</div>

                                                                    </div>

                                                                </div>


                                                                <div class="col">

                                                                    <table id="display-tablePreview" class="table table-hover table-bordered">

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

                                                                            <tr v-for = "(mission, index) in Object.values(event_mission.Mission)">

                                                                                <th scope="row">{{ index + 1 }}</th>

                                                                                <td>{{ mission.Name }}</td>
                                                                            
                                                                                <td>{{ mission.Requirement }}</td>

                                                                                <td>{{ mission.Date }}</td>

                                                                                <td>{{ changeTimeFormat(mission.Start_Time) }}</td>

                                                                                <td>{{ changeTimeFormat(mission.End_Time) }}</td>

                                                                                <td :style="{ color: changeLocationTextColor(mission.Location) }">{{ changeLocationName(mission.Location) }}</td>

                                                                                <td>{{ mission.Point }}</td>

                                                                            </tr>

                                                                        </tbody>
                                                            
                                                                    </table>

                                                                </div>

                                                            </div>

                                                            <ul id="old-event-information-pagination" v-show="Object.values(all_event_mission).filter(v => compareDate(v.To_Date) == false).length > 0"></ul>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="tab-pane fade" id="filter" role="tabpanel" aria-labelledby="filter-tab">

                                                <div class="alert alert-info" role="alert" id="filter-info">
                                                    You can select the location in the table and it will show the mission of the location selected for displaying purpose.
                                                </div>

                                                <ul class="nav nav-pills" id="myTab" role="tablist">
                                        
                                                    <li class="nav-item">
                                            
                                                        <a class="nav-link active" id="filter-general-tab" data-toggle="tab" href="#filter-general" role="tab" aria-controls="filter-general" aria-selected="true">General <span class="badge badge-dark">{{ Object.values(generated_general_mission).length }}</span></a>
                                    
                                                    </li>
                                        
                                                    <li class="nav-item">

                                                        <a class="nav-link" id="filter-event-tab" data-toggle="tab" href="#filter-event" role="tab" aria-controls="filter-event" aria-selected="false">Event <span class="badge badge-dark">{{ Object.values(generated_event_mission).length }}</span></a>

                                                    </li>
                                                    
                                                </ul>

                                                <div class="tab-content" id="myTabContent">

                                                    <div class="tab-pane fade show active" id="filter-general" role="tabpanel" aria-labelledby="filter-general-tab">

                                                        <ul class="nav nav-pills" id="myTab" role="tablist">
                                        
                                                            <li class="nav-item">
                                
                                                                <a class="nav-link active" id="filter-daily-tab" data-toggle="tab" href="#filter-daily" role="tab" aria-controls="filter-daily" aria-selected="true">Daily Mission <span class="badge badge-dark">{{ Object.values(generated_general_mission).filter(v => v.DateTimeMode.toUpperCase() == "DAILY").length }}</span></a>
                        
                                                            </li>
                            
                                                            <li class="nav-item">

                                                                <a class="nav-link" id="filter-random-tab" data-toggle="tab" href="#filter-random" role="tab" aria-controls="filter-random" aria-selected="false">Random Date Time Mission <span class="badge badge-dark">{{ Object.values(generated_general_mission).filter(v => v.DateTimeMode.toUpperCase() == "RANDOM" && compareDate(v.RandomDateTime) == true).length }}</span></a>

                                                            </li>
                                        
                                                        </ul>

                                                        <div class="tab-content" id="myTabContent">

                                                            <div class="tab-pane fade show active" id="filter-daily" role="tabpanel" aria-labelledby="filter-daily-tab">

                                                                <div class="container" id="general-information-wrapper">

                                                                    <div class="row page" v-for="(general_mission, page_number) in Object.values(generated_general_mission).filter(v => v.DateTimeMode.toUpperCase() == 'DAILY')" :id="'filter-general-daily-page-'+(page_number+1)">

                                                                        <div class="col col-md-12" id="general-information-box">

                                                                            <table id="display-tablePreview" class="table table-hover table-bordered">

                                                                                <thead>

                                                                                    <tr>

                                                                                        <th>Mission</th>
                                                                                        <th>Location</th>
                                                                                        <th>Point</th>
            
                                                                                    </tr>

                                                                                </thead>

                                                                                <tbody>

                                                                                    <tr>

                                                                                        <td>{{ general_mission.Name }}</td>

                                                                                        <td :style="{ color: changeLocationTextColor(general_mission.Location) }">{{ changeLocationName(general_mission.Location) }}</td>

                                                                                        <td>{{ general_mission.Point }}</td>

                                                                                    </tr>

                                                                                </tbody>

                                                                            </table>

                                                                        </div>

                                                                    </div>

                                                                    <ul id="filter-general-daily-information-pagination" v-show="Object.values(generated_general_mission).filter(v => v.DateTimeMode.toUpperCase() == 'DAILY').length > 0"></ul>

                                                                </div>

                                                            </div>
                                                            
                                                            <div class="tab-pane fade" id="filter-random" role="tabpanel" aria-labelledby="filter-random-tab">

                                                                <div class="container" id="general-information-wrapper">

                                                                    <div class="row page" v-for="(general_mission, page_number) in Object.values(generated_general_mission).filter(v => v.DateTimeMode.toUpperCase() == 'RANDOM' && compareDate(v.RandomDateTime) == true)" :id="'filter-general-random-page-'+(page_number+1)">

                                                                        <div class="col col-md-12" id="general-information-box">

                                                                            <table id="display-tablePreview" class="table table-hover table-bordered">

                                                                                <thead>

                                                                                    <tr>

                                                                                        <th>Mission</th>
                                                                                        <th>Location</th>
                                                                                        <th>Date Time</th>
                                                                                        <th>Point</th>
            
                                                                                    </tr>

                                                                                </thead>

                                                                                <tbody>

                                                                                    <tr>

                                                                                        <td>{{ general_mission.Name }}</td>

                                                                                        <td :style="{ color: changeLocationTextColor(general_mission.Location) }">{{ changeLocationName(general_mission.Location) }}</td>

                                                                                        <td>{{ changeDateTimeFormat(general_mission.RandomDateTime) }}</td>

                                                                                        <td>{{ general_mission.Point }}</td>

                                                                                    </tr>

                                                                                </tbody>

                                                                            </table>

                                                                        </div>

                                                                    </div>

                                                                     <ul id="filter-general-random-information-pagination" v-show="Object.values(generated_general_mission).filter(v => v.DateTimeMode.toUpperCase() == 'RANDOM' && compareDate(v.RandomDateTime) == true).length > 0"></ul>

                                                                </div>

                                                            </div>
                                                            
                                                        </div>

                                                    </div>

                                                    <div class="tab-pane fade" id="filter-event" role="tabpanel" aria-labelledby="filter-event-tab">
                                                            
                                                        <div class="container" id="event-information-wrapper">

                                                            <div class="row page" v-for="(event_mission, page_number) in Object.values(generated_event_mission)" :id="'filter-event-page-'+(page_number+1)">

                                                                <div class="col col-md-12" id="event-information-box">
                                                                Event Name: {{ event_mission.Name }}

                                                                    <div class="row" id="event-date-information-box">
                                                                
                                                                        <div class="col-md-3">From Date: {{ event_mission.From_Date }}</div>
                                                                        <div class="col-md-3">To Date: {{ event_mission.To_Date }}</div>

                                                                    </div>

                                                                </div>

                                                                <div class="col">

                                                                    <table id="display-tablePreview" class="table table-hover table-bordered">

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

                                                                            <tr v-for = "(mission, index) in Object.values(event_mission.Mission)">

                                                                                <th scope="row">{{ index + 1 }}</th>

                                                                                <td>{{ mission.Name }}</td>
                                                                            
                                                                                <td>{{ mission.Requirement }}</td>

                                                                                <td>{{ mission.Date }}</td>

                                                                                <td>{{ changeTimeFormat(mission.Start_Time) }}</td>

                                                                                <td>{{ changeTimeFormat(mission.End_Time) }}</td>

                                                                                <td :style="{ color: changeLocationTextColor(mission.Location) }">{{ changeLocationName(mission.Location) }}</td>

                                                                                <td>{{ mission.Point }}</td>
     
                                                                            </tr>

                                                                        </tbody>
                                                            
                                                                    </table>

                                                                </div>

                                                            </div>

                                                            <ul id="filter-event-information-pagination" v-show="Object.values(generated_event_mission).length > 0"></ul>

                                                        </div>

                                                    </div>

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

            <!-- Modal Add Mission Selection Box -->
            <div class="modal fade" id="modalAddMissionBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        
                <div class="modal-dialog modal-dialog-centered" role="document">
        
                    <div class="modal-content">

                        <div class="modal-header text-center">
                        
                            <h4 class="modal-title w-100 font-weight-bold">Mission Selection</h4>
                        
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            
                                <span aria-hidden="true">&times;</span>
                            
                            </button>

                        </div>

                        <div class="modal-body">

                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-12 col-example" v-for="type in mission_type" id="mission-select-button-box">

                                        <button type="button" class="btn btn-primary" id="mission-select-button" @click="redirectNewMission(type.value)">{{ type.text }}</button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Modal Event Mission Action Selection Box -->
            <div class="modal fade" id="modalEventActionBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        
                <div class="modal-dialog modal-dialog-centered" role="document">
        
                    <div class="modal-content">

                        <div class="modal-header text-center">
                        
                            <h4 class="modal-title w-100 font-weight-bold">Mission Action Selection</h4>
                        
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            
                                <span aria-hidden="true">&times;</span>
                            
                            </button>

                        </div>

                        <div class="modal-body">

                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-12 col-example" id="mission-action-select-button-box">

                                        <button type="button" class="btn btn-primary" id="mission-action-select-button" @click="RedirectEditEventMission(selected_event_mission_id)">Edit Event</button>
                                        <button type="button" class="btn btn-danger" id="mission-action-select-button" @click="RemoveEventMission(selected_event_mission_id)">Remove Event</button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Modal General Mission Action Selection Box -->
            <div class="modal fade" id="modalGeneralActionBox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        
                <div class="modal-dialog modal-dialog-centered" role="document">
        
                    <div class="modal-content">

                        <div class="modal-header text-center">
                        
                            <h4 class="modal-title w-100 font-weight-bold">Mission Action Selection</h4>
                        
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            
                                <span aria-hidden="true">&times;</span>
                            
                            </button>

                        </div>

                        <div class="modal-body">

                            <div class="container-fluid">

                                <div class="row">

                                    <div class="col-md-12 col-example" id="mission-action-select-button-box">

                                        <button type="button" class="btn btn-primary" id="mission-action-select-button" @click="RedirectEditGeneralMission(selected_general_mission_id)">Edit General</button>
                                        <button type="button" class="btn btn-danger" id="mission-action-select-button" @click="RemoveGeneralMission(selected_general_mission_id)">Remove General</button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Start Default Polygon Info Box -->
            <div style="display: none">
                
                <div id="default-info">
                
                    <div class="card">
                    
                        <h3 class="card-header primary-color white-text">Featured</h3>
                        
                        <div class="card-body">
                            
                            <h4 class="card-title">TARUC Information</h4>

                            <table id="default-info-tablePreview" class="table table-hover table-borderless">
  
                                <tbody>

                                    <tr>
      
                                        <td>
                                            <p class="card-text">Address</p>
                                        </td>

                                        <td>
                                            <p class="card-text">Kampus Utama, Jalan Genting Kelang, 53300 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur</p>
                                        </td>
                                        
                                    </tr>

                                    <tr>
      
                                        <td>
                                            <p class="card-text">Website</p>
                                        </td>
                                        
                                        <td>
                                            <p class="card-text"><a href="https://tarc.edu.my/">tarc.edu.my</a></p>
                                        </td>

                                    </tr>

                                    <tr>
      
                                        <td>
                                            <p class="card-text">Contact</p>
                                        </td>
                                        
                                        <td>
                                            <p class="card-text"><a href="tel:+60341450123">03-4145 0123</a></p>
                                        </td>

                                    </tr>
                                
                                </tbody>
                                
                            </table>

                        </div>
                        
                    </div>

                </div>
            
            </div>

             <!-- Start Polygon Info Box -->
             <div style="display: none">
                
                <div id="info">
                
                    <div class="card">
                    
                        <h3 class="card-header primary-color white-text">Featured</h3>
                        
                        <div class="card-body">
                            
                            <h4 class="card-title">Location Information</h4>

                            <table id="location-info-tablePreview" class="table table-hover table-borderless">
  
                                <tbody>

                                    <tr>
      
                                        <td>
                                            <p class="card-text">Name</p>
                                        </td>

                                        <td>
                                            <p class="card-text">{{ location_name }}</p>
                                        </td>
                                        
                                    </tr>

                                    <tr v-show="location_normal_image.length > 0">
      
                                        <td>
                                            <p class="card-text">Normal Image</p>
                                        </td>
                                        
                                        <td>
                                            <p class="card-text" v-for="normal_image in location_normal_image">{{ normal_image }}

                                                <img :src="'https://lh5.googleusercontent.com/p/'+normal_image">
                                            
                                            </p>
                                        </td>

                                    </tr>

                                    <tr v-show="location_rotate_view_image.length > 0">
      
                                        <td>
                                            <p class="card-text">Rotate View Image</p>
                                        </td>
                                        
                                        <td>
                                            <p class="card-text" v-for="rotate_view_image in location_rotate_view_image">
                                                <iframe :src="'https://www.google.com/maps/embed?pb='+rotate_view_image" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                                            </p>
                                        </td>

                                    </tr>
                                
                                </tbody>
                                
                            </table>

                        </div>
                        
                    </div>

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

                    mission_type:  [
                        { text: 'General-Based Mission', value: 'GENERAL' },
                        { text: 'Event-Based Mission', value: 'EVENT' }
                    ],

                    all_location: [],
                    location_name: null,
                    location_normal_image: [],
                    location_rotate_view_image: [],

                    all_general_mission: {},
                    all_event_mission: {},
                    generated_general_mission: [],
                    generated_event_mission: [],

                    selected_general_mission_id: null,
                    selected_event_mission_id: null
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
                                this.all_event_mission = snap.val() || {};
                            }
                            else if(snap.key == "General") {
                                this.all_general_mission = snap.val() || {};
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
                    redirectNewMission(value) {
                        if(value == this.mission_type[0].value) {
                            location = "Admin_New_General_Mission_Create.php";
                        }
                        else if (value == this.mission_type[1].value) {
                            location = "Admin_New_Event_Mission_Create.php";
                        }
                    },
                    location_load() {
                        let used = [], color = null;

                        db.ref_sub_1.on("child_added", snap => {

                            do {
                                color = randomize()[0];
                            } while (used.includes(color));

                            used.push(color);

                            this.all_location.push(
                                { text: snap.key, value: snap.val().Encoded_Path, color: color }
                            );

                            addPolygon(snap.key, snap.val(), color);
                        });
                    },
                    changeTimeFormat(time) {
                        return tConvert(time);
                    },
                    changeDateTimeFormat(datetime){
                        return dtConvert(datetime);
                    },
                    changeLocationName(location_value) {
                        let location_text = null;

                        for(let i = 0; i < this.all_location.length; i++) {
                            if(location_value == vm.all_location[i].value) {
                                location_text = vm.all_location[i].text;
                            }
                        }

                        return location_text;
                    },
                    changeLocationTextColor(location_value) {
                        let color = null;

                        for(let i = 0; i < this.all_location.length; i++) {
                            if(location_value == vm.all_location[i].value) {
                                color = vm.all_location[i].color;
                            }
                        }

                        return color;
                    },
                    compareDate(date) {
                        return compareDate(date);
                    },
                    event_select_action(id) {
                        this.selected_event_mission_id = id;
                    },
                    RedirectEditEventMission(id) {
                        location = `Admin_Event_Mission_Edit.php?event_mission_id=${id}`
                    },
                    RemoveEventMission(id) {
                        db.ref_main_1.child("Event").child(id).remove();

                        location = 'Admin_Display_Mission.php';
                    },
                    general_select_action(id) {
                        this.selected_general_mission_id = id;
                    },
                    RedirectEditGeneralMission(id) {
                        location = `Admin_General_Mission_Edit.php?general_mission_id=${id}`
                    },
                    RemoveGeneralMission(id) {
                        db.ref_main_1.child("General").child(id).remove();

                        location = 'Admin_Display_Mission.php';
                    }
                },
                created() {
                    this.load();
                    this.location_load();
                    // this.isValid();
                },
                updated() {
                    let general = Object.values(this.all_general_mission);

                    if(general.filter(v => v.DateTimeMode.toUpperCase() == 'DAILY').length > 0) {
                        pagination('general-daily-information-pagination', 'general-daily', general.filter(v => v.DateTimeMode.toUpperCase() == 'DAILY').length);
                    }

                    if(general.filter(v => v.DateTimeMode.toUpperCase() == 'RANDOM' && compareDate(v.RandomDateTime) == true).length > 0) {
                        pagination('general-random-information-pagination', 'general-random', general.filter(v => v.DateTimeMode.toUpperCase() == 'RANDOM' && compareDate(v.RandomDateTime) == true).length);
                    }

                    if (general.filter(v => v.DateTimeMode.toUpperCase() == 'RANDOM' && compareDate(v.RandomDateTime) == false).length > 0){
                        pagination('old-general-information-pagination', 'history-general', general.filter(v => v.DateTimeMode.toUpperCase() == 'RANDOM' && compareDate(v.RandomDateTime) == false).length);
                    }

                    let event = Object.values(this.all_event_mission);

                    if(event.filter(v => this.compareDate(v.To_Date) == true).length > 0) {
                        pagination('current-event-information-pagination', 'event', event.filter(v => this.compareDate(v.To_Date) == true).length);
                    }

                    if (event.filter(v => this.compareDate(v.To_Date) == false).length > 0){
                        pagination('old-event-information-pagination', 'history-event', event.filter(v => this.compareDate(v.To_Date) == false).length);
                    }

                    let filter_general = Object.values(this.generated_general_mission);

                    if(filter_general.filter(v => v.DateTimeMode.toUpperCase() == 'DAILY').length > 0) {
                        pagination('filter-general-daily-information-pagination', 'filter-general-daily', filter_general.filter(v => v.DateTimeMode.toUpperCase() == 'DAILY').length);
                    }

                    if(filter_general.filter(v => v.DateTimeMode.toUpperCase() == 'RANDOM' && compareDate(v.RandomDateTime) == true).length > 0) {
                        pagination('filter-general-random-information-pagination', 'filter-general-random', filter_general.filter(v => v.DateTimeMode.toUpperCase() == 'RANDOM' && compareDate(v.RandomDateTime) == true).length);
                    }

                    let filter_event = Object.values(this.generated_event_mission);

                    if(filter_event.length > 0) {
                        pagination('filter-event-information-pagination', 'filter-event', filter_event.length);
                    }
                    
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

            const info_box = new gm.InfoWindow({
                content: document.getElementById("info")
            });

            const default_info_box = new gm.InfoWindow({
                content: document.getElementById("default-info")
            });

            const default_polygon = new gm.Polygon({
                map,
                path: gm.geometry.encoding.decodePath("_hsRkb{kRHKPELEVCLGDMJIh@SpBo@nCw@fAWlC_@rBWg@iBw@_BoCyB_AiAu@uAc@cBG]C_@?c@Fk@Ro@Zo@f@a@j@_@v@_A`@y@Rk@Je@q@e@k@i@cFiHQeAMsBKa@Is@K{GEs@SaAi@gAe@}@Q@QBsBz@aAP{IzEq@r@o@v@yA~ChDz@nAF^xCHdAJdB?|@MlAKtC?lABx@HfBBbCHfANfAChB?|@In@A`@@`@FNL^RnARbAPb@f@Zf@Tf@T^VfAbB"),
                fillOpacity: 0.1,
                strokeColor: "#00FFFF",
                fillColor: "#00FFFF", 
            });

            gm.event.addListener(default_polygon, 'dblclick', function(e){
                info_box.close();
                default_info_box.setPosition(e.latLng);
                default_info_box.open(map);
            });

            function tConvert(time) {
                time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

                if (time.length > 1) {
                    time = time.slice (1); 
                    time[5] = +time[0] < 12 ? 'AM' : 'PM';
                    time[0] = +time[0] % 12 || 12;
                }
                return time.join ('');
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

            function addPolygon(key, location, color) {
                var selected = new gm.Polygon({
                    map,
                    path: gm.geometry.encoding.decodePath(location.Encoded_Path),
                    fillOpacity: 0.1,
                    strokeColor: color,
                    fillColor: color,
                    key: key
                });

                selected.addListener('dblclick', function(e) {
                    default_info_box.close();

                    vm.location_name = key;

                    if(location.Rotate_View_Image != null) {
                        vm.location_rotate_view_image = location.Rotate_View_Image.split(',');
                    }

                    if(location.Normal_Image != null) {
                        vm.location_normal_image = location.Normal_Image.split(',');
                    }

                    info_box.setPosition(e.latLng);
                    info_box.open(map);
                });

                selected.addListener('click', function(e) {
                    key;

                    if(vm.all_event_mission != {}) {
                        vm.generated_event_mission = [];
                        let mission = Object.values(vm.all_event_mission);

                        mission.forEach(function(a) {
                            value = Object.values(a.Mission).filter(v => v.Location == location.Encoded_Path);

                            if(value.length > 0) {
                                vm.generated_event_mission.push({
                                    Created_Admin: a.Created_Admin,
                                    Created_Date: a.Created_Date,
                                    From_Date: a.From_Date,
                                    Name: a.Name,
                                    To_Date: a.To_Date,
                                    Mission: value
                                });
                            }
                        })
                    }

                    if(vm.all_general_mission != {}) {
                        vm.generated_general_mission = [];
                        let mission = Object.values(vm.all_general_mission);

                        mission.forEach(function(a) {
                            if(a.Location == location.Encoded_Path) {
                                vm.generated_general_mission.push({
                                    Created_Admin: a.Created_Admin,
                                    Created_Date: a.Created_Date,
                                    DateTimeMode: a.DateTimeMode,
                                    Location: a.Location,
                                    Name: a.Name,
                                    Point: a.Point,
                                    RandomDateTime: a.RandomDateTime? a.RandomDateTime:null,
                                });
                            }
                        });
                    }

                });

                return selected;
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
        </script>

        <script>
            function pagination(id, page_id, total_page) {
                if($('#'+id).data("twbs-pagination")){
                    $('#'+id).twbsPagination('destroy');
                }

                $('#'+id).twbsPagination({
                    totalPages: total_page,

                    // the current page that show on start
                    startPage: 1,

                    // maximum visible pages
                    visiblePages: total_page > 5 ? total_page:5,

                    initiateStartPageClick: true,

                    // template for pagination links
                    href: false,

                    // variable name in href template for page number
                    hrefVariable: '{{number}}',

                    // Text labels
                    first: 'First',
                    prev: '<<',
                    next: '>>',
                    last: 'Last',

                    // carousel-style pagination
                    loop: false,

                    // callback function
                    onPageClick: function (event, page) {
	                    $('.page-active-'+page_id).removeClass('page-active-'+page_id);
                        $('#'+page_id+'-page-'+page).addClass('page-active-'+page_id);
                    },

                    // pagination Classes
                    paginationClass: 'pagination pagination-circle pg-blue justify-content-center',
                    nextClass: 'page-item next',
                    prevClass: 'page-item prev',
                    lastClass: 'page-item last',
                    firstClass: 'page-item first',
                    pageClass: 'page-item page',
                    activeClass: 'active',
                    disabledClass: 'disabled'
                });
            } 
        </script>
        <!-- End Custom JS -->

    </footer>
    <!-- END FOOTER -->

    <?php 

        include 'Include/foot.php';

    ?>