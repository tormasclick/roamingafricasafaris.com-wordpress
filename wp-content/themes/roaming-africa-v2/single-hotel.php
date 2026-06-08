import { useParams, Link } from "react-router-dom";
import { getHotelBySlug, type Hotel } from "@/data/hotels";
import { getHotelGallery, getDestinationImage } from "@/data/images";
import { safariPackages } from "@/data/safariPackages";
import { MapPin } from "lucide-react";
import Breadcrumbs from "@/components/Breadcrumbs";
import SEO from "@/components/SEO";
import PageHero from "@/components/PageHero";
import BookingFormHotel from "@/components/BookingFormHotel";
import SafariCard from "@/components/SafariCard";
import {
  Accordion,
  AccordionContent,
  AccordionItem,
  AccordionTrigger,
} from "@/components/ui/accordion";

/* ------------------------------------------------------------------ */
/* Content generators — produce unique SEO content per hotel          */
/* ------------------------------------------------------------------ */

const regionContext: Record<string, { park: string; experience: string; nearby: string }> = {
  nairobi: {
    park: "Nairobi National Park",
    experience: "city sophistication paired with easy access to wildlife on the city's doorstep",
    nearby: "the Giraffe Centre, David Sheldrick Elephant Orphanage and Karen Blixen Museum",
  },
  "mombasa-diani": {
    park: "Shimba Hills National Reserve",
    experience: "white-sand beaches, warm Indian Ocean waters and Swahili coastal culture",
    nearby: "Wasini Island, Kisite Mpunguti Marine Park and Fort Jesus",
  },
  "masai-mara": {
    park: "the Masai Mara National Reserve",
    experience: "world-class big cat sightings and front-row access to the Great Wildebeest Migration",
    nearby: "Maasai villages, hot-air balloon launch sites and the Mara River crossings",
  },
  amboseli: {
    park: "Amboseli National Park",
    experience: "iconic herds of elephants framed by the snow-capped peaks of Mount Kilimanjaro",
    nearby: "Observation Hill, the Amboseli swamps and traditional Maasai cultural villages",
  },
  samburu: {
    park: "Samburu National Reserve",
    experience: "the rare 'Samburu Special Five' and dramatic semi-arid scenery along the Ewaso Ng'iro River",
    nearby: "Buffalo Springs, Shaba Reserve and authentic Samburu cultural visits",
  },
  "lake-nakuru": {
    park: "Lake Nakuru National Park",
    experience: "shimmering flamingo-fringed shores and one of Kenya's premier rhino sanctuaries",
    nearby: "Menengai Crater, Lake Bogoria hot springs and Hyrax Hill",
  },
  tsavo: {
    park: "Tsavo East & West National Parks",
    experience: "the largest protected wilderness in Kenya, famous for its red elephants and Mzima Springs",
    nearby: "Lugard Falls, Aruba Dam and the Shetani lava flows",
  },
  arusha: {
    park: "Arusha National Park",
    experience: "a calm gateway base for safaris to Tanzania's northern circuit and Kilimanjaro climbs",
    nearby: "Lake Duluti, Mount Meru trails and the Cultural Heritage Centre",
  },
  "dar-es-salaam": {
    park: "Saadani National Park",
    experience: "modern East African hospitality blended with vibrant harbour-front energy",
    nearby: "Bongoyo Island, the National Museum and the Kariakoo market",
  },
  serengeti: {
    park: "Serengeti National Park",
    experience: "endless savannah plains and the planet's greatest year-round wildlife spectacle",
    nearby: "Seronera Valley, the Grumeti and Mara River crossings and ancient kopjes",
  },
  ngorongoro: {
    park: "the Ngorongoro Crater",
    experience: "panoramic crater-rim views and an unrivalled concentration of Big Five wildlife",
    nearby: "Olduvai Gorge, Empakai Crater and Maasai bomas",
  },
  tarangire: {
    park: "Tarangire National Park",
    experience: "ancient baobab trees and Tanzania's most impressive elephant herds outside the migration season",
    nearby: "Lake Manyara, Tarangire Silale swamps and Maasai cultural sites",
  },
  zanzibar: {
    park: "Jozani Forest",
    experience: "powder-white beaches, turquoise reefs and the spice-scented heritage of Stone Town",
    nearby: "Stone Town, Prison Island, Mnemba Atoll snorkelling and spice farms",
  },
  ruaha: {
    park: "Ruaha National Park",
    experience: "remote, low-traffic safaris with exceptional big cat and elephant viewing",
    nearby: "the Great Ruaha River, Mwagusi sand river and baobab-dotted hills",
  },
};

const tierCopy: Record<string, string> = {
  budget: "comfortable, value-driven",
  "mid-range": "well-appointed and dependable",
  luxury: "premium, refined",
};

const buildOverview = (hotel: Hotel) => {
  const ctx = regionContext[hotel.region] || {
    park: hotel.location,
    experience: "memorable East African hospitality",
    nearby: "nearby attractions and conservation areas",
  };
  const tier = tierCopy[hotel.tier];

  const p1 =
    `${hotel.name} is a standout ${tier} property in ${hotel.location}, offering guests an authentic East African welcome and convenient access to ${ctx.park}. ` +
    `${hotel.shortDescription} The property combines thoughtful design, attentive service and a strong sense of place, making it a preferred choice for honeymooners, families and wildlife enthusiasts exploring ${hotel.country === "kenya" ? "Kenya" : "Tanzania"}.`;

  const p2 =
    `Guests at ${hotel.name} enjoy spacious accommodation, quality dining experiences inspired by local and international cuisine, and relaxing communal spaces with sweeping views over the surrounding landscape. ` +
    `The location delivers ${ctx.experience}, with easy day-trip access to ${ctx.nearby}. Whether you are arriving for a single-night stop-over or building a longer safari itinerary with Roaming Africa Tours & Safaris, ${hotel.name} provides the comfort, location and quiet character that make East African travel unforgettable.`;

  return [p1, p2];
};

const buildFAQs = (hotel: Hotel) => {
  const ctx = regionContext[hotel.region];
  const park = ctx?.park || hotel.location;
  const country = hotel.country === "kenya" ? "Kenya" : "Tanzania";
  return [
    {
      q: `Is ${hotel.name} suitable for families with children?`,
      a: `Yes. ${hotel.name} welcomes families and can arrange interconnecting or triple rooms on request. Our reservations team will tailor activities, meal plans and transfers to suit guests of all ages.`,
    },
    {
      q: `How far is ${hotel.name} from ${park}?`,
      a: `${hotel.name} is positioned for easy access to ${park}, with short transfer times to the main game-viewing areas. Exact distance varies by gate — our team will share precise driving times when you enquire.`,
    },
    {
      q: `What activities can guests enjoy nearby?`,
      a: `Guests typically combine their stay with game drives, guided nature walks and cultural visits. Popular nearby experiences include ${ctx?.nearby || "the area's signature attractions"}.`,
    },
    {
      q: `Does ${hotel.name} offer airport transfers?`,
      a: `Yes — we arrange private airport and inter-camp transfers from all major ${country} airports and airstrips. Transfers can be booked alongside your reservation.`,
    },
    {
      q: `What is the best time of year to stay at ${hotel.name}?`,
      a: `${hotel.name} is open year-round. The dry seasons (June–October and January–February) offer the most reliable wildlife viewing in this region, while the green seasons bring lush scenery, fewer crowds and excellent birdlife.`,
    },
    {
      q: `Can dietary requirements be accommodated?`,
      a: `Absolutely. The kitchen at ${hotel.name} can cater for vegetarian, vegan, gluten-free, halal and most allergy-related diets when notified at the time of booking.`,
    },
  ];
};

/* ------------------------------------------------------------------ */
/* Page                                                                */
/* ------------------------------------------------------------------ */

const HotelDetail = () => {
  const { slug } = useParams<{ slug: string }>();
  const hotel = getHotelBySlug(slug || "");

  if (!hotel) {
    return (
      <div className="container mx-auto px-4 py-20 text-center">
        <h1>Hotel not found</h1>
        <Link to="/hotels" className="text-primary">
          Browse Hotels
        </Link>
      </div>
    );
  }

  const countryLabel = hotel.country === "kenya" ? "Kenya" : "Tanzania";
  const overview = buildOverview(hotel);
  const faqs = buildFAQs(hotel);
  const gallery = getHotelGallery(hotel.region, hotel.id);

  const nearbySafaris = safariPackages
    .filter((p) =>
      p.destinations.some(
        (d) =>
          d.toLowerCase() === hotel.location.toLowerCase() ||
          d.toLowerCase() === hotel.region.toLowerCase() ||
          d.toLowerCase().includes(hotel.region.replace(/-/g, " "))
      )
    )
    .slice(0, 3);

  const heroImage = getDestinationImage(hotel.region);

  return (
    <>
      <SEO
        title={`${hotel.name} – ${hotel.location}, ${countryLabel} | Book Direct`}
        description={`Book ${hotel.name} in ${hotel.location}, ${countryLabel}. ${hotel.shortDescription} Best rates, easy reservations and nearby safari tours by Roaming Africa Tours & Safaris.`}
        canonical={`https://web-zip-morpher.lovable.app/hotel/${hotel.slug}`}
        jsonLd={{
          "@context": "https://schema.org",
          "@type": "LodgingBusiness",
          name: hotel.name,
          description: overview.join(" "),
          image: gallery,
          address: {
            "@type": "PostalAddress",
            addressLocality: hotel.location,
            addressCountry: countryLabel,
          },
        }}
      />

      <PageHero imageUrl={heroImage}>
        <p className="text-primary-foreground/80 text-sm mb-1 flex items-center gap-1">
          <MapPin className="w-4 h-4" />
          {hotel.location}, {countryLabel}
        </p>
        <h1 className="text-primary-foreground">{hotel.name}</h1>
      </PageHero>

      <div className="container mx-auto px-4">
        <Breadcrumbs
          items={[
            { label: "Hotels & Lodges", href: "/hotels" },
            { label: countryLabel, href: `/hotels/${hotel.country}` },
            { label: hotel.name },
          ]}
        />
      </div>

      <div className="container mx-auto px-4 py-10">
        <div className="grid lg:grid-cols-3 gap-10">
          <div className="lg:col-span-2 space-y-12">
            {/* Hotel Overview */}
            <section>
              <h2 className="mb-4">Hotel Overview</h2>
              <div className="space-y-4 text-muted-foreground leading-relaxed">
                {overview.map((p, i) => (
                  <p key={i}>{p}</p>
                ))}
              </div>
            </section>

            {/* Gallery */}
            <section>
              <h2 className="mb-4">Gallery</h2>
              <div className="grid grid-cols-2 gap-3">
                {gallery.map((src, i) => (
                  <div
                    key={i}
                    className="aspect-[4/3] rounded-xl overflow-hidden bg-muted"
                  >
                    <img
                      src={src}
                      alt={`${hotel.name} — ${["exterior", "guest room", "dining", "pool & grounds"][i]}`}
                      className="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                      loading="lazy"
                    />
                  </div>
                ))}
              </div>
            </section>

            {/* Nearby Safari Tours */}
            {nearbySafaris.length > 0 && (
              <section>
                <h2 className="mb-4">Nearby Safari Tours</h2>
                <p className="text-sm text-muted-foreground mb-5">
                  Combine your stay at {hotel.name} with one of our most popular
                  safari itineraries in {hotel.location}.
                </p>
                <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                  {nearbySafaris.map((s) => (
                    <SafariCard key={s.id} pkg={s} />
                  ))}
                </div>
              </section>
            )}

            {/* FAQ */}
            <section>
              <h2 className="mb-4">Frequently Asked Questions</h2>
              <Accordion type="single" collapsible className="w-full">
                {faqs.map((f, i) => (
                  <AccordionItem key={i} value={`item-${i}`}>
                    <AccordionTrigger className="text-left">
                      {f.q}
                    </AccordionTrigger>
                    <AccordionContent className="text-muted-foreground">
                      {f.a}
                    </AccordionContent>
                  </AccordionItem>
                ))}
              </Accordion>
            </section>
          </div>

          {/* Booking Form */}
          <aside>
            <div className="sticky top-24">
              <BookingFormHotel
                heading={`Book ${hotel.name}`}
                subject={`Reservation Request — ${hotel.name}`}
                contextLine={`${hotel.location}, ${countryLabel}`}
                ctaLabel="Make a Booking →"
              />
            </div>
          </aside>
        </div>
      </div>
    </>
  );
};

export default HotelDetail;
