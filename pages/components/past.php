<?php
$_SESSION["posts"] = [];
require_once("./php/functions.php");
fetchPosts();

if (isset($_GET["user"])) {
    $user = $_GET["user"];
    fetchUserPosts($user);
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

    <!-- pages/components/past.php -->

    <div class="container">
        <div class="community__heading">
            <div>
                <h3>Community!</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam enim ipsam inventore!</p>
            </div>
            <div class="flex" style="gap:1rem; justify-content: center; align-items:center">
                <button class="green__btn" onclick="showAddPost()">Add posts</button>

                <?php
                if ($_GET["user"]) {
                    echo "<a href='?past'>All posts</a>";
                }
                ?>
            </div>
        </div>
        <form action="./php/actions.php?addPost" method="post" class="none" id="post-form">
            <textarea name="post" id="" cols="30" rows="10" placeholder="You may also use HTML"></textarea>
            <button class="green__btn">Add Post</button>
        </form>

        <div class="posts">
            <?php
            if (isset($_SESSION['posts']) && !empty($_SESSION['posts'])) {
                foreach ($_SESSION['posts'] as $post) {
                    // Display posts here
                    $content = $post['post'];
            ?>
                    <div class="post">
                        <div class="post__subs">
                            <div class="post__user">
                                Name: <?php echo $post['name']; ?>
                            </div>

                            <div class="flex gap">
                                <?php
                                echo '<a href="?past&user=' . htmlspecialchars($post['email']) . '" class="">Users posts</a>';
                                ?>

                                <span class="comment-btn" style="cursor: pointer;">Comments</span>

                            </div>
                        </div>

                        <div class="post-content">
                            <?php echo $content; ?>

                        </div>
                        <a href="#" class="see-more-link">See more</a>

                        <section class="comments none">
                            <p class="green__text">Comments:</p>
                            <div class="comment">
                                <div class="comment__user">
                                    Name: <?php echo $post['name']; ?>
                                </div>
                                <div class="comment__content">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam enim ipsam inventore!

                                    <br></br>

                                    <span>time: 23/09/2023</span>
                                </div>
                            </div>


                            <div class="comment">
                                <div class="comment__user">
                                    Name: <?php echo $post['name']; ?>
                                </div>
                                <div class="comment__content">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam enim ipsam inventore!

                                    <br></br>

                                    <span>time: 23/09/2023</span>
                                </div>
                            </div>
                            <hr>

                            <form action="./php/actions.php">
                                <textarea name="comment" id="post-comment" cols="30" rows="2" placeholder="You may also use HTML"></textarea>
                                <button class="green__btn" type="submit">Comment</button>
                                </fo>
                        </section>



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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all post elements
        const posts = document.querySelectorAll('.post');

        // Add click event listeners to each "See more" link within a post
        posts.forEach(post => {
            const seeMoreLink = post.querySelector('.see-more-link');
            const postContent = post.querySelector('.post-content');
            const postText = postContent.textContent;

            const maxLength = 400; // Maximum characters to display initially

            if (postText.length > maxLength) {
                // If post content is longer than the maximum length, truncate it
                const truncatedText = postText.substring(0, maxLength) + '...';
                postContent.textContent = truncatedText;

                // Add "See more" link
                seeMoreLink.style.display = 'inline'; // Show the link

                // Add click event listener to toggle full content
                seeMoreLink.addEventListener('click', (event) => {
                    event.preventDefault();

                    if (postContent.classList.contains('full-content')) {
                        // Hide full content
                        postContent.textContent = truncatedText;
                        postContent.classList.remove('full-content');
                        seeMoreLink.textContent = 'See more';
                    } else {
                        // Show full content
                        postContent.textContent = postText;
                        postContent.classList.add('full-content');
                        seeMoreLink.textContent = 'See less';
                    }
                });
            } else {
                // If the content doesn't need to be truncated, hide the "See more" link
                seeMoreLink.style.display = 'none';
            }
        });
    });
</script>