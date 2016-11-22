<?php
/**
 * Gender question, radio item Html
 *
 * @var $name
 * @var $fChecked
 * @var $mChecked
 * @var $naChecked
 * @var $value
 */
?>

<!--Gender question, radio display -->

<!-- answer -->
<ul class="answers-list radio-list list-unstyled">

    <!-- Female -->
    <li class="answer-item radio-item radio">
        <input
            class="radio"
            type="radio"
            name="<?php echo $name;?>"
            id="answer<?php echo $name;?>F"
            value="F"
            <?php echo $fChecked; ?>
            onclick="checkconditions(this.value, this.name, this.type);"
            aria-labelledby="label-answer<?php echo $name;?>F"
        />

        <label for="answer<?php echo $name;?>F" class="answertext" id="label-answer<?php echo $name;?>F">
          <?php eT('Female');?>
        </label>
        <!--
             The label text is provided inside a div,
             To respect the global HTML flow of other question types
        -->
        <div class="label-text label-clickable">
         
        </div>
    </li>

    <!-- Male -->
    <li class="answer-item radio-item radio">
        <input
            class="radio"
            type="radio"
            name="<?php echo $name;?>"
            id="answer<?php echo $name;?>M"
            value="M"
            <?php echo $mChecked;?>
            onclick="checkconditions(this.value, this.name, this.type);"
            aria-labelledby="label-answer<?php echo $name;?>M"
        />

        <label for="answer<?php echo $name;?>M" class="answertext" id="label-answer<?php echo $name;?>M">
          <?php eT('Male');?>
        </label>
        <!--
             The label text is provided inside a div,
             To respect the global HTML flow of other question types
        -->
        <div class="label-text label-clickable">
            
        </div>
    </li>

    <!-- No answer -->
    <?php if($noAnswer):?>
        <li class="answer-item radio-item noanswer-item radio">
            <input
                class="radio"
                type="radio"
                name="<?php echo $name;?>"
                id="answer<?php echo $name;?>"
                value=""
                <?php echo $naChecked;?>
                onclick="checkconditions(this.value, this.name, this.type);"
                aria-labelledby="label-answer<?php echo $name;?>"
            />

            <label for="answer<?php echo $name;?>" class="answertext" id="label-answer<?php echo $name;?>">
               <?php eT('No answer'); ?> 
            </label>
            <!--
                 The label text is provided inside a div,
                 To respect the global HTML flow of other question types
            -->
            <div class="label-text label-clickable" >
                
            </div>
        </li>
    <?php endif;?>
</ul>
<!-- Value -->
<input
    type="hidden"
    name="java<?php echo $name;?>"
    id="java<?php echo $name; ?>"
    value="<?php echo $value;?>"
/>
<!-- end of answer -->
