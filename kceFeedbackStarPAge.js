let starRatingMainContainer = document.getElementById('studentFeedbackStarContainer');

        let fragment = document.createDocumentFragment();
        let questionsArray = new Array();
        <?php 
            for($i = 1; $i <= count($_SESSION['$allQuestions']); $i++) {
                $question = htmlspecialchars($_SESSION['$allQuestions']["q$i"] . $value);
        ?>
        questionsArray.push(<?php echo "$question" ?>);
        <?php } ?>

        for (let i = 1; i < questionsArray.length; i++){
            let starBlock = document.createElement('div');
            starBlock.classList.add('table-content');
            starBlock.innerHTML = `
                <div class="sno-block">
                    <p class="sNo">${i}.</p>
                </div>
                <div class="question-block">
                    <p class="qusetionPara">${questionsArray[i]}</p>
                </div>
                <div class="star-container">
                    <div class="star-block" id="starContainer">
                        <div class="rate">
                            <input type="radio" id="star5${i}" name="rate${i}" value="5" />
                            <label for="star5${i}" title="5 Stars">5 stars</label>
                            <input type="radio" id="star4${i}" name="rate${i}" value="4" />
                            <label for="star4${i}" title="4 Stars">4 stars</label>
                            <input type="radio" id="star3${i}" name="rate${i}" value="3" />
                            <label for="star3${i}" title="3 Stars">3 stars</label>
                            <input type="radio" id="star2${i}" name="rate${i}" value="2" />
                            <label for="star2${i}" title="2 Stars">2 stars</label>
                            <input type="radio" id="star1${i}" name="rate${i}" value="1" />
                            <label for="star1${i}" title="1 Star">1 star</label>
                        </div>
                    </div>
                </div>
            `;

            fragment.appendChild(starBlock);
        }

        starRatingMainContainer.appendChild(fragment);
        