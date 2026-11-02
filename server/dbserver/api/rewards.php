<?php
/**
 * Server-authoritative chance rewards (spin, golden egg, red envelope).
 * The member never sends an amount: the server picks the prize from the
 * administrator-approved table in data/chance_rewards.json and fails closed
 * when that table is missing or invalid.
 */
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') Database::errorResponse('Method Not Allowed', 405);
$userId = Database::requireUser();
$input = Database::getJsonInput();
$type = trim((string)($input['type'] ?? ''));
$counters = ['spin' => 'free_spins', 'golden_egg' => 'golden_eggs_available', 'red_envelope' => 'red_packets_available'];
if (!isset($counters[$type])) Database::errorResponse('Dedicated reward eligibility required; generic cash claim disabled.', 403);

function bbChanceTable(string $type): array {
    $file = __DIR__ . '/../data/chance_rewards.json';
    $cfg = is_file($file) ? json_decode((string)file_get_contents($file), true) : null;
    $rows = is_array($cfg) ? ($cfg[$type] ?? null) : null;
    if (!is_array($rows) || !count($rows) || count($rows) > 20) return [];
    $total = 0.0;
    foreach ($rows as $r) {
        $amt = $r['amount'] ?? null; $w = $r['weight'] ?? null;
        if (!is_numeric($amt) || !is_numeric($w) || $amt < 0 || $amt > 10000 || $w <= 0) return [];
        $total += (float)$w;
    }
    return $total > 0 ? $rows : [];
}

$table = bbChanceTable($type);
if (!$table) Database::errorResponse('Prize table not approved by an administrator yet.', 409);

$total = array_sum(array_map(fn($r) => (float)$r['weight'], $table));
$pick = random_int(1, 1000000) / 1000000 * $total; $prize = $table[count($table) - 1];
foreach ($table as $r) { $pick -= (float)$r['weight']; if ($pick <= 0) { $prize = $r; break; } }
$amount = round((float)$prize['amount'], 2);
$label = substr((string)($prize['label'] ?? ('৳' . $amount)), 0, 60);
$col = $counters[$type];

$pdo = Database::getConnection();
try {
    $pdo->beginTransaction();
    $user = Database::fetchOne('SELECT * FROM users WHERE id=? FOR UPDATE', [$userId]);
    if (!$user) throw new RuntimeException('User not found');
    if ((int)$user[$col] <= 0) throw new RuntimeException('আপনার কোনো সুযোগ বাকি নেই।');
    Database::execute("UPDATE users SET `$col`=`$col`-1, balance=balance+? WHERE id=?", [$amount, $userId]);
    if ($amount > 0) Database::insert('transactions', [
        'id' => 'tx-' . bin2hex(random_bytes(8)), 'user_id' => $userId, 'username' => $user['username'],
        'user_phone' => $user['phone'], 'type' => 'bonus', 'amount' => $amount, 'channel' => 'system',
        'trx_id' => 'REW' . date('YmdHis') . random_int(100, 999), 'status' => 'success',
        'description' => "{$label} ({$type}) সার্ভার পুরস্কার", 'created_at' => date('Y-m-d H:i:s'),
    ]);
    $pdo->commit();
} catch (Throwable $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    Database::errorResponse($e instanceof RuntimeException && !($e instanceof PDOException) ? $e->getMessage() : 'Reward could not be processed', 400);
}
$u = Database::fetchOne('SELECT * FROM users WHERE id=?', [$userId]);
unset($u['password_hash'], $u['transaction_password']);
Database::jsonResponse(['success' => true, 'prize' => ['label' => $label, 'amount' => $amount], 'newBalance' => (float)$u['balance'], 'user' => $u]);
