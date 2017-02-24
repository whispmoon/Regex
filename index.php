<?php
// git@github.com:imie-source/DL17Regex.git
// https://github.com/imie-source/DL17Regex.git

$examples = [
     [
        "regex" => "/^([12]\d|0[1-9]|3[01])/(0[1-9]|1[12])/(20\d\d|(19\d\d)$/",
        "goods" => ['01/12/1900', '18/04/1980', '14/04/2003'],
        "bads" => ['01/30/1800', '3/5/2000','35/04/2005'],
        "statement" => 'Exemple'   
    ],
    [
        "regex" => "/^((0|[1-9]\d*)|([+-][1-9]\d*)|(\d*[.,]\d*[1-9])|([+-]\d*[.,]\d*[1-9]))$/",
        "goods" => ['1', '10', '120','0,123','+5','-7', '10000000'],
        "bads" => ['01,120', '3#14','abc','+0','-0','010','030', '01000'],
        "statement" => 'Exemple'   
    ],
    [
        "regex" => "/^([1-9]\d*|0)$/",
        "goods" => ['1', '10', '120','0'],
        "bads" => ['01', '3,14','abc','00'],
        "statement" => 'Exemple'   
    ],
     [
        "regex" => "/^[1-9]\d*$/",
        "goods" => ['1', '10', '120'],
        "bads" => ['01', '3.14','abc','0'],
        "statement" => 'Exemple'   
    ],
     [
        "regex" => "/^[A-HJ-NP-TV-Z]{2}-(00[1-9]|0[1-9]\d|[1-9]\d\d)-[A-HJ-NP-TV-Z]{2}$/",
        "goods" => ['AA-123-BB', 'AA-123-BB', 'AA-123-BB'],
        "bads" => ['AA-000-BB', 'AA-123-II','II-123-BB'],
        "statement" => 'Exemple'   
    ],
    [
        "regex" => "/^[12]\d{2}(0[1-9]|1[0-2])(0[1-9]|[1-9]\d)\d{6}(0\d|[1-8]\d|9[0-7])$/",
        "goods" => ['199010100000097', '100010100000001', '199010100000097'],
        "bads" => ['199010100000099', '399010100000097','199000100000097'],
        "statement" => 'Exemple'   
    ],
      [
        "regex" => "/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/",
        "goods" => ['00:00', '15:15', '13:37','01:12'],
        "bads" => ['24:00', '21:60','02:00am','12:','1:12'],
        "statement" => 'Exemple'  
    ],
    [
        "regex" => "/^(0[1-9]|1[0-2]):[0-5][0-9][a|p]m$/",
        "goods" => ['12:30am', '12:30pm', ],
        "bads" => ['00:00am', '15:15am','02:30bm',],
        "statement" => 'Exemple'  
    ],
    [
        "regex" => "/^[A-Z][a-zà-öü]+(-[A-Z][a-zà-öü]+)*$/u",
        "goods" => ['Marcel', 'Jean-François', 'Thomas','Xi','Gülistan'],
        "bads" => ['Jean-', 'jean', 'JEAN', 'X','Joe44'],
        "statement" => 'Exemple'
    ],
    [
        "regex" => "/^[aeiouAEIOUY]([a-z]*[aeiou])?$/",
        "goods" => ['aaa', 'aflazi', 'aggrgrgrgrrga'],
        "bads" => ['école', 'rtunrtunrtyunrtynrty', 'boubou', 'bilibi','charge'],
        "statement" => 'Exemple'
    ],
    [
        "regex" => "/^\d{4,8}$/",
        "goods" => ['1234', '3579', 'oui'],
        "bads" => ['12345', '123','A123'],
        "statement" => 'Exemple'   
    ],
    [
        "regex" => "/^$/",
        "goods" => ['00:00', '15:15', '13:37','01:12'],
        "bads" => ['24:00', '21:60','02:00am','12:','1:12'],
        "statement" => 'Exemple'  
    ],
];

function printExercises($exercises){
    foreach($exercises as $id => $exercise){
        printExercise($exercise["regex"], $exercise["goods"], $exercise["bads"], $exercise["statement"], $id + 1);
    }
}

function printExercise($regex, $goods, $bads, $statement, $nb = 0){
    echo "<h2 class=\"number\">$nb</h2>";
    echo "<p>$statement</p>";
    echo "<p class=\"alert alert-info\">REGEX : $regex</p>";
    echo "<p>Taille : " . strlen($regex) . " caractères</p>";
    printResult($regex, $goods);
    printResult($regex, $bads, false);
    echo "<hr/>";
}

function printResult($regex, $subjects, $flag = 1){
    echo "<div class=\"card\">";
    echo "<h4>" . ($flag ? "Bons" : "Mauvais") . " cas :</h4>";
    echo "<table class=\"table\">";
    echo "<tr>";
    echo "<th>Sujet</th>";
    echo "<th>Résultat</th>";
    echo "</tr>";
    foreach($subjects as $subject){
        $result = preg_match($regex, $subject);
        echo "<tr>";
        echo "<td>$subject</td>";
        echo "<td class=\"alert " . ($result ? "alert-success" : "alert-danger") . "\">";
        echo $result ? "OK" : "KO";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>REGEX</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
    .card {
        background: #fff;
        border-radius: 2px;
        margin: 1rem;
        padding: 1em;
    }
    body{
        background-color: #f9f9f9;
    }
    .number{
        font-size: 1.8em;
        border: 1px solid grey;
        display: inline-block;
        width: 1.2em;
        height: 1.2em;
        text-align: center;
        border-radius: 1.2em;
        background-color: white;
    }
    .number, .card{
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    }
    </style>
</head>
<body>
    <main class="container">
        <h2>Exemples :</h2>
        <?php printExercises($examples) ?>
    </main>
</h1>
</body>
</html>