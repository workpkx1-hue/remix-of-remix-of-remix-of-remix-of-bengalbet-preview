# Remaining work

Current scope: implement the Bengali A-to-Z report on the user-designated test DBServer. Only isolated test accounts may undergo financial tests; unrelated members remain untouched. No background month-long monitoring is running.

Latest request (2026-11-02 06:51 UTC): continue games, referrals, remaining bonuses and admin controls, using isolated test members and safe test-server checks only.

## Verified this iteration
- [x] Connected BengalBet Server and inspected schema/source.
- [x] Stored protected rollback copies of seven PHP files and five settings/tier table snapshots; /data/ returns 403. This is not a full-database backup or restore drill.
- [x] Installed and browser-tested reads for all five previously missing reward-admin sections (daily, VIP, rescue, promos, mystery); authenticated responses 200.
- [x] Added validated daily-config POST and unified daily status/claim configuration on the server; claim uses transaction + user-row lock and daily bet threshold.
- [x] Daily member cards now use server schedule/eligibility, not hardcoded amounts; failed claims cannot fabricate client credits.
- [x] Actual browser login and daily claim on an isolated test member: reward 3.50, wallet increased exactly 3.50, repeat claim rejected 400, status hasSignedToday=true; wallet card read back 703.50. First reproduction exposed double credit; fixed settlement callback and retested with a fresh isolated member.
- [x] Removed repeat generic reward callbacks after successful promo/rescue/mystery settlements. Those flows still need independent end-to-end verification.
- [x] Notice editor/shared admin navigation and server-confirmed mystery timing gates implemented; desktop/mobile read views verified.
- [x] 19 automated tests passed; preview build OK. Synthetic 30/60-day eligibility tests are not real server settlement/load/uptime tests.

## Verified in current continuation
- [x] Activated admin VIP/rescue/promos/mystery settings controls and deleted temporary installers.
- [x] VIP unchanged save returned preserved birthdayBonus=50; fixed admin tier write endpoints.
- [x] Reproduced rescue create failure; diagnosed stale routing id, cleared it, then created inactive tier 9 and verified deactivate response. It remains an inactive audit artifact.
- [x] Created isolated promo +7; fresh actual browser registration, member redemption credited exactly 7 once; duplicate 400, zero-loss rescue 400, off-date mystery 400, ineligible VIP 400; zero page errors. Test promo deactivated.
- [x] Expired promo rejected 400, wallet unchanged and omitted from member list; test code deactivated.
- [x] Removed universal password fallback from live auth. Valid real test-member login succeeded afterward; fallback-negative test remains unverified.
- [x] Added server new-member task table and dedicated status/claim; current-day approved deposits/valid bets, sequential prior claim and earliest account day. This policy is an implementation assumption pending detailed offer approval.
- [x] Actual browser first task +10 exactly once, duplicate/early second-day 400, generic signin bypass 403; settled button disabled and wallet read back 517; zero page errors.
- [x] Generic mission/promo/signin cash claims disabled; unsupported offer paths now reject rather than credit without eligibility. Spin/egg/packet still require authoritative outcome work.
- [x] 21 permanent automated tests passed, preview build OK; both content route metadata inspected.

## Still open
Current release blockers are not all external: remaining feature implementation and full flow testing still need work. No claim of full-plan completion or production readiness is made.
- [ ] Daily manual-credit/reset, rescue review/manual grant and mystery manual issue/drop remain unimplemented; mystery config save not yet roundtrip-tested.
- [ ] Complete VIP earned-tier/activity requirements and advertised weekly/monthly timing; positive rescue/mystery and concurrent settlement tests. Current guarded server handles zero-loss/expiry/date/repeat checks, but exhaustive flow proof remains open.
- [ ] New-member days 2–12 positive boundary/concurrency/clock tests; admin editor actual authenticated browser save still needs verification. Server config persistence and member display are now implemented.
- [ ] End-to-end referral, deposits/withdrawals, remaining bonuses, achievements, event programs and each game's authoritative settlement.
- [ ] Complete editable banner/program/content settings and full administrator permissions audit.
- [ ] Full database backup/restore drill and separate scoped admin identity: hosting/identity facilities not verified.
- [ ] Scheduled 1–2-month observation: requires provisioned scheduler/monitoring; no unattended work runs after this turn.
- [ ] Legal/responsible-gaming and full regression release gates; not publish-ready.
- [ ] Test-account cleanup requires precise inventory and explicit deletion approval; none deleted.

## Verified 06:36 continuation
- [x] Added server new_member_config with validated 12-day definitions; preserved existing amounts and thresholds. Admin GET/POST/readback succeeded; invalid empty list 422; guest and member requests denied. Router action recognition corrected with backup.
- [x] Added editable admin task editor with enabled toggle, per-day requirement/amount/reward and persisted readback validation. Member labels/amounts now derive from server task definitions, no hardcoded display schedule.
- [x] Authenticated member browser: all 12 server tasks rendered; claimed first-day button disabled; duplicate/early claim rejected; wallet unchanged; zero page errors.
- [x] Live withdrawal now locks user row and atomically creates pending transaction/debits balance; validates configured limits, active account and destination; rejects another pending withdrawal.
- [x] Isolated concurrent two-withdrawal check: one pending transaction, one rejection, exactly 500 debited. Below/above/negative/zero amounts rejected. Admin cancellation refunded exactly 500; repeated cancellation no extra money; finalized transition reversal rejected.
- [x] Isolated test deposit 200 remained pending without credit; approval added stored amount+bonus=210 once. Repeated approval did not add money; subsequent rejection blocked. Test member balance read back 727.
- [x] Live transaction status and batch actions now use pending-to-final atomic guard. Ledger deletion, direct creation and financial amount edits disabled; note edits retained. Test finalized amount edit and deletion both 409. These restrictions need matching admin presentation updates.
- [x] 24 frontend tests and permanent PHP money/config tests passed; preview build OK. Protected source rollback copies retained; temporary installers removed.
- [ ] Deposit submission still uses old hardcoded 5% bonus/minimum; full authoritative offer config and idempotency remain incomplete. Pending withdrawal guard blocks repeats until finalization, not durable client request-key replay across finalization.
- [ ] Real browser withdrawal submission + admin approval interaction and complete live admin editor UI not yet exercised; server endpoint tests alone do not establish these UI flows.
