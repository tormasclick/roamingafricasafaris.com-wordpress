import { useState } from "react";
import { Link, useLocation } from "react-router-dom";
import { Menu, X, ChevronDown, Phone, Mail } from "lucide-react";
import { PHONE, EMAIL } from "@/data/constants";
import logo from "@/assets/logo.png";

interface SimpleChild { label: string; href: string; }
interface MegaColumn { title: string; items: SimpleChild[]; }
interface NavItem {
  label: string;
  href: string;
  children?: SimpleChild[];
  mega?: MegaColumn[];
  highlight?: boolean;
}

const navItems: NavItem[] = [
  { label: "Home", href: "/" },
  {
    label: "Kenya Safaris", href: "/kenya-safaris",
    children: [
      { label: "Kenya Safari Tours", href: "/kenya-safaris" },
      { label: "Day Trips", href: "/kenya-safaris/day-trips" },
      { label: "Flying Safaris", href: "/kenya-safaris/fly-in" },
      { label: "Helicopter Tours", href: "/kenya-safaris/helicopter" },
      { label: "Golf Safaris", href: "/kenya-safaris/golf" },
      { label: "Accessible Safaris", href: "/kenya-safaris/accessible" },
    ],
  },
  {
    label: "Tanzania Safaris", href: "/tanzania-safaris",
    children: [
      { label: "Tanzania Safari Tours", href: "/tanzania-safaris" },
      { label: "Flying Safaris", href: "/tanzania-safaris/fly-in" },
      { label: "Helicopter Tours", href: "/tanzania-safaris/helicopter" },
      { label: "Zanzibar Beach Holidays", href: "/tanzania-safaris/zanzibar" },
      { label: "Accessible Safaris", href: "/tanzania-safaris/accessible" },
    ],
  },
  { label: "Combo Safaris", href: "/combo-safaris" },
  {
    label: "Destinations", href: "/destinations",
    mega: [
      {
        title: "Kenya",
        items: [
          { label: "Maasai Mara", href: "/destination/masai-mara" },
          { label: "Amboseli", href: "/destination/amboseli" },
          { label: "Tsavo East", href: "/destination/tsavo-east" },
          { label: "Tsavo West", href: "/destination/tsavo-west" },
          { label: "Lake Nakuru", href: "/destination/lake-nakuru" },
          { label: "Lake Naivasha", href: "/destination/lake-naivasha" },
          { label: "Nairobi National Park", href: "/destination/nairobi-national-park" },
          { label: "Ol Pejeta Conservancy", href: "/destination/ol-pejeta-conservancy" },
          { label: "Watamu", href: "/destination/watamu" },
          { label: "Malindi", href: "/destination/malindi" },
          { label: "Diani", href: "/destination/diani" },
        ],
      },
      {
        title: "Tanzania",
        items: [
          { label: "Serengeti", href: "/destination/serengeti-national-park" },
          { label: "Ngorongoro Crater", href: "/destination/ngorongoro-crater" },
          { label: "Tarangire", href: "/destination/tarangire-national-park" },
          { label: "Lake Manyara", href: "/destination/lake-manyara" },
          { label: "Lake Natron", href: "/destination/lake-natron" },
          { label: "Mikumi National Park", href: "/destination/mikumi-national-park" },
          { label: "Grumeti Game Reserve", href: "/destination/grumeti-game-reserve" },
          { label: "Nyerere National Park", href: "/destination/nyerere-national-park" },
          { label: "Arusha", href: "/destination/arusha" },
          { label: "Zanzibar", href: "/destination/zanzibar" },
        ],
      },
    ],
  },
  { label: "Hotels & Lodges", href: "/hotels" },
  {
    label: "Our Vehicles", href: "/our-vehicles",
    mega: [
      {
        title: "Safari Vehicles",
        items: [
          { label: "Extended 4x4 Safari Landcruiser", href: "/our-vehicles/extended-4x4-safari-landcruiser" },
          { label: "Safari Tour Van", href: "/our-vehicles/safari-tour-van" },
          { label: "Overland Safari Truck", href: "/our-vehicles/overland-safari-truck" },
          { label: "Wheelchair Accessible Landcruiser", href: "/our-vehicles/wheelchair-accessible-landcruiser" },
        ],
      },
      {
        title: "Self Drive Vehicles",
        items: [
          { label: "Toyota Prado 4WD SUV", href: "/our-vehicles/toyota-prado-4wd-suv" },
          { label: "Toyota Hilux 4WD Double Cab", href: "/our-vehicles/toyota-hilux-4wd-double-cab" },
          { label: "Toyota RAV4 Mini SUV", href: "/our-vehicles/toyota-rav4-mini-suv" },
          { label: "Toyota Landcruiser V8 SUV", href: "/our-vehicles/toyota-landcruiser-v8-suv" },
        ],
      },
      {
        title: "Luxury Buses",
        items: [
          { label: "25 Seater Bus", href: "/our-vehicles/25-seater-bus" },
          { label: "33 Seater Bus", href: "/our-vehicles/33-seater-bus" },
          { label: "51 Seater Bus", href: "/our-vehicles/51-seater-bus" },
        ],
      },
    ],
  },
  { label: "Contact", href: "/contact", highlight: true },
];

const Header = () => {
  const [mobileOpen, setMobileOpen] = useState(false);
  const [openDropdown, setOpenDropdown] = useState<string | null>(null);
  const location = useLocation();

  return (
    <>
      <div className="bg-primary text-primary-foreground text-sm hidden md:block">
        <div className="container mx-auto px-4 py-2 flex justify-between items-center">
          <div className="flex items-center gap-6">
            <a href={`tel:${PHONE.replace(/\s/g, "")}`} className="flex items-center gap-1 hover:text-accent transition-colors">
              <Phone className="w-3.5 h-3.5" />{PHONE}
            </a>
            <a href={`mailto:${EMAIL}`} className="flex items-center gap-1 hover:text-accent transition-colors">
              <Mail className="w-3.5 h-3.5" />{EMAIL}
            </a>
          </div>
          <Link to="/booking" className="bg-accent text-accent-foreground px-4 py-1 rounded-full font-heading font-bold text-xs hover:brightness-110 transition-all">
            Make a Booking
          </Link>
        </div>
      </div>

      <header className="bg-popover sticky top-0 z-40 shadow-md">
        <div className="container mx-auto px-4 flex items-center justify-between h-16 lg:h-20">
          <Link to="/" className="flex-shrink-0">
            <img src={logo} alt="Roaming Africa Tours & Safaris" className="h-12 lg:h-16" />
          </Link>

          <nav className="hidden lg:flex items-center gap-1">
            {navItems.map((item) => (
              <div
                key={item.label}
                className="relative"
                onMouseEnter={() => (item.children || item.mega) && setOpenDropdown(item.label)}
                onMouseLeave={() => setOpenDropdown(null)}
              >
                <Link
                  to={item.href}
                  className={`px-3 py-2 text-sm font-heading font-medium rounded-full transition-colors flex items-center gap-1 ${
                    item.highlight
                      ? "bg-primary text-primary-foreground hover:bg-secondary"
                      : location.pathname === item.href
                        ? "text-primary bg-muted"
                        : "text-foreground hover:text-primary hover:bg-muted"
                  }`}
                >
                  {item.label}
                  {(item.children || item.mega) && <ChevronDown className="w-3.5 h-3.5" />}
                </Link>

                {item.children && openDropdown === item.label && (
                  <div className="absolute top-full left-0 w-60 bg-popover border border-border rounded-lg shadow-xl py-2 animate-fade-in-up">
                    {item.children.map((child) => (
                      <Link key={child.href + child.label} to={child.href} className="block px-4 py-2 text-sm hover:bg-muted hover:text-primary" onClick={() => setOpenDropdown(null)}>
                        {child.label}
                      </Link>
                    ))}
                  </div>
                )}

                {item.mega && openDropdown === item.label && (
                  <div
                    className={`absolute top-full right-0 bg-popover border border-border rounded-lg shadow-xl p-6 grid gap-6 animate-fade-in-up ${
                      item.mega.length === 4 ? "w-[880px] grid-cols-4" : item.mega.length === 2 ? "w-[560px] grid-cols-2" : "w-[680px] grid-cols-3"
                    }`}
                  >
                    {item.mega.map((col) => (
                      <div key={col.title}>
                        <p className="text-xs font-heading font-bold text-primary uppercase tracking-wide mb-3">{col.title}</p>
                        <ul className="space-y-1.5">
                          {col.items.map((c) => (
                            <li key={c.href + c.label}>
                              <Link to={c.href} className="block text-sm hover:text-primary" onClick={() => setOpenDropdown(null)}>
                                {c.label}
                              </Link>
                            </li>
                          ))}
                        </ul>
                      </div>
                    ))}
                  </div>
                )}
              </div>
            ))}
          </nav>

          <button className="lg:hidden p-2" onClick={() => setMobileOpen(!mobileOpen)} aria-label="Toggle menu">
            {mobileOpen ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
          </button>
        </div>

        {mobileOpen && (
          <div className="lg:hidden bg-popover border-t border-border max-h-[80vh] overflow-y-auto">
            {navItems.map((item) => (
              <div key={item.label}>
                <Link to={item.href} className="block px-4 py-3 font-heading font-medium border-b border-border hover:bg-muted" onClick={() => !(item.children || item.mega) && setMobileOpen(false)}>
                  {item.label}
                </Link>
                {item.children?.map((child) => (
                  <Link key={child.href + child.label} to={child.href} className="block px-8 py-2 text-sm text-muted-foreground border-b border-border hover:bg-muted" onClick={() => setMobileOpen(false)}>
                    {child.label}
                  </Link>
                ))}
                {item.mega?.map((col) => (
                  <div key={col.title}>
                    <p className="px-6 py-2 text-xs font-bold text-primary uppercase">{col.title}</p>
                    {col.items.map((c) => (
                      <Link key={c.href + c.label} to={c.href} className="block px-8 py-1.5 text-sm text-muted-foreground border-b border-border" onClick={() => setMobileOpen(false)}>
                        {c.label}
                      </Link>
                    ))}
                  </div>
                ))}
              </div>
            ))}
            <div className="p-4">
              <Link to="/booking" className="block text-center bg-accent text-accent-foreground py-3 rounded-full font-heading font-bold" onClick={() => setMobileOpen(false)}>
                Make a Booking
              </Link>
            </div>
          </div>
        )}
      </header>
    </>
  );
};

export default Header;
