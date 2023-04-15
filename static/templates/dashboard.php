<script>
    function del(type,title){
        $.post('/api/del',{
            type:type,
            title:title
        },function(){document.location.href="/dashboard"});
    }
</script>
<?php 
$con = mysqli_connect($_ENV['host'],$_ENV['username'],$_ENV['password'],$_ENV['dbname']);
?>
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
              <li><a class="dropdown-item" href="/">EVENT</a></li>
              <li><a class="dropdown-item" href="/logout">LOGOUT</a></li>
            </ul>
          </div></div>
          <h1 class="col-8">USER DASHBOARD</h1>
    </div></div>
    <div class="container-fluid position-sticky top-0 text-center bg-white mb-3 d-none d-lg-grid">
        <div class="row">
        <button type="button" class="btn col">
            <h6><?php echo "$email";?></h6>
                <a href="/api/logout">LOGOUT</a>
            </button>
            <h1 class="col-lg-6">
            USER DASHBOARD</h1>
            <button type='button' class='btn col'><a href='/'>HOME</a></button>
            <button type="button" class="btn col"><a href="#events">EVENTS</a></button>
            <button type="button" class="btn col"><a href="#stalls">STALLS</a></button>
        </div>
    </div>
<div>
    <!--EVENTS-->
    <div id="events" class="container-fluid text-center bg-white p-5 mb-5">
    <h1>REGISTERED EVENTS</h1>
    <div id="events-body" 
    class="row row-cols-1 row-cols-lg-2 justify-content-center position-static">
    <?php
    $type='event';
    $sql = "SELECT * FROM events WHERE title in (
        SELECT event FROM event_registrations 
        WHERE user_email='$email'
    )";
    $events = mysqli_query($con,$sql);
    while($Q_result = mysqli_fetch_assoc($events)){
        $title=$Q_result['title'];
        $description=$Q_result['description'];
        $image=$Q_result['image'];
        $fee=$Q_result['fee'];
        include "static/templates/item.php";}
    ?>
</div></div>
<!--STALLS-->
<div id="stalls" class="container-fluid text-center bg-white p-5 mb-5">
    <h1>REGISTERED STALLS</h1>
    <div id="stalls-body"
    class="row row-cols-1 row-cols-lg-2 justify-content-center">
    <?php
    $type='stall';
    $sql = "SELECT * FROM stalls WHERE title in (
        SELECT stall FROM stall_registrations 
        WHERE user_email='$email'
    )";
    $stalls = mysqli_query($con,$sql);
    while($Q_result = mysqli_fetch_assoc($stalls)){
        $title=$Q_result['title'];
        $description=$Q_result['description'];
        $image=$Q_result['image'];
        $fee=$Q_result['fee'];
        include "static/templates/item.php";}
    ?>
</div></div></div>
</body>