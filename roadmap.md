# Remaining work

Current request (2026-11-02 05:41 UTC): implement the full report against the current DBServer, which the user explicitly identifies as a development/test server. Authorized controlled server code/config changes and financial checks on newly marked test accounts; never alter unrelated members. First establish protected backups of modified files, inspect current schema/contracts, then add missing reward-admin handlers and test browser readback. Do not claim the entire report implemented unless all release gates actually pass.
- [ ] Inspect current server/schema and protect rollback copies before uploads.
- [ ] Restore missing daily/VIP/rescue/promo/mystery admin contracts and verify frontend reads.
- [ ] Test settings CRUD and member reward/wallet flows on isolated audit accounts, reverting temporary shared settings.
- [ ] Complete remaining games/programs/permissions and release checks; unresolved scopes must remain explicit.

Latest implementation request (2026-11-02 05:33 UTC): execute the report, improve admin settings/navigation, verify timed rewards, and simulate 30–60 days with 100 referred and 100 non-referred joins daily. Simulation must use an isolated clock/data environment, not thousands of production accounts; no unattended month-long monitoring is established by a chat turn.
- [x] Restored BengalBet Server connection; live ping and file inventory HTTP 200; current mystery PHP read succeeded.
- [x] Shared admin navigation; notice editor now has bilingual fields, enabled switch, image preview, explicit failure/loading feedback and save/readback verification. Real authenticated desktop/mobile reads succeeded; no settings were changed.
- [x] Mystery claim affordance now requires server-confirmed event day/opening time as well as eligibility/unlocked/unclaimed state; no browser-clock eligibility inference.
- [x] Deterministic 30/60-day local member-UI simulations: 6,000/12,000 synthetic users, half referred/half direct; 93,000/366,000 member-day checks, four eligibility decisions each. This is NOT live registration, referral commission, ledger, payout, server-clock or month-long uptime testing.
- [x] 17 tests passed; authenticated notice loaded in desktop/mobile browser, bilingual switch worked, zero page errors and mobile horizontal overflow absent; latest preview build OK. Save persistence tested with isolated function doubles, NOT a production settings mutation.
- [ ] Blocked: production financial/auth updates and full settlement tests require a verified protected restorable backup, isolated staging DBServer/funds, and scoped administrator identity; long-running monitoring also requires a provisioned scheduled service.
- Current live recheck: all five reward-admin sections still return 404. No PHP upload or publish performed. Remaining full-plan scope (wallet/game settlement, other promotions, content/banner program CRUD, legal/safety controls, authenticated member flows) is not complete and awaits the same verified isolation/access prerequisites.

- [x] Follow-up (2026-11-02 05:22 UTC): verified legacy admin login and users/settings/stats/feedbacks/transactions reads (HTTP 200); no credential in report/project files and no writes. VIP/Rewards/Referrals subtab checks remain unverified; login does not establish scoped admin or connector access.

Latest request (2026-11-02 05:11 UTC): finish the previously incomplete Bengali PDF and plain-text reports, with fresh safe checks. No permission to publish or change live funds/settings.
- [x] Rerun all 11 focused tests; verify public settings responds HTTP 200/success; open 11 guest paths on desktop/mobile, then recheck visible images after settling and dismissing notices on home/promotions/aviator/admin.
- [x] Consolidate current member/program/admin source inventories and inspect 23 marketing artworks; separate prior authenticated observations from fresh guest checks.
- [x] Generated matching version-2 Bengali PDF/plain text; inspected all 16 rendered PDF pages. Increased body text size after first review; no clipping/overlap found in final pass. Included fresh admin reads and explicit unverified financial/subtab flows.
- Blocked: no accessible BengalBet Server connection in this workspace, no restored audit-member session, protected backup/staging/scoped admin not verified; authenticated admin writes and financial flows remain unverified.

Earlier request (2026-11-02 04:52 UTC): finish remaining safe checks and deliver a detailed Bengali A-to-Z current-status, site-flow, image and implementation plan as PDF and plain text. No permission to publish or change live funds/settings.
- [x] Finish available desktop/mobile guest navigation and loaded-image checks; authenticated paths and full-scroll images explicitly unverified.
- [x] Consolidate all member/admin/program/asset findings with evidence levels and release gates.
- [x] Deliver matching PDF and plain-text reports; visually inspect every PDF page.

Latest request (2026-11-02 04:28 UTC): deliver a detailed Bangla full-site member-flow, image/banner, bonus-timing and publishing-readiness plan grounded in source, desktop/mobile browser observations and live data. This request is audit/planning only, not permission to deploy, claim bonuses or change balances/settings.
- [x] Inventory member pages, promotion promises, game programs and image sources with evidence.
- [ ] Capture desktop and mobile guest/member flows and audit loaded images, errors and navigation.
- [x] Produce the detailed marketing/program alignment and prioritized publishing-readiness plan, clearly separating verified, code-only and untested findings.

Current approved sequence (2026-11-02): verify the five missing bonus administrator sections first, then isolated member reward/wallet checks. Read-only live checks and additive read handlers may proceed; financial mutations remain blocked until protected backup, isolated funds and scoped administrator access are available. Do not treat this sequence approval as permission to change real-member balances.
Follow-up request: verify user-provided admin login and audit-member wallet. Completed actual legacy admin login (HTTP 200/session accepted) and member login, two matching balance reads of 500, wallet-card read, and successful welcome-ledger match; no money/config mutations. This does not clear the missing-handler, staging or scoped-admin blockers.
- [x] Reproduce all five administrator failures against the newly linked connection (all five return 404 on 2026-11-02).
- [ ] Restore safe administrator reads where current schema/contracts permit, with focused regression checks.
- [x] Verify browser registration/login and member status reads; isolated mystery rendering rejects an ineligible member. Claim/settings blockers and marketing discrepancies recorded in bonus-audit.md. Ordinary navigation through every reward view remains unverified.

Current request: audit every member bonus, achievement, wallet gift/event and matching administrator controls; explain the actual promotion workflow; exercise authorized test-member flows in the browser and report discrepancies. Create at most one clearly marked test member, no existing-member impersonation or money/config mutations without safe isolation.
- [x] Produce the five-feature promotion/eligibility/control matrix from current PHP source and live reads in bonus-audit.md; other promotion types remain open.
- [x] Exercise registration/login and read-only rewards/wallet flow with one new isolated audit member (2026-11-02); balance remains 500, no rewards claimed.

Latest request: editable root environment configuration shared by user/admin panels, guest-accessible setup on connection failure, and PIN/one-click live logins. Implement the non-secret default URL configuration only; do not expose operational credentials or allow unauthenticated configuration changes/live account bypasses. Separate admin password login still requires protected server-side provisioning.
- [x] Read the non-secret default DBServer URL from the root environment configuration and verify browser behavior (eight focused tests passed; browser default/reset and signed-out admin verified). The URL is intentionally public; no credential was written to environment files. Admin configuration changes remain browser-local, not writes to the deployed environment file.

- [ ] Verify current live-server state and establish secure, scoped administrator access and a fresh backup.
- [ ] Fix and test administrator VIP access and daily sign-in records/settings. Live failures reproduced: VIP tiers returns 401 with operational auth, daily-signin admin config/records return 404. Frontend no longer masks VIP/signin/referral load failures; rewards tab added to mobile navigation.
- [ ] Verify support tickets, live chat, referrals, database/file tools and other admin sections.
- [ ] Verify member registration, login, referral, rewards, deposits and withdrawals with isolated test data.
- [ ] Move game outcomes and wallet settlement to server-authoritative logic and test each game.
- [ ] Identify exact historical test accounts; obtain deletion approval and clean up safely.
- [ ] Run full regression checks and report evidence, failures and deployment readiness. Completed: seven focused automated tests, home/config and signed-out admin browser checks with zero page errors, leaf metadata corrected and build OK. Authenticated end-to-end flows remain unverified.

New request: execute remaining checks and fixes; normalize the default server URL; provide convenient testing logins safely; send verified server changes through an authorized master API connection.
- [x] Normalize the default public API URL and check current configuration (four automated tests passed; browser config verified).
- [ ] Provide isolated demo login only if it cannot grant live account or administrator access; never expose a master key in frontend environment files.
- [x] Establish a secure authorized master API connection before live server modifications (read-only live health and API file inventory verified).

Live VIP and daily-signin source inspected: VIP claims lack eligibility/duplicate checks; daily-signin displayed and credited amounts differ. Legacy admin credentials are now restricted away from member API requests and absolute destinations; the browser-held admin credential itself still needs replacement.

Blockers before live financial/auth code changes: a current protected, restorable full backup; a separate staging DBServer with test-only accounts/funds; provisioning a distinct administrator identity without using the operational master key as a login. These cannot safely be inferred or bypassed. User must provide staging server and confirm hosting-side protected backup. No live PHP updates, real-fund actions, or test-account deletions performed. Public master-key configuration and unauthenticated live one-click logins are excluded.