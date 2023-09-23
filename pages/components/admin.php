<?php
include("php/functions.php");
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
        <div class="session__heading">
            <div>
                <h3>Welcome Admin</h3>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deleniti vero esse nemo?</p>
            </div>

            <div class="admin__section__heading">
                <h4>Users:</h4>

                <h4 class="green__text"><?php echo count(getAllUsers()); ?></h4>
            </div>
        </div>

        <div class="stats">
            <div class="users">
                <div>
                    <h4>User Details: </h4>

                </div>
                <!-- Table to show all users -->
                <table>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Joined on</th>
                        <th>User Ip</th>
                        <th>Status</th>
                        <th>Block</th>
                    </tr>
                    <?php
                    $users = getAllUsers();
                    foreach ($users as $user) {
                    ?>
                        <tr>
                            <td><?php echo $user["first_name"]; ?></td>
                            <td><?php echo $user["last_name"]; ?></td>
                            <td><?php echo $user["email"]; ?></td>
                            <td><?php echo $user["created_at"]; ?></td>
                            <td><?php echo $user["ip"]; ?></td>
                            <td><?php if ($user["connect"] == 1) {
                                    echo "User logged in";
                                } else if ($user["connect"] == 0) {
                                    echo "User logged out!";
                                } else {
                                    echo "User Blocked!";
                                } ?></td>

                            <td><?php
                                if ($user["connect"] == 1 || $user["connect"] == 0) {
                                    echo "<a href='./php/actions.php?block=" . $user['id'] . "' class='red__text'>Block</a>";
                                } else {
                                    echo "<a href='./php/actions.php?unblock=" . $user['id'] . "' class='green__text'>Unblock</a>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>

            <div class="users">
                <div>
                    <h4>User Assessments: </h4>

                </div>
                <!-- Table to show all users -->
                <table>
                    <tr>
                        <th>Email</th>
                        <th>Score (out of 30)</th>
                        <th>Assessment Taken on</th>
                    </tr>
                    <?php
                    $users = getAllAssessments();
                    foreach ($users as $user) {
                    ?>
                        <tr>
                            <td><?php echo $user["email"]; ?></td>
                            <td><?php echo $user["score"];
                                if ($user["score"] > 25) {
                                    echo "High Risk";
                                } else if ($user["score"] > 15) {
                                    echo " Moderate";
                                } else {
                                    echo " Normal";
                                } ?></td>
                            <td><?php echo $user["created_at"]; ?></td>

                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>

            <div class="users">
                <div>
                    <h4>Sessions Information: </h4>
                    <p class="green__text">Count: <?php echo count(getSessionDetails()); ?> </p>
                </div>
                <!-- Table to show all users -->
                <table>
                    <tr>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Description</th>
                        <th>Know more</th>
                        <th>Venue</th>
                        <th>Updated at</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                    $users = getSessionDetails();
                    foreach ($users as $user) {
                    ?>
                        <tr>
                            <td><?php echo $user["email"]; ?></td>
                            <td><?php echo $user["name"];
                                ?></td>
                            <td><?php echo $user["date"]; ?></td>
                            <td><?php echo $user["time"]; ?></td>
                            <td class="table-desc"><?php echo $user["description"]; ?></td>

                            <td class="table-know-more"><?php echo $user["know_more"]; ?></td>
                            <td><?php echo $user["venue"]; ?></td>
                            <td><?php echo $user["updated_at"]; ?></td>
                            <td><?php echo "<a class='red__text' href='./php/actions.php?deleteSession=" . $user['id'] . "'>Delete</a>" ?></td>

                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>

            <div class="users">
                <div>
                    <h4>Articles Information: </h4>
                    <p class="green__text">Count: <?php echo count(getAllPosts()); ?> </p>
                </div>
                <!-- Table to show all users -->
                <table>
                    <tr>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Post</th>
                        <th>Updated at</th>
                        <th>Delete</th>
                    </tr>
                    <?php
                    $users = getAllPosts();
                    foreach ($users as $user) {
                    ?>
                        <tr>
                            <td><?php echo $user["email"]; ?></td>
                            <td><?php echo $user["name"];
                                ?></td>
                           

                            <td><?php echo $user["post"]; ?></td>
                           
                            <td><?php echo $user["created_at"]; ?></td>
                            <td><?php echo "<a class='red__text' href='./php/actions.php?deleteArticle=" . $user['id'] . "'>Delete</a>" ?></td>

                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</section>