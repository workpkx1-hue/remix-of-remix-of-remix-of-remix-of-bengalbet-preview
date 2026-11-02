# Remaining work

- [ ] Verify current live-server state and establish secure, scoped administrator access and a fresh backup.
- [ ] Fix and test administrator VIP access and daily sign-in records/settings.
- [ ] Verify support tickets, live chat, referrals, database/file tools and other admin sections.
- [ ] Verify member registration, login, referral, rewards, deposits and withdrawals with isolated test data.
- [ ] Move game outcomes and wallet settlement to server-authoritative logic and test each game.
- [ ] Identify exact historical test accounts; obtain deletion approval and clean up safely.
- [ ] Run regression checks and report evidence, failures and deployment readiness.

New request: execute remaining checks and fixes; normalize the default server URL; provide convenient testing logins safely; send verified server changes through an authorized master API connection.
- [ ] Normalize the default public API URL and check current configuration.
- [ ] Provide isolated demo login only if it cannot grant live account or administrator access; never expose a master key in frontend environment files.
- [ ] Establish a secure authorized master API connection before live server modifications.

Live changes require secure server access. Public master-key configuration and unauthenticated live one-click logins are excluded.