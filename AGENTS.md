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
- Keep credential forwarding decisions in requestPolicy and test member/admin boundaries; legacy browser admin access is transitional and must not be expanded into demo bypasses or unrestricted proxies.
