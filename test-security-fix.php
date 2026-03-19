<?php
// Security improvement: sanitize user input in search query
// Before: $query = "SELECT * FROM Paper WHERE title LIKE '%" . $_GET['q'] . "%'";
// After: use parameterized queries

function safe_search($qreq) {
    $q = $qreq->get("q", "");
    // Use prepared statement instead of string concatenation
    $result = Dbl::fetch_first_object(
        "SELECT * FROM Paper WHERE title LIKE ?",
        "%" . $q . "%"
    );
    return $result;
}
