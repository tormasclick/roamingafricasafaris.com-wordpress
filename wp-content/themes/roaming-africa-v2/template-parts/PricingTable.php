interface TierRow {
  1: number;
  2: number;
  4: number;
  6: number;
}

export interface PriceTable {
  lowSeason: { comfort: TierRow; luxury: TierRow };
  highSeason: { comfort: TierRow; luxury: TierRow };
}

/**
 * Derive a 2-tier × 4-group × 2-season pricing table from a single
 * "from" price (interpreted as low-season Comfort 1-person).
 *
 * Group discounts: 1p ×1.00, 2p ×0.85, 4p ×0.75, 6+p ×0.65
 * Tier multipliers: Comfort ×1.00, Luxury ×1.60
 * Season multiplier: High Season = Low × 1.20
 */
export const deriveTable = (priceFrom: number): PriceTable => {
  const groupMul: TierRow = { 1: 1, 2: 0.85, 4: 0.75, 6: 0.65 };
  const row = (base: number): TierRow => ({
    1: Math.round((base * groupMul[1]) / 10) * 10,
    2: Math.round((base * groupMul[2]) / 10) * 10,
    4: Math.round((base * groupMul[4]) / 10) * 10,
    6: Math.round((base * groupMul[6]) / 10) * 10,
  });
  return {
    lowSeason: {
      comfort: row(priceFrom),
      luxury: row(priceFrom * 1.6),
    },
    highSeason: {
      comfort: row(priceFrom * 1.2),
      luxury: row(priceFrom * 1.6 * 1.2),
    },
  };
};

const fmt = (n: number) => `$${n.toLocaleString()}*`;

const SeasonTable = ({
  label,
  months,
  rows,
}: {
  label: string;
  months: string;
  rows: PriceTable["lowSeason"];
}) => {
  const tiers = [
    { key: "comfort" as const, label: "Adventure", color: "text-[#b85a1a]" },
    { key: "luxury" as const, label: "Comfort", color: "text-[rgb(41,135,66)]" },
  ];
  const people: Array<{ key: keyof TierRow; label: string }> = [
    { key: 1, label: "1 Person" },
    { key: 2, label: "2 People" },
    { key: 4, label: "4 People" },
    { key: 6, label: "6+ People" },
  ];

  return (
    <div className="rounded-xl overflow-hidden border-2 border-[rgb(41,135,66)]/30 bg-card shadow-sm">
      <div className="bg-gradient-to-r from-[rgb(41,135,66)] to-[rgb(52,156,80)] text-white px-4 py-3">
        <h3 className="text-base font-heading font-bold uppercase tracking-wide">
          {label}
        </h3>
        <p className="text-xs opacity-90 mt-0.5">{months}</p>
      </div>

      {/* Unified horizontal table — works on mobile and desktop */}
      <div className="overflow-x-auto bg-[#f5f1e8]">
        <table className="w-full text-sm">
          <thead>
            <tr className="bg-[rgb(58,75,42)] text-white">
              <th className="text-center font-heading font-bold uppercase text-[11px] sm:text-xs px-2 sm:px-3 py-2.5 tracking-wide w-[28%]">
                Level
              </th>
              {tiers.map((t) => (
                <th
                  key={t.key}
                  className={`text-center font-heading font-bold uppercase text-[11px] sm:text-xs px-2 sm:px-3 py-2.5 tracking-wide bg-[#f5f1e8] ${t.color}`}
                >
                  {t.label}
                </th>
              ))}
            </tr>
          </thead>
          <tbody>
            {people.map((p) => (
              <tr key={p.key} className="border-t border-[rgb(41,135,66)]/15">
                <td className="bg-[rgb(58,75,42)] text-white text-center font-heading font-bold uppercase text-[11px] sm:text-xs px-2 sm:px-3 py-3 tracking-wide">
                  {p.label}
                </td>
                {tiers.map((t) => (
                  <td
                    key={t.key}
                    className={`text-center font-heading font-semibold text-[12px] sm:text-sm px-2 sm:px-3 py-3 whitespace-nowrap ${t.color}`}
                  >
                    {fmt(rows[t.key][p.key])} USD
                  </td>
                ))}
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
};


interface Props {
  table?: PriceTable;
  priceFrom?: number;
  title?: string;
  subtitle?: string;
}

const PricingTable = ({
  table,
  priceFrom,
  title = "Tour Pricing",
  subtitle = "Group discounts available. Prices include accommodation, meals, guide, and park fees.",
}: Props) => {
  const data = table || (priceFrom ? deriveTable(priceFrom) : null);
  if (!data) return null;

  return (
    <section className="space-y-5">
      <div>
        <h2 className="text-lg mb-1">{title}</h2>
        <p className="text-xs text-muted-foreground">{subtitle}</p>
      </div>

      <SeasonTable
        label="Low Season"
        months="April · May · November"
        rows={data.lowSeason}
      />
      <SeasonTable
        label="High Season"
        months="January · February · March · June · July · August · September · October · December"
        rows={data.highSeason}
      />

      <p className="text-xs italic text-muted-foreground">* Cost per person sharing. Prices in USD.</p>
    </section>
  );
};

export default PricingTable;
