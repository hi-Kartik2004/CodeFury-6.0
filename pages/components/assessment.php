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
        <h2>Mental Health Assessment!</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius laboriosam molestias numquam!</p>
        <form action="./php/actions.php?assessment" method="post" class="assessment__form">
            <div class="question">
                <p>1. Over the past two weeks, how often have you felt overwhelmed or unable to cope with daily stressors?</p>
                <div class="options">
                    <input required type="radio" name="question1" id="q1-option1" value="1">
                    <label for="q1-option1">Rarely</label>

                    <input required type="radio" name="question1" id="q1-option2" value="2">
                    <label for="q1-option2">Sometimes</label>

                    <input required type="radio" name="question1" id="q1-option3" value="3">
                    <label for="q1-option3">Frequently</label>
                </div>
            </div>

            <div class="question">
                <p>2. How often do you experience feelings of sadness or hopelessness?</p>
                <div class="options">
                    <input required type="radio" name="question2" id="q2-option1" value="1">
                    <label for="q2-option1">Rarely</label>

                    <input required type="radio" name="question2" id="q2-option2" value="2">
                    <label for="q2-option2">Sometimes</label>

                    <input required type="radio" name="question2" id="q2-option3" value="3">
                    <label for="q2-option3">Frequently</label>
                </div>
            </div>

            <div class="question">
                <p>3. How often do you find it difficult to concentrate or make decisions?</p>
                <div class="options">
                    <input required type="radio" name="question3" id="q3-option1" value="1">
                    <label for="q3-option1">Rarely</label>

                    <input required type="radio" name="question3" id="q3-option2" value="2">
                    <label for="q3-option2">Sometimes</label>

                    <input required type="radio" name="question3" id="q3-option3" value="3">
                    <label for="q3-option3">Frequently</label>
                </div>
            </div>

            <div class="question">
                <p>4. How often do you feel anxious or experience excessive worry?</p>
                <div class="options">
                    <input required type="radio" name="question4" id="q4-option1" value="1">
                    <label for="q4-option1">Rarely</label>

                    <input required type="radio" name="question4" id="q4-option2" value="2">
                    <label for="q4-option2">Sometimes</label>

                    <input required type="radio" name="question4" id="q4-option3" value="3">
                    <label for="q4-option3">Frequently</label>
                </div>
            </div>

            <div class="question">
                <p>5. Have you experienced any significant changes in your appetite or weight recently?</p>
                <div class="options">
                    <input required type="radio" name="question5" id="q5-option1" value="1">
                    <label for="q5-option1">No</label>

                    <input required type="radio" name="question5" id="q5-option2" value="2">
                    <label for="q5-option2">Yes, a little</label>

                    <input required type="radio" name="question5" id="q5-option3" value="3">
                    <label for="q5-option3">Yes, significantly</label>
                </div>
            </div>

            <div class="question">
                <p>6. How often do you have trouble falling asleep or staying asleep?</p>
                <div class="options">
                    <input required type="radio" name="question6" id="q6-option1" value="1">
                    <label for="q6-option1">Rarely</label>

                    <input required type="radio" name="question6" id="q6-option2" value="2">
                    <label for="q6-option2">Sometimes</label>

                    <input required type="radio" name="question6" id="q6-option3" value="3">
                    <label for="q6-option3">Frequently</label>
                </div>
            </div>

            <div class="question">
                <p>7. How often do you experience feelings of loneliness or isolation?</p>
                <div class="options">
                    <input required type="radio" name="question7" id="q7-option1" value="1">
                    <label for="q7-option1">Rarely</label>

                    <input required type="radio" name="question7" id="q7-option2" value="2">
                    <label for="q7-option2">Sometimes</label>

                    <input required type="radio" name="question7" id="q7-option3" value="3">
                    <label for="q7-option3">Frequently</label>
                </div>
            </div>

            <div class="question">
                <p>8. How often do you experience uncontrollable anger or irritability?</p>
                <div class="options">
                    <input required type="radio" name="question8" id="q8-option1" value="1">
                    <label for="q8-option1">Rarely</label>

                    <input required type="radio" name="question8" id="q8-option2" value="2">
                    <label for="q8-option2">Sometimes</label>

                    <input required type="radio" name="question8" id="q8-option3" value="3">
                    <label for="q8-option3">Frequently</label>
                </div>
            </div>

            <div class="question">
                <p>9. Have you had thoughts of self-harm or suicide in the past month?</p>
                <div class="options">
                    <input required type="radio" name="question9" id="q9-option1" value="1">
                    <label for="q9-option1">No</label>

                    <input required type="radio" name="question9" id="q9-option2" value="2">
                    <label for="q9-option2">Yes, but not recently</label>

                    <input required type="radio" name="question9" id="q9-option3" value="3">
                    <label for="q9-option3">Yes, recently</label>
                </div>
            </div>

            <div class="question">
                <p>10. How often do you struggle with low self-esteem or self-worth?</p>
                <div class="options">
                    <input required type="radio" name="question10" id="q10-option1" value="1">
                    <label for="q10-option1">Rarely</label>

                    <input required type="radio" name="question10" id="q10-option2" value="2">
                    <label for="q10-option2">Sometimes</label>

                    <input required type="radio" name="question10" id="q10-option3" value="3">
                    <label for="q10-option3">Frequently</label>
                </div>
            </div>

            <button type="submit" class="green__btn">Get Score</button>
        </form>

    </div>
</section>