import { useParams, Link, Navigate } from "react-router-dom";
import SEO from "@/components/SEO";
import PageHero from "@/components/PageHero";
import Breadcrumbs from "@/components/Breadcrumbs";
import { hotels, HOTEL_REGIONS } from "@/data/hotels";
import { getHotelImage } from "@/data/images";

const HotelCountry = () => {
  const { country } = useParams<{ country: string }>();
  if (country !== "kenya" && country !== "tanzania") return <Navigate to="/hotels" replace />;
  const countryLabel = country === "kenya" ? "Kenya" : "Tanzania";
  const regions = HOTEL_REGIONS.filter((r) => r.country === country);

  return (
    <>
      <SEO
        title={`${countryLabel} Hotels & Safari Lodges | Browse by Region`}
        description={`Explore ${countryLabel} safari lodges, camps and city hotels by region. From Nairobi to Masai Mara, Serengeti to Zanzibar — curated accommodation by Roaming Africa Tours.`}
        canonical={`https://kenya-journey-weaver.lovable.app/hotels/${country}`}
      />
      <PageHero>
        <h1 className="text-primary-foreground">{countryLabel} Hotels & Safari Lodges</h1>
      </PageHero>
      <div className="container mx-auto px-4">
        <Breadcrumbs items={[{ label: "Hotels", href: "/hotels" }, { label: countryLabel }]} />
      </div>
      <div className="container mx-auto px-4 py-8">
        <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {regions.map((r) => {
            const count = hotels.filter((h) => h.region === r.region).length;
            return (
              <Link key={r.region} to={`/hotels/${country}/${r.region}`} className="group relative h-52 rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all">
                <img src={getHotelImage(r.region, r.region)} alt={r.label} className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" />
                <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent" />
                <div className="absolute inset-x-0 bottom-0 p-4 text-primary-foreground">
                  <h3 className="text-lg font-heading font-bold mb-1">{r.label}</h3>
                  <p className="text-xs opacity-90">{count} hotels &amp; lodges</p>
                </div>
              </Link>
            );
          })}
        </div>
      </div>
    </>
  );
};

export default HotelCountry;
