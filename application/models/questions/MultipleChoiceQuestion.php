<?php
namespace ls\models\questions;

use ls\interfaces\iResponse;

/**
 * Class MultipleChoiceQuestion
 * @package ls\models\questions
 */
class MultipleChoiceQuestion extends ChoiceQuestion
{
    public function getSubQuestionScales()
    {
        return 1;
    }

    /**
     * This function return the class by question type
     * @param string question type
     * @return string Question class to be added to the container
     */
    public function getClasses()
    {
        $result = parent::getClasses();
        $result[] = 'multiple-opt';
        return $result;
    }

    public function getColumns()
    {
        $result = call_user_func_array('array_merge', array_map(function (\Question $subQuestion) {
            $subResult = [];
            foreach ($subQuestion->columns as $name => $type) {
                $subResult[$this->sgqa . $name] = $type;
            }
            return $subResult;
        }, $this->subQuestions));
        return $result;
    }

    /**
     * Returns the fields for this question.
     * @return QuestionResponseField[]
     */
    public function getFields() {
        $result = [];
        foreach ($this->subQuestions as $subQuestion) {
            $result[] = $field = new \QuestionResponseField($this->sgqa . $subQuestion->title, "{$this->title}_{$subQuestion->title}", $this);
            /**
             * @todo Include subquestion relevance.
             */
            $field->setRelevanceScript($this->relevanceScript);
            $field->setLabels([
                'Y' => $subQuestion->question
            ]);
        }
        return $result;
    }

    /**
     * This function renders the object.
     * It MUST NOT produce any output.
     * It should return a string or an object that can be converted to string.
     * @param \ls\interfaces\Response $response
     * @param \SurveySession $session
     * @return \RenderedQuestion
     */
    public function render(iResponse $response, \SurveySession $session)
    {
        $result = parent::render($response, $session);

        $html = '';
        foreach($this->subQuestions as $subQuestion) {
            $html .= \TbHtml::openTag('div');
            $html .= $this->renderSubQuestion($subQuestion, $response, $session);
            $html .= \TbHtml::closeTag('div');
        }


        $result->setHtml($html);
        return $result;
    }

    public function renderSubQuestion(\Question $question, iResponse $response, \SurveySession $session) {
        // Render a line in the multiple choice question.
        $result = '';
        $field = $this->sgqa . $question->title;
        $result .= \TbHtml::checkBox($field, $response->$field == 'Y', [
            'id' => "answer$field",
            'value' => 'Y'
        ]);
        $result .= \TbHtml::label($question->question, "answer$field");
        return $result;

    }



}