<?php
// index.php

require_once 'vendor/autoload.php';

use App\Services\ReverseTextService;

$reverseService = new ReverseTextService();
$input = $_POST['input'] ?? '';
$output = '';

$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if ($input) {
    $output = $reverseService->reverseWordsInString($input);
    if ($isAjax) {
        echo json_encode(['output' => $output]);
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Палиндром-сервис</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<style>
    #loading {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    #loading.show {
        opacity: 1;
        visibility: visible;
    }

    #result {
        transition: opacity 0.3s ease;
    }

    .hidden {
        display: none !important;
    }
</style>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
<div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
    <h1 class="text-2xl font-bold mb-4 text-center">Палиндром-сервис</h1>
    <form method="post" id="reverseForm">
        <label for="input" class="block text-sm font-medium text-gray-700">Введите строку:</label>
        <textarea id="input" name="input" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"><?php echo htmlspecialchars($input); ?></textarea>
        <button type="submit" class="mt-4 w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">Обратить</button>
    </form>
    <div id="loading" class="hidden flex items-center justify-center mt-4">
        <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-indigo-600"></div>
        <span class="ml-2 text-indigo-600">Обработка...</span>
    </div>

    <?php if ($output && !$isAjax): ?>
        <div id="result" class="mt-4">
            <h2 class="text-xl font-semibold mb-2">Результат:</h2>
            <pre class="bg-gray-200 p-4 rounded-md overflow-auto"><?php echo htmlspecialchars($output); ?></pre>
        </div>
    <?php else: ?>
        <div id="result" class="hidden mt-4">
            <h2 class="text-xl font-semibold mb-2">Результат:</h2>
            <pre id="output" class="bg-gray-200 p-4 rounded-md overflow-auto"></pre>
        </div>
    <?php endif; ?>
</div>
<script src="src/js/app.js"></script>
</body>
</html>