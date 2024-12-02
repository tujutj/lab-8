<?php
// URL з GET-параметрами
$url = 'http://lab.vntu.org/api-server/lab8.php?user=student&pass=p@ssw0rd';

// Отримання даних через file_get_contents()
$response = file_get_contents($url);

// Перетворення JSON-даних у PHP-масив
$data = json_decode($response, true);

// Об'єднання всіх записів про людей в один масив
$people = [];
foreach ($data as $group) {
    if (is_array($group)) {
        $people = array_merge($people, $group);
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Дані з API</title>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Дані людей</h1>
    <?php if (!empty($people)): ?>
        <table>
            <thead>
                <tr>
                    <th>Ім'я</th>
                    <th>Приналежність</th>
                    <th>Ранг</th>
                    <th>Розташування</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($people as $person): ?>
                    <tr>
                        <td><?= htmlspecialchars($person['name'] ?? 'Невідомо') ?></td>
                        <td><?= htmlspecialchars($person['affiliation'] ?? 'Невідомо') ?></td>
                        <td><?= htmlspecialchars($person['rank'] ?? 'Невідомо') ?></td>
                        <td><?= htmlspecialchars($person['location'] ?? 'Невідомо') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align: center;">Дані відсутні або API не повернув результат.</p>
    <?php endif; ?>
</body>
</html>