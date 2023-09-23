<?php
$session = [];
require_once("./php/functions.php");
deleteOverSessions();
$sessions = getSessionDetails();
?>

<section class="wrapper">
    <div id="myModal2" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Session Details</h3>
                <span class="close2">&times;</span>
            </div>
            <div id="sessionDetails"></div>
        </div>
    </div>


    <div class="error" id="error"><?php
                                    if (isset($_SESSION["err"]["err_msg"])) {
                                        echo "
            <div class='err__content'>
                <i class='bx bx-error-circle'></i>
                " . $_SESSION['err']['err_msg'] . "
            </div>
        ";
                                        unset($_SESSION["err"]);
                                    }
                                    ?></div>
    <div class="container">
        <div class="community__heading">
            <div>
                <h3>Schedule a Counselling Session!</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et, provident.</p>
            </div>
            <button class="green__btn" onclick="showAddPost()" style="width: 7.5rem;">Take session</button>
        </div>

        <form action="./php/actions.php?addSession" method="post" class="none session__form" id="post-form">
            <h4>Details: </h4>
            <input type="text" name="heading" placeholder="Heading of the session" required>
            <input type="date" placeholder="Date of the session" name="date" required>
            <input type="time" placeholder="time of the session" name="time" required>
            <input type="text" placeholder="short description about the session" name="desc" required>
            <input type="url" name="url" placeholder="Venue map url" required>
            <textarea name="know-more" id="know-more" cols="10" rows="5" placeholder="More details! You may also use HTML"></textarea>
            <button class="green__btn">Add Post</button>
        </form>

        <div class="sessions">
            <?php foreach ($sessions as $session) { ?>
                <div class="session">
                    <div class="session__heading">
                        <div>
                            <h4><?php echo $session['heading']; ?></h4>
                            <a href="?past&user=<?php echo $session['name']; ?>">By: <?php echo $session['name']; ?></a>
                        </div>

                        <div>
                            <p>Time: <?php echo $session['time']; ?></p>
                            <p>Date: <?php echo $session['date']; ?></p>
                        </div>
                    </div>
                    <div class="session__content">
                        <p><?php echo $session['description']; ?></p>

                        <div class="session__details">
                            <a href="<?= $session["venue"] ?>" class="green__btn" target="_blank" style="max-width: 5.5rem;">Venue</a>
                            <button class="green__btn gray__btn know-more-button" data-details="<?php echo htmlspecialchars($session['know_more']); ?>">Know more</button>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
