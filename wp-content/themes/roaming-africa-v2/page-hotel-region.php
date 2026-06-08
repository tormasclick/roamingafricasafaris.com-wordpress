import { useParams, Link, Navigate } from "react-router-dom";
import { MapPin } from "lucide-react";
import SEO from "@/components/SEO";
import PageHero from "@/components/PageHero";
import Breadcrumbs from "@/components/Breadcrumbs";
import { hotels, HOTEL_REGIONS } from "@/data/hotels";
import { getHotelImage } from "@/data/images";

const tierLabel: Record<string, string> = { budget: "Budget", "mid-range": "Mid-Range", luxury: "Luxury" };
const tierColor: Record<string, string> = {
  budget: "bg-highlight text-foreground",
  "mid-range": "bg-secondary text-secondary-foreground",
  luxury: "bg-accent text-accent-foreground",
};

const HotelRegion = () => {
  const { country, region } = useParams<{ country: string; region: string }>();
  const meta = HOTEL_REGIONS.find((r) => r.region === region && r.country === country);
  if (!meta) return <Navigate to="/hotels" replace />;
  const list = hotels.filter((h) => h.region === region);
  const countryLabel = country === "kenya" ? "Kenya" : "Tanzania";

  return (
    <>
      <SEO
        title={`${meta.label} Hotels & Lodges | ${countryLabel} Safari Accommodation`}
        description={`Browse ${list.length} ${meta.label} hotels and lodges across ${countryLabel}. Budget, mid-range and luxury safari accommodation curated by Roaming Africa Tours.`}
        canonical={`https://kenya-journey-weaver.lovable.app/hotels/${country}/${region}`}
      />
      <PageHero>
        <div className="flex items-center gap-2 text-primary-foreground opacity-80 text-xs mb-2"><MapPin className="w-3.5 h-3.5" />{countryLabel}</div>
        <h1 className="text-primary-foreground">{meta.label} Hotels & Lodges</h1>
      </PageHero>
      <div className="container mx-auto px-4">
        <Breadcrumbs items={[
          { label: "Hotels", href: "/hotels" },
          { label: countryLabel, href: `/hotels/${country}` },
          { label: meta.label },
        ]} />
      </div>
      <div className="container mx-auto px-4 py-8">
        <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {list.map((hotel) => (
            <div key={hotel.id} className="group bg-card border border-border rounded-2xl overflow-hidden shadow-md hover:shadow-xl hover:-translate-y-1 transition-all flex flex-col">
              <Link to={`/hotel/${hotel.slug}`} className="relative h-44 overflow-hidden block">
                <img src={getHotelImage(hotel.region, hotel.id)} alt={hotel.name} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" />
                <span className={`absolute top-3 right-3 text-xs font-heading font-bold px-3 py-1 rounded-full ${tierColor[hotel.tier]}`}>
                  {tierLabel[hotel.tier]}
                </span>
              </Link>
              <div className="p-4 flex flex-col flex-1">
                <h3 className="text-base font-heading font-bold mb-1">
                  <Link to={`/hotel/${hotel.slug}`} className="hover:text-primary">{hotel.name}</Link>
                </h3>
                <p className="text-xs text-muted-foreground mb-2 flex items-center gap-1"><MapPin className="w-3 h-3" />{hotel.location}</p>
                <p className="text-sm text-muted-foreground line-clamp-2 mb-3 flex-1">{hotel.shortDescription}</p>
                {hotel.priceFrom && <p className="mb-3 text-sm font-heading font-bold text-primary">From {hotel.priceFrom} <span className="text-xs font-normal text-muted-foreground">/night</span></p>}
                <div className="flex items-center gap-2 mt-auto">
                  <Link to={`/hotel/${hotel.slug}`} className="flex-1 text-center text-sm font-heading font-bold text-primary">View Details</Link>
                  <Link to="/booking" className="flex-1 inline-flex items-center justify-center bg-accent text-accent-foreground text-sm font-heading font-bold px-4 py-2 rounded-full shadow-md">Make a Booking</Link>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </>
  );
};

export default HotelRegion;
