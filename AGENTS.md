<!-- LOVABLE:BEGIN -->
> [!IMPORTANT]
> This project is connected to [Lovable](https://lovable.dev). Avoid rewriting
> published git history — force pushing, or rebasing/amending/squashing commits
> that are already pushed — as it rewrites history on Lovable's side and the
> user will likely lose their project history.
>
> Commits you push to the connected branch sync back to Lovable and show up in
> the editor, so keep the branch in a working state.
<!-- LOVABLE:END -->

- The imported BengalBet SPA lives in src/bengalbet (marked @ts-nocheck) and is rendered client-only by src/routes/index.tsx and the catch-all src/routes/$.tsx, because it does its own path-based view switching.
- Normalize public API origin and directory through the shared apiConfig module to prevent duplicated URL paths; operational credentials belong in the server-side connector, never frontend environment files.
- The root environment configuration may set the public default API URL; browser-local admin settings override that default, and reset restores it. Environment changes require a new deployment to affect the published app.
- Keep credential forwarding decisions in requestPolicy and test member/admin boundaries; legacy browser admin access is transitional and must not be expanded into demo bypasses or unrestricted proxies.
- Keep member mystery-claim eligibility in rewardEligibility and fail closed on missing server data; client checks prevent accidental claims but do not replace authoritative server validation.
- Keep notice editing in AdminSiteContent and confirm saves through settingsPersistence readback; a successful write response alone does not establish persisted member-visible settings.
- Derive all administrator navigation surfaces from one tab list to preserve access and consistent labels.

- Completed server reward settlements notify the parent through onSettledReward for read-only wallet refresh; never forward them to the generic reward-claim callback, which would credit twice.
- Keep external PHP reward-source mirrors under server/dbserver/api for review; they are not the TanStack app runtime and live uploads require authenticated connector operations.

- New-member task claims submit only the task day to the dedicated server handler; server task state owns eligibility/claim status and settled wallet refresh prevents generic duplicate credits.
- New-member task definitions are persisted in one server configuration consumed by status and claims; admin edits require validated twelve-day definitions and readback verification, and member labels derive from those same definitions.
- External payment status changes use a transactional pending-to-final guard with locked transaction/user rows; finalized states are immutable and repeated identical decisions cannot credit or refund twice.
- Client-generated game outcomes are simulation-only and cannot update shared cash balances or submit automatic cash settlements; trusted server rounds are required before enabling real-money game settlement.
