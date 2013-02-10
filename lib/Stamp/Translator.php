<?php
/*
 * This class is responsible for building up an erray of emitters, or
 * classes that can format various parts of a date. Translator recognizes
 * the parts of the example dates and builds up appropriate objects that
 * can format a new date for that part
 */
namespace Stamp;

class Translator
{
  private $TIME_ZONE_ABBREVIATIONS = array(
    'ACDT', 'ACST', 'ACT', 'ADT', 'AEDT', 'AEST', 'AFT', 'AKDT', 'AKST',
    'AMST', 'AMT', 'ART', 'AST', 'AWDT', 'AWST', 'AZOST', 'AZT', 'BDT',
    'BIOT', 'BIT', 'BOT', 'BRT', 'BST', 'BTTCAT', 'CCT', 'CDT', 'CEDT',
    'CEST', 'CET', 'CHADT', 'CHAST', 'CHOT', 'ChST', 'CHUT', 'CIST',
    'CIT', 'CKT', 'CLST', 'CLT', 'COST', 'COT', 'CST', 'CT', 'CVT',
    'CWST', 'CXT', 'DAVT', 'DDUT', 'DFT', 'EASST', 'EAST', 'EAT', 'ECT',
    'EDT', 'EEDT', 'EEST', 'EET', 'EGST', 'EGT', 'EIT', 'EST', 'FET',
    'FJT', 'FKST', 'FKT', 'FNT', 'GALT', 'GAMT', 'GET', 'GFT', 'GILT',
    'GIT', 'GMT', 'GST', 'GYT', 'HADT', 'HAEC', 'HAST', 'HKT', 'HMT',
    'HOVT', 'HST', 'ICT', 'IDT', 'IOT', 'IRDT', 'IRKT', 'IRST', 'IST',
    'JST', 'KGT', 'KOST', 'KRAT', 'KST', 'LHST', 'LINT', 'MAGT', 'MART',
    'MAWT', 'MDT', 'MET', 'MEST', 'MHT', 'MIST', 'MIT', 'MMT', 'MSK',
    'MST', 'MUT', 'MVT', 'MYT', 'NCT', 'NDT', 'NFT', 'NPT', 'NST', 'NT',
    'NUT', 'NZDT', 'NZST', 'OMST', 'ORAT', 'PDT', 'PET', 'PETT', 'PGT',
    'PHOT', 'PHT', 'PKT', 'PMDT', 'PMST', 'PONT', 'PST', 'RET', 'ROTT',
    'SAKT', 'SAMT', 'SAST', 'SBT', 'SCT', 'SGT', 'SLT', 'SRT', 'SST',
    'SYOT', 'TAHT', 'THA', 'TFT', 'TJT', 'TKT', 'TLT', 'TMT', 'TOT',
    'TVT', 'UCT', 'ULAT', 'UTC', 'UYST', 'UYT', 'UZT', 'VET', 'VLAT',
    'VOLT', 'VOST', 'VUT', 'WAKT', 'WAST', 'WAT', 'WEDT', 'WEST', 'WET',
    'WST', 'YAKT', 'YEKT'
  );

  private $MONTH_NAMES = array(
    'January', 'February', 'March', 'April', 'May', 'June', 'July',
    'August', 'September', 'October', 'November', 'Dec'
  );

  private $MONTH_ABBRV = array(
    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
    'Nov', 'Dec'
  );

  private $DAY_NAMES = array(
    'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
  );

  private $DAY_ABBRV = array(
    'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'
  );

  private $timezone_regexp;
  private $monthnames_regexp;
  private $abbr_monthnames_regexp;
  private $daynames_regexp;
  private $abbr_daynames_regexp;
  private $two_digit_regexp;
  private $four_digit_regexp;
  private $ordinal_day_regexp;
  private $one_digit_regexp;
  protected $time_regexp;

  public function __construct()
  {
    $this->timezone_regexp = '/^(' . implode('|', $this->TIME_ZONE_ABBREVIATIONS) . ')$/';
    $this->monthnames_regexp = '/^(' . implode('|', $this->MONTH_NAMES) . ')$/i';
    $this->abbr_monthnames_regexp = '/^(' . implode('|', $this->MONTH_ABBRV) . ')$/i';
    $this->daynames_regexp = '/^(' . implode('|', $this->DAY_NAMES) . ')$/i';
    $this->abbr_daynames_regexp = '/^(' . implode('|', $this->DAY_ABBRV) . ')$/i';
    $this->two_digit_regexp = '/^\d{2}$/';
    $this->four_digit_regexp = '/^\d{4}$/';
    $this->ordinal_day_regexp = '/^(\d{1,2})(st|nd|rd|th)$/';
    $this->one_digit_regexp = '/^\d{1}$/';
    $this->time_regexp = '/(\d{1,2})(:)(\d{2})(\s*)(:)?(\d{2})?(\s*)?([ap]m)?/i';
  }

  public function translate($example, $time)
  {
    $parts = preg_split($this->time_regexp, $example);

    if ( count($parts) == 1 ) {
      $before = $parts[0];
      $after = false;
      $time_matches = false;
    } else {
      $before = $parts[0];
      $after = $parts[1];
      preg_match($this->time_regexp, $example, $time_matches);
    }

    $emitters = new Emitters\Composite();
    $previous = false;

    // handle our before date parts
    $date_parts = preg_split('/\b/', $before, -1, PREG_SPLIT_NO_EMPTY);
    foreach ($date_parts as $token) {
      $val = $emitters->add($this->date_emitter($token, $previous));
      if ($val && $val->field != 'string') {
        $previous = $val;
      }
    }

    // now deal with time bits
    $previous = false;
    if ($time_matches) {
      array_shift($time_matches); // first match is whole string
      foreach ($time_matches as $token) {
        $val = $emitters->add($this->time_emitter($token, $previous));
        if ($val && $val->field != 'string')
        {
          $previous = $val;
        }
      }
    }

    // now handle our after time bits if needed
    $previous = false;
    if ( $after ) {
      $date_parts = preg_split('/\b/', $after, -1, PREG_SPLIT_NO_EMPTY);
      foreach ($date_parts as $token) {
        $val = $emitters->add($this->date_emitter($token, $previous));
        if ($val && $val->field != 'string') {
          $previous = $val;
        }
      } 
    }

    return $emitters->format($time);
  }

  public function date_emitter($token, $previous)
  {
    if (preg_match($this->monthnames_regexp, $token)) {
      return new Emitters\Lookup("F");
    } elseif (preg_match($this->abbr_monthnames_regexp, $token)) {
      return new Emitters\Lookup("M");
    } elseif (preg_match($this->daynames_regexp, $token)) {
      return new Emitters\Lookup("l");
    } elseif (preg_match($this->abbr_daynames_regexp, $token)) {
      return new Emitters\Lookup("D");
    } elseif (preg_match($this->timezone_regexp, $token)) {
      return new Emitters\Lookup("T");
    } elseif (preg_match($this->four_digit_regexp, $token)) {
      return new Emitters\Lookup("Y");
    } elseif (preg_match($this->ordinal_day_regexp, $token)) {
      return new Emitters\Ordinal($token);
    } elseif (preg_match($this->two_digit_regexp, $token)) {
      return new Emitters\TwoDigitDate($token, $previous);
    } elseif (preg_match($this->one_digit_regexp, $token)) {
      return new Emitters\Lookup("j");
    } else {
      return new Emitters\String($token);
    }
  }

  private function time_emitter($token, $previous)
  {
    if ( preg_match('/^(a|p)m$/', $token) ) {
      return new Emitters\AmPm();
    } elseif ( preg_match('/^(A|P)M$/', $token)) {
      return new Emitters\AmPm('uppercase');
    } elseif ( preg_match($this->two_digit_regexp, $token)) {
      return new Emitters\TwoDigitTime($token, $previous);
    } elseif (preg_match($this->one_digit_regexp, $token)) {
      return new Emitters\Lookup("g");
    } else {
      return new Emitters\String($token);
    }
  }
}
