<?php
/** Read-only reward admin contracts. Invoked by authenticated admin.php. */
Database::requireAdmin();
if ($method !== 'GET') Database::errorResponse('This reward operation is not implemented; no changes were made.', 405);
function bbRewardRow(array $row): array {
    $out = [];
    foreach ($row as $key => $value) {
        $name = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));
        $out[$name] = is_numeric($value) && !in_array($key, ['id','user_id','code','ticket_code'], true) ? 0 + $value : $value;
    }
    foreach (['enabled','eligible'] as $key) if (isset($out[$key])) $out[$key] = (bool)$out[$key];
    if (isset($out['perksJson'])) $out['perks'] = json_decode($out['perksJson'], true) ?: [];
    if (isset($out['monthYear'])) {
        $parts = explode('-', $out['monthYear']);
        $out['year'] = $parts[0] ?? '';
        $out['month'] = $parts[1] ?? '';
        $out['cardCode'] = $out['cardCode'] ?? $out['ticketCode'] ?? '';
        $out['voucherCode'] = $out['voucherCode'] ?? $out['ticketCode'] ?? '';
        $out['turnoverMultiplier'] = $out['bonusAmount'] > 0 ? $out['turnoverRequired'] / $out['bonusAmount'] : 0;
    }
    return $out;
}
function bbRewardRows(string $table, string $order, array $filters = []): array {
    $where = []; $params = [];
    foreach ($filters as $key => $value) if ($value !== '' && $value !== 'all') { $where[] = '`' . $key . '` = ?'; $params[] = $value; }
    $search = trim($_GET['search'] ?? '');
    if ($search !== '') { $where[] = '(`username` LIKE ? OR `user_id` LIKE ?)'; $params[] = '%' . $search . '%'; $params[] = '%' . $search . '%'; }
    $sql = 'SELECT * FROM `' . $table . '`' . ($where ? ' WHERE ' . implode(' AND ', $where) : '') . ' ORDER BY ' . $order;
    return array_map('bbRewardRow', Database::fetchAll($sql, $params));
}
switch ($section) {
case 'daily-signin':
    if ($action === 'config') {
        $row = Database::fetchOne('SELECT config_json FROM daily_signin_config WHERE id = 1');
        $config = $row ? json_decode($row['config_json'], true) : null;
        if (!$config) {
            $config = ['enabled'=>true, 'cycleDays'=>30, 'dailyRequiredBet'=>0, 'days'=>[]];
            for ($day=1; $day<=30; $day++) $config['days'][] = ['day'=>$day, 'bonus'=>round(2 + $day * 1.5, 2)];
        }
        Database::jsonResponse(['success'=>true, 'config'=>$config, 'configured'=>(bool)$row]);
    }
    if ($action === 'records') {
        $rows = bbRewardRows('daily_signin_records', '`claimed_at` DESC', ['date'=>$_GET['date'] ?? '']);
        Database::jsonResponse(['success'=>true,'records'=>$rows,'total'=>count($rows)]);
    }
    break;
case 'vip':
    $tiers = array_map('bbRewardRow', Database::fetchAll('SELECT * FROM vip_tiers ORDER BY level ASC'));
    if ($action === 'tiers') Database::jsonResponse(['success'=>true,'tiers'=>$tiers,'count'=>count($tiers)]);
    $claims = bbRewardRows('vip_claims', '`timestamp` DESC');
    if ($action === 'claims') Database::jsonResponse(['success'=>true,'claims'=>$claims,'count'=>count($claims)]);
    if ($action === 'stats') {
        $levels=[];
        foreach (Database::fetchAll('SELECT vip_level, COUNT(*) AS total FROM users GROUP BY vip_level') as $row) $levels[(int)$row['vip_level']] = (int)$row['total'];
        Database::jsonResponse(['success'=>true,'stats'=>['totalTiers'=>count($tiers),'totalClaimsCount'=>count($claims),'totalBonusDistributed'=>array_sum(array_column($claims,'bonus')),'levelCounts'=>$levels,'tiers'=>$tiers,'recentClaims'=>array_slice($claims,0,50)]]);
    }
    break;
case 'rescue':
    if ($action === 'tiers') {
        $rows=array_map('bbRewardRow', Database::fetchAll('SELECT * FROM rescue_tiers ORDER BY min_loss ASC'));
        Database::jsonResponse(['success'=>true,'tiers'=>$rows]);
    }
    if ($action === 'claims') {
        $rows=bbRewardRows('rescue_claims','`claimed_at` DESC',['status'=>$_GET['status'] ?? '']);
        Database::jsonResponse(['success'=>true,'claims'=>$rows,'total'=>count($rows)]);
    }
    break;
case 'promos':
    if ($action === 'redemptions') {
        $rows=bbRewardRows('promo_redemptions','`redeemed_at` DESC',['code'=>$_GET['code'] ?? '']);
        Database::jsonResponse(['success'=>true,'redemptions'=>$rows,'total'=>count($rows)]);
    }
    if ($action === '' || $action === 'list') {
        $where=[]; $params=[];
        if (!empty($_GET['status']) && $_GET['status'] !== 'all') { $where[]='status = ?'; $params[]=$_GET['status']; }
        if (!empty($_GET['search'])) { $where[]='(code LIKE ? OR title LIKE ?)'; $params[]='%'.$_GET['search'].'%'; $params[]='%'.$_GET['search'].'%'; }
        $rows=array_map('bbRewardRow',Database::fetchAll('SELECT * FROM promo_codes'.($where ? ' WHERE '.implode(' AND ',$where) : '').' ORDER BY created_at DESC',$params));
        Database::jsonResponse(['success'=>true,'promos'=>$rows,'total'=>count($rows)]);
    }
    break;
case 'mystery-reward':
    if ($action === 'config') {
        $row=Database::fetchOne('SELECT config_json FROM mystery_reward_config WHERE id = 1');
        $config=$row ? json_decode($row['config_json'],true) : null;
        if (!$config) $config=['enabled'=>true,'minBonusAmount'=>2500,'maxBonusAmount'=>2500,'triggerDayOfMonth'=>23,'triggerHour'=>18,'minBetRequired'=>500,'promoCode'=>'','wageringTurnover'=>1,'autoCreditEnabled'=>false];
        Database::jsonResponse(['success'=>true,'config'=>$config,'configured'=>(bool)$row]);
    }
    if ($action === 'cards') {
        $rows=bbRewardRows('mystery_cash_cards','`unlocked_at` DESC',['status'=>$_GET['status'] ?? '', 'month_year'=>$_GET['monthYear'] ?? '']);
        Database::jsonResponse(['success'=>true,'cards'=>$rows,'total'=>count($rows)]);
    }
    break;
}
Database::errorResponse('Unknown reward admin action',404);
