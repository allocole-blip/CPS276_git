<?php
require_once 'PdoMethods.php';

class date_time extends PdoMethods {

    public function checkSubmit() {
        if (isset($_POST['addNote'])) {
            return $this->addNote();
        } elseif (isset($_POST['getNotes'])) {
            return $this->displayNotes();
        }
        return "";
    }

    public function addNote() {
        $dateTime = $_POST['dateTime'] ?? '';
        $note = $_POST['note'] ?? '';
        if (empty($dateTime) || empty($note)) {
        return "you need to enter date, time, and note.";
    }
        

        $timestamp = strtotime($dateTime);
        $pdo = new PdoMethods();
        $sql = "INSERT INTO assignmnet8 (timestamp, note) VALUES (:timestamp, :note)";
        $bindings = [
            [':timestamp', $timestamp, 'str'],
            [':note', $note, 'str']
        ];

        $result = $pdo->otherBinded($sql, $bindings);

        if ($result === 'error') {
            return "Database error";
        } else {
            return "note has been added";
        }
    }
 public function displayNotes() {
    $begDate = $_POST['begDate'] ?? '';
    $endDate = $_POST['endDate'] ?? '';

    if (empty($begDate) || empty($endDate)) {
        return "no date range selected";
    }
    $begTS = strtotime($begDate);
    $endTS = strtotime($endDate);

    $pdo = new PdoMethods();
    $sql = "SELECT timeStamp, note FROM assignmnet8 WHERE
     timeStamp BETWEEN :begDate AND :endDate ORDER BY timeStamp DESC";
    $bindings = [
        [':begDate', $begTS, 'str'],
        [':endDate', $endTS, 'str']
    ];
    $records = $pdo->selectBinded($sql, $bindings);

    if ($records === 'error' || count($records) === 0) {
        return "no notes where found in the range selected";
    }

       $output  = "<table class=\"table table-striped\">";
       $output .= "<thead><tr><th>Date & Time</th><th>Note</th></tr></thead>";
        $output .= "<tbody>";
    foreach ($records as $note) {
        $dateFormatted = date("m/d/Y h:i A", $note['timeStamp']);
        $noteText = htmlspecialchars($note['note'], ENT_QUOTES);
        $output .= "<tr><td>{$dateFormatted}</td><td>{$noteText}</td></tr>";
    }
    $output .= "</tbody></table>";

    return $output;
}
    }
?>
