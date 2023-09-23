<?php
require_once("./php/functions.php");
$sessions = [];
if (isset($_GET["manage"]) && $_GET["manage"] == "sessions") {
    $email = $_SESSION["login"]["data"]["email"];
    $sessions = getSessionDetailsByUser($email);
    // echo $email;
}
?>

<section class="wrapper">
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
        <div id="myModal2" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Session Details</h3>
                    <span class="close2">&times;</span>
                </div>
                <div id="sessionDetails"></div>
            </div>
        </div>
        <?php
        if ($_GET["manage"] && isset($_GET["editSession"])) {
            $session = getSessionById($_GET["editSession"]);
            echo '
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Session: ' . $session["heading"] . '</h3>
                <span class="close">&times;</span>
            </div>
            <form action="./php/actions.php?editSession=' . $session["id"] . '" method="post" class="session__form" id="post-form">
                <input type="text" name="heading" placeholder="Heading of the session" value="' . $session["heading"] . '" required>
                <input type="date" placeholder="Date of the session" name="date" value="' . $session["date"] . '" required>
                <input type="time" placeholder="Time of the session" name="time" value="' . $session["time"] . '" required>
                <input type="text" placeholder="Short description about the session" name="desc" value="' . $session["description"] . '" required>
                <input type="url" name="url" placeholder="Venue map URL" value="' . $session["venue"] . '" required>
                <textarea name="know-more" id="know-more" cols="10" rows="5" placeholder="More details! You may also use HTML">' . $session["know_more"] . '</textarea>
                <button class="green__btn" style="max-width: 9rem; width: 100%">Update Session</button>
            </form>
        </div>
    </div>';
        }

        ?>

        <div class="session__heading">
            <div>
                <h3>Manage Your Sessions</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Impedit, ex.</p>
            </div>

            <a href="?manage=articles" class="green__btn" style="max-width: 10.5rem; width: 100%;">Manage Articles</a>
        </div>

        <div class="sessions">
            <?php foreach ($sessions as $session) { ?>
                <div class="session">
                    <div class="session__heading">
                        <div>
                            <h4><?php echo $session['heading']; ?></h4>
                            <a href="?past&user=<?php echo $session['email']; ?>">By: <?php echo $session['name']; ?></a>
                        </div>

                        <div>
                            <p>Time: <?php echo $session['time']; ?></p>
                            <p>Date: <?php echo $session['date']; ?></p>
                        </div>
                    </div>
                    <div class="session__content">
                        <p><?php echo $session['description']; ?></p>

                        <div class="session__details">
                            <div>
                                <a href="<?= $session["venue"] ?>" class="green__btn" target="_blank" style="width:7.5rem;">Venue</a>
                                <button class="green__btn gray__btn know-more-button" data-details="<?php echo htmlspecialchars($session['know_more']); ?>">Know more</button>
                            </div>

                            <div class="manage__options">
                                <a class="" href="?manage=sessions&editSession=<?= $session['id'] ?>">Edit Session</a>
                                <a href="#" class="red__text" onclick="confirmDelete(<?= $session['id']; ?>)">Delete Session</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<script>
    function confirmDelete(sessionId) {
        console.log("confirm Delete called!");
        if (confirm("Are you sure you want to delete this post?")) {
            window.location.href = './php/actions.php?deleteSession=' + sessionId;
        } else {
            return false; // Cancel the default link behavior
        }
    }
    document.addEventListener('DOMContentLoaded', function() {

        function handleModal() {
            function openEditModal() {
                const modal = document.getElementById("myModal");
                modal.style.display = "block";
            }

            // Check if the editPost parameter exists in the URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has("editSession")) {
                // Open the modal when the parameter is present
                openEditModal();
            }

            // Close the modal when the close button is clicked
            const closeButton = document.querySelector(".close");
            closeButton.addEventListener("click", () => {
                const modal = document.getElementById("myModal");
                modal.style.display = "none";
            });

        }

        try {
            handleModal();
        } catch (err) {
            console.log("Modal cannot be used");
        }

    });
</script>