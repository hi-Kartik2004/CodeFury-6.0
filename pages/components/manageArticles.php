<?php
$myPosts = [];
require_once("./php/functions.php");

$myPosts = getUserPosts($_SESSION["login"]["data"]["email"]);


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
    <?php
    if ($_GET["manage"] && isset($_GET["editPost"])) {
        $post = getPostById($_GET["editPost"]);
        echo '
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Article</h3>
                <span class="close">&times;</span>
            </div>
            <form id="editForm" action="./php/actions.php?editArticle=' . $_GET["editPost"] . '" method="post">
                <textarea name="post" rows="10" cols="30">' . $post["post"] . '</textarea>
                <button class="green__btn">Publish</button>
            </form>
        </div>
    </div>';
    }

    ?>
    <div class="container">
        <div class="session__heading">
            <div>
                <h3>Manage Your Articles</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate error nulla at!</p>
            </div>

            <a href="?manage=sessions" class="green__btn" style="max-width: 8.4rem; width: 100%">Edit Sessions</a>

        </div>

        <div class="posts">
            <?php
            if (!empty($myPosts)) {
                foreach ($myPosts as $post) {
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
                                echo '<a href="?manage=articles&editPost=' . ($post['id']) . '"style="font-size: 0.75rem;">Edit post</a>';



                                ?>

                                <a href="#" style="font-size: 0.75rem;" onclick="confirmDelete(<?= $post['id']; ?>)">Delete post</a>


                                <span class="comment-btn" style="cursor: pointer;">Comments</span>

                            </div>
                        </div>

                        <div class="post-content">
                            <?php echo $content; ?>

                        </div>
                        <a href="#" class="see-more-link">See more</a>

                        <section class="comments none">
                            <?php
                            $comments = getCommentsForPost($post['id'], $conn);

                            if (!empty($comments)) {
                                echo '<p class="green__text">Comments:</p>';

                                foreach ($comments as $comment) {
                                    echo '<div class="comment">';
                                    echo '<div class="comment__user">Name: ' . $comment['name'] . '</div>';
                                    echo '<div class="comment__content">' . $comment['comment'] . '<br><br>';
                                    echo '<span>time: ' . $comment['created_at'] . '</span>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '<hr>';
                                }
                            }
                            ?>

                            <form action="./php/actions.php?addComment=<?php echo $post['id']; ?>" method="post">
                                <textarea name="post-comment" id="post-comment" cols="30" rows="2" placeholder="You may also use HTML"></textarea>
                                <button class="green__btn" type="submit">Comment</button>
                            </form>
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
    function confirmDelete(postId) {
        console.log("confirm Delete called!");
        if (confirm("Are you sure you want to delete this post?")) {
            window.location.href = './php/actions.php?deleteArticle=' + postId;
        } else {
            return false; // Cancel the default link behavior
        }
    }
    document.addEventListener('DOMContentLoaded', function() {


        function handleLength() {
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
        }

        try {
            handleLength();
        } catch (error) {
            console.log("Handle length cannot be used");
        }


        function handleModal() {
            function openEditModal() {
                const modal = document.getElementById("myModal");
                modal.style.display = "block";
            }

            // Check if the editPost parameter exists in the URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has("editPost")) {
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