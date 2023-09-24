<section class="hero__section">
    <!-- Loading animation -->
    <!-- <div class="loading-animation">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div> -->



    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide" id="slider1">
                <div class="slider1__content__wrapper">
                    <div class="slider1__heading">
                        <h3>THE COMMUNITY OF 10+ MENTAL HEALTH EXPERTS</h3>
                        <p>
                            Join us now & get your questions answered!
                        </p>
                    </div>

                    <button class="hero__green__btn">
                        <a href="?login" style="font-weight:500; opacity: 1;">Start Now</a>
                    </button>
                </div>

            </div>
            <div class="swiper-slide" id="slider2">
                <div class="slider1__content__wrapper">
                    <div class="slider1__heading">
                        <h3>Articles | Community | Counselling | Mental Status</h3>
                        <p>
                            Enhance mental health and well-being in the digital age.
                        </p>
                    </div>

                    <button class="hero__green__btn">
                        <a href="https://github.com/hi-Kartik2004/CodeFury-6.0/issues" target="_blank" style="font-weight:500; opacity: 1;">Get in touch</a>
                    </button>
                </div>

            </div>
            <!-- <div class="swiper-slide">Slide 3</div>
            <div class="swiper-slide">Slide 4</div>
            <div class="swiper-slide">Slide 5</div>
            <div class="swiper-slide">Slide 6</div>
            <div class="swiper-slide">Slide 7</div>
            <div class="swiper-slide">Slide 8</div>
            <div class="swiper-slide">Slide 9</div> -->
        </div>
        <div class="swiper-button-next" style="background-color: var(--gray-color); padding: 2.5rem; border-radius: 100%; color: var(--green-color);"></div>
        <div class="swiper-button-prev" style="background-color: var(--gray-color); padding: 2.5rem; border-radius: 100%; color: var(--green-color);"></div>
        <div class="swiper-pagination" style="color: var(--green-color);"></div>
        <div class="autoplay-progress">
            <svg viewBox="0 0 48 48">
                <circle cx="24" cy="24" r="20"></circle>
            </svg>
            <span></span>
        </div>
    </div>
</section>

<section class="about__wrapper">
    <div class="about">
        <h4><u> Welcome to Online Metal Clinic </u></h4>
        <br>

        <p>
            Welcome to Mental Clinic, your source for mental health support and resources. Join our community and find the help and guidance you need. Explore, connect, and take steps toward a healthier mind. Start your journey to mental well-being with us today.
            <br>
            <br>
            We are a decentralized exchange focused on offering a premier support to all the people of this digital age.
        </p>
    </div>

</section>

<section class="hero__stocks__wrapper">
    <div class="hero__stocks container loading add-loader" id="hero-stocks">

        <?php
        require_once "./php/functions.php";
        $users = getAllUsers();
        $counter = 0; // Initialize a counter variable

        foreach ($users as $user) {
            if ($counter < 12) {
                $counter++;
            } else {
                break;
            }
        ?>

            <div class="stocks__card">
                <div class="card__top">
                    <div>
                        <?php
                        $getArticleCount = count(getUserPosts($user["email"]));

                        $getSessionCount = count(getSessionDetailsByUser($user["email"]));

                        $getCommentCount = count(getCommentsPerUser($user["email"]));
                        ?>

                        <?php
                        if ($getArticleCount > 20 || $getSessionCount > 20 || $getCommentCount > 20) {
                            echo "<i class='bx bxs-heart' ></i>";
                        } else if ($getArticleCount > 10 || $getSessionCount > 10 || $getCommentCount > 10) {
                            echo "<i class='bx bx-laugh' ></i>";
                        } else {
                            echo "<i class='bx bx-smile'></i>";
                        }
                        ?>

                    </div>

                    <div class="card__heading">
                        <h6><?= $user["first_name"] ?></h6>
                        <span>Joined: <?= $user["created_at"] ?></span>
                    </div>

                </div>

                <div class="card__bottom">

                    <h6>Articles: <?= $getArticleCount ?></h6>
                    <h6>Comments: <?= $getCommentCount ?></h6>
                    <h6>Sessions: <?= $getSessionCount ?></h6>
                </div>
            </div>

        <?php
        }
        ?>


    </div>

    <button class="hero__green__btn">
        <a href="?past">Show more</a>
    </button>
</section>

<!-- ============= News Letter ================= -->
<section class="newsletter">
    <div class="newsletter__wrapper container">
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
        <div class="newsletter__heading">
            <h3>Email NewsLetter</h3>
            <p>Subscribe to our newsletter!</p>
        </div>

        <form action="./php/actions.php?newsLetter" method="post">
            <input type="email" name="email" placeholder="example@mail.com" id="subscribe-input">
            <button class="hero__green__btn" id="subscribe-btn" type="submit">
                <h6>Submit</h6>
            </button>
        </form>

    </div>

</section>