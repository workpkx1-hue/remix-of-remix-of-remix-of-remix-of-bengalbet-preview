# Remaining work

Current scope: implement the Bengali A-to-Z report on the user-designated test DBServer. Only isolated test accounts may undergo financial tests; unrelated members remain untouched. No background month-long monitoring is running.

Latest request (2026-11-02 06:36 UTC): complete the full plan; continue implementation and live test-server verification. Current focus: server-owned editable 12-day member tasks, followed by remaining money/game/admin release gates.

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
- [ ] Daily manual-credit/reset, rescue review/manual grant and mystery manual issue/drop remain unimplemented; mystery config save not yet roundtrip-tested.
- [ ] Complete VIP earned-tier/activity requirements and advertised weekly/monthly timing; positive rescue/mystery and concurrent settlement tests. Current guarded server handles zero-loss/expiry/date/repeat checks, but exhaustive flow proof remains open.
- [ ] New-member days 2–12 positive boundary/concurrency/clock tests and shared administrator task configuration; frontend display definitions are still static.
- [ ] End-to-end referral, deposits/withdrawals, remaining bonuses, achievements, event programs and each game's authoritative settlement.
- [ ] Complete editable banner/program/content settings and full administrator permissions audit.
- [ ] Full database backup/restore drill and separate scoped admin identity: hosting/identity facilities not verified.
- [ ] Scheduled 1–2-month observation: requires provisioned scheduler/monitoring; no unattended work runs after this turn.
- [ ] Legal/responsible-gaming and full regression release gates; not publish-ready.
- [ ] Test-account cleanup requires precise inventory and explicit deletion approval; none deleted.
