# Remaining work

Current scope: implement the Bengali A-to-Z report on the user-designated test DBServer. Only isolated test accounts may undergo financial tests; unrelated members remain untouched. No background month-long monitoring is running.

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

## Still open
- [ ] VIP/rescue/promo/mystery configuration CRUD and daily manual-credit/reset controls: handlers not implemented; no writes implied by successful reads.
- [ ] Server VIP eligibility/duplicate safeguards, rescue zero-loss rejection, promo expiry/concurrency and mystery date/settlement consistency.
- [ ] Authoritative new-member task progression; current 12-day UI retains client-side assumptions and is not release-ready.
- [ ] End-to-end referral, deposits/withdrawals, remaining bonuses, achievements, event programs and each game's authoritative settlement.
- [ ] Complete editable banner/program/content settings and full administrator permissions audit.
- [ ] Full database backup/restore drill and separate scoped admin identity: hosting/identity facilities not verified.
- [ ] Scheduled 1–2-month observation: requires provisioned scheduler/monitoring; no unattended work runs after this turn.
- [ ] Legal/responsible-gaming and full regression release gates; not publish-ready.
- [ ] Test-account cleanup requires precise inventory and explicit deletion approval; none deleted.
