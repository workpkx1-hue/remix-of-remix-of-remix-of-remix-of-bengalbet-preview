import { createFileRoute, ClientOnly } from "@tanstack/react-router";
import { lazy, Suspense } from "react";
import "../bengalbet/index.css";

const BengalBetApp = lazy(async () => {
  const [{ default: App }, { FavoritesProvider }] = await Promise.all([
    import("../bengalbet/App"),
    import("../bengalbet/hooks/useFavorites"),
  ]);
  return {
    default: () => (
      <FavoritesProvider>
        <App />
      </FavoritesProvider>
    ),
  };
});

export const Route = createFileRoute("/")({
  head: () => ({
    meta: [
      { title: "BengalBet - Online Gaming Portal" },
      { name: "description", content: "BengalBet games lobby, promotions, lucky spin and VIP rewards." },
      { property: "og:title", content: "BengalBet - Online Gaming Portal" },
      { property: "og:description", content: "BengalBet games lobby, promotions, lucky spin and VIP rewards." },
      { property: "og:type", content: "website" },
      { name: "twitter:card", content: "summary_large_image" },
    ],
    links: [
      {
        rel: "stylesheet",
        href: "https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&family=Teko:wght@500;600;700&display=swap",
      },
    ],
  }),
  component: Index,
});

function Index() {
  return (
    <ClientOnly fallback={<div className="min-h-screen" />}>
      <Suspense fallback={<div className="min-h-screen" />}>
        <BengalBetApp />
      </Suspense>
    </ClientOnly>
  );
}
