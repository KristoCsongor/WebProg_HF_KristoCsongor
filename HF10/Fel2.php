<?php
$json = '[
    {
        "title": "The Catcher in the Rye",
        "author": "J.D. Salinger",
        "publication_year": 1951,
        "category": "Fiction"
    },
    {
        "title": "To Kill a Mockingbird",
        "author": "Harper Lee",
        "publication_year": 1960,
        "category": "Fiction"
    },
    {
        "title": "1984",
        "author": "George Orwell",
        "publication_year": 1949,
        "category": "Dystopian"
    },
    {
        "title": "The Great Gatsby",
        "author": "F. Scott Fitzgerald",
        "publication_year": 1925,
        "category": "Fiction"
    },
    {
        "title": "Brave New World",
        "author": "Aldous Huxley",
        "publication_year": 1932,
        "category": "Dystopian"
    }
]';

$books = json_decode($json, true);

$booksByCategory = [];
foreach ($books as $book) {
    $booksByCategory[$book["category"]][] = $book;
}

echo '<table style="border: 1px solid black; width: 100%">';
echo '<tr>';
foreach ($booksByCategory as $category => $categoryBooks) {
    echo '<th style="border: 1px solid black; padding: 10px">' . $category . '</th>';
}
echo '</tr>';

$maxRowCount = max(array_map(function ($item) {
    return count($item);
}, $booksByCategory));

for ($i = 0; $i < $maxRowCount; $i++) {
    echo '<tr>';
    foreach ($booksByCategory as $category => $categoryBooks) {
        if (isset($categoryBooks[$i])) {
            $book = $categoryBooks[$i];
            echo '<td style="border: 1px solid black; padding: 5px">';
            echo '<b>Author:</b> ' . $book['author'] . '<br>';
            echo '<b>Title:</b> ' . $book['title'] . '<br>';
            echo '<b>Publication Year:</b> ' . $book['publication_year'];
            echo '</td>';
        } else {
            echo '<td style="border: 1px solid black; padding: 5px"></td>';
        }
    }
    echo '</tr>';
}

echo '</table>';