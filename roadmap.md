# Remaining work

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