<script>
    function add(type,title){
        $.post('/api/add',{
            type:type,title:title
        },function(){document.location.href="/"});
    }
</script>
<body class="m-2 p-2 m-lg-3">
<!--NAVIGATION BAR-->
    <div class="container-fluid position-sticky top-0 p-3 mb-3 bg-white d-block d-lg-none">
        <div class="row row-cols-10">
        <div class="col align-self-end">
        <div class="dropdown position-relative">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              MENU
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#event">EVENT</a></li>
              <li><a class="dropdown-item" href="#stall">STALL</a></li>
              <li><a class="dropdown-item" href="#">CONTACT</a></li>
              <li><a class="dropdown-item" href="#">ADMIN</a></li>
              <li><a class="dropdown-item" href="#">LOGIN</a></li>
            </ul>
          </div></div>
          <h1 class="col-8">FEST WEBSITE</h1>
    </div></div>
    <div class="container-fluid position-sticky top-0 text-center bg-white mb-3 d-none d-lg-grid">
        <div class="row">
        <?php
        if($LoggedIn)
        echo "<button type='button' class='btn col'>
        <h6>$email</h6>
        <a href='/api/logout'>LOGOUT</a></button>";
        else echo "<button type='button' class='btn col'><a href='/login'>LOGIN</a></button>";
        ?>
            <h1 class="col-lg-6">FEST WEBSITE</h1>
            <button type="button" class="btn col"><a href="#events">EVENTS</a></button>
            <button type="button" class="btn col"><a href="#stalls">STALLS</a></button>
            <?php 
            if($LoggedIn)
            echo "<button type='button' class='btn col'>
            <a href='/dashboard'>DASHBOARD</a></button>";
            ?>
        </div>
    </div>
<!--FRONT IMAGE-->
<img id="front" class="mb-5"></img>
<!--EVENTS-->              
<div id="events" class="container-fluid text-center bg-white p-5 mb-5">
    <h1>EVENTS</h1>
    <div id="events-body" 
    class="row row-cols-1 row-cols-lg-2 justify-content-center position-static">
    <?php
    $events = mysqli_query($_ENV['con'],"SELECT * FROM events");
    $type='event';
    while($Q_result = mysqli_fetch_assoc($events)){
        $title=$Q_result['title'];
        $description=$Q_result['description'];
        $image=$Q_result['image'];
        $fee=$Q_result['fee'];
        $added=0;
        if(!$admin & $LoggedIn){
        if(mysqli_fetch_assoc(mysqli_query($_ENV['con'],"SELECT * FROM event_registrations WHERE user_email='$email'AND event='$title'")))$added=1;}
        include "static/templates/item.php";
    }
    ?>
    </div>
</div>
<!--STALLS-->
<div id="stalls" class="container-fluid text-center bg-white p-5 mb-5">
    <h1>STALLS</h1>
    <div id="stalls-body"
    class="row row-cols-1 row-cols-lg-2 justify-content-center">
    <?php
    $stalls = mysqli_query($_ENV['con'],"SELECT * FROM stalls ORDER BY NULL");
    $type='stall';
    while($Q_result = mysqli_fetch_assoc($stalls)){
        $title=$Q_result['title'];
        $description=$Q_result['description'];
        $image=$Q_result['image'];
        $fee=$Q_result['fee'];
        $added=0;
        if(!$admin & $LoggedIn){
        if(mysqli_fetch_assoc(mysqli_query($_ENV['con'],"SELECT * FROM stall_registrations WHERE user_email='$email'AND stall='$title'")))$added=1;}
        include "static/templates/item.php";}
    ?>
    </div>
</div>
</body>