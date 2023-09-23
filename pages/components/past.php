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
        <div class="community__heading">
            <div>
                <h3>Community!</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam enim ipsam inventore!</p>
            </div>
            <button class="green__btn" onclick="showAddPost()">Add posts</button>
        </div>
        <form action="./php/actions.php?addPost" method="post" class="none" id="post-form">
            <textarea name="post" id="" cols="30" rows="10" placeholder="You may also use html"></textarea>
            <button class="green__btn">Add Post</button>
        </form>

        <div class="posts">
    <?php
    if (isset($_SESSION['posts']) && !empty($_SESSION['posts'])) {
        foreach ($_SESSION['posts'] as $post) {
    ?>
    <div class="post">
        <!-- <h5><?php echo $post['post_heading']; ?></h5> -->
        <p><?php echo $post['post']; ?></p>

        <div class="post__subs">
            <div>
                Name: <?php echo $post['name']; ?>
            </div>

            <div>
                <a href="?past&user=<?php echo $post['user_id']; ?>">View all posts</a>
            </div>
        </div>
    </div>
    <?php
        }
    } else {
        echo "<div>No posts Found!</div>";
    }
    ?>
</div>

    </div>
</section>