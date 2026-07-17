<?php

declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: public, max-age=60, stale-while-revalidate=300');
header('X-Content-Type-Options: nosniff');

$query = trim((string) ($_GET['q'] ?? ''));
$limit = max(1, min(20, (int) ($_GET['limit'] ?? 12)));

try {
    $dsn = getenv('EV_CATALOG_DSN') ?: 'mysql:host=127.0.0.1;dbname=smart_ev_route_planner;charset=utf8mb4';
    $user = getenv('EV_CATALOG_DB_USER') ?: 'root';
    $password = getenv('EV_CATALOG_DB_PASSWORD') ?: '';
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

    $sql = <<<'SQL'
        SELECT m.id, b.name AS brand, m.name, m.trim_name,
               m.usable_battery_kwh AS battery,
               m.max_dc_charging_kw AS peak,
               m.usable_range_km AS usable_range,
               m.connector_type
        FROM ev_models m
        INNER JOIN ev_brands b ON b.id = m.brand_id
        WHERE m.is_active = 1 AND b.is_active = 1
          AND (:query = '' OR CONCAT_WS(' ', b.name, m.name, m.trim_name) LIKE :term)
        ORDER BY
          CASE WHEN b.name LIKE :prefix THEN 0 ELSE 1 END,
          b.name ASC, m.name ASC, m.trim_name ASC
        LIMIT %d
        SQL;
    $statement = $pdo->prepare(sprintf($sql, $limit));
    $statement->execute([
        'query' => $query,
        'term' => '%' . $query . '%',
        'prefix' => $query . '%',
    ]);

    $models = array_map(static function (array $row): array {
        $name = trim($row['name'] . ' ' . $row['trim_name']);
        $battery = (float) $row['battery'];
        $peak = (float) $row['peak'];
        return [
            'id' => 'ev-' . (int) $row['id'],
            'brand' => $row['brand'],
            'model' => $name,
            'battery' => $battery,
            'peak' => $peak,
            'curve' => rtrim(rtrim(number_format($peak, 1, '.', ''), '0'), '.') . ' kW',
            'range' => (int) $row['usable_range'],
            'connector' => $row['connector_type'],
            'chargeTime' => $peak > 0 ? max(16, (int) round(($battery * .7 / $peak) * 60 * 1.45)) : null,
        ];
    }, $statement->fetchAll());

    echo json_encode(['models' => $models, 'count' => count($models)], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (Throwable $exception) {
    http_response_code(503);
    echo json_encode(['models' => [], 'count' => 0, 'error' => 'catalog_unavailable']);
}
