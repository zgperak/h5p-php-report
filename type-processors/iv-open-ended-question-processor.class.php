<?php

/**
 * Class FillInProcessor
 * Processes and generates HTML report for 'fill-in' interaction type.
 */
class IVOpenEndedQuestionProcessor extends TypeProcessor {

  function __construct() {
    $this->counter = 0;
  }

  /**
   * Determines options for interaction and generates a human readable HTML
   * report.
   *
   * @inheritdoc
   */
  public function generateHTML($description, $crp, $response, $extras, $scoreSettings) {

    // We need some style for our report
    $this->setStyle('styles/iv-open-ended.css');
    // Send the subcontent id to the view so it can render and grade the correct content
    $container =
      '<div class="h5p-iv-open-ended-reporting-container ' . // Send subcontent id and score scale factor to the front end
      ($this->counter == 0 ? "h5p-iv-open-ended-reporting-visible" : "h5p-iv-open-ended-reporting-hidden") .
      '" data-report-id="' . $extras->subcontent_id .
      '" data-report-scale="' . $scoreSettings->scaledScorePerScore .
      '" data-report-max="' . $scoreSettings->parentMaxScore .
      '" data-report-score-label="' . 'Score' . //TODO escape colon
      '" data-report-score-delimiter="' . $scoreSettings->scoreDelimiter .
      '" data-report-questions-remaining-label="' . $scoreSettings->questionsRemainingLabel .
      '" data-report-submit-button-label="' . $scoreSettings->submitButtonLabel .
      '">' .
        '<div class="h5p-iv-open-ended-reporting-header" id="h5p-iv-open-ended-reporting-header-' . $this->counter .  '">'.
          '<div class="h5p-iv-open-ended-reporting-title-wrapper" id="h5p-iv-open-ended-reporting-title-wrapper-' . $this->counter .  '">'.
            '<p class="h5p-reporting-description">' .
              $description .
            '</p>' .
          '</div>'.
          '<div>' .
            '<div class="h5p-iv-open-ended-reporting-scores h5p-iv-open-ended-reporting-hidden" id="h5p-iv-open-ended-reporting-score-' . $this->counter . '">' .
              '<div class="h5p-iv-open-ended-reporting-change-grade" data-report-id="' . $this->counter . '">Change grade</div>' .
              $this->generateScoreHtml($scoreSettings) .
            '</div>' .
          '</div>'.
        '</div>'.
        '<div class="h5p-iv-open-ended-response-container">' .
          $response .
        '</div>' .
        '<div class="h5p-iv-open-ended-reporting-footer"> ' .
          '<div class="h5p-iv-open-ended-reporting-question-counter"></div>'.
          '<div class="h5p-iv-open-ended-reporting-button-wrapper">' .
            '<button class="h5p-iv-open-ended-previous"></button>' .
            '<button class="h5p-iv-open-ended-next"></button>' .
          '</div>' .
        '</div>' .
      '</div>';

    $this->counter++;

    return $container;
  }
}
