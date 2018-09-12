<?php
require_once 'config.php';

header('Content-Type: application/json');

$deps = 'deps';
if (isset($_GET['all'])) $deps .= '_all';

$host = SERVERNAME; $dbname = DATABASE; $username = USERNAME; $password = PASSWORD;
$con = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$sql = "
    SELECT name AS n,
    (
        SELECT COUNT(*)
        FROM applicant
        WHERE
            applicant.first LIKE CONCAT(n, '%')
            OR
            applicant.second LIKE CONCAT(n, '%')
    ) AS 'all',
    (
        SELECT COUNT(*)
        FROM applicant
        WHERE
            applicant.sex = '男'
            AND
            (
                applicant.first LIKE CONCAT(n, '%')
                OR
                applicant.second LIKE CONCAT(n, '%')
            )
    ) AS 'boy',
    (
        SELECT COUNT(*)
        FROM applicant
        WHERE
            applicant.sex = '女'
            AND
            (
                applicant.first LIKE CONCAT(n, '%')
                OR
                applicant.second LIKE CONCAT(n, '%')
            )
    ) AS 'girl',
    (
        SELECT COUNT(*)
        FROM applicant
        WHERE
            applicant.first LIKE CONCAT(n, '%')
    ) AS 'fcall',
    (
        SELECT COUNT(*)
        FROM applicant
        WHERE
            applicant.sex = '男'
            AND
            applicant.first LIKE CONCAT(n, '%')
    ) AS 'fcboy',
    (
        SELECT COUNT(*)
        FROM applicant
        WHERE
            applicant.sex = '女'
            AND
            applicant.first LIKE CONCAT(n, '%')
    ) AS 'fcgirl',
    (
        SELECT COUNT(*)
        FROM applicant
        WHERE
            applicant.second LIKE CONCAT(n, '%')
    ) AS 'scall',
    (
        SELECT COUNT(*)
        FROM applicant
        WHERE
            applicant.sex = '男'
            AND
            applicant.second LIKE CONCAT(n, '%')
    ) AS 'scboy',
    (
        SELECT COUNT(*)
        FROM applicant
        WHERE
            applicant.sex = '女'
            AND
            applicant.second LIKE CONCAT(n, '%')
    ) AS 'scgirl'
    FROM 
" . $deps;

$stmt = $con->prepare($sql);
$stmt->execute();
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
