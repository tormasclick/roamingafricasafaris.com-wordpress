import { Bed } from "lucide-react";
import { getItineraryImage } from "@/data/images";

export interface ItineraryDay {
  day: number;
  title: string;
  description: string;
  accommodation?: { type: string; name: string } | null;
}

interface Props {
  itinerary: ItineraryDay[];
  fallbackSlug: string;
}

/**
 * Vertical day-by-day itinerary. Each day shows a hero image, full description,
 * and the overnight accommodation when provided.
 */
const ItineraryStrip = ({ itinerary, fallbackSlug }: Props) => {
  const items = itinerary.map((d, i) => ({
    ...d,
    image: getItineraryImage(`${d.title} ${d.description}`, fallbackSlug, i),
  }));

  return (
    <div>
      {items.map((d) => (
        <div
          key={d.day}
          className="mb-6 pb-6 border-b border-border last:border-0"
        >
          <div className="relative mb-4 rounded-xl overflow-hidden h-48 md:h-64">
            <img
              src={d.image}
              alt={`Day ${d.day}: ${d.title}`}
              loading="lazy"
              className="w-full h-full object-cover"
            />
            <span className="absolute top-3 left-3 bg-accent text-accent-foreground text-[11px] font-heading font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-md">
              Day {d.day}
            </span>
          </div>
          <h3 className="text-base md:text-lg font-heading font-semibold mb-1.5">
            Day {d.day}: {d.title}
          </h3>
          <p className="text-sm text-muted-foreground leading-relaxed">
            {d.description}
          </p>

          {d.accommodation && (
            <div className="mt-3 flex items-center gap-2 bg-muted/60 border border-border rounded-lg px-3 py-2">
              <Bed className="w-4 h-4 text-primary flex-shrink-0" />
              <span className="text-sm">
                <span className="font-heading font-semibold">Overnight:</span>{" "}
                <span className="text-muted-foreground">
                  {d.accommodation.type} · {d.accommodation.name}
                </span>
              </span>
            </div>
          )}
        </div>
      ))}
    </div>
  );
};

export default ItineraryStrip;
