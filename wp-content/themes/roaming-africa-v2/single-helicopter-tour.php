import { Link, useParams } from "react-router-dom";
import Breadcrumbs from "@/components/Breadcrumbs";
import SEO from "@/components/SEO";
import PageHero from "@/components/PageHero";
import BookingFormTour from "@/components/BookingFormTour";
import { MapPin, Clock } from "lucide-react";
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/components/ui/accordion";

const u = (id: string, w = 1200) =>
  `https://images.unsplash.com/${id}?w=${w}&q=80&auto=format&fit=crop`;

// 4+ curated images per helicopter destination
const HELI_GALLERIES: Record<string, string[]> = {
  "mount-kenya-alpine-helicopter-tour": [
    u("photo-1518709268805-4e9042af2176"),
    u("photo-1464822759023-fed622ff2c3b"),
    u("photo-1486870591958-9b9d0d1dda99"),
    u("photo-1469474968028-56623f02e42e"),
  ],
  "lake-bogoria-helicopter-safari": [
    u("photo-1574068468668-a05a11f871da"),
    u("photo-1469594292607-7bd90f8d3ba4"),
    u("photo-1486870591958-9b9d0d1dda99"),
    u("photo-1551582045-6ec9c11d8697"),
  ],
  "mount-ololokwe-samburu-helicopter-safari": [
    u("photo-1530092285049-1c42085fd395"),
    u("photo-1551632436-cbf8dd35adfa"),
    u("photo-1486870591958-9b9d0d1dda99"),
    u("photo-1518709268805-4e9042af2176"),
  ],
  "lake-magadi-helicopter-safari": [
    u("photo-1469594292607-7bd90f8d3ba4"),
    u("photo-1547036967-23d11aacaee0"),
    u("photo-1486870591958-9b9d0d1dda99"),
    u("photo-1500382017468-9049fed747ef"),
  ],
  "lake-logipi-helicopter-safari": [
    u("photo-1469594292607-7bd90f8d3ba4"),
    u("photo-1500382017468-9049fed747ef"),
    u("photo-1486870591958-9b9d0d1dda99"),
    u("photo-1518709268805-4e9042af2176"),
  ],
  "ngorongoro-serengeti-3day-helicopter-safari": [
    u("photo-1534476478164-b15bfe571b17"),
    u("photo-1549366021-9f761d040a94"),
    u("photo-1486870591958-9b9d0d1dda99"),
    u("photo-1547036967-23d11aacaee0"),
  ],
  "lake-natron-helicopter-safari": [
    u("photo-1469594292607-7bd90f8d3ba4"),
    u("photo-1486870591958-9b9d0d1dda99"),
    u("photo-1518709268805-4e9042af2176"),
    u("photo-1500382017468-9049fed747ef"),
  ],
  "kilimanjaro-helicopter-safari": [
    u("photo-1464822759023-fed622ff2c3b"),
    u("photo-1503917988258-f87a78e3c995"),
    u("photo-1486870591958-9b9d0d1dda99"),
    u("photo-1518709268805-4e9042af2176"),
  ],
  "ngorongoro-crater-helicopter-safari": [
    u("photo-1534476478164-b15bfe571b17"),
    u("photo-1547971805-46e4f6c3e5e8"),
    u("photo-1486870591958-9b9d0d1dda99"),
    u("photo-1469474968028-56623f02e42e"),
  ],
  "nyerere-3day-helicopter-safari": [
    u("photo-1547036967-23d11aacaee0"),
    u("photo-1518709268805-4e9042af2176"),
    u("photo-1486870591958-9b9d0d1dda99"),
    u("photo-1500382017468-9049fed747ef"),
  ],
};

const FALLBACK_HELI_GALLERY = [
  u("photo-1486870591958-9b9d0d1dda99"),
  u("photo-1518709268805-4e9042af2176"),
  u("photo-1469474968028-56623f02e42e"),
  u("photo-1547036967-23d11aacaee0"),
];


interface ItineraryItem { title: string; description: string; }
interface HelicopterTour {
  slug: string;
  country: "kenya" | "tanzania";
  name: string;
  region: string;
  duration: string;
  priceFrom: number;
  priceLabel?: string;
  overview: string;
  flightExperience: string;
  highlights: string[];
  itinerary?: ItineraryItem[];
  inclusions?: string[];
  exclusions?: string[];
  idealFor: string[];
  faqs: { question: string; answer: string }[];
}

const stdIncl = [
  "Private helicopter charter with experienced commercial pilot",
  "Fuel, landing fees and operator insurance",
  "Bottled water and refreshments on board",
  "Ground transfers to and from the helipad",
  "All applicable park and conservancy fees on landing",
  "Gourmet bush picnic or champagne breakfast (where indicated)",
];
const stdExcl = [
  "International flights and visas",
  "Travel and medical insurance",
  "Premium drinks and personal expenses",
  "Tips and gratuities for pilot and ground crew",
  "Pre and post-tour accommodation unless specified",
  "Optional add-on excursions",
];




const baseFaqs = (name: string, region: string) => [
  { question: `How long is the ${name}?`, answer: `Flight time varies by package — typically 1.5–4 hours of flying with landings, plus picnic or activity time on the ground. Full-day excursions run 6–8 hours door-to-door from your starting point.` },
  { question: `What helicopter is used?`, answer: `We charter modern Airbus AS350 B3 (Squirrel) and Bell 407 helicopters operated by Kenya's leading licensed charter companies. All aircraft are twin-pilot capable, fully insured, and maintained to international JAR-OPS standards.` },
  { question: `How many passengers can fly together?`, answer: `Up to 5 passengers per helicopter for comfortable seating and full window views. Larger groups are accommodated using multiple ships flying in formation.` },
  { question: `What is the best time of year for this tour?`, answer: `${region} offers good helicopter conditions year-round, with clearest skies during the dry seasons (June–October and January–February). Early-morning departures consistently deliver the best photography light and smoothest air.` },
  { question: `What is the cancellation policy for helicopter tours?`, answer: `Weather cancellations by the operator receive a full refund or reschedule. Client cancellations follow our standard policy — see our Terms & Conditions page.` },
  { question: `Can the tour be combined with other safaris?`, answer: `Yes. We routinely build helicopter days into longer Kenya, Tanzania and combo safari itineraries, including transfers to remote lodges and aerial sightseeing en route.` },
];

const tours: HelicopterTour[] = [
  {
    slug: "mount-kenya-alpine-helicopter-tour",
    country: "kenya",
    name: "Mount Kenya Alpine Helicopter Tour",
    region: "Mount Kenya, Central Highlands",
    duration: "6 Hours",
    priceFrom: 15800,
    overview:
      "A 6-hour alpine helicopter expedition to Africa's second-highest peak. Soar above glaciers, alpine lakes and jagged spires, with optional landings on the moorlands for a high-altitude champagne breakfast.",
    flightExperience:
      "Lift off from Nairobi Wilson Airport in a luxury Airbus AS350, cross the equator and climb steeply over Mount Kenya's western flanks. Circle Batian and Nelion peaks, bank low over Lewis Glacier, then descend to Mackinder's Valley for a champagne breakfast surrounded by giant lobelia and senecio.",
    highlights: [
      "Aerial views of Batian and Nelion peaks",
      "Flight over the equator",
      "Optional landing at Mackinder's Valley",
      "Glacier and alpine lake views",
      "Champagne breakfast at a private high-altitude site",
    ],
    itinerary: [
      { title: "Wilson Airport Departure", description: "Morning briefing and safety walk-around at Nairobi's Wilson Airport, followed by lift-off in a luxury Airbus AS350 helicopter heading north toward the equator." },
      { title: "Equator Crossing & Mt Kenya Approach", description: "Climb steadily over the central highlands, crossing the equator before approaching the western flanks of Mount Kenya for jaw-dropping aerial photography." },
      { title: "Summit Circuit — Batian, Nelion & Lewis Glacier", description: "Circle the jagged twin peaks of Batian and Nelion, bank low over Lewis Glacier and trace the dramatic ridgelines of Africa's second-highest mountain." },
      { title: "Mackinder's Valley Landing & Champagne Breakfast", description: "Touch down on the alpine moorland of Mackinder's Valley for a private champagne breakfast among giant lobelias and senecio at over 4,200 m." },
      { title: "Return to Nairobi", description: "Lift off for the scenic return flight via Mount Kenya's southern slopes, landing back at Wilson Airport by early afternoon." },
    ],
    inclusions: stdIncl,
    exclusions: stdExcl,
    idealFor: ["Honeymoon couples", "VIPs and incentive groups", "Photography enthusiasts", "Time-poor luxury travellers"],
    faqs: baseFaqs("Mount Kenya Alpine Helicopter Tour", "Mount Kenya"),
  },
  {
    slug: "lake-bogoria-helicopter-safari",
    country: "kenya",
    name: "Lake Bogoria Helicopter Safari",
    region: "Lake Bogoria, Great Rift Valley",
    duration: "4 Hours",
    priceFrom: 12000,
    overview:
      "A 4-hour aerial safari over the Rift Valley escarpment to Lake Bogoria, home to millions of flamingos and bubbling hot springs. Land lakeside for a geothermal walk and gourmet picnic.",
    flightExperience:
      "A 50-minute flight from Nairobi crosses the dramatic Rift Valley escarpment before descending into the soda-flat basin of Lake Bogoria. Land within metres of bubbling geysers, walk among the geothermal vents with a KWS ranger, and enjoy a gourmet picnic on the shore.",
    highlights: [
      "Aerial views of flamingo flocks turning the lake pink",
      "Geysers and hot springs landing",
      "Rift Valley escarpment flight",
      "Optional add-on to Lake Baringo",
    ],
    itinerary: [
      { title: "Wilson Airport Departure", description: "Morning safety briefing and departure from Wilson Airport, Nairobi, in a luxury twin-engine helicopter." },
      { title: "Rift Valley Escarpment Flight", description: "Climb over the Aberdares foothills and bank along the dramatic Rift Valley escarpment with sweeping views of Lakes Naivasha and Elementaita en route." },
      { title: "Lake Bogoria Descent & Flamingo Flyover", description: "Descend low over Lake Bogoria's soda flats for spectacular aerial views of greater and lesser flamingo flocks turning the lake pink." },
      { title: "Geyser Landing & Guided Walk", description: "Land lakeside near the bubbling geysers and hot springs for a KWS ranger-guided geothermal walk among the steam vents." },
      { title: "Lakeside Gourmet Picnic", description: "Enjoy a private gourmet picnic with champagne on the shore, surrounded by flamingos and dramatic Rift Valley scenery." },
      { title: "Return to Nairobi", description: "Lift off for the scenic return flight back to Wilson Airport, landing in the early afternoon." },
    ],
    inclusions: stdIncl,
    exclusions: stdExcl,
    idealFor: ["Birding enthusiasts", "Luxury day-trippers from Nairobi", "Honeymoon couples"],
    faqs: baseFaqs("Lake Bogoria Helicopter Safari", "the Great Rift Valley"),
  },
  {
    slug: "mount-ololokwe-samburu-helicopter-safari",
    country: "kenya",
    name: "Mount Ololokwe Samburu Helicopter Safari",
    region: "Samburu and Shaba, Northern Kenya",
    duration: "3 Hours",
    priceFrom: 9000,
    overview:
      "A 3-hour aerial adventure to the sacred flat-topped massif of Mount Ololokwe in Samburu country. Land on the summit plateau for sundowners with 360° views over Samburu and Shaba.",
    flightExperience:
      "Fly north from Samburu lodges over the palm-fringed Ewaso Nyiro river country to the sacred mesa of Ololokwe. Touch down on the flat summit plateau at 1,800 m for sundowner cocktails as the sun sets over the Mathews Range.",
    highlights: [
      "Summit landing on Ololokwe's flat plateau",
      "Sundowner cocktails with panoramic views",
      "Samburu cultural welcome",
      "Optional combination with a Samburu game drive",
    ],
    itinerary: [
      { title: "Samburu Helipad Departure", description: "Afternoon briefing and lift-off from your Samburu lodge airstrip, climbing north over the palm-fringed Ewaso Nyiro river." },
      { title: "Ewaso Nyiro Aerial Flight", description: "Trace the winding river course with aerial spotting of elephant, reticulated giraffe and Grevy's zebra in the bush below." },
      { title: "Ololokwe Summit Landing", description: "Touch down on the flat summit plateau of Mount Ololokwe at 1,800 m — a sacred Samburu site rarely accessible by any other means." },
      { title: "Samburu Cultural Welcome & Sundowners", description: "Enjoy a Samburu warriors' welcome on arrival, followed by sundowner cocktails and canapés as the sun sets over the Mathews Range and Matthews Forest." },
      { title: "Return Night Flight", description: "Return flight back to your lodge under the soft glow of dusk, landing in time for dinner at camp." },
    ],
    inclusions: stdIncl,
    exclusions: stdExcl,
    idealFor: ["Adventure luxury travellers", "Special occasions and proposals", "Incentive groups"],
    faqs: baseFaqs("Mount Ololokwe Samburu Helicopter Safari", "Samburu and Shaba"),
  },
  {
    slug: "lake-magadi-helicopter-safari",
    country: "kenya",
    name: "Lake Magadi Helicopter Safari from Nairobi",
    region: "Lake Magadi, South of Nairobi",
    duration: "3 Hours",
    priceFrom: 9000,
    overview:
      "A 3-hour dramatic flight from Nairobi over the Rift Valley to the soda flats of Lake Magadi. Land for a hot spring soak and gourmet brunch on the salt pans.",
    flightExperience:
      "Lift off from Wilson Airport, cross Nairobi National Park at low level for game-spotting from the air, then drop down the Rift Valley wall to land on the pink-and-white soda pans of Lake Magadi.",
    highlights: [
      "Aerial views over the soda lake's pink and white pans",
      "Hot spring landing and soak",
      "Gourmet picnic on the salt flats",
      "Nairobi National Park flyover en route",
    ],
    itinerary: [
      { title: "Wilson Airport Departure", description: "Morning briefing and departure from Nairobi's Wilson Airport on a private helicopter charter." },
      { title: "Nairobi National Park Flyover", description: "Low-level flight over Nairobi National Park with aerial spotting of rhino, lion, buffalo and giraffe against the city skyline." },
      { title: "Rift Valley Descent", description: "Drop down the southern Rift Valley wall with sweeping views of the Ngong Hills and Maasai steppe en route to Lake Magadi." },
      { title: "Lake Magadi Soda Pans Landing", description: "Touch down on the pink-and-white soda pans of Lake Magadi for a guided walk among the alkaline crystals and flamingo colonies." },
      { title: "Hot Spring Soak & Gourmet Brunch", description: "Soak in the natural thermal springs at the lake edge, followed by a private gourmet brunch served on the salt flats." },
      { title: "Return to Nairobi", description: "Scenic return flight to Wilson Airport, landing in the early afternoon." },
    ],
    inclusions: stdIncl,
    exclusions: stdExcl,
    idealFor: ["Day-trippers from Nairobi", "Photographers", "Romantic getaways"],
    faqs: baseFaqs("Lake Magadi Helicopter Safari", "the southern Rift Valley"),
  },
  {
    slug: "lake-logipi-helicopter-safari",
    country: "kenya",
    name: "Lake Logipi Helicopter Safari",
    region: "Lake Logipi, Suguta Valley",
    duration: "5 Hours",
    priceFrom: 14000,
    overview:
      "A 5-hour expedition to one of Kenya's most remote and otherworldly destinations — Lake Logipi, a shallow alkaline lake in the Suguta Valley fringed by black lava flows and the ancient Cathedral Rock.",
    flightExperience:
      "Fly north from Nairobi or Loisaba over the Laikipia Plateau and the deep folds of the Suguta Valley — one of the lowest, hottest places on Earth. Descend over the lava fields surrounding Lake Logipi and land near Cathedral Rock for a private lunch on the shore among flamingo colonies.",
    highlights: [
      "Aerial views of Suguta Valley lava fields",
      "Cathedral Rock landing",
      "Flamingo colonies on Lake Logipi",
      "One of Kenya's most remote wilderness experiences",
    ],
    itinerary: [
      { title: "Northern Departure", description: "Morning lift-off from Loisaba or Nairobi Wilson Airport, climbing north over the vast Laikipia Plateau." },
      { title: "Laikipia & Mathews Range Flight", description: "Trace the Mathews Range and Ndoto mountains with aerial views of elephant herds and rugged wilderness rarely seen by visitors." },
      { title: "Suguta Valley Descent", description: "Drop into the dramatic Suguta Valley — one of the lowest, hottest places on Earth — circling over black lava flows and ancient volcanic cones." },
      { title: "Cathedral Rock Landing", description: "Land near the iconic Cathedral Rock on the shore of Lake Logipi, surrounded by flamingo colonies and otherworldly volcanic landscapes." },
      { title: "Private Lakeside Lunch", description: "Enjoy a private gourmet lunch with champagne on the lake shore, with optional photography walks to the lava field edge." },
      { title: "Return Flight", description: "Lift off for the scenic return flight via the Suguta volcanic field and Laikipia Plateau, landing back at base by late afternoon." },
    ],
    inclusions: stdIncl,
    exclusions: stdExcl,
    idealFor: ["Expedition luxury travellers", "Photographers", "Geology enthusiasts"],
    faqs: baseFaqs("Lake Logipi Helicopter Safari", "the Suguta Valley"),
  },
  {
    slug: "ngorongoro-serengeti-3day-helicopter-safari",
    country: "tanzania",
    name: "3 Days Ngorongoro & Serengeti Helicopter Safari",
    region: "Ngorongoro Crater, Serengeti Park",
    duration: "3 Days",
    priceFrom: 0,
    priceLabel: "Enquire for Pricing",
    overview:
      "A helicopter safari over the Ngorongoro Crater and Serengeti is an unforgettable experience that offers unparalleled views and insights into these remarkable natural wonders, with a fantastic opportunity for aerial photography.",
    flightExperience:
      "Three days of fly-camping luxury combining helicopter transfers and aerial game viewing between Ngorongoro and the Serengeti. Hover over the crater rim, descend into the caldera for a game drive, then transfer north to the Serengeti for Migration tracking from the air with private bush picnics.",
    highlights: [
      "Aerial views of Ngorongoro Crater",
      "Serengeti Migration tracking from the air",
      "Private bush breakfasts and sundowners",
      "Luxury tented camp accommodation",
    ],
    itinerary: [
      { title: "Day 1 — Arusha → Ngorongoro Crater (Helicopter Transfer & Aerial Crater Circuit)", description: "Morning safety briefing at Arusha Airport before lifting off in a private helicopter for the scenic flight to the Ngorongoro Highlands. Climb over coffee estates and ancient volcanic cones before tracing the perfect 20 km rim of the caldera, with sweeping aerial views of Lake Magadi and Big Five spotting from the air. Land on the rim for a gourmet champagne brunch, then descend by 4x4 for an afternoon crater-floor game drive. Meals: brunch, dinner. Overnight: luxury crater-rim lodge." },
      { title: "Day 2 — Ngorongoro → Central Serengeti (Helicopter Flight & Migration Tracking)", description: "Sunrise breakfast on the crater rim, followed by a private helicopter transfer northwest into the Serengeti — flying low over Olduvai Gorge, the Gol Mountains and the open plains in search of the Great Migration herds. Land at your luxury tented camp for lunch and a full afternoon game drive in the heart of the Serengeti. Meals: full board. Overnight: luxury tented camp, central Serengeti." },
      { title: "Day 3 — Serengeti Aerial Game Viewing & Return Flight", description: "Early-morning helicopter scenic flight over the Migration river crossings and predator country, with optional landings for a private bush breakfast in the middle of the plains. Late-morning return flight via the western Serengeti corridor back to Arusha. Meals: breakfast, bush picnic." },
    ],
    inclusions: [
      "Private helicopter charter with experienced commercial pilot",
      "All inter-camp helicopter transfers and aerial game viewing",
      "2 nights luxury accommodation on full board",
      "Crater-floor 4x4 game drive with professional guide",
      "Park, conservancy and concession fees",
      "Private bush meals and sundowners",
      "Bottled water and refreshments throughout",
    ],
    exclusions: stdExcl,
    idealFor: ["Luxury honeymooners", "Photographers", "Incentive groups"],
    faqs: baseFaqs("3 Days Ngorongoro & Serengeti Helicopter Safari", "northern Tanzania"),
  },
  {
    slug: "lake-natron-helicopter-safari",
    country: "tanzania",
    name: "Lake Natron Helicopter Safari",
    region: "Day Trip Tanzania, Lake Natron",
    duration: "Full-day excursion",
    priceFrom: 11700,
    overview:
      "Our Lake Natron helicopter safari takes you low to the hot valley floor, where the ever-changing colors of the lake — reds, purples and oranges — paint a vibrant picture, a result of its algae-rich waters that draw flocks of flamingos. The route winds through the Great Rift Valley toward one of Tanzania's most spectacular natural phenomena, the red volcanic waters of Lake Natron, stopping for lunch and refreshments along the way.",
    flightExperience:
      "Depart Arusha and fly north over the Rift Valley wall. Bank around the perfect volcanic cone of Ol Doinyo Lengai before descending to the crimson shoreline of Natron. Land for a Maasai-guided walk to the Engare Sero waterfalls and ancient hominid footprints.",
    highlights: [
      "Aerial views of Ol Doinyo Lengai active volcano",
      "Crimson soda flats and flamingo breeding grounds",
      "Waterfall walk landing",
      "Maasai cultural visit",
    ],
    itinerary: [
      { title: "Arusha Departure & Safety Briefing", description: "Morning safety briefing and walk-around at Arusha Airport before lifting off in a private Airbus AS350 helicopter for the scenic flight north over the Rift Valley wall." },
      { title: "Ol Doinyo Lengai Volcano Flyover", description: "Bank around the perfect volcanic cone of Ol Doinyo Lengai — the 'Mountain of God' — at near-summit altitude, with breathtaking aerial views of the active crater." },
      { title: "Lake Natron Descent & Crimson Shoreline", description: "Descend low over the crimson soda flats of Lake Natron, with aerial spotting of flamingo breeding colonies turning the water pink against the volcanic black sands." },
      { title: "Engare Sero Landing & Maasai Welcome", description: "Land near a Maasai village on the southern shore for a traditional warriors' welcome, followed by a guided walk to the Engare Sero waterfalls and ancient hominid footprints. Meal: gourmet bush lunch on the shore." },
      { title: "Return Flight via the Rift Valley", description: "Lift off for the scenic return flight south, tracing the Rift Valley escarpment back to Arusha and landing in the late afternoon." },
    ],
    inclusions: stdIncl,
    exclusions: stdExcl,
    idealFor: ["Photographers", "Geology and volcano enthusiasts", "Luxury Serengeti combos"],
    faqs: baseFaqs("Lake Natron Helicopter Safari", "northern Tanzania"),
  },
  {
    slug: "kilimanjaro-helicopter-safari",
    country: "tanzania",
    name: "Kilimanjaro Helicopter Safari",
    region: "Moshi, Northern Tanzania",
    duration: "Half-day excursion",
    priceFrom: 4500,
    overview:
      "The Kilimanjaro Helicopter Tour starts from Moshi Airport. Taking off, the pilot points the helicopter east, making a flight over the city. During your flight you will see all the climbing routes to Kilimanjaro while skirting the mountain range. You will also fly over Lake Chala — the largest tectonic lake in the Kilimanjaro area.",
    flightExperience:
      "From Moshi Airport, climb in a wide spiral up the western flanks of Kibo. Fly within metres of the summit glaciers and crater rim, bank over the jagged spires of Mawenzi, then descend via Lake Chala for an aerial finale.",
    highlights: [
      "Close-up views of Uhuru Peak and the summit glaciers",
      "Flight over Shira Plateau and Mawenzi",
      "Lake Chala tectonic lake flyover",
      "All climbing routes visible from the air",
    ],
    itinerary: [
      { title: "Moshi Airport Departure", description: "Morning safety briefing and lift-off from Moshi Airport in a private helicopter, with an eastward arc over the town of Moshi and the coffee plantations on Kilimanjaro's lower slopes." },
      { title: "Western Flank Climb", description: "Climb in a wide spiral up the western flanks of Kibo, with aerial views of the Machame, Lemosho and Shira climbing routes weaving up through the rainforest and moorland zones." },
      { title: "Summit Glaciers & Crater Rim", description: "Fly within metres of the summit glaciers and Uhuru Peak crater rim — Africa's highest point at 5,895 m — for once-in-a-lifetime aerial photography of the icefields." },
      { title: "Mawenzi & Shira Plateau", description: "Bank over the jagged spires of Mawenzi, then trace the broad Shira Plateau, where the original third volcanic cone collapsed millions of years ago." },
      { title: "Lake Chala Finale & Return", description: "Descend via Lake Chala — the largest tectonic lake in the Kilimanjaro region — for a low-level flyover before returning to Moshi Airport. Champagne refreshments on landing." },
    ],
    inclusions: stdIncl,
    exclusions: stdExcl,
    idealFor: ["Honeymoon couples", "Non-climbers wanting the Kilimanjaro experience", "VIP and incentive groups"],
    faqs: baseFaqs("Kilimanjaro Helicopter Safari", "northern Tanzania"),
  },
  {
    slug: "ngorongoro-crater-helicopter-safari",
    country: "tanzania",
    name: "Ngorongoro Crater Helicopter Safari",
    region: "Ngorongoro Crater",
    duration: "Half-day excursion",
    priceFrom: 9000,
    overview:
      "A helicopter safari over the Ngorongoro Crater is an unforgettable experience that offers unparalleled views and insights into this remarkable natural wonder, with a fantastic opportunity for aerial photography.",
    flightExperience:
      "Lift off from an Arusha or Karatu airstrip and climb over the Ngorongoro Highlands. Trace the perfect rim of the caldera before banking low into the crater for unparalleled aerial views of the Big Five on the crater floor.",
    highlights: [
      "Aerial views of the entire Ngorongoro caldera",
      "Crater rim flight at sunrise",
      "Big Five spotting from the air",
      "Highland forest and lake views",
    ],
    itinerary: [
      { title: "Arusha / Karatu Departure", description: "Early morning departure from Arusha or Karatu airstrip in a private helicopter for the short flight to the Ngorongoro Highlands." },
      { title: "Highland Climb", description: "Climb over the lush Ngorongoro Highlands forest with aerial views of coffee estates, Maasai villages and ancient volcanic cones." },
      { title: "Crater Rim Sunrise Circuit", description: "Trace the perfect 20 km-wide rim of the Ngorongoro caldera in the soft sunrise light — a once-in-a-lifetime aerial perspective." },
      { title: "Caldera Descent & Big Five Spotting", description: "Bank low into the crater floor for spectacular aerial spotting of the Big Five — lion, leopard, elephant, buffalo and the endangered black rhino." },
      { title: "Crater Floor Picnic", description: "Land on the crater rim for a gourmet champagne breakfast with sweeping views over Lake Magadi and the crater floor below." },
      { title: "Return Flight", description: "Scenic return via Lake Manyara, with aerial views of flamingo flocks before landing back at base mid-morning." },
    ],
    inclusions: stdIncl,
    exclusions: stdExcl,
    idealFor: ["Photographers", "Luxury day-trippers", "Honeymoon couples"],
    faqs: baseFaqs("Ngorongoro Crater Helicopter Safari", "the Ngorongoro Highlands"),
  },
  {
    slug: "nyerere-3day-helicopter-safari",
    country: "tanzania",
    name: "3 Days Helicopter Safari to Nyerere National Park",
    region: "Nyerere National Park, Southern Tanzania",
    duration: "3 Days",
    priceFrom: 13500,
    priceLabel: "From USD 13,500 per person",
    overview:
      "A three-day helicopter safari to Nyerere National Park — Africa's largest game reserve. Offers unparalleled aerial views, exclusive boat safaris on the Rufiji River, and game drives in one of Tanzania's wildest, least-visited wildernesses.",
    flightExperience:
      "Fly south from Dar es Salaam or Zanzibar over the Rufiji Delta and into the heart of Nyerere. Spend three days combining aerial wildlife tracking, Rufiji boat safaris, walking safaris and game drives, with luxury tented-camp accommodation by the river.",
    highlights: [
      "Aerial views of the Rufiji River and delta",
      "Wild dog and elephant tracking",
      "Boat safari on the Rufiji",
      "Remote luxury fly-camp accommodation",
    ],
    itinerary: [
      { title: "Day 1 — Dar es Salaam / Zanzibar → Nyerere", description: "Morning helicopter departure from Dar es Salaam or Zanzibar, flying south over the Rufiji Delta with aerial views of mangrove forests and remote bush wilderness. Land at your luxury riverside camp for lunch, followed by an afternoon Rufiji River boat safari to spot hippos, crocodiles and elephant on the banks." },
      { title: "Day 2 — Aerial Wildlife Tracking & Game Drive", description: "Sunrise helicopter scenic flight over the heart of Nyerere with aerial wildlife tracking — searching for the rare African wild dog, large elephant herds and lion prides. Afternoon game drive or guided walking safari with an armed ranger, followed by sundowners on the Rufiji." },
      { title: "Day 3 — Final Boat Safari & Return", description: "Morning boat safari along the Rufiji with private breakfast on the riverbank. Late morning helicopter departure for the scenic return flight via the delta back to Dar es Salaam or Zanzibar." },
    ],
    inclusions: [
      "Private helicopter charter with experienced commercial pilot",
      "Return flights from Dar es Salaam or Zanzibar to Nyerere camp",
      "2 nights luxury riverside tented-camp accommodation on full board",
      "All game drives, walking safaris and Rufiji boat safaris",
      "Park and conservancy fees",
      "Private bush meals and sundowners",
      "Bottled water and refreshments throughout",
    ],
    exclusions: stdExcl,
    idealFor: ["Expedition luxury travellers", "Photographers", "Repeat safari guests"],
    faqs: baseFaqs("3 Days Helicopter Safari to Nyerere National Park", "southern Tanzania"),
  },
];

const HelicopterTourDetail = () => {
  const { slug } = useParams<{ slug: string }>();
  const tour = tours.find((t) => t.slug === slug);

  if (!tour) {
    return (
      <div className="container mx-auto px-4 py-20 text-center">
        <h1>Helicopter tour not found</h1>
        <Link to="/kenya-safaris/helicopter" className="text-primary">Browse Helicopter Tours</Link>
      </div>
    );
  }

  const parentHref =
    tour.country === "kenya" ? "/kenya-safaris/helicopter" : "/tanzania-safaris/helicopter";
  const parentLabel =
    tour.country === "kenya" ? "Kenya Helicopter Tours" : "Tanzania Helicopter Tours";

  const related = tours.filter((t) => t.slug !== tour.slug && t.country === tour.country).slice(0, 3);

  const jsonLd = {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    mainEntity: tour.faqs.map((f) => ({
      "@type": "Question",
      name: f.question,
      acceptedAnswer: { "@type": "Answer", text: f.answer },
    })),
  };

  return (
    <>
      <SEO
        title={`${tour.name} | ${parentLabel}`}
        description={tour.overview.slice(0, 158)}
        canonical={`https://every-page-grabber.lovable.app/${tour.country}-helicopter-tours/${tour.slug}`}
        jsonLd={jsonLd}
      />

      <PageHero>
        <p className="text-primary-foreground/80 text-sm mb-1 flex items-center gap-3">
          <span className="flex items-center gap-1"><MapPin className="w-4 h-4" />{tour.region}</span>
          <span className="flex items-center gap-1"><Clock className="w-4 h-4" />{tour.duration}</span>
        </p>
        <h1 className="text-primary-foreground">{tour.name}</h1>
      </PageHero>

      <div className="container mx-auto px-4">
        <Breadcrumbs items={[{ label: parentLabel, href: parentHref }, { label: tour.name }]} />
      </div>

      <div className="container mx-auto px-4 py-10 grid lg:grid-cols-3 gap-10">
        <div className="lg:col-span-2 space-y-10">
          <section>
            <h2 className="mb-3">Overview</h2>
            <p className="text-muted-foreground text-sm leading-relaxed">{tour.overview}</p>
          </section>

          <section>
            <h2 className="mb-4">Gallery</h2>
            <div className="grid grid-cols-2 gap-3">
              {(HELI_GALLERIES[tour.slug] || FALLBACK_HELI_GALLERY).map((src, i) => (
                <div key={i} className="aspect-[4/3] overflow-hidden rounded-xl">
                  <img
                    src={src}
                    alt={`${tour.name} photo ${i + 1}`}
                    className="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                    loading="lazy"
                  />
                </div>
              ))}
            </div>
          </section>

          <section>
            <h2 className="mb-3">Flight Experience</h2>
            <p className="text-muted-foreground text-sm leading-relaxed">{tour.flightExperience}</p>
          </section>

          <section>
            <h2 className="mb-3">Highlights</h2>
            <ul className="space-y-2">
              {tour.highlights.map((h) => (
                <li key={h} className="flex items-start gap-2 text-sm bg-muted rounded-xl px-4 py-3">
                  <span className="w-2 h-2 rounded-full bg-primary mt-1.5 flex-shrink-0" />{h}
                </li>
              ))}
            </ul>
          </section>

          {tour.itinerary && tour.itinerary.length > 0 && (
            <section>
              <h2 className="mb-4">Detailed Itinerary</h2>
              <ol className="space-y-4">
                {tour.itinerary.map((leg, i) => (
                  <li key={i} className="bg-card border border-border rounded-xl p-4">
                    <div className="flex items-start gap-3">
                      <span className="flex-shrink-0 w-8 h-8 rounded-full bg-primary text-primary-foreground font-heading font-bold text-sm flex items-center justify-center">
                        {i + 1}
                      </span>
                      <div>
                        <h3 className="font-heading font-bold text-sm mb-1">{leg.title}</h3>
                        <p className="text-muted-foreground text-sm leading-relaxed">{leg.description}</p>
                      </div>
                    </div>
                  </li>
                ))}
              </ol>
            </section>
          )}

          {(tour.inclusions || tour.exclusions) && (
            <div className="grid md:grid-cols-2 gap-6">
              {tour.inclusions && (
                <section>
                  <h2 className="text-lg mb-3">Inclusions</h2>
                  <ul className="space-y-2">
                    {tour.inclusions.map((item) => (
                      <li key={item} className="flex items-start gap-2 text-sm">
                        <span className="text-primary mt-0.5">✓</span>{item}
                      </li>
                    ))}
                  </ul>
                </section>
              )}
              {tour.exclusions && (
                <section>
                  <h2 className="text-lg mb-3">Exclusions</h2>
                  <ul className="space-y-2">
                    {tour.exclusions.map((item) => (
                      <li key={item} className="flex items-start gap-2 text-sm">
                        <span className="text-destructive mt-0.5">✕</span>{item}
                      </li>
                    ))}
                  </ul>
                </section>
              )}
            </div>
          )}

          {/* Elegant premium pricing card */}
          <section>
            <h2 className="mb-3">Tour Pricing</h2>
            <div className="rounded-2xl border border-primary/30 bg-gradient-to-br from-primary/5 via-card to-accent/10 p-6 shadow-md">
              <p className="text-xs uppercase tracking-widest text-muted-foreground font-heading font-bold mb-2">
                Private Helicopter Charter
              </p>
              <p className="text-3xl md:text-4xl font-heading font-bold text-primary leading-tight">
                {tour.priceLabel || `From USD ${tour.priceFrom.toLocaleString()}`}
              </p>
              <p className="mt-3 text-sm text-muted-foreground leading-relaxed">
                Pricing covers the full private charter for up to 5 passengers (unless noted). Group rates per person available — request a tailored quote for your dates.
              </p>
            </div>
          </section>

          <section>
            <h2 className="mb-3">Ideal For</h2>
            <div className="flex flex-wrap gap-3">
              {tour.idealFor.map((u) => (
                <span key={u} className="bg-highlight/30 text-foreground px-4 py-2 rounded-full text-sm font-heading font-bold">{u}</span>
              ))}
            </div>
          </section>

          <section>
            <h2 className="mb-4">Frequently Asked Questions</h2>
            <Accordion type="single" collapsible className="w-full">
              {tour.faqs.map((f, i) => (
                <AccordionItem key={i} value={`faq-${i}`}>
                  <AccordionTrigger className="text-left text-sm font-heading">{f.question}</AccordionTrigger>
                  <AccordionContent className="text-muted-foreground text-sm leading-relaxed">{f.answer}</AccordionContent>
                </AccordionItem>
              ))}
            </Accordion>
          </section>

          {related.length > 0 && (
            <section>
              <h2 className="mb-4">Related Experiences</h2>
              <div className="grid sm:grid-cols-3 gap-4 text-sm">
                {related.map((r) => {
                  const cover = (HELI_GALLERIES[r.slug] || FALLBACK_HELI_GALLERY)[0];
                  return (
                    <div
                      key={r.slug}
                      className="bg-card border border-border rounded-xl overflow-hidden flex flex-col hover:border-primary hover:shadow-md transition-all"
                    >
                      <div className="aspect-[4/3] overflow-hidden">
                        <img
                          src={cover}
                          alt={r.name}
                          loading="lazy"
                          className="w-full h-full object-cover hover:scale-105 transition-transform duration-500"
                        />
                      </div>
                      <div className="p-4 flex flex-col flex-1">
                        <h3 className="font-heading font-bold text-sm mb-1 leading-snug">{r.name}</h3>
                        <p className="text-xs text-muted-foreground line-clamp-3 mb-3">
                          {r.overview}
                        </p>
                        <Link
                          to={`/${r.country}-helicopter-tours/${r.slug}`}
                          className="mt-auto inline-flex items-center justify-center bg-primary text-primary-foreground rounded-full px-4 py-2 text-xs font-heading font-bold hover:bg-secondary transition-all"
                        >
                          View Details
                        </Link>
                      </div>
                    </div>
                  );
                })}
              </div>
            </section>
          )}
        </div>

        <aside>
          <div className="sticky top-24">
            <BookingFormTour
              subject={`Helicopter Tour Enquiry — ${tour.name}`}
              contextLine={`${tour.duration} • ${tour.region}`}
            />
          </div>
        </aside>
      </div>
    </>
  );
};

export default HelicopterTourDetail;
